<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\Berita_model;
use App\Models\HomeContent;
use App\Models\ProgramMasaDepan;
use App\Models\Industri;
use App\Models\KisahSukses;

class Home extends Controller
{
    // Homepage
    public function index()
    {
        $site_config = DB::table('konfigurasi')->first();

        if (!$site_config) {
            $site_config = (object) [
                'namaweb'   => 'Company Profile CMS',
                'tagline'   => 'Your Tagline Here',
                'deskripsi' => 'Site description',
                'keywords'  => 'keywords'
            ];
        }

        $videos  = DB::table('video')->orderBy('id_video', 'DESC')->get();
        $slider  = DB::table('galeri')
                        ->where('jenis_galeri', 'Homepage')
                        ->limit(5)
                        ->orderBy('id_galeri', 'DESC')
                        ->get();

        $layanan = DB::table('berita')
                        ->where([
                            'jenis_berita'  => 'Layanan',
                            'status_berita' => 'Publish'
                        ])
                        ->orderBy('urutan', 'ASC')
                        ->get();

        $news   = new Berita_model();
        $berita = $news->home();

        // Load data program masa depan
        $program_masa_depan = ProgramMasaDepan::publish()->ordered()->get();
        
        // Load data industri
        $industri = Industri::publish()->ordered()->get();
        
        // Load data kisah sukses
        $kisah_sukses = KisahSukses::publish()->ordered()->get();

        /**
         * ===============================
         * FIX ERROR home_contents TIDAK ADA
         * ===============================
         */
        if (Schema::hasTable('home_contents')) {
            $home_contents = HomeContent::where('active', 1)
                                ->orderBy('urutan', 'ASC')
                                ->get()
                                ->keyBy('section');
        } else {
            $home_contents = collect(); // kosong tapi aman
        }

        $data = [
            'title'         => $site_config->namaweb . ' - ' . $site_config->tagline,
            'deskripsi'     => $site_config->namaweb . ' - ' . $site_config->tagline,
            'keywords'      => $site_config->namaweb . ' - ' . $site_config->tagline,
            'slider'        => $slider,
            'site_config'   => $site_config,
            'berita'        => $berita,
            'beritas'       => $berita,
            'layanan'       => $layanan,
            'videos'        => $videos,
            'home_contents' => $home_contents,
            'program_masa_depan' => $program_masa_depan,
            'industri'      => $industri,
            'kisah_sukses'  => $kisah_sukses,
            'content'       => 'home/index_tailwind'
        ];

        return view('home', $data);
    }

    // Halaman info
    public function info()
    {
        $site_config = DB::table('konfigurasi')->first();
        $news        = new Berita_model();
        $berita      = $news->home();

        $kategori_staff = DB::table('kategori_staff')
                                ->orderBy('urutan', 'ASC')
                                ->get();

        $layanan = DB::table('berita')
                        ->where([
                            'jenis_berita'  => 'Layanan',
                            'status_berita' => 'Publish'
                        ])
                        ->orderBy('urutan', 'ASC')
                        ->get();

        $data = [
            'title'          => 'Tentang ' . $site_config->namaweb,
            'deskripsi'      => 'Tentang ' . $site_config->namaweb,
            'keywords'       => 'Tentang ' . $site_config->namaweb,
            'site_config'    => $site_config,
            'berita'         => $berita,
            'layanan'        => $layanan,
            'kategori_staff' => $kategori_staff,
            'content'        => 'home/aws'
        ];

        return view('layout/wrapper', $data);
    }

    // Kontak
    public function kontak()
    {
        $site_config = DB::table('konfigurasi')->first();

        return view('kontak', [
            'title'       => 'Menghubungi ' . $site_config->namaweb,
            'deskripsi'   => 'Kontak ' . $site_config->namaweb,
            'keywords'    => 'Kontak ' . $site_config->namaweb,
            'site_config' => $site_config
        ]);
    }

    // Kirim pesan kontak
    public function kirim_pesan(Request $request)
    {
        $request->validate([
            'nama'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'telepon' => 'required|string|max:20',
            'subjek'  => 'required|string|max:255',
            'pesan'   => 'required|string|max:2000'
        ]);

        DB::table('kontak')->insert([
            'nama'           => $request->nama,
            'email'          => $request->email,
            'telepon'        => $request->telepon,
            'subjek'         => $request->subjek,
            'pesan'          => $request->pesan,
            'tanggal_kontak' => now(),
            'status_kontak'  => 'Baru'
        ]);

        return back()->with('success', 'Pesan berhasil dikirim.');
    }
}
