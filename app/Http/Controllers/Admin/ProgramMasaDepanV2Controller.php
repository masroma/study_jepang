<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use App\Models\ProgramMasaDepan;

class ProgramMasaDepanV2Controller extends Controller
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
        $query = ProgramMasaDepan::orderBy('urutan', 'ASC')->orderBy('id_program', 'DESC');
        
        // Search
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul', 'LIKE', "%{$search}%")
                  ->orWhere('judul_id', 'LIKE', "%{$search}%")
                  ->orWhere('judul_en', 'LIKE', "%{$search}%")
                  ->orWhere('judul_jp', 'LIKE', "%{$search}%")
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
        
        $programs = $query->paginate($perPage)->withQueryString();
        
        // Add image URLs to each program safely
        $programs->getCollection()->transform(function ($program) {
            if ($program->gambar) {
                $program->image_url = $this->getImageUrl($program->gambar);
            } else {
                $program->image_url = null;
            }
            return $program;
        });
        
        $data = [
            'title' => 'Kelola Program Masa Depan - ' . $site->namaweb,
            'site' => $site,
            'programs' => $programs,
            'current_search' => $request->search ?? '',
            'current_status' => $request->status ?? '',
            'current_per_page' => $perPage
        ];
        
        return view('admin.v2.program_masa_depan.index', $data);
    }

    // Tambah
    public function tambah()
    {
        if (Session::get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        
        $site = DB::table('konfigurasi')->first();
        
        $data = [
            'title' => 'Tambah Program Masa Depan - ' . $site->namaweb,
            'site' => $site
        ];
        
        return view('admin.v2.program_masa_depan.tambah', $data);
    }

    // Edit
    public function edit($id_program)
    {
        if (Session::get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        
        $site = DB::table('konfigurasi')->first();
        $program = ProgramMasaDepan::find($id_program);
        
        if (!$program) {
            return redirect('admin/v2/program-masa-depan')->with(['warning' => 'Program tidak ditemukan']);
        }
        
        // Add image URL safely
        $program->image_url = $program->gambar ? $this->getImageUrl($program->gambar) : null;
        
        $data = [
            'title' => 'Edit Program Masa Depan - ' . $site->namaweb,
            'site' => $site,
            'program' => $program
        ];
        
        return view('admin.v2.program_masa_depan.edit', $data);
    }

    // Proses Tambah
    public function tambah_proses(Request $request)
    {
        if (Session::get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        
        $request->validate([
            'judul_id' => 'required|string|max:255',
            'judul_en' => 'nullable|string|max:255',
            'judul_jp' => 'nullable|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:5120', // Max 5MB
            'deskripsi_id' => 'nullable|string',
            'deskripsi_en' => 'nullable|string',
            'deskripsi_jp' => 'nullable|string',
            'lokasi_id' => 'nullable|string|max:255',
            'lokasi_en' => 'nullable|string|max:255',
            'lokasi_jp' => 'nullable|string|max:255',
            'durasi_id' => 'nullable|string|max:255',
            'durasi_en' => 'nullable|string|max:255',
            'durasi_jp' => 'nullable|string|max:255',
            'visa_id' => 'nullable|string|max:255',
            'visa_en' => 'nullable|string|max:255',
            'visa_jp' => 'nullable|string|max:255',
            'gaji_id' => 'nullable|string|max:255',
            'gaji_en' => 'nullable|string|max:255',
            'gaji_jp' => 'nullable|string|max:255',
            'sertifikat_id' => 'nullable|string|max:255',
            'sertifikat_en' => 'nullable|string|max:255',
            'sertifikat_jp' => 'nullable|string|max:255',
            'urutan' => 'nullable|integer|min:0',
            'status' => 'required|in:Publish,Draft'
        ]);

        $data = $request->except('gambar');
        
        // Map old field names to new multi-language fields for backward compatibility
        // If old fields exist, use them as _id
        if ($request->has('judul') && !$request->has('judul_id')) {
            $data['judul_id'] = $request->judul;
        }
        if ($request->has('deskripsi') && !$request->has('deskripsi_id')) {
            $data['deskripsi_id'] = $request->deskripsi;
        }
        if ($request->has('lokasi') && !$request->has('lokasi_id')) {
            $data['lokasi_id'] = $request->lokasi;
        }
        if ($request->has('durasi') && !$request->has('durasi_id')) {
            $data['durasi_id'] = $request->durasi;
        }
        if ($request->has('visa') && !$request->has('visa_id')) {
            $data['visa_id'] = $request->visa;
        }
        if ($request->has('gaji') && !$request->has('gaji_id')) {
            $data['gaji_id'] = $request->gaji;
        }
        if ($request->has('sertifikat') && !$request->has('sertifikat_id')) {
            $data['sertifikat_id'] = $request->sertifikat;
        }

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
                Log::info('Program gambar uploaded to S3: ' . $s3Path);
            } catch (\Exception $e) {
                Log::error('Error uploading program gambar to S3: ' . $e->getMessage());
                return redirect()->back()->withInput()->with(['warning' => 'Error mengupload gambar: ' . $e->getMessage()]);
            }
        }

        $data['urutan'] = $request->urutan ?? 0;

        ProgramMasaDepan::create($data);

        return redirect('admin/v2/program-masa-depan')->with(['sukses' => 'Program Masa Depan berhasil ditambahkan']);
    }

    // Proses Edit
    public function edit_proses(Request $request)
    {
        if (Session::get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        
        $request->validate([
            'id_program' => 'required|exists:program_masa_depan,id_program',
            'judul_id' => 'required|string|max:255',
            'judul_en' => 'nullable|string|max:255',
            'judul_jp' => 'nullable|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:5120', // Max 5MB
            'deskripsi_id' => 'nullable|string',
            'deskripsi_en' => 'nullable|string',
            'deskripsi_jp' => 'nullable|string',
            'lokasi_id' => 'nullable|string|max:255',
            'lokasi_en' => 'nullable|string|max:255',
            'lokasi_jp' => 'nullable|string|max:255',
            'durasi_id' => 'nullable|string|max:255',
            'durasi_en' => 'nullable|string|max:255',
            'durasi_jp' => 'nullable|string|max:255',
            'visa_id' => 'nullable|string|max:255',
            'visa_en' => 'nullable|string|max:255',
            'visa_jp' => 'nullable|string|max:255',
            'gaji_id' => 'nullable|string|max:255',
            'gaji_en' => 'nullable|string|max:255',
            'gaji_jp' => 'nullable|string|max:255',
            'sertifikat_id' => 'nullable|string|max:255',
            'sertifikat_en' => 'nullable|string|max:255',
            'sertifikat_jp' => 'nullable|string|max:255',
            'urutan' => 'nullable|integer|min:0',
            'status' => 'required|in:Publish,Draft'
        ]);

        $program = ProgramMasaDepan::find($request->id_program);
        
        if (!$program) {
            return redirect('admin/v2/program-masa-depan')->with(['warning' => 'Program tidak ditemukan']);
        }

        $data = $request->except(['gambar', 'id_program']);
        
        // Map old field names to new multi-language fields for backward compatibility
        if ($request->has('judul') && !$request->has('judul_id')) {
            $data['judul_id'] = $request->judul;
        }
        if ($request->has('deskripsi') && !$request->has('deskripsi_id')) {
            $data['deskripsi_id'] = $request->deskripsi;
        }
        if ($request->has('lokasi') && !$request->has('lokasi_id')) {
            $data['lokasi_id'] = $request->lokasi;
        }
        if ($request->has('durasi') && !$request->has('durasi_id')) {
            $data['durasi_id'] = $request->durasi;
        }
        if ($request->has('visa') && !$request->has('visa_id')) {
            $data['visa_id'] = $request->visa;
        }
        if ($request->has('gaji') && !$request->has('gaji_id')) {
            $data['gaji_id'] = $request->gaji;
        }
        if ($request->has('sertifikat') && !$request->has('sertifikat_id')) {
            $data['sertifikat_id'] = $request->sertifikat;
        }

        // Upload gambar baru
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            // Validate file size (5MB = 5242880 bytes)
            if ($file->getSize() > 5242880) {
                return redirect()->back()->withInput()->with(['warning' => 'Ukuran file gambar terlalu besar. Maksimal 5MB']);
            }
            // Hapus gambar lama
            if ($program->gambar) {
                try {
                    if (Storage::disk('s3')->exists($program->gambar)) {
                        Storage::disk('s3')->delete($program->gambar);
                    }
                } catch (\Exception $e) {
                    // Log error but continue - file might not exist in S3
                    Log::warning('Error checking/deleting program gambar from S3: ' . $e->getMessage() . ' - Path: ' . $program->gambar);
                }
            }
            try {
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $s3Path = 'assets/upload/image/hero/' . $filename;
                Storage::disk('s3')->put($s3Path, file_get_contents($file->getRealPath()), 'public');
                $data['gambar'] = $s3Path;
                Log::info('Program gambar (edit) uploaded to S3: ' . $s3Path);
            } catch (\Exception $e) {
                Log::error('Error uploading program gambar (edit) to S3: ' . $e->getMessage());
                return redirect()->back()->withInput()->with(['warning' => 'Error mengupload gambar: ' . $e->getMessage()]);
            }
        }

        $data['urutan'] = $request->urutan ?? $program->urutan;

        $program->update($data);

        return redirect('admin/v2/program-masa-depan')->with(['sukses' => 'Program Masa Depan berhasil diperbarui']);
    }

    // Delete
    public function delete($id_program)
    {
        if (Session::get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        
        $program = ProgramMasaDepan::find($id_program);
        
        if (!$program) {
            return redirect('admin/v2/program-masa-depan')->with(['warning' => 'Program tidak ditemukan']);
        }

        // Hapus gambar
        if ($program->gambar) {
            try {
                if (Storage::disk('s3')->exists($program->gambar)) {
                    Storage::disk('s3')->delete($program->gambar);
                }
            } catch (\Exception $e) {
                Log::warning('Error checking/deleting program gambar from S3: ' . $e->getMessage() . ' - Path: ' . $program->gambar);
            }
        }
        
        $program->delete();

        return redirect('admin/v2/program-masa-depan')->with(['sukses' => 'Program Masa Depan berhasil dihapus']);
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
            // If path starts with image/program-masa-depan/, it's old local path - try local first
            if (strpos($path, 'image/program-masa-depan/') === 0) {
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
            
            // Handle old uploads/program/ path
            if (strpos($path, 'uploads/program/') === 0) {
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
