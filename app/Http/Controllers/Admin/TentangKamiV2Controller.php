<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
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

        // Add image URL safely
        if ($site->gambar) {
            $site->image_url = $this->getImageUrl($site->gambar);
        } else {
            $site->image_url = null;
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
            'gambar' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:5120', // Max 5MB
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
            $file = $request->file('gambar');
            // Validate file size (5MB = 5242880 bytes)
            if ($file->getSize() > 5242880) {
                return redirect()->back()->withInput()->with(['warning' => 'Ukuran file gambar terlalu besar. Maksimal 5MB']);
            }
            // Hapus gambar lama jika ada
            if ($site->gambar && Storage::disk('s3')->exists($site->gambar)) {
                Storage::disk('s3')->delete($site->gambar);
                // Also delete thumbnail if exists
                $thumbPath = 'assets/upload/image/thumbs/' . basename($site->gambar);
                if (Storage::disk('s3')->exists($thumbPath)) {
                    Storage::disk('s3')->delete($thumbPath);
                }
            }
            
            $filenamewithextension = $file->getClientOriginalName();
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $nama_file = Str::slug($filename, '-') . '-' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            
            $s3Path = 'assets/upload/image/' . $nama_file;
            Storage::disk('s3')->put($s3Path, file_get_contents($file->getRealPath()), 'public');
            $updateData['gambar'] = $s3Path;
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
            if (strpos($path, 'assets/upload/image/') === 0) {
                $oldPath = public_path('storage/' . $path);
                if (File::exists($oldPath)) {
                    return asset('storage/' . $path);
                }
            }
            // If path starts with image/tentang-kami/, try to find in local
            if (strpos($path, 'image/tentang-kami/') === 0) {
                $localPath = public_path($path);
                if (File::exists($localPath)) {
                    return asset($path);
                }
            }
            // Return null if file doesn't exist
            return null;
        } catch (\Exception $e) {
            Log::error('Error getting image URL: ' . $e->getMessage());
            return null;
        }
    }
}
