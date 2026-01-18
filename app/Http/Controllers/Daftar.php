<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        // Proses pendaftaran bisa disambungkan ke sistem pemesanan yang sudah ada
        // atau kirim ke WhatsApp/Email
        $site_config = DB::table('konfigurasi')->first();
        $waNumber = isset($site_config->telepon) ? preg_replace('/\D+/', '', $site_config->telepon) : '';
        
        // Validasi
        $request->validate([
            'nama_lengkap' => 'required',
            'email' => 'required|email',
            'nomor_telepon' => 'required',
            'program' => 'required'
        ]);
        
        // Redirect ke WhatsApp dengan pesan otomatis
        if($waNumber) {
            $message = urlencode("Halo, saya ingin mendaftar program:\n\n" .
                "Nama: " . $request->nama_lengkap . "\n" .
                "Email: " . $request->email . "\n" .
                "Telepon: " . $request->nomor_telepon . "\n" .
                "Program: " . $request->program . "\n" .
                "Level Bahasa: " . ($request->level_bahasa ?? '-') . "\n" .
                "Pendidikan: " . ($request->pendidikan ?? '-'));
            
            return redirect("https://wa.me/{$waNumber}?text={$message}");
        }
        
        // Jika tidak ada WhatsApp, redirect ke kontak
        return redirect('kontak')->with('sukses', 'Terima kasih! Tim kami akan menghubungi Anda segera.');
    }
}
