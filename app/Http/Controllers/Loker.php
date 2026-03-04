<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use App\Models\Loker_model;
use App\Models\PendaftaranLoker_model;

class Loker extends Controller
{
    // Index - Daftar semua lowongan
    public function index()
    {
        $site_config = DB::table('konfigurasi')->first();
        
        // Ambil hanya lowongan instruktur
        $loker = DB::table('loker')
            ->where('status_loker', 'Publish')
            ->where(function($query) {
                $query->whereNull('tipe_loker')
                      ->orWhere('tipe_loker', 'instruktur');
            })
            ->where(function($query) {
                $query->whereNull('tanggal_selesai')
                      ->orWhere('tanggal_selesai', '>=', date('Y-m-d'));
            })
            ->orderBy('urutan', 'ASC')
            ->orderBy('id_loker', 'DESC')
            ->get();

        // Add S3 URLs to each loker
        foreach ($loker as $item) {
            if ($item->gambar) {
                $item->gambar_url = $this->getImageUrl($item->gambar);
            }
        }

        $data = [
            'title'         => 'Lowongan Kerja - Instruktur - ' . $site_config->namaweb,
            'deskripsi'     => 'Lowongan Kerja untuk menjadi Instruktur di ' . $site_config->namaweb,
            'keywords'      => 'lowongan kerja, instruktur, karir',
            'site_config'   => $site_config,
            'loker'         => $loker
        ];

        return view('loker.index', $data);
    }

    // Detail - Detail lowongan dan form pendaftaran
    public function detail($slug_loker)
    {
        $site_config = DB::table('konfigurasi')->first();
        
        // Ambil detail lowongan instruktur
        $loker = DB::table('loker')
            ->where('slug_loker', $slug_loker)
            ->where('status_loker', 'Publish')
            ->where(function($query) {
                $query->whereNull('tipe_loker')
                      ->orWhere('tipe_loker', 'instruktur');
            })
            ->first();

        if(!$loker) {
            return redirect('loker')->with(['warning' => 'Lowongan kerja tidak ditemukan']);
        }

        // Add S3 URL
        if ($loker->gambar) {
            $loker->gambar_url = $this->getImageUrl($loker->gambar);
        }

        // Ambil lowongan lain untuk rekomendasi
        $loker_lain = DB::table('loker')
            ->where('status_loker', 'Publish')
            ->where(function($query) {
                $query->whereNull('tipe_loker')
                      ->orWhere('tipe_loker', 'instruktur');
            })
            ->where('id_loker', '!=', $loker->id_loker)
            ->where(function($query) {
                $query->whereNull('tanggal_selesai')
                      ->orWhere('tanggal_selesai', '>=', date('Y-m-d'));
            })
            ->orderBy('id_loker', 'DESC')
            ->limit(5)
            ->get();

        // Add S3 URLs to each loker_lain
        foreach ($loker_lain as $item) {
            if ($item->gambar) {
                $item->gambar_url = $this->getImageUrl($item->gambar);
            }
        }

        $data = [
            'title'         => $loker->judul_loker . ' - ' . $site_config->namaweb,
            'deskripsi'     => $loker->deskripsi_singkat ?? strip_tags(substr($loker->isi_loker, 0, 160)),
            'keywords'      => $loker->judul_loker . ', ' . $loker->posisi,
            'site_config'   => $site_config,
            'loker'         => $loker,
            'loker_lain'    => $loker_lain
        ];

        return view('loker.detail', $data);
    }

    // Proses Pendaftaran
    public function proses_pendaftaran(Request $request)
    {
        $request->validate([
            'id_loker' => 'required|exists:loker,id_loker',
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telepon' => 'required|string|max:20',
            'whatsapp' => 'required|string|max:20',
            'cv_file' => 'required|mimes:pdf,doc,docx|max:5120', // max 5MB
        ]);

        // Cek apakah lowongan masih aktif dan tipe instruktur
        $loker = DB::table('loker')
            ->where('id_loker', $request->id_loker)
            ->where(function($query) {
                $query->whereNull('tipe_loker')
                      ->orWhere('tipe_loker', 'instruktur');
            })
            ->first();
        
        if(!$loker || $loker->status_loker != 'Publish') {
            return redirect('loker')->with(['warning' => 'Lowongan kerja tidak tersedia']);
        }

        // Upload CV
        $cv_file = null;
        if($request->hasFile('cv_file')) {
            $file = $request->file('cv_file');
            $cv_file = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
            $s3Path = 'assets/upload/file/cv/' . $cv_file;
            Storage::disk('public')->put($s3Path, file_get_contents($file->getRealPath()), 'public');
        }

        // Simpan data pendaftaran
        $data = [
            'id_loker' => $request->id_loker,
            'nama' => $request->nama,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'whatsapp' => $request->whatsapp,
            'alamat' => $request->alamat,
            'pendidikan_terakhir' => $request->pendidikan_terakhir,
            'pengalaman' => $request->pengalaman,
            'cv_file' => $cv_file,
            'catatan' => $request->catatan,
            'status_pendaftaran' => 'Baru',
            'tanggal_pendaftaran' => now(),
            'created_at' => now(),
            'updated_at' => now()
        ];

        // Jika user sudah login, simpan user_id
        if(Session::has('id_user') && Session::get('akses_level') === 'User') {
            $data['id_user'] = Session::get('id_user');
        }

        DB::table('pendaftaran_loker')->insert($data);

        return redirect('loker/detail/'.$loker->slug_loker)->with(['sukses' => 'Pendaftaran berhasil dikirim. Terima kasih atas minat Anda untuk bergabung dengan kami.']);
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
            if (strpos($path, 'assets/upload/image/loker/') === 0) {
                $oldPath = public_path('storage/' . $path);
                if (file_exists($oldPath)) {
                    return asset('storage/' . $path);
                }
            }
            // If path starts with image/loker/, try to find in local
            if (strpos($path, 'image/loker/') === 0) {
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
