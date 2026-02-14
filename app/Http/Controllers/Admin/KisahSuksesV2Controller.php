<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\KisahSukses;

class KisahSuksesV2Controller extends Controller
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
        $query = KisahSukses::orderBy('urutan', 'ASC')->orderBy('id_kisah', 'DESC');
        
        // Search
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'LIKE', "%{$search}%")
                  ->orWhere('nama_id', 'LIKE', "%{$search}%")
                  ->orWhere('nama_en', 'LIKE', "%{$search}%")
                  ->orWhere('nama_jp', 'LIKE', "%{$search}%")
                  ->orWhere('pekerjaan', 'LIKE', "%{$search}%")
                  ->orWhere('pekerjaan_id', 'LIKE', "%{$search}%")
                  ->orWhere('pekerjaan_en', 'LIKE', "%{$search}%")
                  ->orWhere('pekerjaan_jp', 'LIKE', "%{$search}%")
                  ->orWhere('lokasi', 'LIKE', "%{$search}%")
                  ->orWhere('lokasi_id', 'LIKE', "%{$search}%")
                  ->orWhere('lokasi_en', 'LIKE', "%{$search}%")
                  ->orWhere('lokasi_jp', 'LIKE', "%{$search}%")
                  ->orWhere('testimoni', 'LIKE', "%{$search}%")
                  ->orWhere('testimoni_id', 'LIKE', "%{$search}%")
                  ->orWhere('testimoni_en', 'LIKE', "%{$search}%")
                  ->orWhere('testimoni_jp', 'LIKE', "%{$search}%");
            });
        }
        
        // Filter status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }
        
        $kisah_sukses = $query->paginate($perPage)->withQueryString();
        
        $data = [
            'title' => 'Kelola Kisah Sukses - ' . $site->namaweb,
            'site' => $site,
            'kisah_sukses' => $kisah_sukses,
            'current_search' => $request->search ?? '',
            'current_status' => $request->status ?? '',
            'current_per_page' => $perPage
        ];
        
        return view('admin.v2.kisah_sukses.index', $data);
    }

    // Tambah
    public function tambah()
    {
        if (Session::get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        
        $site = DB::table('konfigurasi')->first();
        
        $data = [
            'title' => 'Tambah Kisah Sukses - ' . $site->namaweb,
            'site' => $site
        ];
        
        return view('admin.v2.kisah_sukses.tambah', $data);
    }

    // Edit
    public function edit($id_kisah)
    {
        if (Session::get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        
        $site = DB::table('konfigurasi')->first();
        $kisah = KisahSukses::find($id_kisah);
        
        if (!$kisah) {
            return redirect('admin/v2/kisah-sukses')->with(['warning' => 'Kisah sukses tidak ditemukan']);
        }
        
        $data = [
            'title' => 'Edit Kisah Sukses - ' . $site->namaweb,
            'site' => $site,
            'kisah' => $kisah
        ];
        
        return view('admin.v2.kisah_sukses.edit', $data);
    }

    // Proses Tambah
    public function tambah_proses(Request $request)
    {
        if (Session::get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        
        $request->validate([
            'nama' => 'required|string|max:255',
            'pekerjaan' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'testimoni' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'program' => 'nullable|string|max:255',
            'tahun' => 'nullable|integer|min:2000|max:' . date('Y'),
            'rating' => 'nullable|integer|min:1|max:5',
            'video_url' => 'nullable|url',
            'video_file' => 'nullable|mimes:mp4,avi,mov,wmv|max:10240',
            'urutan' => 'nullable|integer|min:0',
            'status' => 'required|in:Publish,Draft'
        ]);

        $data = $request->except(['foto', 'video_file']);

        // Upload foto
        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $s3Path = 'uploads/kisah-sukses/' . $imageName;
            Storage::disk('s3')->put($s3Path, file_get_contents($image->getRealPath()), 'public');
            $data['foto'] = $imageName;
        }

        // Upload video
        if ($request->hasFile('video_file')) {
            $video = $request->file('video_file');
            $videoName = time() . '_video_' . uniqid() . '.' . $video->getClientOriginalExtension();
            $s3Path = 'uploads/kisah-sukses/videos/' . $videoName;
            Storage::disk('s3')->put($s3Path, file_get_contents($video->getRealPath()), 'public');
            $data['video_file'] = $videoName;
        }

        $data['urutan'] = $request->urutan ?? 0;
        $data['rating'] = $request->rating ?? 5;

        KisahSukses::create($data);

        return redirect('admin/v2/kisah-sukses')->with(['sukses' => 'Kisah Sukses berhasil ditambahkan']);
    }

    // Proses Edit
    public function edit_proses(Request $request)
    {
        if (Session::get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        
        $request->validate([
            'id_kisah' => 'required|exists:kisah_sukses,id_kisah',
            'nama' => 'required|string|max:255',
            'pekerjaan' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'testimoni' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'program' => 'nullable|string|max:255',
            'tahun' => 'nullable|integer|min:2000|max:' . date('Y'),
            'rating' => 'nullable|integer|min:1|max:5',
            'video_url' => 'nullable|url',
            'video_file' => 'nullable|mimes:mp4,avi,mov,wmv|max:10240',
            'urutan' => 'nullable|integer|min:0',
            'status' => 'required|in:Publish,Draft'
        ]);

        $kisah = KisahSukses::find($request->id_kisah);
        
        if (!$kisah) {
            return redirect('admin/v2/kisah-sukses')->with(['warning' => 'Kisah sukses tidak ditemukan']);
        }

        $data = $request->except(['foto', 'video_file', 'id_kisah']);

        // Upload foto baru
        if ($request->hasFile('foto')) {
            // Hapus foto lama
            if ($kisah->foto && Storage::disk('s3')->exists('uploads/kisah-sukses/' . $kisah->foto)) {
                Storage::disk('s3')->delete('uploads/kisah-sukses/' . $kisah->foto);
            }

            $image = $request->file('foto');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $s3Path = 'uploads/kisah-sukses/' . $imageName;
            Storage::disk('s3')->put($s3Path, file_get_contents($image->getRealPath()), 'public');
            $data['foto'] = $imageName;
        }

        // Upload video baru
        if ($request->hasFile('video_file')) {
            // Hapus video lama
            if ($kisah->video_file && Storage::disk('s3')->exists('uploads/kisah-sukses/videos/' . $kisah->video_file)) {
                Storage::disk('s3')->delete('uploads/kisah-sukses/videos/' . $kisah->video_file);
            }

            $video = $request->file('video_file');
            $videoName = time() . '_video_' . uniqid() . '.' . $video->getClientOriginalExtension();
            $s3Path = 'uploads/kisah-sukses/videos/' . $videoName;
            Storage::disk('s3')->put($s3Path, file_get_contents($video->getRealPath()), 'public');
            $data['video_file'] = $videoName;
        }

        $data['urutan'] = $request->urutan ?? $kisah->urutan;
        $data['rating'] = $request->rating ?? $kisah->rating;

        $kisah->update($data);

        return redirect('admin/v2/kisah-sukses')->with(['sukses' => 'Kisah Sukses berhasil diperbarui']);
    }

    // Delete
    public function delete($id_kisah)
    {
        if (Session::get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        
        $kisah = KisahSukses::find($id_kisah);
        
        if (!$kisah) {
            return redirect('admin/v2/kisah-sukses')->with(['warning' => 'Kisah sukses tidak ditemukan']);
        }

        // Hapus foto
        if ($kisah->foto && Storage::disk('s3')->exists('uploads/kisah-sukses/' . $kisah->foto)) {
            Storage::disk('s3')->delete('uploads/kisah-sukses/' . $kisah->foto);
        }
        
        // Hapus video file
        if ($kisah->video_file && Storage::disk('s3')->exists('uploads/kisah-sukses/videos/' . $kisah->video_file)) {
            Storage::disk('s3')->delete('uploads/kisah-sukses/videos/' . $kisah->video_file);
        }
        
        $kisah->delete();

        return redirect('admin/v2/kisah-sukses')->with(['sukses' => 'Kisah Sukses berhasil dihapus']);
    }
}
