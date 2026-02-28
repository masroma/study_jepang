<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
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
        
        $request->validate([
            'nama' => 'required|string|max:255',
            'sub_nama' => 'nullable|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi' => 'nullable|string',
            'urutan' => 'nullable|integer|min:0',
            'status' => 'required|in:Publish,Draft'
        ]);

        $data = $request->except('gambar');

        // Upload gambar
        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $s3Path = 'uploads/industri/' . $imageName;
            Storage::disk('public')->put($s3Path, file_get_contents($image->getRealPath()), 'public');
            $data['gambar'] = $imageName;
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
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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
            // Hapus gambar lama
            if ($industry->gambar && Storage::disk('public')->exists('uploads/industri/' . $industry->gambar)) {
                Storage::disk('public')->delete('uploads/industri/' . $industry->gambar);
            }

            $image = $request->file('gambar');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $s3Path = 'uploads/industri/' . $imageName;
            Storage::disk('public')->put($s3Path, file_get_contents($image->getRealPath()), 'public');
            $data['gambar'] = $imageName;
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
        if ($industry->gambar && Storage::disk('public')->exists('uploads/industri/' . $industry->gambar)) {
            Storage::disk('public')->delete('uploads/industri/' . $industry->gambar);
        }
        
        $industry->delete();

        return redirect('admin/v2/industri')->with(['sukses' => 'Industri berhasil dihapus']);
    }
}
