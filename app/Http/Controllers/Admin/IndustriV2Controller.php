<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use App\Models\Industri;

class IndustriV2Controller extends Controller
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
        $query = Industri::orderBy('urutan', 'ASC')->orderBy('id_industri', 'DESC');
        
        // Search
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'LIKE', "%{$search}%")
                  ->orWhere('nama_id', 'LIKE', "%{$search}%")
                  ->orWhere('nama_en', 'LIKE', "%{$search}%")
                  ->orWhere('nama_jp', 'LIKE', "%{$search}%")
                  ->orWhere('sub_nama', 'LIKE', "%{$search}%")
                  ->orWhere('sub_nama_id', 'LIKE', "%{$search}%")
                  ->orWhere('sub_nama_en', 'LIKE', "%{$search}%")
                  ->orWhere('sub_nama_jp', 'LIKE', "%{$search}%")
                  ->orWhere('deskripsi', 'LIKE', "%{$search}%")
                  ->orWhere('deskripsi_id', 'LIKE', "%{$search}%")
                  ->orWhere('deskripsi_en', 'LIKE', "%{$search}%")
                  ->orWhere('deskripsi_jp', 'LIKE', "%{$search}%");
            });
        }
        
        // Filter status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }
        
        $industries = $query->paginate($perPage)->withQueryString();
        
        // Add image URLs to each industry safely
        $industries->getCollection()->transform(function ($industry) {
            if ($industry->gambar) {
                $industry->image_url = $this->getImageUrl($industry->gambar);
            } else {
                $industry->image_url = null;
            }
            return $industry;
        });
        
        $data = [
            'title' => 'Kelola Industri - ' . $site->namaweb,
            'site' => $site,
            'industries' => $industries,
            'current_search' => $request->search ?? '',
            'current_status' => $request->status ?? '',
            'current_per_page' => $perPage
        ];
        
        return view('admin.v2.industri.index', $data);
    }

    // Tambah
    public function tambah()
    {
        if (Session::get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        
        $site = DB::table('konfigurasi')->first();
        
        $data = [
            'title' => 'Tambah Industri - ' . $site->namaweb,
            'site' => $site
        ];
        
        return view('admin.v2.industri.tambah', $data);
    }

    // Edit
    public function edit($id_industri)
    {
        if (Session::get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        
        $site = DB::table('konfigurasi')->first();
        $industry = Industri::find($id_industri);
        
        if (!$industry) {
            return redirect('admin/v2/industri')->with(['warning' => 'Industri tidak ditemukan']);
        }
        
        // Add image URL safely
        $industry->image_url = $industry->gambar ? $this->getImageUrl($industry->gambar) : null;
        
        $data = [
            'title' => 'Edit Industri - ' . $site->namaweb,
            'site' => $site,
            'industry' => $industry
        ];
        
        return view('admin.v2.industri.edit', $data);
    }

    // Proses Tambah
    public function tambah_proses(Request $request)
    {
        if (Session::get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        
        // NOTE: Table `industri` uses single-language columns (nama, deskripsi, dll).
        // Views `admin/v2/industri/tambah|edit.blade.php` also post these fields.
        $request->validate([
            'nama' => 'required|string|max:255',
            'sub_nama' => 'nullable|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:5120', // Max 5MB
            'deskripsi' => 'nullable|string',
            'urutan' => 'nullable|integer|min:0',
            'status' => 'required|in:Publish,Draft'
        ]);

        $data = $request->except('gambar');

        // Upload gambar
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            // Validate file size (5MB = 5242880 bytes)
            if ($file->getSize() > 5242880) {
                return redirect()->back()->withInput()->with(['warning' => 'Ukuran file gambar terlalu besar. Maksimal 5MB']);
            }
            try {
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $s3Path = 'assets/upload/image/hero/' . $filename;
                Storage::disk('s3')->put($s3Path, file_get_contents($file->getRealPath()), 'public');
                $data['gambar'] = $s3Path;
                Log::info('Industri gambar uploaded to S3: ' . $s3Path);
            } catch (\Exception $e) {
                Log::error('Error uploading industri gambar to S3: ' . $e->getMessage());
                return redirect()->back()->withInput()->with(['warning' => 'Error mengupload gambar: ' . $e->getMessage()]);
            }
        }

        $data['urutan'] = $request->urutan ?? 0;

        Industri::create($data);

        return redirect('admin/v2/industri')->with(['sukses' => 'Industri berhasil ditambahkan']);
    }

    // Proses Edit
    public function edit_proses(Request $request)
    {
        if (Session::get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        
        $request->validate([
            'id_industri' => 'required|exists:industri,id_industri',
            'nama' => 'required|string|max:255',
            'sub_nama' => 'nullable|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:5120', // Max 5MB
            'deskripsi' => 'nullable|string',
            'urutan' => 'nullable|integer|min:0',
            'status' => 'required|in:Publish,Draft'
        ]);

        $industry = Industri::find($request->id_industri);
        
        if (!$industry) {
            return redirect('admin/v2/industri')->with(['warning' => 'Industri tidak ditemukan']);
        }

        $data = $request->except(['gambar', 'id_industri']);

        // Upload gambar baru
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            // Validate file size (5MB = 5242880 bytes)
            if ($file->getSize() > 5242880) {
                return redirect()->back()->withInput()->with(['warning' => 'Ukuran file gambar terlalu besar. Maksimal 5MB']);
            }
            // Hapus gambar lama
            if ($industry->gambar) {
                try {
                    if (Storage::disk('s3')->exists($industry->gambar)) {
                        Storage::disk('s3')->delete($industry->gambar);
                    }
                } catch (\Exception $e) {
                    // Log error but continue - file might not exist in S3
                    Log::warning('Error checking/deleting industri gambar from S3: ' . $e->getMessage() . ' - Path: ' . $industry->gambar);
                }
            }
            try {
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $s3Path = 'assets/upload/image/hero/' . $filename;
                Storage::disk('s3')->put($s3Path, file_get_contents($file->getRealPath()), 'public');
                $data['gambar'] = $s3Path;
                Log::info('Industri gambar (edit) uploaded to S3: ' . $s3Path);
            } catch (\Exception $e) {
                Log::error('Error uploading industri gambar (edit) to S3: ' . $e->getMessage());
                return redirect()->back()->withInput()->with(['warning' => 'Error mengupload gambar: ' . $e->getMessage()]);
            }
        }

        $data['urutan'] = $request->urutan ?? $industry->urutan;

        $industry->update($data);

        return redirect('admin/v2/industri')->with(['sukses' => 'Industri berhasil diperbarui']);
    }

    // Delete
    public function delete($id_industri)
    {
        if (Session::get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        
        $industry = Industri::find($id_industri);
        
        if (!$industry) {
            return redirect('admin/v2/industri')->with(['warning' => 'Industri tidak ditemukan']);
        }

        // Hapus gambar
        if ($industry->gambar) {
            try {
                if (Storage::disk('s3')->exists($industry->gambar)) {
                    Storage::disk('s3')->delete($industry->gambar);
                }
            } catch (\Exception $e) {
                Log::warning('Error checking/deleting industri gambar from S3: ' . $e->getMessage() . ' - Path: ' . $industry->gambar);
            }
        }
        
        $industry->delete();

        return redirect('admin/v2/industri')->with(['sukses' => 'Industri berhasil dihapus']);
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
            // If path starts with image/industri/, it's old local path - try local first
            if (strpos($path, 'image/industri/') === 0) {
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
            
            // Handle old uploads/industri/ path
            if (strpos($path, 'uploads/industri/') === 0) {
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
            if (strpos($path, 'assets/upload/image/hero/') === 0) {
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
}
