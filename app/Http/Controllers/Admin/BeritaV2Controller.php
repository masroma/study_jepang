<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use App\Models\Berita;
use App\Models\Kategori;
use Illuminate\Support\Str;
use Image;

class BeritaV2Controller extends Controller
{
    // Index
    public function index(Request $request)
    {
        if (Session::get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        
        $site = DB::table('konfigurasi')->first();
        
        // Filter hanya berita (bukan layanan)
        $query = Berita::with('kategori')
            ->where('jenis_berita', 'Berita')
            ->orderBy('id_berita', 'DESC');
        
        // Pencarian
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul_berita', 'LIKE', "%{$search}%")
                  ->orWhere('isi', 'LIKE', "%{$search}%");
            });
        }
        
        // Filter status
        if ($request->has('status') && $request->status != '') {
            $query->where('status_berita', $request->status);
        }
        
        // Filter kategori
        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('id_kategori', $request->kategori);
        }
        
        // Per page (default 10)
        $perPage = $request->get('per_page', 10);
        $perPage = in_array($perPage, [10, 25, 50, 100]) ? $perPage : 10;
        
        $beritas = $query->paginate($perPage)->withQueryString();
        
        // Add image URL to each berita
        $beritas->getCollection()->transform(function ($berita) {
            if ($berita->gambar) {
                $berita->image_url = $this->getImageUrl($berita->gambar);
            } else {
                $berita->image_url = null;
            }
            return $berita;
        });
        
        $kategoris = Kategori::orderBy('urutan', 'ASC')->get();
        
        // Statistik
        $stats = [
            'total' => Berita::where('jenis_berita', 'Berita')->count(),
            'publish' => Berita::where('jenis_berita', 'Berita')->where('status_berita', 'Publish')->count(),
            'draft' => Berita::where('jenis_berita', 'Berita')->where('status_berita', 'Draft')->count(),
        ];
        
        $data = [
            'title' => 'Kelola Berita - ' . $site->namaweb,
            'site' => $site,
            'beritas' => $beritas,
            'kategoris' => $kategoris,
            'stats' => $stats,
            'current_status' => $request->status ?? '',
            'current_kategori' => $request->kategori ?? '',
            'current_search' => $request->search ?? '',
            'current_per_page' => $perPage
        ];
        
        return view('admin.v2.berita.index', $data);
    }

    // Tambah
    public function tambah()
    {
        if (Session::get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        
        $site = DB::table('konfigurasi')->first();
        $kategoris = Kategori::orderBy('urutan', 'ASC')->get();
        
        $data = [
            'title' => 'Tambah Berita - ' . $site->namaweb,
            'site' => $site,
            'kategoris' => $kategoris
        ];
        
        return view('admin.v2.berita.tambah', $data);
    }

    // Edit
    public function edit($id_berita)
    {
        if (Session::get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        
        $site = DB::table('konfigurasi')->first();
        $berita = Berita::with('kategori')->find($id_berita);
        
        if (!$berita || $berita->jenis_berita != 'Berita') {
            return redirect('admin/v2/berita')->with(['warning' => 'Berita tidak ditemukan']);
        }
        
        // Add image URL safely
        $berita->image_url = $berita->gambar ? $this->getImageUrl($berita->gambar) : null;
        
        $kategoris = Kategori::orderBy('urutan', 'ASC')->get();
        
        $data = [
            'title' => 'Edit Berita - ' . $site->namaweb,
            'site' => $site,
            'berita' => $berita,
            'kategoris' => $kategoris
        ];
        
        return view('admin.v2.berita.edit', $data);
    }

    // Proses Tambah
    public function tambah_proses(Request $request)
    {
        if (Session::get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        
        $request->validate([
            'judul_berita' => 'required|string|max:255|unique:berita,judul_berita',
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:5120', // Max 5MB
            'icon' => 'nullable|string|max:255',
            'keywords' => 'nullable|string|max:500',
            'tanggal_publish' => 'nullable|date',
            'jam_publish' => 'nullable|string',
            'urutan' => 'nullable|integer|min:0',
            'status_berita' => 'required|in:Publish,Draft'
        ]);

        $data = $request->except(['gambar', 'tanggal_publish', 'jam_publish']);
        
        // Generate slug
        $data['slug_berita'] = Str::slug($request->judul_berita);
        
        // Cek apakah slug sudah ada
        $slugExists = Berita::where('slug_berita', $data['slug_berita'])->exists();
        if ($slugExists) {
            $data['slug_berita'] = $data['slug_berita'] . '-' . time();
        }

        // Upload gambar
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            // Validate file size (5MB = 5242880 bytes)
            if ($file->getSize() > 5242880) {
                return redirect()->back()->withInput()->with(['warning' => 'Ukuran file gambar terlalu besar. Maksimal 5MB']);
            }
            
            $filenamewithextension = $file->getClientOriginalName();
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $nama_file = Str::slug($filename, '-') . '-' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            
            $uploadPath = public_path('image/berita');
            $thumbPath = public_path('image/berita/thumbs');
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true);
            }
            if (!File::exists($thumbPath)) {
                File::makeDirectory($thumbPath, 0755, true);
            }
            
            // Move original image
            if ($file->move($uploadPath, $nama_file)) {
                // Create thumbnail
                try {
                    $img = Image::make($uploadPath . '/' . $nama_file)->resize(150, 150);
                    $img->save($thumbPath . '/' . $nama_file);
                } catch (\Exception $e) {
                    Log::warning('Failed to create thumbnail: ' . $e->getMessage());
                }
                $data['gambar'] = 'image/berita/' . $nama_file;
            } else {
                return redirect()->back()->withInput()->with(['warning' => 'Gagal mengupload gambar']);
            }
        }

        // Tanggal publish
        $tanggal_publish = $request->tanggal_publish ?? date('Y-m-d');
        $jam_publish = $request->jam_publish ?? date('H:i:s');
        $data['tanggal_publish'] = $tanggal_publish . ' ' . $jam_publish;
        
        $data['id_user'] = Session::get('id_user');
        $data['jenis_berita'] = 'Berita';
        $data['urutan'] = $request->urutan ?? 0;
        $data['tanggal_post'] = now();

        Berita::create($data);

        return redirect('admin/v2/berita')->with(['sukses' => 'Berita berhasil ditambahkan']);
    }

    // Proses Edit
    public function edit_proses(Request $request)
    {
        if (Session::get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        
        $request->validate([
            'id_berita' => 'required|exists:berita,id_berita',
            'judul_berita' => 'required|string|max:255|unique:berita,judul_berita,' . $request->id_berita . ',id_berita',
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:5120', // Max 5MB
            'icon' => 'nullable|string|max:255',
            'keywords' => 'nullable|string|max:500',
            'tanggal_publish' => 'nullable|date',
            'jam_publish' => 'nullable|string',
            'urutan' => 'nullable|integer|min:0',
            'status_berita' => 'required|in:Publish,Draft'
        ]);

        $berita = Berita::find($request->id_berita);
        
        if (!$berita || $berita->jenis_berita != 'Berita') {
            return redirect('admin/v2/berita')->with(['warning' => 'Berita tidak ditemukan']);
        }

        $data = $request->except(['gambar', 'id_berita', 'tanggal_publish', 'jam_publish']);
        
        // Generate slug jika judul berubah
        if ($berita->judul_berita != $request->judul_berita) {
            $data['slug_berita'] = Str::slug($request->judul_berita);
            // Cek apakah slug sudah ada (kecuali untuk berita ini)
            $slugExists = Berita::where('slug_berita', $data['slug_berita'])->where('id_berita', '!=', $berita->id_berita)->exists();
            if ($slugExists) {
                $data['slug_berita'] = $data['slug_berita'] . '-' . time();
            }
        }

        // Upload gambar baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($berita->gambar) {
                $this->deleteImage($berita->gambar);
            }

            $file = $request->file('gambar');
            // Validate file size (5MB = 5242880 bytes)
            if ($file->getSize() > 5242880) {
                return redirect()->back()->withInput()->with(['warning' => 'Ukuran file gambar terlalu besar. Maksimal 5MB']);
            }
            
            $filenamewithextension = $file->getClientOriginalName();
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $nama_file = Str::slug($filename, '-') . '-' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            
            $uploadPath = public_path('image/berita');
            $thumbPath = public_path('image/berita/thumbs');
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true);
            }
            if (!File::exists($thumbPath)) {
                File::makeDirectory($thumbPath, 0755, true);
            }
            
            // Move original image
            if ($file->move($uploadPath, $nama_file)) {
                // Create thumbnail
                try {
                    $img = Image::make($uploadPath . '/' . $nama_file)->resize(150, 150);
                    $img->save($thumbPath . '/' . $nama_file);
                } catch (\Exception $e) {
                    Log::warning('Failed to create thumbnail: ' . $e->getMessage());
                }
                $data['gambar'] = 'image/berita/' . $nama_file;
            } else {
                return redirect()->back()->withInput()->with(['warning' => 'Gagal mengupload gambar']);
            }
        }

        // Tanggal publish
        $tanggal_publish = $request->tanggal_publish ?? date('Y-m-d', strtotime($berita->tanggal_publish));
        $jam_publish = $request->jam_publish ?? date('H:i:s', strtotime($berita->tanggal_publish));
        $data['tanggal_publish'] = $tanggal_publish . ' ' . $jam_publish;
        
        $data['id_user'] = Session::get('id_user');
        $data['urutan'] = $request->urutan ?? $berita->urutan;

        $berita->update($data);

        return redirect('admin/v2/berita')->with(['sukses' => 'Berita berhasil diperbarui']);
    }

    // Delete
    public function delete($id_berita)
    {
        if (Session::get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        
        $berita = Berita::find($id_berita);
        
        if (!$berita || $berita->jenis_berita != 'Berita') {
            return redirect('admin/v2/berita')->with(['warning' => 'Berita tidak ditemukan']);
        }

        // Hapus gambar
        if ($berita->gambar) {
            $this->deleteImage($berita->gambar);
        }
        
        $berita->delete();

        return redirect('admin/v2/berita')->with(['sukses' => 'Berita berhasil dihapus']);
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
            // New path: image/berita/...
            if (strpos($path, 'image/berita/') === 0) {
                return asset($path);
            }
            // Handle old paths that might still be in database
            if (strpos($path, 'assets/upload/image/') === 0) {
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
            
            // New path: image/berita/...
            if (strpos($path, 'image/berita/') === 0) {
                $filePath = public_path($path);
                $thumbPath = public_path('image/berita/thumbs/' . basename($path));
                if (File::exists($filePath)) {
                    File::delete($filePath);
                }
                if (File::exists($thumbPath)) {
                    File::delete($thumbPath);
                }
                return true;
            }
            
            // Handle old paths
            if (strpos($path, 'assets/upload/image/') === 0) {
                $oldPath = public_path('storage/' . $path);
                $oldThumbPath = public_path('storage/assets/upload/image/thumbs/' . basename($path));
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }
                if (File::exists($oldThumbPath)) {
                    File::delete($oldThumbPath);
                }
                return true;
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
}
