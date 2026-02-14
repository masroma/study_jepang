<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
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
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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
            $image = $request->file('gambar');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $s3Path = 'uploads/program/' . $imageName;
            Storage::disk('s3')->put($s3Path, file_get_contents($image->getRealPath()), 'public');
            $data['gambar'] = $imageName;
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
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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
            // Hapus gambar lama
            if ($program->gambar && Storage::disk('s3')->exists('uploads/program/' . $program->gambar)) {
                Storage::disk('s3')->delete('uploads/program/' . $program->gambar);
            }

            $image = $request->file('gambar');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $s3Path = 'uploads/program/' . $imageName;
            Storage::disk('s3')->put($s3Path, file_get_contents($image->getRealPath()), 'public');
            $data['gambar'] = $imageName;
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
        if ($program->gambar && Storage::disk('s3')->exists('uploads/program/' . $program->gambar)) {
            Storage::disk('s3')->delete('uploads/program/' . $program->gambar);
        }
        
        $program->delete();

        return redirect('admin/v2/program-masa-depan')->with(['sukses' => 'Program Masa Depan berhasil dihapus']);
    }
}
