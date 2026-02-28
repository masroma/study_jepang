<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\Loker;
use Illuminate\Support\Str;

class LokerV2Controller extends Controller
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
        $query = Loker::orderBy('urutan', 'ASC')->orderBy('id_loker', 'DESC');
        
        // Search
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul_loker', 'LIKE', "%{$search}%")
                  ->orWhere('judul_loker_id', 'LIKE', "%{$search}%")
                  ->orWhere('judul_loker_en', 'LIKE', "%{$search}%")
                  ->orWhere('judul_loker_jp', 'LIKE', "%{$search}%")
                  ->orWhere('posisi', 'LIKE', "%{$search}%")
                  ->orWhere('posisi_id', 'LIKE', "%{$search}%")
                  ->orWhere('posisi_en', 'LIKE', "%{$search}%")
                  ->orWhere('posisi_jp', 'LIKE', "%{$search}%")
                  ->orWhere('deskripsi_singkat', 'LIKE', "%{$search}%")
                  ->orWhere('deskripsi_singkat_id', 'LIKE', "%{$search}%")
                  ->orWhere('deskripsi_singkat_en', 'LIKE', "%{$search}%")
                  ->orWhere('deskripsi_singkat_jp', 'LIKE', "%{$search}%");
            });
        }
        
        // Filter status
        if ($request->has('status') && $request->status != '') {
            $query->where('status_loker', $request->status);
        }
        
        $lokers = $query->paginate($perPage)->withQueryString();
        
        $data = [
            'title' => 'Kelola Lowongan Pekerjaan - ' . $site->namaweb,
            'site' => $site,
            'lokers' => $lokers,
            'current_search' => $request->search ?? '',
            'current_status' => $request->status ?? '',
            'current_per_page' => $perPage
        ];
        
        return view('admin.v2.loker.index', $data);
    }

    // Tambah
    public function tambah()
    {
        if (Session::get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        
        $site = DB::table('konfigurasi')->first();
        
        $data = [
            'title' => 'Tambah Lowongan Pekerjaan - ' . $site->namaweb,
            'site' => $site
        ];
        
        return view('admin.v2.loker.tambah', $data);
    }

    // Edit
    public function edit($id_loker)
    {
        if (Session::get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        
        $site = DB::table('konfigurasi')->first();
        $loker = Loker::find($id_loker);
        
        if (!$loker) {
            return redirect('admin/v2/loker')->with(['warning' => 'Lowongan pekerjaan tidak ditemukan']);
        }
        
        $data = [
            'title' => 'Edit Lowongan Pekerjaan - ' . $site->namaweb,
            'site' => $site,
            'loker' => $loker
        ];
        
        return view('admin.v2.loker.edit', $data);
    }

    // Proses Tambah
    public function tambah_proses(Request $request)
    {
        if (Session::get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        
        $request->validate([
            'judul_loker' => 'required|string|max:255',
            'posisi' => 'required|string|max:255',
            'isi_loker' => 'required|string',
            'deskripsi_singkat' => 'nullable|string',
            'lokasi_kerja' => 'nullable|string|max:255',
            'tipe_kerja' => 'nullable|string|max:255',
            'persyaratan' => 'nullable|string',
            'tanggung_jawab' => 'nullable|string',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'urutan' => 'nullable|integer|min:0',
            'status_loker' => 'required|in:Publish,Draft,Tutup'
        ]);

        $data = $request->except('gambar');
        
        // Generate slug
        $data['slug_loker'] = Str::slug($request->judul_loker);
        
        // Cek apakah slug sudah ada
        $slugExists = Loker::where('slug_loker', $data['slug_loker'])->exists();
        if ($slugExists) {
            $data['slug_loker'] = $data['slug_loker'] . '-' . time();
        }

        // Upload gambar
        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $s3Path = 'assets/upload/image/loker/' . $imageName;
            Storage::disk('public')->put($s3Path, file_get_contents($image->getRealPath()), 'public');
            $data['gambar'] = $imageName;
        }

        $data['urutan'] = $request->urutan ?? 0;

        Loker::create($data);

        return redirect('admin/v2/loker')->with(['sukses' => 'Lowongan pekerjaan berhasil ditambahkan']);
    }

    // Proses Edit
    public function edit_proses(Request $request)
    {
        if (Session::get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        
        $request->validate([
            'id_loker' => 'required|exists:loker,id_loker',
            'judul_loker' => 'required|string|max:255',
            'posisi' => 'required|string|max:255',
            'isi_loker' => 'required|string',
            'deskripsi_singkat' => 'nullable|string',
            'lokasi_kerja' => 'nullable|string|max:255',
            'tipe_kerja' => 'nullable|string|max:255',
            'persyaratan' => 'nullable|string',
            'tanggung_jawab' => 'nullable|string',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'urutan' => 'nullable|integer|min:0',
            'status_loker' => 'required|in:Publish,Draft,Tutup'
        ]);

        $loker = Loker::find($request->id_loker);
        
        if (!$loker) {
            return redirect('admin/v2/loker')->with(['warning' => 'Lowongan pekerjaan tidak ditemukan']);
        }

        $data = $request->except(['gambar', 'id_loker']);
        
        // Generate slug jika judul berubah
        if ($loker->judul_loker != $request->judul_loker) {
            $data['slug_loker'] = Str::slug($request->judul_loker);
            // Cek apakah slug sudah ada (kecuali untuk loker ini)
            $slugExists = Loker::where('slug_loker', $data['slug_loker'])->where('id_loker', '!=', $loker->id_loker)->exists();
            if ($slugExists) {
                $data['slug_loker'] = $data['slug_loker'] . '-' . time();
            }
        }

        // Upload gambar baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($loker->gambar && Storage::disk('public')->exists('assets/upload/image/loker/' . $loker->gambar)) {
                Storage::disk('public')->delete('assets/upload/image/loker/' . $loker->gambar);
            }

            $image = $request->file('gambar');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $s3Path = 'assets/upload/image/loker/' . $imageName;
            Storage::disk('public')->put($s3Path, file_get_contents($image->getRealPath()), 'public');
            $data['gambar'] = $imageName;
        }

        $data['urutan'] = $request->urutan ?? $loker->urutan;

        $loker->update($data);

        return redirect('admin/v2/loker')->with(['sukses' => 'Lowongan pekerjaan berhasil diperbarui']);
    }

    // Delete
    public function delete($id_loker)
    {
        if (Session::get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        
        $loker = Loker::find($id_loker);
        
        if (!$loker) {
            return redirect('admin/v2/loker')->with(['warning' => 'Lowongan pekerjaan tidak ditemukan']);
        }

        // Hapus gambar
        if ($loker->gambar && Storage::disk('public')->exists('assets/upload/image/loker/' . $loker->gambar)) {
            Storage::disk('public')->delete('assets/upload/image/loker/' . $loker->gambar);
        }
        
        $loker->delete();

        return redirect('admin/v2/loker')->with(['sukses' => 'Lowongan pekerjaan berhasil dihapus']);
    }
}
