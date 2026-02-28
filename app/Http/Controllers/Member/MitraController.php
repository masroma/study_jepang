<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\Mitra;
use App\Models\Referal;
use App\Models\Withdraw;
use Illuminate\Support\Str;

class MitraController extends Controller
{
    // Daftar Jadi Mitra
    public function daftar()
    {
        if(Session::get('username')=="") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }

        if(Session::get('akses_level') !== 'User') {
            return redirect('admin/v2')->with(['warning' => 'Akses ditolak']);
        }

        $userId = Session::get('id_user');
        
        // Cek apakah sudah jadi mitra
        $mitra = Mitra::where('id_user', $userId)->first();
        if($mitra) {
            return redirect('member/mitra/dashboard')->with(['warning' => 'Anda sudah terdaftar sebagai mitra']);
        }

        $site = DB::table('konfigurasi')->first();

        $data = [
            'title' => 'Daftar Jadi Mitra - ' . $site->namaweb,
            'site' => $site
        ];

        return view('member.mitra.daftar', $data);
    }

    // Proses Daftar Mitra
    public function prosesDaftar(Request $request)
    {
        if(Session::get('username')=="") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }

        if(Session::get('akses_level') !== 'User') {
            return redirect('admin/v2')->with(['warning' => 'Akses ditolak']);
        }

        $userId = Session::get('id_user');
        
        // Cek apakah sudah jadi mitra
        $mitra = Mitra::where('id_user', $userId)->first();
        if($mitra) {
            return redirect('member/mitra/dashboard')->with(['warning' => 'Anda sudah terdaftar sebagai mitra']);
        }

        // Generate kode referal unik
        do {
            $kodeReferal = strtoupper(Str::random(8));
        } while(Mitra::where('kode_referal', $kodeReferal)->exists());

        // Buat mitra baru
        Mitra::create([
            'id_user' => $userId,
            'kode_referal' => $kodeReferal,
            'saldo' => 0,
            'status' => 'Aktif',
            'tanggal_daftar' => now()
        ]);

        return redirect('member/mitra/dashboard')->with(['sukses' => 'Selamat! Anda berhasil menjadi mitra']);
    }

    // Dashboard Mitra
    public function dashboard()
    {
        if(Session::get('username')=="") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }

        if(Session::get('akses_level') !== 'User') {
            return redirect('admin/v2')->with(['warning' => 'Akses ditolak']);
        }

        $userId = Session::get('id_user');
        $mitra = Mitra::where('id_user', $userId)->first();

        if(!$mitra) {
            return redirect('member/mitra/daftar')->with(['warning' => 'Anda belum terdaftar sebagai mitra']);
        }

        $site = DB::table('konfigurasi')->first();

        // Statistik
        $stats = [
            'total_referal' => Referal::where('id_mitra', $mitra->id_mitra)->count(),
            'referal_pending' => Referal::where('id_mitra', $mitra->id_mitra)->where('status', 'Pending')->count(),
            'referal_diterima' => Referal::where('id_mitra', $mitra->id_mitra)->where('status', 'Diterima')->count(),
            'total_komisi' => DB::table('komisi')->where('id_mitra', $mitra->id_mitra)->sum('jumlah_komisi'),
            'komisi_paid' => DB::table('komisi')->where('id_mitra', $mitra->id_mitra)->where('status', 'Paid')->sum('jumlah_komisi'),
            'total_withdraw' => Withdraw::where('id_mitra', $mitra->id_mitra)->where('status', 'Selesai')->sum('jumlah'),
            'withdraw_pending' => Withdraw::where('id_mitra', $mitra->id_mitra)->whereIn('status', ['Pending', 'Diproses'])->sum('jumlah')
        ];

        // Referal terbaru
        $referal_terbaru = Referal::where('id_mitra', $mitra->id_mitra)
            ->orderBy('tanggal', 'DESC')
            ->limit(5)
            ->get();

        $data = [
            'title' => 'Dashboard Mitra - ' . $site->namaweb,
            'site' => $site,
            'mitra' => $mitra,
            'stats' => $stats,
            'referal_terbaru' => $referal_terbaru
        ];

        return view('member.mitra.dashboard', $data);
    }

    // List Referal
    public function referal()
    {
        if(Session::get('username')=="") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }

        if(Session::get('akses_level') !== 'User') {
            return redirect('admin/v2')->with(['warning' => 'Akses ditolak']);
        }

        $userId = Session::get('id_user');
        $mitra = Mitra::where('id_user', $userId)->first();

        if(!$mitra) {
            return redirect('member/mitra/daftar')->with(['warning' => 'Anda belum terdaftar sebagai mitra']);
        }

        $site = DB::table('konfigurasi')->first();
        $referals = Referal::where('id_mitra', $mitra->id_mitra)
            ->orderBy('tanggal', 'DESC')
            ->get();

        $data = [
            'title' => 'List Referal - ' . $site->namaweb,
            'site' => $site,
            'mitra' => $mitra,
            'referals' => $referals
        ];

        return view('member.mitra.referal', $data);
    }

    // Tambah Referal
    public function tambahReferal()
    {
        if(Session::get('username')=="") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }

        if(Session::get('akses_level') !== 'User') {
            return redirect('admin/v2')->with(['warning' => 'Akses ditolak']);
        }

        $userId = Session::get('id_user');
        $mitra = Mitra::where('id_user', $userId)->first();

        if(!$mitra) {
            return redirect('member/mitra/daftar')->with(['warning' => 'Anda belum terdaftar sebagai mitra']);
        }

        $site = DB::table('konfigurasi')->first();

        $data = [
            'title' => 'Tambah Referal - ' . $site->namaweb,
            'site' => $site,
            'mitra' => $mitra
        ];

        return view('member.mitra.tambah_referal', $data);
    }

    // Proses Tambah Referal
    public function prosesTambahReferal(Request $request)
    {
        if(Session::get('username')=="") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }

        if(Session::get('akses_level') !== 'User') {
            return redirect('admin/v2')->with(['warning' => 'Akses ditolak']);
        }

        $userId = Session::get('id_user');
        $mitra = Mitra::where('id_user', $userId)->first();

        if(!$mitra) {
            return redirect('member/mitra/daftar')->with(['warning' => 'Anda belum terdaftar sebagai mitra']);
        }

        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'telepon' => 'required|string|max:20',
            'program' => 'required|in:Kerja,Pendidikan',
            'catatan' => 'nullable|string'
        ]);

        Referal::create([
            'id_mitra' => $mitra->id_mitra,
            'nama' => $request->nama,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'program' => $request->program,
            'catatan' => $request->catatan,
            'status' => 'Pending',
            'tanggal' => now()
        ]);

        return redirect('member/mitra/referal')->with(['sukses' => 'Referal berhasil ditambahkan']);
    }

    // Withdraw
    public function withdraw()
    {
        if(Session::get('username')=="") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }

        if(Session::get('akses_level') !== 'User') {
            return redirect('admin/v2')->with(['warning' => 'Akses ditolak']);
        }

        $userId = Session::get('id_user');
        $mitra = Mitra::where('id_user', $userId)->first();

        if(!$mitra) {
            return redirect('member/mitra/daftar')->with(['warning' => 'Anda belum terdaftar sebagai mitra']);
        }

        $site = DB::table('konfigurasi')->first();
        $withdraws = Withdraw::where('id_mitra', $mitra->id_mitra)
            ->orderBy('tanggal', 'DESC')
            ->get();

        $data = [
            'title' => 'Withdraw - ' . $site->namaweb,
            'site' => $site,
            'mitra' => $mitra,
            'withdraws' => $withdraws
        ];

        return view('member.mitra.withdraw', $data);
    }

    // Proses Withdraw
    public function prosesWithdraw(Request $request)
    {
        if(Session::get('username')=="") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }

        if(Session::get('akses_level') !== 'User') {
            return redirect('admin/v2')->with(['warning' => 'Akses ditolak']);
        }

        $userId = Session::get('id_user');
        $mitra = Mitra::where('id_user', $userId)->first();

        if(!$mitra) {
            return redirect('member/mitra/daftar')->with(['warning' => 'Anda belum terdaftar sebagai mitra']);
        }

        $request->validate([
            'jumlah' => 'required|numeric|min:50000',
            'bank' => 'required|string|max:50',
            'rekening' => 'required|string|max:50',
            'nama_rekening' => 'required|string|max:100'
        ]);

        // Cek saldo cukup
        if($mitra->saldo < $request->jumlah) {
            return redirect('member/mitra/withdraw')->with(['warning' => 'Saldo tidak cukup']);
        }

        // Kurangi saldo
        $mitra->decrement('saldo', $request->jumlah);

        // Buat withdraw
        Withdraw::create([
            'id_mitra' => $mitra->id_mitra,
            'jumlah' => $request->jumlah,
            'bank' => $request->bank,
            'rekening' => $request->rekening,
            'nama_rekening' => $request->nama_rekening,
            'status' => 'Pending',
            'tanggal' => now()
        ]);

        return redirect('member/mitra/withdraw')->with(['sukses' => 'Permintaan withdraw berhasil dikirim']);
    }
}
