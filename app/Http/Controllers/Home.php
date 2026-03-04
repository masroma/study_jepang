<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use App\Models\Berita_model;
use App\Models\HomeContent;
use App\Models\ProgramMasaDepan;
use App\Models\Industri;
use App\Models\KisahSukses;
use App\Models\HeroSlider;

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

        // Cache queries untuk performa lebih baik
        $videos  = cache()->remember('home_videos', 3600, function() {
            return DB::table('video')->orderBy('id_video', 'DESC')->limit(1)->get();
        });
        
        // NOTE: $slider dari tabel 'galeri' - TIDAK DIGUNAKAN di home.blade.php
        // View menggunakan $hero_sliders dari tabel 'hero_sliders' (lihat baris 76-81)
        $slider  = cache()->remember('home_slider', 3600, function() {
            return DB::table('galeri')
                        ->where('jenis_galeri', 'Homepage')
                        ->limit(5)
                        ->orderBy('id_galeri', 'DESC')
                        ->get();
        });

        $layanan = cache()->remember('home_layanan', 3600, function() {
            return DB::table('berita')
                        ->where([
                            'jenis_berita'  => 'Layanan',
                            'status_berita' => 'Publish'
                        ])
                        ->orderBy('urutan', 'ASC')
                        ->limit(10)
                        ->get();
        });

        $news   = new Berita_model();
        $berita = cache()->remember('home_berita', 3600, function() use ($news) {
            return $news->home();
        });

        // Load data program masa depan dengan limit
        $program_masa_depan = cache()->remember('home_program_masa_depan', 3600, function() {
            $programs = ProgramMasaDepan::publish()->ordered()->limit(8)->get();
            // Add S3 URLs
            foreach ($programs as $program) {
                if ($program->gambar) {
                    $program->gambar_url = $this->getImageUrl($program->gambar);
                }
            }
            return $programs;
        });
        
        // Load data industri dengan limit
        $industri = cache()->remember('home_industri', 3600, function() {
            $industries = Industri::publish()->ordered()->limit(10)->get();
            // Add S3 URLs
            foreach ($industries as $item) {
                if ($item->gambar) {
                    $item->gambar_url = $this->getImageUrl($item->gambar);
                }
            }
            return $industries;
        });
        
        // Load data kisah sukses dengan limit
        $kisah_sukses = cache()->remember('home_kisah_sukses', 3600, function() {
            $kisahs = KisahSukses::publish()->ordered()->limit(6)->get();
            // Add S3 URLs
            foreach ($kisahs as $kisah) {
                if ($kisah->foto) {
                    $kisah->foto_url = $this->getImageUrl($kisah->foto);
                }
            }
            return $kisahs;
        });

        // Load hero sliders - INI YANG DIGUNAKAN di home.blade.php untuk slider homepage
        // Data diambil dari tabel 'hero_sliders', BUKAN dari tabel 'galeri'
        $hero_sliders = cache()->remember('home_hero_sliders', 3600, function() {
            if (Schema::hasTable('hero_sliders')) {
                $sliders = HeroSlider::publish()->ordered()->get();
                // Add S3 URLs
                foreach ($sliders as $slider) {
                    if ($slider->person_image) {
                        $slider->person_image_url = $this->getImageUrl($slider->person_image);
                    }
                    if ($slider->background_image) {
                        $slider->background_image_url = $this->getImageUrl($slider->background_image);
                    }
                }
                return $sliders;
            }
            return collect();
        });

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
            'slider'        => $slider, // Dari tabel 'galeri' - TIDAK DIGUNAKAN di home.blade.php
            'site_config'   => $site_config,
            'berita'        => $berita,
            'beritas'       => $berita,
            'layanan'       => $layanan,
            'videos'        => $videos,
            'home_contents' => $home_contents,
            'program_masa_depan' => $program_masa_depan,
            'industri'      => $industri,
            'kisah_sukses'  => $kisah_sukses,
            // INI YANG DIGUNAKAN untuk slider homepage - dari tabel 'hero_sliders'
            'hero_sliders'  => $hero_sliders,
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

    /**
     * Helper function to get image URL from S3
     */
    private function getImageUrl($path)
    {
        try {
            if (empty($path)) {
                return null;
            }
            // Check if file exists in S3
            if (Storage::disk('s3')->exists($path)) {
                return Storage::disk('s3')->url($path);
            }
            // Handle old paths that might still be in database (for backward compatibility)
            // Try to find in old local storage
            if (strpos($path, 'assets/upload/image/') === 0 || 
                strpos($path, 'uploads/') === 0) {
                $oldPath = public_path('storage/' . $path);
                if (file_exists($oldPath)) {
                    return asset('storage/' . $path);
                }
            }
            // If path starts with image/, try to find in local
            if (strpos($path, 'image/') === 0) {
                $localPath = public_path($path);
                if (file_exists($localPath)) {
                    return asset($path);
                }
            }
            // Return null if file doesn't exist
            return null;
        } catch (\Exception $e) {
            return null;
        }
    }
}
