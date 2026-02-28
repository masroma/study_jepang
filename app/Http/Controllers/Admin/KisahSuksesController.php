<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\KisahSukses;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class KisahSuksesController extends Controller
{
    // Main page
    public function index()
    {
        if(Session::get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']); }
        
        $site_config = DB::table('konfigurasi')->first();
        $kisah_sukses = KisahSukses::orderBy('urutan', 'ASC')->orderBy('id_kisah', 'DESC')->get();

        $data = [
            'title'         => 'Kisah Sukses - ' . $site_config->namaweb,
            'deskripsi'     => 'Halaman Kisah Sukses - ' . $site_config->namaweb,
            'keywords'      => 'Kisah Sukses',
            'site_config'   => $site_config,
            'kisah_sukses'  => $kisah_sukses,
            'content'       => 'admin/kisah_sukses/index'
        ];

        return view('admin/layout/wrapper', $data);
    }

    // Add page
    public function tambah()
    {
        if(Session::get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']); }
        
        $site_config = DB::table('konfigurasi')->first();

        $data = [
            'title'         => 'Tambah Kisah Sukses - ' . $site_config->namaweb,
            'deskripsi'     => 'Tambah Kisah Sukses - ' . $site_config->namaweb,
            'keywords'      => 'Tambah Kisah Sukses',
            'site_config'   => $site_config,
            'content'       => 'admin/kisah_sukses/tambah'
        ];

        return view('admin/layout/wrapper', $data);
    }

    // Edit page
    public function edit($id_kisah)
    {
        if(Session::get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']); }
        
        $site_config = DB::table('konfigurasi')->first();
        $kisah = KisahSukses::findOrFail($id_kisah);

        $data = [
            'title'         => 'Edit Kisah Sukses - ' . $site_config->namaweb,
            'deskripsi'     => 'Edit Kisah Sukses - ' . $site_config->namaweb,
            'keywords'      => 'Edit Kisah Sukses',
            'site_config'   => $site_config,
            'kisah'         => $kisah,
            'content'       => 'admin/kisah_sukses/edit'
        ];

        return view('admin/layout/wrapper', $data);
    }

    // Process add
    public function tambah_proses(Request $request)
    {
        if(Session::get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']); }
        
        $request->validate([
            'nama'          => 'required|string|max:255',
            'pekerjaan'     => 'required|string|max:255',
            'lokasi'        => 'required|string|max:255',
            'testimoni'     => 'required|string',
            'foto'          => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'program'       => 'nullable|string|max:255',
            'tahun'         => 'nullable|integer|min:2000|max:' . date('Y'),
            'rating'        => 'integer|min:1|max:5',
            'video_url'     => 'nullable|url',
            'video_file'    => 'nullable|mimes:mp4,avi,mov,wmv|max:10240', // max 10MB
            'urutan'        => 'integer|min:0',
            'status'        => 'required|in:Publish,Draft'
        ]);

        // Upload foto
        $imageName = null;
        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $s3Path = 'uploads/kisah-sukses/' . $imageName;
            Storage::disk('public')->put($s3Path, file_get_contents($image->getRealPath()), 'public');
        }

        // Upload video
        $videoName = null;
        if ($request->hasFile('video_file')) {
            $video = $request->file('video_file');
            $videoName = time() . '_video.' . $video->getClientOriginalExtension();
            $s3Path = 'uploads/kisah-sukses/videos/' . $videoName;
            Storage::disk('public')->put($s3Path, file_get_contents($video->getRealPath()), 'public');
        }

        // Remove file fields from request to avoid conflicts
        $data = $request->except(['foto', 'video_file']);
        
        // Add file names if they exist
        if ($imageName) {
            $data['foto'] = $imageName;
        }
        if ($videoName) {
            $data['video_file'] = $videoName;
        }

        KisahSukses::create($data);

        // Debug: check if data was saved
        $count = KisahSukses::count();
        return redirect('admin/kisah-sukses')->with('success', "Kisah Sukses berhasil ditambahkan. Total data: {$count}");
    }

    // Process edit
    public function edit_proses(Request $request, $id_kisah)
    {
        if(Session::get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']); }
        
        $request->validate([
            'nama'          => 'required|string|max:255',
            'pekerjaan'     => 'required|string|max:255',
            'lokasi'        => 'required|string|max:255',
            'testimoni'     => 'required|string',
            'foto'          => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'program'       => 'nullable|string|max:255',
            'tahun'         => 'nullable|integer|min:2000|max:' . date('Y'),
            'rating'        => 'integer|min:1|max:5',
            'video_url'     => 'nullable|url',
            'video_file'    => 'nullable|mimes:mp4,avi,mov,wmv|max:10240', // max 10MB
            'urutan'        => 'integer|min:0',
            'status'        => 'required|in:Publish,Draft'
        ]);

        $kisah = KisahSukses::findOrFail($id_kisah);
        $data = $request->except('foto', 'video_file');

        // Upload foto baru
        if ($request->hasFile('foto')) {
            // Hapus foto lama
            if ($kisah->foto && Storage::disk('public')->exists('uploads/kisah-sukses/' . $kisah->foto)) {
                Storage::disk('public')->delete('uploads/kisah-sukses/' . $kisah->foto);
            }

            $image = $request->file('foto');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $s3Path = 'uploads/kisah-sukses/' . $imageName;
            Storage::disk('public')->put($s3Path, file_get_contents($image->getRealPath()), 'public');
            $data['foto'] = $imageName;
        }

        // Upload video baru
        if ($request->hasFile('video_file')) {
            // Hapus video lama
            if ($kisah->video_file && Storage::disk('public')->exists('uploads/kisah-sukses/videos/' . $kisah->video_file)) {
                Storage::disk('public')->delete('uploads/kisah-sukses/videos/' . $kisah->video_file);
            }

            $video = $request->file('video_file');
            $videoName = time() . '_video.' . $video->getClientOriginalExtension();
            $s3Path = 'uploads/kisah-sukses/videos/' . $videoName;
            Storage::disk('public')->put($s3Path, file_get_contents($video->getRealPath()), 'public');
            $data['video_file'] = $videoName;
        }

        $kisah->update($data);

        return redirect('admin/kisah-sukses')->with('success', 'Kisah Sukses berhasil diperbarui');
    }

    // Delete
    public function delete($id_kisah)
    {
        if(Session::get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']); }
        
        $kisah = KisahSukses::findOrFail($id_kisah);
        
        // Hapus foto
        if ($kisah->foto && Storage::disk('public')->exists('uploads/kisah-sukses/' . $kisah->foto)) {
            Storage::disk('public')->delete('uploads/kisah-sukses/' . $kisah->foto);
        }
        
        // Hapus video file
        if ($kisah->video_file && Storage::disk('public')->exists('uploads/kisah-sukses/videos/' . $kisah->video_file)) {
            Storage::disk('public')->delete('uploads/kisah-sukses/videos/' . $kisah->video_file);
        }
        
        $kisah->delete();

        return redirect('admin/kisah-sukses')->with('success', 'Kisah Sukses berhasil dihapus');
    }
}
