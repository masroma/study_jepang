<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use App\Models\Produk;
use Illuminate\Support\Str;

class ProdukV2Controller extends Controller
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
        $query = Produk::orderBy('urutan', 'ASC')->orderBy('id_produk', 'DESC');
        
        // Search
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'LIKE', "%{$search}%")
                  ->orWhere('nama_id', 'LIKE', "%{$search}%")
                  ->orWhere('nama_en', 'LIKE', "%{$search}%")
                  ->orWhere('nama_jp', 'LIKE', "%{$search}%")
                  ->orWhere('kategori', 'LIKE', "%{$search}%")
                  ->orWhere('kategori_id', 'LIKE', "%{$search}%")
                  ->orWhere('kategori_en', 'LIKE', "%{$search}%")
                  ->orWhere('kategori_jp', 'LIKE', "%{$search}%")
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
        
        // Filter kategori
        if ($request->has('kategori') && $request->kategori != '') {
            $query->where(function($q) use ($request) {
                $q->where('kategori', 'LIKE', "%{$request->kategori}%")
                  ->orWhere('kategori_id', 'LIKE', "%{$request->kategori}%");
            });
        }
        
        $produks = $query->paginate($perPage)->withQueryString();
        
        // Add image URL to each produk
        $produks->getCollection()->transform(function ($produk) {
            if ($produk->gambar) {
                $produk->image_url = $this->getImageUrl($produk->gambar);
            } else {
                $produk->image_url = null;
            }
            return $produk;
        });
        
        $data = [
            'title' => 'Kelola Produk - ' . $site->namaweb,
            'site' => $site,
            'produks' => $produks,
            'current_search' => $request->search ?? '',
            'current_status' => $request->status ?? '',
            'current_kategori' => $request->kategori ?? '',
            'current_per_page' => $perPage
        ];
        
        return view('admin.v2.produk.index', $data);
    }

    // Tambah
    public function tambah()
    {
        if (Session::get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        
        $site = DB::table('konfigurasi')->first();
        
        $data = [
            'title' => 'Tambah Produk - ' . $site->namaweb,
            'site' => $site
        ];
        
        return view('admin.v2.produk.tambah', $data);
    }

    // Edit
    public function edit($id_produk)
    {
        if (Session::get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        
        $site = DB::table('konfigurasi')->first();
        $produk = Produk::find($id_produk);
        
        if (!$produk) {
            return redirect('admin/v2/produk')->with(['warning' => 'Produk tidak ditemukan']);
        }
        
        // Add image URL safely
        $produk->image_url = $produk->gambar ? $this->getImageUrl($produk->gambar) : null;
        
        $data = [
            'title' => 'Edit Produk - ' . $site->namaweb,
            'site' => $site,
            'produk' => $produk
        ];
        
        return view('admin.v2.produk.edit', $data);
    }

    // Proses Tambah
    public function tambah_proses(Request $request)
    {
        if (Session::get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        
        $request->validate([
            'nama' => 'required|string|max:255',
            'kategori' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'spesifikasi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:5120', // Max 5MB
            'moq' => 'nullable|string|max:255',
            'harga' => 'nullable|string|max:255',
            'asal' => 'nullable|string|max:255',
            'sertifikasi' => 'nullable|string|max:255',
            'kemasan' => 'nullable|string|max:255',
            'urutan' => 'nullable|integer|min:0',
            'status' => 'required|in:Publish,Draft'
        ]);

        $data = $request->except('gambar');
        
        // Generate slug
        $data['slug'] = Str::slug($request->nama);
        
        // Cek apakah slug sudah ada
        $slugExists = Produk::where('slug', $data['slug'])->exists();
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
            $s3Path = 'uploads/produk/' . $filename;
            Storage::disk('s3')->put($s3Path, file_get_contents($file->getRealPath()), 'public');
            $data['gambar'] = $s3Path;
        }

        $data['urutan'] = $request->urutan ?? 0;

        Produk::create($data);

        return redirect('admin/v2/produk')->with(['sukses' => 'Produk berhasil ditambahkan']);
    }

    // Proses Edit
    public function edit_proses(Request $request)
    {
        if (Session::get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        
        $request->validate([
            'id_produk' => 'required|exists:produk,id_produk',
            'nama' => 'required|string|max:255',
            'kategori' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'spesifikasi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:5120', // Max 5MB
            'moq' => 'nullable|string|max:255',
            'harga' => 'nullable|string|max:255',
            'asal' => 'nullable|string|max:255',
            'sertifikasi' => 'nullable|string|max:255',
            'kemasan' => 'nullable|string|max:255',
            'urutan' => 'nullable|integer|min:0',
            'status' => 'required|in:Publish,Draft'
        ]);

        $produk = Produk::find($request->id_produk);
        
        if (!$produk) {
            return redirect('admin/v2/produk')->with(['warning' => 'Produk tidak ditemukan']);
        }

        $data = $request->except(['gambar', 'id_produk']);
        
        // Generate slug jika nama berubah
        if ($produk->nama != $request->nama) {
            $data['slug'] = Str::slug($request->nama);
            // Cek apakah slug sudah ada (kecuali untuk produk ini)
            $slugExists = Produk::where('slug', $data['slug'])->where('id_produk', '!=', $produk->id_produk)->exists();
            if ($slugExists) {
                $data['slug'] = $data['slug'] . '-' . time();
            }
        }

        // Upload gambar baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($produk->gambar && Storage::disk('s3')->exists($produk->gambar)) {
                Storage::disk('s3')->delete($produk->gambar);
            }

            $file = $request->file('gambar');
            // Validate file size (5MB = 5242880 bytes)
            if ($file->getSize() > 5242880) {
                return redirect()->back()->withInput()->with(['warning' => 'Ukuran file gambar terlalu besar. Maksimal 5MB']);
            }
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $s3Path = 'uploads/produk/' . $filename;
            Storage::disk('s3')->put($s3Path, file_get_contents($file->getRealPath()), 'public');
            $data['gambar'] = $s3Path;
        }

        $data['urutan'] = $request->urutan ?? $produk->urutan;

        $produk->update($data);

        return redirect('admin/v2/produk')->with(['sukses' => 'Produk berhasil diperbarui']);
    }

    // Delete
    public function delete($id_produk)
    {
        if (Session::get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        
        $produk = Produk::find($id_produk);
        
        if (!$produk) {
            return redirect('admin/v2/produk')->with(['warning' => 'Produk tidak ditemukan']);
        }

        // Hapus gambar
        if ($produk->gambar && Storage::disk('s3')->exists($produk->gambar)) {
            Storage::disk('s3')->delete($produk->gambar);
        }
        
        $produk->delete();

        return redirect('admin/v2/produk')->with(['sukses' => 'Produk berhasil dihapus']);
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
            if (strpos($path, 'uploads/produk/') === 0) {
                $oldPath = public_path('storage/' . $path);
                if (File::exists($oldPath)) {
                    return asset('storage/' . $path);
                }
            }
            // If path starts with image/produk/, try to find in local
            if (strpos($path, 'image/produk/') === 0) {
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
