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
        
        // Add video file URL safely
        $kisah->video_file_url = $kisah->video_file ? $this->getVideoUrl($kisah->video_file) : null;
        
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
        
        // NOTE: Table `kisah_sukses` uses single-language columns (nama, pekerjaan, lokasi, testimoni, dll).
        // Views `admin/v2/kisah_sukses/tambah|edit.blade.php` also post these fields.
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
            try {
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $s3Path = 'assets/upload/image/hero/' . $filename;
                Storage::disk('s3')->put($s3Path, file_get_contents($file->getRealPath()), 'public');
                $data['foto'] = $s3Path;
                Log::info('Kisah sukses foto uploaded to S3: ' . $s3Path);
            } catch (\Exception $e) {
                Log::error('Error uploading kisah sukses foto to S3: ' . $e->getMessage());
                return redirect()->back()->withInput()->with(['warning' => 'Error mengupload foto: ' . $e->getMessage()]);
            }
        }

        // Upload video
        if ($request->hasFile('video_file')) {
            $video = $request->file('video_file');
            // Validate file size (10MB = 10485760 bytes)
            if ($video->getSize() > 10485760) {
                return redirect()->back()->withInput()->with(['warning' => 'Ukuran file video terlalu besar. Maksimal 10MB']);
            }
            try {
                $videoName = time() . '_video_' . uniqid() . '.' . $video->getClientOriginalExtension();
                $s3Path = 'assets/upload/image/hero/videos/' . $videoName;
                Storage::disk('s3')->put($s3Path, file_get_contents($video->getRealPath()), 'public');
                $data['video_file'] = $s3Path;
                Log::info('Kisah sukses video uploaded to S3: ' . $s3Path);
            } catch (\Exception $e) {
                Log::error('Error uploading kisah sukses video to S3: ' . $e->getMessage());
                return redirect()->back()->withInput()->with(['warning' => 'Error mengupload video: ' . $e->getMessage()]);
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
                try {
                    if (Storage::disk('s3')->exists($kisah->foto)) {
                        Storage::disk('s3')->delete($kisah->foto);
                    }
                } catch (\Exception $e) {
                    // Log error but continue - file might not exist in S3
                    Log::warning('Error checking/deleting kisah sukses foto from S3: ' . $e->getMessage() . ' - Path: ' . $kisah->foto);
                }
            }
            try {
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $s3Path = 'assets/upload/image/hero/' . $filename;
                Storage::disk('s3')->put($s3Path, file_get_contents($file->getRealPath()), 'public');
                $data['foto'] = $s3Path;
                Log::info('Kisah sukses foto (edit) uploaded to S3: ' . $s3Path);
            } catch (\Exception $e) {
                Log::error('Error uploading kisah sukses foto (edit) to S3: ' . $e->getMessage());
                return redirect()->back()->withInput()->with(['warning' => 'Error mengupload foto: ' . $e->getMessage()]);
            }
        }

        // Upload video baru
        if ($request->hasFile('video_file')) {
            $video = $request->file('video_file');
            // Validate file size (10MB = 10485760 bytes)
            if ($video->getSize() > 10485760) {
                return redirect()->back()->withInput()->with(['warning' => 'Ukuran file video terlalu besar. Maksimal 10MB']);
            }
            // Hapus video lama
            if ($kisah->video_file) {
                try {
                    if (Storage::disk('s3')->exists($kisah->video_file)) {
                        Storage::disk('s3')->delete($kisah->video_file);
                    }
                } catch (\Exception $e) {
                    // Log error but continue - file might not exist in S3
                    Log::warning('Error checking/deleting kisah sukses video from S3: ' . $e->getMessage() . ' - Path: ' . $kisah->video_file);
                }
            }
            try {
                $videoName = time() . '_video_' . uniqid() . '.' . $video->getClientOriginalExtension();
                $s3Path = 'assets/upload/image/hero/videos/' . $videoName;
                Storage::disk('s3')->put($s3Path, file_get_contents($video->getRealPath()), 'public');
                $data['video_file'] = $s3Path;
                Log::info('Kisah sukses video (edit) uploaded to S3: ' . $s3Path);
            } catch (\Exception $e) {
                Log::error('Error uploading kisah sukses video (edit) to S3: ' . $e->getMessage());
                return redirect()->back()->withInput()->with(['warning' => 'Error mengupload video: ' . $e->getMessage()]);
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
            try {
                if (Storage::disk('s3')->exists($kisah->foto)) {
                    Storage::disk('s3')->delete($kisah->foto);
                }
            } catch (\Exception $e) {
                Log::warning('Error checking/deleting kisah sukses foto from S3: ' . $e->getMessage() . ' - Path: ' . $kisah->foto);
            }
        }
        
        // Hapus video file
        if ($kisah->video_file) {
            try {
                if (Storage::disk('s3')->exists($kisah->video_file)) {
                    Storage::disk('s3')->delete($kisah->video_file);
                }
            } catch (\Exception $e) {
                Log::warning('Error checking/deleting kisah sukses video from S3: ' . $e->getMessage() . ' - Path: ' . $kisah->video_file);
            }
        }
        
        $kisah->delete();

        return redirect('admin/v2/kisah-sukses')->with(['sukses' => 'Kisah Sukses berhasil dihapus']);
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
            
            // Handle old paths that might still be in database (for backward compatibility)
            // If path starts with image/kisah-sukses/, it's old local path - try local first
            if (strpos($path, 'image/kisah-sukses/') === 0 && strpos($path, '/videos/') === false) {
                $localPath = public_path($path);
                if (File::exists($localPath)) {
                    return asset($path);
                }
                // If not found locally, try to construct S3 URL anyway (might be migrated)
                // Convert old path to new S3 path format
                $s3Path = 'assets/upload/image/hero/' . basename($path);
                try {
                    if (Storage::disk('s3')->exists($s3Path)) {
                        return Storage::disk('s3')->url($s3Path);
                    }
                } catch (\Exception $e) {
                    // Ignore S3 check error for old paths
                }
                // Try direct S3 URL with old path (in case file was uploaded with old path)
                try {
                    return Storage::disk('s3')->url($path);
                } catch (\Exception $e) {
                    // Ignore if fails
                }
                return null;
            }
            
            // Handle old uploads/kisah-sukses/ path (not videos)
            if (strpos($path, 'uploads/kisah-sukses/') === 0 && strpos($path, '/videos/') === false) {
                $oldPath = public_path('storage/' . $path);
                if (File::exists($oldPath)) {
                    return asset('storage/' . $path);
                }
                // Try S3 with new path format
                $s3Path = 'assets/upload/image/hero/' . basename($path);
                try {
                    return Storage::disk('s3')->url($s3Path);
                } catch (\Exception $e) {
                    // Ignore if fails
                }
            }
            
            // For new S3 paths (assets/upload/image/hero/)
            if (strpos($path, 'assets/upload/image/hero/') === 0 && strpos($path, '/videos/') === false) {
                try {
                    // Try to check if exists in S3
                    if (Storage::disk('s3')->exists($path)) {
                        return Storage::disk('s3')->url($path);
                    }
                } catch (\Exception $e) {
                    // If check fails, still try to return URL (file might exist but check failed)
                    Log::warning('Error checking S3 file existence: ' . $e->getMessage() . ' - Path: ' . $path);
                }
                // Return S3 URL anyway (file might exist even if check failed)
                try {
                    return Storage::disk('s3')->url($path);
                } catch (\Exception $e) {
                    Log::error('Error getting S3 URL: ' . $e->getMessage() . ' - Path: ' . $path);
                }
                // Fallback to local storage check
                $oldPath = public_path('storage/' . $path);
                if (File::exists($oldPath)) {
                    return asset('storage/' . $path);
                }
                return null;
            }
            
            // For any other path, try S3 first
            try {
                return Storage::disk('s3')->url($path);
            } catch (\Exception $e) {
                Log::warning('Error getting S3 URL for path: ' . $path . ' - ' . $e->getMessage());
                return null;
            }
        } catch (\Exception $e) {
            Log::error('Error getting image URL: ' . $e->getMessage() . ' - Path: ' . $path);
            return null;
        }
    }

    /**
     * Helper function to get video URL from S3
     */
    private function getVideoUrl($path)
    {
        try {
            if (empty($path)) {
                return null;
            }
            
            // Handle old paths that might still be in database (for backward compatibility)
            // If path starts with image/kisah-sukses/videos/, it's old local path - try local first
            if (strpos($path, 'image/kisah-sukses/videos/') === 0) {
                $localPath = public_path($path);
                if (File::exists($localPath)) {
                    return asset($path);
                }
                // If not found locally, try to construct S3 URL anyway (might be migrated)
                // Convert old path to new S3 path format
                $s3Path = 'assets/upload/image/hero/videos/' . basename($path);
                try {
                    if (Storage::disk('s3')->exists($s3Path)) {
                        return Storage::disk('s3')->url($s3Path);
                    }
                } catch (\Exception $e) {
                    // Ignore S3 check error for old paths
                }
                // Try direct S3 URL with old path (in case file was uploaded with old path)
                try {
                    return Storage::disk('s3')->url($path);
                } catch (\Exception $e) {
                    // Ignore if fails
                }
                return null;
            }
            
            // Handle old uploads/kisah-sukses/videos/ path
            if (strpos($path, 'uploads/kisah-sukses/videos/') === 0) {
                $oldPath = public_path('storage/' . $path);
                if (File::exists($oldPath)) {
                    return asset('storage/' . $path);
                }
                // Try S3 with new path format
                $s3Path = 'assets/upload/image/hero/videos/' . basename($path);
                try {
                    return Storage::disk('s3')->url($s3Path);
                } catch (\Exception $e) {
                    // Ignore if fails
                }
            }
            
            // For new S3 paths (assets/upload/image/hero/videos/)
            if (strpos($path, 'assets/upload/image/hero/videos/') === 0) {
                try {
                    // Try to check if exists in S3
                    if (Storage::disk('s3')->exists($path)) {
                        return Storage::disk('s3')->url($path);
                    }
                } catch (\Exception $e) {
                    // If check fails, still try to return URL (file might exist but check failed)
                    Log::warning('Error checking S3 video file existence: ' . $e->getMessage() . ' - Path: ' . $path);
                }
                // Return S3 URL anyway (file might exist even if check failed)
                try {
                    return Storage::disk('s3')->url($path);
                } catch (\Exception $e) {
                    Log::error('Error getting S3 video URL: ' . $e->getMessage() . ' - Path: ' . $path);
                }
                // Fallback to local storage check
                $oldPath = public_path('storage/' . $path);
                if (File::exists($oldPath)) {
                    return asset('storage/' . $path);
                }
                return null;
            }
            
            // For any other path, try S3 first
            try {
                return Storage::disk('s3')->url($path);
            } catch (\Exception $e) {
                Log::warning('Error getting S3 video URL for path: ' . $path . ' - ' . $e->getMessage());
                return null;
            }
        } catch (\Exception $e) {
            Log::error('Error getting video URL: ' . $e->getMessage() . ' - Path: ' . $path);
            return null;
        }
    }
}
