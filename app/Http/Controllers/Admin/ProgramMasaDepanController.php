<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ProgramMasaDepan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class ProgramMasaDepanController extends Controller
{
    // Main page
    public function index()
    {
        if(Session::get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']); }
        
        $site_config = DB::table('konfigurasi')->first();
        $programs = ProgramMasaDepan::orderBy('urutan', 'ASC')->orderBy('id_program', 'DESC')->get();

        $data = [
            'title'         => 'Program Masa Depan - ' . $site_config->namaweb,
            'deskripsi'     => 'Halaman Program Masa Depan - ' . $site_config->namaweb,
            'keywords'      => 'Program Masa Depan',
            'site_config'   => $site_config,
            'programs'      => $programs,
            'content'       => 'admin/program_masa_depan/index'
        ];

        return view('admin/layout/wrapper', $data);
    }

    // Add page
    public function tambah()
    {
        if(Session::get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']); }
        
        $site_config = DB::table('konfigurasi')->first();

        $data = [
            'title'         => 'Tambah Program Masa Depan - ' . $site_config->namaweb,
            'deskripsi'     => 'Tambah Program Masa Depan - ' . $site_config->namaweb,
            'keywords'      => 'Tambah Program Masa Depan',
            'site_config'   => $site_config,
            'content'       => 'admin/program_masa_depan/tambah'
        ];

        return view('admin/layout/wrapper', $data);
    }

    // Edit page
    public function edit($id_program)
    {
        if(Session::get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']); }
        
        $site_config = DB::table('konfigurasi')->first();
        $program = ProgramMasaDepan::findOrFail($id_program);

        $data = [
            'title'         => 'Edit Program Masa Depan - ' . $site_config->namaweb,
            'deskripsi'     => 'Edit Program Masa Depan - ' . $site_config->namaweb,
            'keywords'      => 'Edit Program Masa Depan',
            'site_config'   => $site_config,
            'program'       => $program,
            'content'       => 'admin/program_masa_depan/edit'
        ];

        return view('admin/layout/wrapper', $data);
    }

    // Process add
    public function tambah_proses(Request $request)
    {
        if(Session::get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']); }
        
        $request->validate([
            'judul'         => 'required|string|max:255',
            'gambar'        => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi'     => 'nullable|string',
            'lokasi'        => 'nullable|string|max:255',
            'durasi'        => 'nullable|string|max:255',
            'visa'          => 'nullable|string|max:255',
            'gaji'          => 'nullable|string|max:255',
            'sertifikat'    => 'nullable|string|max:255',
            'urutan'        => 'integer|min:0',
            'status'        => 'required|in:Publish,Draft'
        ]);

        // Upload gambar
        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $s3Path = 'uploads/program/' . $imageName;
            Storage::disk('public')->put($s3Path, file_get_contents($image->getRealPath()), 'public');
            $request->merge(['gambar' => $imageName]);
        }

        ProgramMasaDepan::create($request->all());

        return redirect('admin/program-masa-depan')->with('success', 'Program Masa Depan berhasil ditambahkan');
    }

    // Process edit
    public function edit_proses(Request $request, $id_program)
    {
        $request->validate([
            'judul'         => 'required|string|max:255',
            'gambar'        => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi'     => 'nullable|string',
            'lokasi'        => 'nullable|string|max:255',
            'durasi'        => 'nullable|string|max:255',
            'visa'          => 'nullable|string|max:255',
            'gaji'          => 'nullable|string|max:255',
            'sertifikat'    => 'nullable|string|max:255',
            'urutan'        => 'integer|min:0',
            'status'        => 'required|in:Publish,Draft'
        ]);

        $program = ProgramMasaDepan::findOrFail($id_program);
        $data = $request->except('gambar');

        // Upload gambar baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($program->gambar && Storage::disk('public')->exists('uploads/program/' . $program->gambar)) {
                Storage::disk('public')->delete('uploads/program/' . $program->gambar);
            }

            $image = $request->file('gambar');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $s3Path = 'uploads/program/' . $imageName;
            Storage::disk('public')->put($s3Path, file_get_contents($image->getRealPath()), 'public');
            $data['gambar'] = $imageName;
        }

        $program->update($data);

        return redirect('admin/program-masa-depan')->with('success', 'Program Masa Depan berhasil diperbarui');
    }

    // Delete
    public function delete($id_program)
    {
        $program = ProgramMasaDepan::findOrFail($id_program);
        
        // Hapus gambar
        if ($program->gambar && Storage::disk('public')->exists('uploads/program/' . $program->gambar)) {
            Storage::disk('public')->delete('uploads/program/' . $program->gambar);
        }
        
        $program->delete();

        return redirect('admin/program-masa-depan')->with('success', 'Program Masa Depan berhasil dihapus');
    }
}
