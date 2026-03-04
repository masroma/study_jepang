<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use App\Models\KisahSukses;

class KisahSuksesV2Controller extends Controller
{
    // Index
    public function index(Request $request)
    {
        if (Session::get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        
        $site = DB::table('konfigurasi')->first();
        
        // Per page (default 10)
        $perPage = $request->get('per_page', 10);
        $perPage = in_array($perPage, [10, 25, 50, 100]) ? $perPage : 10;
        
        // Query
        $query = KisahSukses::orderBy('urutan', 'ASC')->orderBy('id_kisah', 'DESC');
        
        // Search
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'LIKE', "%{$search}%")
                  ->orWhere('nama_id', 'LIKE', "%{$search}%")
                  ->orWhere('nama_en', 'LIKE', "%{$search}%")
                  ->orWhere('nama_jp', 'LIKE', "%{$search}%")
                  ->orWhere('pekerjaan', 'LIKE', "%{$search}%")
                  ->orWhere('pekerjaan_id', 'LIKE', "%{$search}%")
                  ->orWhere('pekerjaan_en', 'LIKE', "%{$search}%")
                  ->orWhere('pekerjaan_jp', 'LIKE', "%{$search}%")
                  ->orWhere('lokasi', 'LIKE', "%{$search}%")
                  ->orWhere('lokasi_id', 'LIKE', "%{$search}%")
                  ->orWhere('lokasi_en', 'LIKE', "%{$search}%")
                  ->orWhere('lokasi_jp', 'LIKE', "%{$search}%")
                  ->orWhere('testimoni', 'LIKE', "%{$search}%")
                  ->orWhere('testimoni_id', 'LIKE', "%{$search}%")
                  ->orWhere('testimoni_en', 'LIKE', "%{$search}%")
                  ->orWhere('testimoni_jp', 'LIKE', "%{$search}%");
            });
        }
        
        // Filter status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }
        
        $kisah_sukses = $query->paginate($perPage)->withQueryString();
        
        // Add image URLs to each kisah sukses safely
        $kisah_sukses->getCollection()->transform(function ($kisah) {
            if ($kisah->foto) {
                $kisah->image_url = $this->getImageUrl($kisah->foto);
            } else {
                $kisah->image_url = null;
            }
            return $kisah;
        });
        
        $data = [
            'title' => 'Kelola Kisah Sukses - ' . $site->namaweb,
            'site' => $site,
            'kisah_sukses' => $kisah_sukses,
            'current_search' => $request->search ?? '',
            'current_status' => $request->status ?? '',
            'current_per_page' => $perPage
        ];
        
        return view('admin.v2.kisah_sukses.index', $data);
    }

    // Tambah
    public function tambah()
    {
        if (Session::get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        
        $site = DB::table('konfigurasi')->first();
        
        $data = [
            'title' => 'Tambah Kisah Sukses - ' . $site->namaweb,
            'site' => $site
        ];
        
        return view('admin.v2.kisah_sukses.tambah', $data);
    }

    // Edit
    public function edit($id_kisah)
    {
        if (Session::get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        
        $site = DB::table('konfigurasi')->first();
        $kisah = KisahSukses::find($id_kisah);
        
        if (!$kisah) {
            return redirect('admin/v2/kisah-sukses')->with(['warning' => 'Kisah sukses tidak ditemukan']);
        }
        
        // Add image URL safely
        $kisah->image_url = $kisah->foto ? $this->getImageUrl($kisah->foto) : null;
        
        $data = [
            'title' => 'Edit Kisah Sukses - ' . $site->namaweb,
            'site' => $site,
            'kisah' => $kisah
        ];
        
        return view('admin.v2.kisah_sukses.edit', $data);
    }

    // Proses Tambah
    public function tambah_proses(Request $request)
    {
        if (Session::get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        
        $request->validate([
            'nama' => 'required|string|max:255',
            'pekerjaan' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'testimoni' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:5120', // Max 5MB
            'program' => 'nullable|string|max:255',
            'tahun' => 'nullable|integer|min:2000|max:' . date('Y'),
            'rating' => 'nullable|integer|min:1|max:5',
            'video_url' => 'nullable|url',
            'video_file' => 'nullable|mimes:mp4,avi,mov,wmv|max:10240',
            'urutan' => 'nullable|integer|min:0',
            'status' => 'required|in:Publish,Draft'
        ]);

        $data = $request->except(['foto', 'video_file']);

        // Upload foto
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            // Validate file size (5MB = 5242880 bytes)
            if ($file->getSize() > 5242880) {
                return redirect()->back()->withInput()->with(['warning' => 'Ukuran file foto terlalu besar. Maksimal 5MB']);
            }
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $uploadPath = public_path('image/kisah-sukses');
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true);
            }
            if ($file->move($uploadPath, $filename)) {
                $data['foto'] = 'image/kisah-sukses/' . $filename;
            } else {
                return redirect()->back()->withInput()->with(['warning' => 'Gagal mengupload foto']);
            }
        }

        // Upload video
        if ($request->hasFile('video_file')) {
            $video = $request->file('video_file');
            $videoName = time() . '_video_' . uniqid() . '.' . $video->getClientOriginalExtension();
            $uploadPath = public_path('image/kisah-sukses/videos');
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true);
            }
            if ($video->move($uploadPath, $videoName)) {
                $data['video_file'] = 'image/kisah-sukses/videos/' . $videoName;
            }
        }

        $data['urutan'] = $request->urutan ?? 0;
        $data['rating'] = $request->rating ?? 5;

        KisahSukses::create($data);

        return redirect('admin/v2/kisah-sukses')->with(['sukses' => 'Kisah Sukses berhasil ditambahkan']);
    }

    // Proses Edit
    public function edit_proses(Request $request)
    {
        if (Session::get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        
        $request->validate([
            'id_kisah' => 'required|exists:kisah_sukses,id_kisah',
            'nama' => 'required|string|max:255',
            'pekerjaan' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'testimoni' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:5120', // Max 5MB
            'program' => 'nullable|string|max:255',
            'tahun' => 'nullable|integer|min:2000|max:' . date('Y'),
            'rating' => 'nullable|integer|min:1|max:5',
            'video_url' => 'nullable|url',
            'video_file' => 'nullable|mimes:mp4,avi,mov,wmv|max:10240',
            'urutan' => 'nullable|integer|min:0',
            'status' => 'required|in:Publish,Draft'
        ]);

        $kisah = KisahSukses::find($request->id_kisah);
        
        if (!$kisah) {
            return redirect('admin/v2/kisah-sukses')->with(['warning' => 'Kisah sukses tidak ditemukan']);
        }

        $data = $request->except(['foto', 'video_file', 'id_kisah']);

        // Upload foto baru
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            // Validate file size (5MB = 5242880 bytes)
            if ($file->getSize() > 5242880) {
                return redirect()->back()->withInput()->with(['warning' => 'Ukuran file foto terlalu besar. Maksimal 5MB']);
            }
            // Hapus foto lama
            if ($kisah->foto) {
                $this->deleteImage($kisah->foto);
            }
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $uploadPath = public_path('image/kisah-sukses');
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true);
            }
            if ($file->move($uploadPath, $filename)) {
                $data['foto'] = 'image/kisah-sukses/' . $filename;
            } else {
                return redirect()->back()->withInput()->with(['warning' => 'Gagal mengupload foto']);
            }
        }

        // Upload video baru
        if ($request->hasFile('video_file')) {
            // Hapus video lama
            if ($kisah->video_file) {
                $this->deleteVideo($kisah->video_file);
            }
            $video = $request->file('video_file');
            $videoName = time() . '_video_' . uniqid() . '.' . $video->getClientOriginalExtension();
            $uploadPath = public_path('image/kisah-sukses/videos');
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true);
            }
            if ($video->move($uploadPath, $videoName)) {
                $data['video_file'] = 'image/kisah-sukses/videos/' . $videoName;
            }
        }

        $data['urutan'] = $request->urutan ?? $kisah->urutan;
        $data['rating'] = $request->rating ?? $kisah->rating;

        $kisah->update($data);

        return redirect('admin/v2/kisah-sukses')->with(['sukses' => 'Kisah Sukses berhasil diperbarui']);
    }

    // Delete
    public function delete($id_kisah)
    {
        if (Session::get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        
        $kisah = KisahSukses::find($id_kisah);
        
        if (!$kisah) {
            return redirect('admin/v2/kisah-sukses')->with(['warning' => 'Kisah sukses tidak ditemukan']);
        }

        // Hapus foto
        if ($kisah->foto) {
            $this->deleteImage($kisah->foto);
        }
        
        // Hapus video file
        if ($kisah->video_file) {
            $this->deleteVideo($kisah->video_file);
        }
        
        $kisah->delete();

        return redirect('admin/v2/kisah-sukses')->with(['sukses' => 'Kisah Sukses berhasil dihapus']);
    }

    /**
     * Helper function to get image URL from public directory
     */
    private function getImageUrl($path)
    {
        try {
            if (empty($path)) {
                return null;
            }
            // New path: image/kisah-sukses/...
            if (strpos($path, 'image/kisah-sukses/') === 0) {
                return asset($path);
            }
            // Handle old paths that might still be in database
            if (strpos($path, 'uploads/kisah-sukses/') === 0 && strpos($path, '/videos/') === false) {
                // Try to find in old location first, then return asset path
                $oldPath = public_path('storage/' . $path);
                if (File::exists($oldPath)) {
                    return asset('storage/' . $path);
                }
            }
            // If path doesn't match known patterns, assume it's relative to public
            return asset($path);
        } catch (\Exception $e) {
            Log::error('Error getting image URL: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Helper function to delete image from public directory
     */
    private function deleteImage($path)
    {
        try {
            if (empty($path)) {
                return false;
            }
            
            // New path: image/kisah-sukses/...
            if (strpos($path, 'image/kisah-sukses/') === 0 && strpos($path, '/videos/') === false) {
                $filePath = public_path($path);
                if (File::exists($filePath)) {
                    return File::delete($filePath);
                }
            }
            
            // Handle old paths
            if (strpos($path, 'uploads/kisah-sukses/') === 0 && strpos($path, '/videos/') === false) {
                $oldPath = public_path('storage/' . $path);
                if (File::exists($oldPath)) {
                    return File::delete($oldPath);
                }
            } else {
                // Assume it's relative to public
                $filePath = public_path($path);
                if (File::exists($filePath)) {
                    return File::delete($filePath);
                }
            }
            
            return false;
        } catch (\Exception $e) {
            Log::error('Error deleting file: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Helper function to delete video from public directory
     */
    private function deleteVideo($path)
    {
        try {
            if (empty($path)) {
                return false;
            }
            
            // New path: image/kisah-sukses/videos/...
            if (strpos($path, 'image/kisah-sukses/videos/') === 0) {
                $filePath = public_path($path);
                if (File::exists($filePath)) {
                    return File::delete($filePath);
                }
            }
            
            // Handle old paths
            if (strpos($path, 'uploads/kisah-sukses/videos/') === 0) {
                $oldPath = public_path('storage/' . $path);
                if (File::exists($oldPath)) {
                    return File::delete($oldPath);
                }
            } else {
                // Assume it's relative to public
                $filePath = public_path($path);
                if (File::exists($filePath)) {
                    return File::delete($filePath);
                }
            }
            
            return false;
        } catch (\Exception $e) {
            Log::error('Error deleting video: ' . $e->getMessage());
            return false;
        }
    }
}
