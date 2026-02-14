<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\PendaftaranLoker;
use App\Models\Loker;

class PendaftaranLokerV2Controller extends Controller
{
    // Index
    public function index(Request $request)
    {
        if (Session::get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        
        $site = DB::table('konfigurasi')->first();
        
        // Filter berdasarkan status atau pencarian
        $query = PendaftaranLoker::with('loker')
            ->join('loker', 'loker.id_loker', '=', 'pendaftaran_loker.id_loker')
            ->select('pendaftaran_loker.*', 'loker.judul_loker', 'loker.posisi');
        
        // Filter status
        if ($request->has('status') && $request->status != '') {
            $query->where('pendaftaran_loker.status_pendaftaran', $request->status);
        }
        
        // Pencarian
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('pendaftaran_loker.nama', 'LIKE', "%{$search}%")
                  ->orWhere('pendaftaran_loker.email', 'LIKE', "%{$search}%")
                  ->orWhere('loker.judul_loker', 'LIKE', "%{$search}%");
            });
        }
        
        // Per page (default 10)
        $perPage = $request->get('per_page', 10);
        $perPage = in_array($perPage, [10, 25, 50, 100]) ? $perPage : 10;
        
        $pelamars = $query->orderBy('pendaftaran_loker.id_pendaftaran', 'DESC')
            ->paginate($perPage)->withQueryString();
        
        // Statistik
        $stats = [
            'total' => PendaftaranLoker::count(),
            'baru' => PendaftaranLoker::where('status_pendaftaran', 'Baru')->count(),
            'dibaca' => PendaftaranLoker::where('status_pendaftaran', 'Dibaca')->count(),
            'diproses' => PendaftaranLoker::where('status_pendaftaran', 'Diproses')->count(),
            'diterima' => PendaftaranLoker::where('status_pendaftaran', 'Diterima')->count(),
            'ditolak' => PendaftaranLoker::where('status_pendaftaran', 'Ditolak')->count(),
        ];
        
        $data = [
            'title' => 'Kelola Pelamar - ' . $site->namaweb,
            'site' => $site,
            'pelamars' => $pelamars,
            'stats' => $stats,
            'current_status' => $request->status ?? '',
            'current_search' => $request->search ?? '',
            'current_per_page' => $perPage
        ];
        
        return view('admin.v2.pelamar.index', $data);
    }

    // Detail
    public function detail($id_pendaftaran)
    {
        if (Session::get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        
        $site = DB::table('konfigurasi')->first();
        $pelamar = PendaftaranLoker::with('loker')
            ->join('loker', 'loker.id_loker', '=', 'pendaftaran_loker.id_loker')
            ->select('pendaftaran_loker.*', 'loker.judul_loker', 'loker.posisi', 'loker.slug_loker')
            ->where('pendaftaran_loker.id_pendaftaran', $id_pendaftaran)
            ->first();
        
        if (!$pelamar) {
            return redirect('admin/v2/pelamar')->with(['warning' => 'Data pelamar tidak ditemukan']);
        }
        
        $data = [
            'title' => 'Detail Pelamar - ' . $site->namaweb,
            'site' => $site,
            'pelamar' => $pelamar
        ];
        
        return view('admin.v2.pelamar.detail', $data);
    }

    // Update Status
    public function update_status(Request $request)
    {
        if (Session::get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        
        $request->validate([
            'id_pendaftaran' => 'required|exists:pendaftaran_loker,id_pendaftaran',
            'status_pendaftaran' => 'required|in:Baru,Dibaca,Diproses,Diterima,Ditolak'
        ]);

        $pelamar = PendaftaranLoker::find($request->id_pendaftaran);
        
        if (!$pelamar) {
            return redirect('admin/v2/pelamar')->with(['warning' => 'Data pelamar tidak ditemukan']);
        }

        $pelamar->update([
            'status_pendaftaran' => $request->status_pendaftaran
        ]);

        return redirect()->back()->with(['sukses' => 'Status pelamar berhasil diperbarui']);
    }

    // Delete
    public function delete($id_pendaftaran)
    {
        if (Session::get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        
        $pelamar = PendaftaranLoker::find($id_pendaftaran);
        
        if (!$pelamar) {
            return redirect('admin/v2/pelamar')->with(['warning' => 'Data pelamar tidak ditemukan']);
        }

        // Hapus file CV jika ada
        if ($pelamar->cv_file && Storage::disk('s3')->exists('assets/upload/file/cv/' . $pelamar->cv_file)) {
            Storage::disk('s3')->delete('assets/upload/file/cv/' . $pelamar->cv_file);
        }
        
        $pelamar->delete();

        return redirect('admin/v2/pelamar')->with(['sukses' => 'Data pelamar berhasil dihapus']);
    }

    // Download CV
    public function download_cv($id_pendaftaran)
    {
        if (Session::get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        
        $pelamar = PendaftaranLoker::find($id_pendaftaran);
        
        if (!$pelamar || !$pelamar->cv_file) {
            return redirect('admin/v2/pelamar')->with(['warning' => 'File CV tidak ditemukan']);
        }

        $filePath = 'assets/upload/file/cv/' . $pelamar->cv_file;
        
        if (Storage::disk('s3')->exists($filePath)) {
            $fileUrl = Storage::disk('s3')->url($filePath);
            return redirect($fileUrl);
        }

        return redirect('admin/v2/pelamar')->with(['warning' => 'File CV tidak ditemukan']);
    }
}
