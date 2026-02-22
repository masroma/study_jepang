<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class Lamaran extends Controller
{
    // Index - Daftar semua lamaran
    public function index(Request $request)
    {
        if(Session::get('username')=="") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }

        if(Session::get('akses_level') !== 'User') {
            return redirect('admin/v2')->with(['warning' => 'Akses ditolak']);
        }

        $site = DB::table('konfigurasi')->first();
        $userId = Session::get('id_user');

        // Filter berdasarkan status
        $query = DB::table('pendaftaran_loker')
            ->join('loker', 'loker.id_loker', '=', 'pendaftaran_loker.id_loker')
            ->select('pendaftaran_loker.*', 'loker.judul_loker', 'loker.posisi', 'loker.slug_loker')
            ->where('pendaftaran_loker.id_user', $userId);

        if($request->status) {
            $query->where('pendaftaran_loker.status_pendaftaran', $request->status);
        }

        $lamaran = $query->orderBy('pendaftaran_loker.tanggal_pendaftaran', 'DESC')
            ->paginate(10);

        $data = [
            'title' => 'Lamaran Saya - ' . $site->namaweb,
            'site' => $site,
            'lamaran' => $lamaran,
            'current_status' => $request->status ?? 'all'
        ];

        return view('member.lamaran.index', $data);
    }

    // Detail lamaran
    public function detail($id_pendaftaran)
    {
        if(Session::get('username')=="") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }

        if(Session::get('akses_level') !== 'User') {
            return redirect('admin/v2')->with(['warning' => 'Akses ditolak']);
        }

        $site = DB::table('konfigurasi')->first();
        $userId = Session::get('id_user');

        $lamaran = DB::table('pendaftaran_loker')
            ->join('loker', 'loker.id_loker', '=', 'pendaftaran_loker.id_loker')
            ->select('pendaftaran_loker.*', 'loker.judul_loker', 'loker.posisi', 'loker.slug_loker', 'loker.isi_loker')
            ->where('pendaftaran_loker.id_pendaftaran', $id_pendaftaran)
            ->where('pendaftaran_loker.id_user', $userId)
            ->first();

        if(!$lamaran) {
            return redirect('member/lamaran')->with(['warning' => 'Lamaran tidak ditemukan']);
        }

        $data = [
            'title' => 'Detail Lamaran - ' . $site->namaweb,
            'site' => $site,
            'lamaran' => $lamaran
        ];

        return view('member.lamaran.detail', $data);
    }

    // Download CV
    public function download_cv($id_pendaftaran)
    {
        if(Session::get('username')=="") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }

        if(Session::get('akses_level') !== 'User') {
            return redirect('admin/v2')->with(['warning' => 'Akses ditolak']);
        }

        $userId = Session::get('id_user');

        $lamaran = DB::table('pendaftaran_loker')
            ->where('id_pendaftaran', $id_pendaftaran)
            ->where('id_user', $userId)
            ->first();

        if(!$lamaran || !$lamaran->cv_file) {
            return redirect('member/lamaran')->with(['warning' => 'File CV tidak ditemukan']);
        }

        $filePath = 'assets/upload/file/cv/' . $lamaran->cv_file;
        
        if(Storage::disk('s3')->exists($filePath)) {
            $fileContent = Storage::disk('s3')->get($filePath);
            $mimeType = Storage::disk('s3')->mimeType($filePath);
            
            return response($fileContent, 200)
                ->header('Content-Type', $mimeType)
                ->header('Content-Disposition', 'attachment; filename="' . $lamaran->cv_file . '"');
        }

        return redirect('member/lamaran')->with(['warning' => 'File CV tidak ditemukan']);
    }
}
