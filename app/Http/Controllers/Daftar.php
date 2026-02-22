<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\WhatsAppService;

class Daftar extends Controller
{
    public function index()
    {
        $site_config = DB::table('konfigurasi')->first();

        $data = array(
            'title' => 'Daftar Sekarang - ' . $site_config->namaweb,
            'deskripsi' => 'Daftar Program Belajar dan Kerja di Jepang - ' . $site_config->namaweb,
            'keywords' => 'Daftar, Pendaftaran, Program Jepang',
            'site_config' => $site_config
        );
        
        return view('daftar.index', $data);
    }
    
    public function proses(Request $request)
    {
        // Validasi
        $request->validate([
            'nama_lengkap' => 'required|string|max:50',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:6',
            'whatsapp' => 'required|string',
        ]);

        // Cek apakah email sudah terdaftar
        $existingUser = DB::table('users')
            ->where('email', $request->email)
            ->first();

        if ($existingUser) {
            return redirect('daftar')->with(['warning' => 'Email sudah terdaftar. Silakan gunakan email lain atau lakukan login.']);
        }

        try {
            // Generate username dari email (ambil bagian sebelum @)
            $emailParts = explode('@', $request->email);
            $baseUsername = $emailParts[0];
            $username = $baseUsername;
            $counter = 1;
            
            // Cek apakah username sudah ada, jika ada tambahkan angka
            while (DB::table('users')->where('username', $username)->exists()) {
                $username = $baseUsername . $counter;
                $counter++;
            }

            // Simpan user baru dengan status belum verified
            $userId = DB::table('users')->insertGetId([
                'nama' => $request->nama_lengkap,
                'email' => $request->email,
                'username' => $username,
                'password' => sha1($request->password),
                'whatsapp' => $request->whatsapp,
                'akses_level' => 'User', // Member otomatis dari registrasi web
                'email_verified' => false,
                'email_verified_at' => null,
                'tanggal' => now(),
            ]);

            // Generate 6-digit OTP
            $otp = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);

            // Store OTP in session with expiration (10 minutes)
            $request->session()->put('verification_otp', $otp);
            $request->session()->put('verification_user_id', $userId);
            $request->session()->put('verification_expires', now()->addMinutes(10)->timestamp);

            // Send OTP via WhatsApp
            $whatsappService = new WhatsAppService();
            $result = $whatsappService->sendOTP($request->whatsapp, $otp);

            if ($result['success']) {
                return redirect('daftar/verifikasi')->with([
                    'sukses' => 'Pendaftaran berhasil! Kode verifikasi telah dikirim ke WhatsApp Anda. Silakan cek pesan WhatsApp Anda.',
                    'user_id' => $userId
                ]);
            } else {
                // If WhatsApp fails, still redirect to verification but show warning
                return redirect('daftar/verifikasi')->with([
                    'warning' => 'Pendaftaran berhasil, namun gagal mengirim OTP via WhatsApp: ' . ($result['error'] ?? 'Terjadi kesalahan') . '. Silakan hubungi administrator untuk verifikasi manual.',
                    'user_id' => $userId
                ]);
            }

        } catch (\Exception $e) {
            return redirect('daftar')->with(['warning' => 'Terjadi kesalahan saat pendaftaran. Silakan coba lagi.']);
        }
    }

    public function verifikasi()
    {
        $site_config = DB::table('konfigurasi')->first();

        $data = array(
            'title' => 'Verifikasi Akun - ' . $site_config->namaweb,
            'site_config' => $site_config
        );
        
        return view('daftar.verifikasi', $data);
    }

    public function verifikasi_proses(Request $request)
    {
        $otp = $request->otp;
        $sessionOtp = $request->session()->get('verification_otp');
        $userId = $request->session()->get('verification_user_id');
        $expires = $request->session()->get('verification_expires');

        // Validasi session
        if (!$sessionOtp || !$userId || !$expires) {
            return redirect('daftar/verifikasi')->with(['error' => 'Sesi verifikasi tidak ditemukan. Silakan daftar ulang.']);
        }

        // Cek expiration
        if (now()->timestamp > $expires) {
            $request->session()->forget(['verification_otp', 'verification_user_id', 'verification_expires']);
            return redirect('daftar/verifikasi')->with(['error' => 'Kode verifikasi telah kedaluwarsa. Silakan kirim ulang kode.']);
        }

        // Validasi OTP
        if ($otp !== $sessionOtp) {
            return redirect('daftar/verifikasi')->with(['error' => 'Kode verifikasi tidak sesuai. Silakan coba lagi.']);
        }

        // Update user status to verified
        DB::table('users')
            ->where('id_user', $userId)
            ->update([
                'email_verified' => true,
                'email_verified_at' => now(),
            ]);

        // Clear session
        $request->session()->forget(['verification_otp', 'verification_user_id', 'verification_expires']);

        return redirect('login')->with(['sukses' => 'Akun Anda berhasil diverifikasi! Silakan login dengan email dan password Anda.']);
    }

    public function kirim_ulang_otp(Request $request)
    {
        $userId = $request->session()->get('verification_user_id');

        if (!$userId) {
            return redirect('daftar/verifikasi')->with(['error' => 'Sesi verifikasi tidak ditemukan. Silakan daftar ulang.']);
        }

        // Get user data
        $user = DB::table('users')->where('id_user', $userId)->first();

        if (!$user) {
            return redirect('daftar/verifikasi')->with(['error' => 'User tidak ditemukan.']);
        }

        // Generate new OTP
        $otp = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);

        // Store OTP in session with expiration (10 minutes)
        $request->session()->put('verification_otp', $otp);
        $request->session()->put('verification_expires', now()->addMinutes(10)->timestamp);

        // Send OTP via WhatsApp
        $whatsappService = new WhatsAppService();
        $result = $whatsappService->sendOTP($user->whatsapp, $otp);

        if ($result['success']) {
            return redirect('daftar/verifikasi')->with(['sukses' => 'Kode verifikasi baru telah dikirim ke WhatsApp Anda.']);
        } else {
            return redirect('daftar/verifikasi')->with(['warning' => 'Gagal mengirim OTP via WhatsApp: ' . ($result['error'] ?? 'Terjadi kesalahan') . '. Silakan hubungi administrator.']);
        }
    }
}
