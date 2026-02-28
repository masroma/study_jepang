<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
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
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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
            $image = $request->file('gambar');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $s3Path = 'uploads/layanan/' . $imageName;
            Storage::disk('public')->put($s3Path, file_get_contents($image->getRealPath()), 'public');
            $data['gambar'] = $imageName;
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
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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
            if ($layanan->gambar && Storage::disk('public')->exists('uploads/layanan/' . $layanan->gambar)) {
                Storage::disk('public')->delete('uploads/layanan/' . $layanan->gambar);
            }

            $image = $request->file('gambar');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $s3Path = 'uploads/layanan/' . $imageName;
            Storage::disk('public')->put($s3Path, file_get_contents($image->getRealPath()), 'public');
            $data['gambar'] = $imageName;
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
        if ($layanan->gambar && Storage::disk('public')->exists('uploads/layanan/' . $layanan->gambar)) {
            Storage::disk('public')->delete('uploads/layanan/' . $layanan->gambar);
        }
        
        $layanan->delete();

        return redirect('admin/v2/layanan')->with(['sukses' => 'Layanan berhasil dihapus']);
    }
}
