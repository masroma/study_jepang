<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Industri;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class IndustriController extends Controller
{
    // Main page
    public function index()
    {
        if(Session::get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']); }
        
        $site_config = DB::table('konfigurasi')->first();
        $industries = Industri::orderBy('urutan', 'ASC')->orderBy('id_industri', 'DESC')->get();

        $data = [
            'title'         => 'Industri - ' . $site_config->namaweb,
            'deskripsi'     => 'Halaman Industri - ' . $site_config->namaweb,
            'keywords'      => 'Industri',
            'site_config'   => $site_config,
            'industries'    => $industries,
            'content'       => 'admin/industri/index'
        ];

        return view('admin/layout/wrapper', $data);
    }

    // Add page
    public function tambah()
    {
        if(Session::get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']); }
        
        $site_config = DB::table('konfigurasi')->first();

        $data = [
            'title'         => 'Tambah Industri - ' . $site_config->namaweb,
            'deskripsi'     => 'Tambah Industri - ' . $site_config->namaweb,
            'keywords'      => 'Tambah Industri',
            'site_config'   => $site_config,
            'content'       => 'admin/industri/tambah'
        ];

        return view('admin/layout/wrapper', $data);
    }

    // Edit page
    public function edit($id_industri)
    {
        if(Session::get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']); }
        
        $site_config = DB::table('konfigurasi')->first();
        $industry = Industri::findOrFail($id_industri);

        $data = [
            'title'         => 'Edit Industri - ' . $site_config->namaweb,
            'deskripsi'     => 'Edit Industri - ' . $site_config->namaweb,
            'keywords'      => 'Edit Industri',
            'site_config'   => $site_config,
            'industry'      => $industry,
            'content'       => 'admin/industri/edit'
        ];

        return view('admin/layout/wrapper', $data);
    }

    // Process add
    public function tambah_proses(Request $request)
    {
        if(Session::get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']); }
        
        $request->validate([
            'nama'          => 'required|string|max:255',
            'sub_nama'      => 'nullable|string|max:255',
            'gambar'        => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi'     => 'nullable|string',
            'urutan'        => 'integer|min:0',
            'status'        => 'required|in:Publish,Draft'
        ]);

        // Upload gambar
        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $s3Path = 'uploads/industri/' . $imageName;
            Storage::disk('s3')->put($s3Path, file_get_contents($image->getRealPath()), 'public');
            $request->merge(['gambar' => $imageName]);
        }

        Industri::create($request->all());

        return redirect('admin/industri')->with('success', 'Industri berhasil ditambahkan');
    }

    // Process edit
    public function edit_proses(Request $request, $id_industri)
    {
        $request->validate([
            'nama'          => 'required|string|max:255',
            'sub_nama'      => 'nullable|string|max:255',
            'gambar'        => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi'     => 'nullable|string',
            'urutan'        => 'integer|min:0',
            'status'        => 'required|in:Publish,Draft'
        ]);

        $industry = Industri::findOrFail($id_industri);
        $data = $request->except('gambar');

        // Upload gambar baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($industry->gambar && Storage::disk('s3')->exists('uploads/industri/' . $industry->gambar)) {
                Storage::disk('s3')->delete('uploads/industri/' . $industry->gambar);
            }

            $image = $request->file('gambar');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $s3Path = 'uploads/industri/' . $imageName;
            Storage::disk('s3')->put($s3Path, file_get_contents($image->getRealPath()), 'public');
            $data['gambar'] = $imageName;
        }

        $industry->update($data);

        return redirect('admin/industri')->with('success', 'Industri berhasil diperbarui');
    }

    // Delete
    public function delete($id_industri)
    {
        $industry = Industri::findOrFail($id_industri);
        
        // Hapus gambar
        if ($industry->gambar && Storage::disk('s3')->exists('uploads/industri/' . $industry->gambar)) {
            Storage::disk('s3')->delete('uploads/industri/' . $industry->gambar);
        }
        
        $industry->delete();

        return redirect('admin/industri')->with('success', 'Industri berhasil dihapus');
    }
}
