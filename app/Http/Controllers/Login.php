<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User_model;
use App\Helpers\Website;
use App\Services\WhatsAppService;

class Login extends Controller
{
    // Main page
    public function index()
    {
    	$site = DB::table('konfigurasi')->first();
        $data = array(  'title'     => 'Login Administrator',
    					'site'		=> $site,
                        'site_config' => $site);
        return view('login.index',$data);
    }

    // Cek
    public function check(Request $request)
    {
        $loginMethod = $request->login_method ?? 'email';
        $password    = $request->password;
        $model       = new User_model();
        $user        = null;

        // Validate password
        if (empty($password)) {
            return redirect('login')->with(['warning' => 'Password harus diisi']);
        }

        // Login berdasarkan method yang dipilih
        if ($loginMethod === 'whatsapp') {
            $whatsapp = $request->whatsapp;
            if (empty($whatsapp)) {
                return redirect('login')->with(['warning' => 'Nomor WhatsApp harus diisi']);
            }
            $user = $model->loginByWhatsApp($whatsapp, $password);
        } else {
            // Default: login dengan email
            $email = $request->email;
            if (empty($email)) {
                return redirect('login')->with(['warning' => 'Email harus diisi']);
            }
            $user = $model->loginByEmail($email, $password);
        }

        if($user) {
            // Check if user is verified (for User level only, Admin can always login)
            if ($user->akses_level === 'User' && (!isset($user->email_verified) || !$user->email_verified)) {
                return redirect('login')->with([
                    'warning' => 'Akun Anda belum diverifikasi. Silakan verifikasi akun terlebih dahulu melalui WhatsApp yang telah dikirim saat pendaftaran. Jika Anda belum menerima kode verifikasi, silakan hubungi administrator.'
                ]);
            }

            $request->session()->put('id_user', $user->id_user);
            $request->session()->put('nama', $user->nama);
            $request->session()->put('username', $user->username);
            $request->session()->put('email', $user->email ?? $user->username);
            $request->session()->put('akses_level', $user->akses_level);
            
            // Redirect berdasarkan role
            if ($user->akses_level === 'Admin') {
                return redirect('admin/v2')->with(['sukses' => 'Anda berhasil login']);
            } else {
                return redirect('member/dashboard')->with(['sukses' => 'Selamat datang di portal member']);
            }
        } else {
            $errorMessage = $loginMethod === 'whatsapp' 
                ? 'Mohon maaf, Nomor WhatsApp atau password salah'
                : 'Mohon maaf, Email atau password salah';
            return redirect('login')->with(['warning' => $errorMessage]);
        }
    }

    // Homepage
    public function logout()
    {
        Session()->forget('id_user');
        Session()->forget('nama');
        Session()->forget('username');
        Session()->forget('akses_level');
        return redirect('login')->with(['sukses' => 'Anda berhasil logout']);
    }

    // Forgot password
    public function lupa()
    {
    	$site = DB::table('konfigurasi')->first();
       	$data = array(  'title'     => 'Lupa Password',
    					'site'		=> $site,
                        'site_config' => $site);
        return view('login/lupa',$data);
    }

    // Process forgot password
    public function lupa_proses(Request $request)
    {
        $email = $request->email;
        $phone = $request->phone;

        // Validate input
        if (empty($email) || empty($phone)) {
            return redirect('login/lupa')->with(['warning' => 'Email/Username dan nomor WhatsApp harus diisi']);
        }

        // Find user by email or username
        $user = DB::table('users')
            ->where('email', $email)
            ->orWhere('username', $email)
            ->first();

        if (!$user) {
            return redirect('login/lupa')->with(['warning' => 'Email atau username tidak ditemukan']);
        }

        // Generate 6-digit OTP
        $otp = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);

        // Store OTP in session with expiration (10 minutes)
        $request->session()->put('reset_password_otp', $otp);
        $request->session()->put('reset_password_user_id', $user->id_user);
        $request->session()->put('reset_password_expires', now()->addMinutes(10)->timestamp);

        // Send OTP via WhatsApp
        $whatsappService = new WhatsAppService();
        $result = $whatsappService->sendPasswordResetOTP($phone, $otp);

        if ($result['success']) {
            return redirect('login/lupa')->with(['sukses' => 'Kode OTP telah dikirim ke WhatsApp Anda. Silakan cek pesan WhatsApp Anda.']);
        } else {
            // If WhatsApp fails, still store OTP in session but show warning
            return redirect('login/lupa')->with(['warning' => 'Gagal mengirim OTP via WhatsApp: ' . ($result['error'] ?? 'Terjadi kesalahan') . '. Silakan coba lagi atau hubungi administrator.']);
        }
    }
}
