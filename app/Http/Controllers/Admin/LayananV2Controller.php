<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use App\Models\Layanan;
use Illuminate\Support\Str;

class LayananV2Controller extends Controller
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
        $query = Layanan::orderBy('urutan', 'ASC')->orderBy('id_layanan', 'DESC');
        
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
        
        $layanans = $query->paginate($perPage)->withQueryString();
        
        // Add image URL to each layanan
        $layanans->getCollection()->transform(function ($layanan) {
            if ($layanan->gambar) {
                $layanan->image_url = $this->getImageUrl($layanan->gambar);
            } else {
                $layanan->image_url = null;
            }
            return $layanan;
        });
        
        $data = [
            'title' => 'Kelola Layanan - ' . $site->namaweb,
            'site' => $site,
            'layanans' => $layanans,
            'current_search' => $request->search ?? '',
            'current_status' => $request->status ?? '',
            'current_per_page' => $perPage
        ];
        
        return view('admin.v2.layanan.index', $data);
    }

    // Tambah
    public function tambah()
    {
        if (Session::get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        
        $site = DB::table('konfigurasi')->first();
        
        $data = [
            'title' => 'Tambah Layanan - ' . $site->namaweb,
            'site' => $site
        ];
        
        return view('admin.v2.layanan.tambah', $data);
    }

    // Edit
    public function edit($id_layanan)
    {
        if (Session::get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        
        $site = DB::table('konfigurasi')->first();
        $layanan = Layanan::find($id_layanan);
        
        if (!$layanan) {
            return redirect('admin/v2/layanan')->with(['warning' => 'Layanan tidak ditemukan']);
        }
        
        // Add image URL safely
        $layanan->image_url = $layanan->gambar ? $this->getImageUrl($layanan->gambar) : null;
        
        $data = [
            'title' => 'Edit Layanan - ' . $site->namaweb,
            'site' => $site,
            'layanan' => $layanan
        ];
        
        return view('admin.v2.layanan.edit', $data);
    }

    // Proses Tambah
    public function tambah_proses(Request $request)
    {
        if (Session::get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        
        $request->validate([
            'judul' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'fitur' => 'nullable|string',
            'lokasi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:5120', // Max 5MB
            'urutan' => 'nullable|integer|min:0',
            'status' => 'required|in:Publish,Draft'
        ]);

        $data = $request->except('gambar');
        
        // Generate slug
        $data['slug'] = Str::slug($request->judul);
        
        // Cek apakah slug sudah ada
        $slugExists = Layanan::where('slug', $data['slug'])->exists();
        if ($slugExists) {
            $data['slug'] = $data['slug'] . '-' . time();
        }

        // Upload gambar
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            // Validate file size (5MB = 5242880 bytes)
            if ($file->getSize() > 5242880) {
                return redirect()->back()->withInput()->with(['warning' => 'Ukuran file gambar terlalu besar. Maksimal 5MB']);
            }
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $s3Path = 'uploads/layanan/' . $filename;
            Storage::disk('s3')->put($s3Path, file_get_contents($file->getRealPath()), 'public');
            $data['gambar'] = $s3Path;
        }

        $data['urutan'] = $request->urutan ?? 0;

        Layanan::create($data);

        return redirect('admin/v2/layanan')->with(['sukses' => 'Layanan berhasil ditambahkan']);
    }

    // Proses Edit
    public function edit_proses(Request $request)
    {
        if (Session::get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        
        $request->validate([
            'id_layanan' => 'required|exists:layanan,id_layanan',
            'judul' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'fitur' => 'nullable|string',
            'lokasi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:5120', // Max 5MB
            'urutan' => 'nullable|integer|min:0',
            'status' => 'required|in:Publish,Draft'
        ]);

        $layanan = Layanan::find($request->id_layanan);
        
        if (!$layanan) {
            return redirect('admin/v2/layanan')->with(['warning' => 'Layanan tidak ditemukan']);
        }

        $data = $request->except(['gambar', 'id_layanan']);
        
        // Generate slug jika judul berubah
        if ($layanan->judul != $request->judul) {
            $data['slug'] = Str::slug($request->judul);
            // Cek apakah slug sudah ada (kecuali untuk layanan ini)
            $slugExists = Layanan::where('slug', $data['slug'])->where('id_layanan', '!=', $layanan->id_layanan)->exists();
            if ($slugExists) {
                $data['slug'] = $data['slug'] . '-' . time();
            }
        }

        // Upload gambar baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($layanan->gambar && Storage::disk('s3')->exists($layanan->gambar)) {
                Storage::disk('s3')->delete($layanan->gambar);
            }

            $file = $request->file('gambar');
            // Validate file size (5MB = 5242880 bytes)
            if ($file->getSize() > 5242880) {
                return redirect()->back()->withInput()->with(['warning' => 'Ukuran file gambar terlalu besar. Maksimal 5MB']);
            }
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $s3Path = 'uploads/layanan/' . $filename;
            Storage::disk('s3')->put($s3Path, file_get_contents($file->getRealPath()), 'public');
            $data['gambar'] = $s3Path;
        }

        $data['urutan'] = $request->urutan ?? $layanan->urutan;

        $layanan->update($data);

        return redirect('admin/v2/layanan')->with(['sukses' => 'Layanan berhasil diperbarui']);
    }

    // Delete
    public function delete($id_layanan)
    {
        if (Session::get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        
        $layanan = Layanan::find($id_layanan);
        
        if (!$layanan) {
            return redirect('admin/v2/layanan')->with(['warning' => 'Layanan tidak ditemukan']);
        }

        // Hapus gambar
        if ($layanan->gambar && Storage::disk('s3')->exists($layanan->gambar)) {
            Storage::disk('s3')->delete($layanan->gambar);
        }
        
        $layanan->delete();

        return redirect('admin/v2/layanan')->with(['sukses' => 'Layanan berhasil dihapus']);
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
            if (strpos($path, 'uploads/layanan/') === 0) {
                $oldPath = public_path('storage/' . $path);
                if (File::exists($oldPath)) {
                    return asset('storage/' . $path);
                }
            }
            // If path starts with image/layanan/, try to find in local
            if (strpos($path, 'image/layanan/') === 0) {
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
