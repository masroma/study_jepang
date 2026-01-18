<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Berita_model;

class KisahSukses extends Controller
{
    public function index()
    {
        $site_config = DB::table('konfigurasi')->first();
        
        // Ambil data testimoni/kisah sukses dari berita dengan kategori tertentu atau staff
        // Bisa juga dari video testimoni atau galeri
        $testimoni = DB::table('berita')
            ->where('status_berita', 'Publish')
            ->where(function($query) {
                $query->where('judul_berita', 'like', '%testimoni%')
                      ->orWhere('judul_berita', 'like', '%kisah%')
                      ->orWhere('judul_berita', 'like', '%sukses%')
                      ->orWhere('keywords', 'like', '%testimoni%');
            })
            ->orderBy('id_berita', 'DESC')
            ->limit(6)
            ->get();
        
        // Jika tidak ada, ambil dari staff atau video
        if($testimoni->isEmpty()) {
            $testimoni = DB::table('staff')
                ->where('status_staff', 'Publish')
                ->orderBy('id_staff', 'DESC')
                ->limit(6)
                ->get();
        }
        
        // Ambil video testimoni jika ada
        $video_testimoni = DB::table('video')
            ->where('judul', 'like', '%testimoni%')
            ->orWhere('judul', 'like', '%kisah%')
            ->orderBy('id_video', 'DESC')
            ->limit(3)
            ->get();

        $data = array(
            'title' => 'Kisah Sukses - ' . $site_config->namaweb,
            'deskripsi' => 'Kisah Sukses Alumni - ' . $site_config->namaweb,
            'keywords' => 'Kisah Sukses, Testimoni, Alumni',
            'site_config' => $site_config,
            'testimoni' => $testimoni,
            'video_testimoni' => $video_testimoni
        );
        
        return view('kisah-sukses', $data);
    }
}
