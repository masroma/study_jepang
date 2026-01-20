<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Berita_model;

class TrainingCenter extends Controller
{
    public function index()
    {
        $site_config = DB::table('konfigurasi')->first();
        
        // Ambil data program training dari berita jenis 'Layanan'
        $programs_berita = DB::table('berita')
            ->where('jenis_berita', 'Layanan')
            ->where('status_berita', 'Publish')
            ->orderBy('urutan', 'ASC')
            ->get();
        
        // Ambil data agenda untuk training
        $programs_agenda = DB::table('agenda')
            ->where('status_agenda', 'Publish')
            ->orderBy('id_agenda', 'DESC')
            ->get();
        
        // Gabungkan dan urutkan berdasarkan tanggal atau urutan
        $programs = $programs_berita->merge($programs_agenda)->sortByDesc('tanggal_publish')->take(6);
        
        // Ambil testimoni siswa training
        $testimoni_training = DB::table('berita')
            ->where('status_berita', 'Publish')
            ->where(function($query) {
                $query->where('judul_berita', 'like', '%training%')
                      ->orWhere('judul_berita', 'like', '%pelatihan%')
                      ->orWhere('keywords', 'like', '%training%');
            })
            ->orderBy('id_berita', 'DESC')
            ->limit(2)
            ->get();
        
        // Ambil data video untuk training center (jika ada)
        $videos = DB::table('video')->orderBy('id_video', 'DESC')->get();

        $data = array(
            'title' => 'Training Center - ' . $site_config->namaweb,
            'deskripsi' => 'Training Center Pelatihan Bahasa Jepang - ' . $site_config->namaweb,
            'keywords' => 'Training Center, Pelatihan Bahasa Jepang, JLPT',
            'site_config' => $site_config,
            'programs' => $programs,
            'testimoni_training' => $testimoni_training,
            'videos' => $videos
        );
        
        return view('training-center', $data);
    }
}
