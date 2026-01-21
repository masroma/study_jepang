<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Loker_model;
use App\Models\PendaftaranLoker_model;
use Illuminate\Support\Facades\Storage;

class Loker extends Controller
{
    // Index - Daftar semua lowongan
    public function index()
    {
        $site_config = DB::table('konfigurasi')->first();
        $myloker = new Loker_model();
        $loker = $myloker->publik();

        $data = [
            'title'         => 'Lowongan Kerja - Instruktur - ' . $site_config->namaweb,
            'deskripsi'     => 'Lowongan Kerja untuk menjadi Instruktur di ' . $site_config->namaweb,
            'keywords'      => 'lowongan kerja, instruktur, karir',
            'site_config'   => $site_config,
            'loker'         => $loker,
            'content'       => 'loker/index'
        ];

        return view('layout/wrapper', $data);
    }

    // Detail - Detail lowongan dan form pendaftaran
    public function detail($slug_loker)
    {
        $site_config = DB::table('konfigurasi')->first();
        $myloker = new Loker_model();
        $loker = $myloker->detail_slug($slug_loker);

        if(!$loker) {
            return redirect('loker')->with(['warning' => 'Lowongan kerja tidak ditemukan']);
        }

        // Ambil lowongan lain untuk rekomendasi
        $myloker_all = new Loker_model();
        $loker_lain = DB::table('loker')
            ->where('status_loker', 'Publish')
            ->where('id_loker', '!=', $loker->id_loker)
            ->where(function($query) {
                $query->whereNull('tanggal_selesai')
                      ->orWhere('tanggal_selesai', '>=', date('Y-m-d'));
            })
            ->orderBy('id_loker', 'DESC')
            ->limit(5)
            ->get();

        $data = [
            'title'         => $loker->judul_loker . ' - ' . $site_config->namaweb,
            'deskripsi'     => $loker->deskripsi_singkat ?? strip_tags(substr($loker->isi_loker, 0, 160)),
            'keywords'      => $loker->judul_loker . ', ' . $loker->posisi,
            'site_config'   => $site_config,
            'loker'         => $loker,
            'loker_lain'    => $loker_lain,
            'content'       => 'loker/detail'
        ];

        return view('layout/wrapper', $data);
    }

    // Proses Pendaftaran
    public function proses_pendaftaran(Request $request)
    {
        $request->validate([
            'id_loker' => 'required|exists:loker,id_loker',
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telepon' => 'required|string|max:20',
            'cv_file' => 'required|mimes:pdf,doc,docx|max:5120', // max 5MB
        ]);

        // Cek apakah lowongan masih aktif
        $myloker = new Loker_model();
        $loker = $myloker->detail($request->id_loker);
        
        if(!$loker || $loker->status_loker != 'Publish') {
            return redirect('loker')->with(['warning' => 'Lowongan kerja tidak tersedia']);
        }

        // Upload CV
        $cv_file = null;
        if($request->hasFile('cv_file')) {
            $file = $request->file('cv_file');
            $cv_file = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
            $s3Path = 'assets/upload/file/cv/' . $cv_file;
            Storage::disk('s3')->put($s3Path, file_get_contents($file->getRealPath()), 'public');
        }

        // Simpan data pendaftaran
        $data = [
            'id_loker' => $request->id_loker,
            'nama' => $request->nama,
            'email' => $request->email,
            'telepon' => $request->telepon,
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

        DB::table('pendaftaran_loker')->insert($data);

        return redirect('loker/detail/'.$loker->slug_loker)->with(['sukses' => 'Pendaftaran berhasil dikirim. Terima kasih atas minat Anda untuk bergabung dengan kami.']);
    }
}
