<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TentangKamiV2Controller extends Controller
{
    // Index - Tampilkan form tentang kami
    public function index()
    {
        if (Session::get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }

        $site = DB::table('konfigurasi')->first();
        
        if (!$site) {
            // Buat data default jika belum ada
            $insertData = [
                'namaweb' => 'Meghantara Global Group',
                'nama_singkat' => 'MEGHANTARA',
                'tagline' => 'Study & Work in Japan',
                'bahasa' => 'ID'
            ];
            
            $id = DB::table('konfigurasi')->insertGetId($insertData);
            $site = DB::table('konfigurasi')->where('id_konfigurasi', $id)->first();
        }

        $data = [
            'title' => 'Kelola Tentang Kami - ' . $site->namaweb,
            'site' => $site
        ];

        return view('admin.v2.tentang_kami.index', $data);
    }

    // Update Tentang Kami
    public function update(Request $request)
    {
        if (Session::get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }

        $request->validate([
            'id_konfigurasi' => 'required|exists:konfigurasi,id_konfigurasi',
            'nama_singkat' => 'nullable|string|max:200',
            'tentang' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
            'sejarah' => 'nullable|string',
            'nilai_perusahaan' => 'nullable|string',
        ]);

        $site = DB::table('konfigurasi')->where('id_konfigurasi', $request->id_konfigurasi)->first();
        
        if (!$site) {
            return redirect('admin/v2/tentang-kami')->with(['warning' => 'Data tidak ditemukan']);
        }

        $updateData = [
            'nama_singkat' => $request->nama_singkat,
            'tentang' => $request->tentang,
            'id_user' => Session::get('id_user')
        ];

        // Upload gambar
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($site->gambar && Storage::disk('s3')->exists('assets/upload/image/' . $site->gambar)) {
                Storage::disk('s3')->delete('assets/upload/image/' . $site->gambar);
                // Hapus thumbnail juga jika ada
                if (Storage::disk('s3')->exists('assets/upload/image/thumbs/' . $site->gambar)) {
                    Storage::disk('s3')->delete('assets/upload/image/thumbs/' . $site->gambar);
                }
            }

            $image = $request->file('gambar');
            $filenamewithextension = $image->getClientOriginalName();
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $nama_file = Str::slug($filename, '-') . '-' . time() . '.' . $image->getClientOriginalExtension();
            
            // Upload ke S3
            $s3Path = 'assets/upload/image/' . $nama_file;
            Storage::disk('s3')->put($s3Path, file_get_contents($image->getRealPath()), 'public');
            
            $updateData['gambar'] = $nama_file;
        }

        // Update field tambahan jika ada di database
        // Cek apakah kolom visi, misi, sejarah, nilai_perusahaan ada
        $columns = DB::select("SHOW COLUMNS FROM konfigurasi LIKE 'visi'");
        if (count($columns) > 0 && $request->visi) {
            $updateData['visi'] = $request->visi;
        }

        $columns = DB::select("SHOW COLUMNS FROM konfigurasi LIKE 'misi'");
        if (count($columns) > 0 && $request->misi) {
            $updateData['misi'] = $request->misi;
        }

        $columns = DB::select("SHOW COLUMNS FROM konfigurasi LIKE 'sejarah'");
        if (count($columns) > 0 && $request->sejarah) {
            $updateData['sejarah'] = $request->sejarah;
        }

        $columns = DB::select("SHOW COLUMNS FROM konfigurasi LIKE 'nilai_perusahaan'");
        if (count($columns) > 0 && $request->nilai_perusahaan) {
            $updateData['nilai_perusahaan'] = $request->nilai_perusahaan;
        }

        DB::table('konfigurasi')
            ->where('id_konfigurasi', $request->id_konfigurasi)
            ->update($updateData);

        return redirect('admin/v2/tentang-kami')->with(['sukses' => 'Tentang Kami berhasil diupdate']);
    }
}
