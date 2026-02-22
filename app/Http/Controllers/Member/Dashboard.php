<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Dashboard extends Controller
{
    // Index Dashboard
    public function index()
    {
        if(Session::get('username')=="") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }

        // Cek apakah user adalah member
        if(Session::get('akses_level') !== 'User') {
            return redirect('admin/v2')->with(['warning' => 'Akses ditolak']);
        }

        $site = DB::table('konfigurasi')->first();
        $user = DB::table('users')->where('id_user', Session::get('id_user'))->first();
        $userId = Session::get('id_user');

        // Statistik untuk member
        $stats = [
            'total_lamaran' => DB::table('pendaftaran_loker')
                ->where('id_user', $userId)
                ->count(),
            'lamaran_baru' => DB::table('pendaftaran_loker')
                ->where('id_user', $userId)
                ->where('status_pendaftaran', 'Baru')
                ->count(),
            'lamaran_diproses' => DB::table('pendaftaran_loker')
                ->where('id_user', $userId)
                ->whereIn('status_pendaftaran', ['Dibaca', 'Diproses'])
                ->count(),
            'lamaran_diterima' => DB::table('pendaftaran_loker')
                ->where('id_user', $userId)
                ->where('status_pendaftaran', 'Diterima')
                ->count(),
            'total_quotation' => DB::table('kontak')
                ->where('id_user', $userId)
                ->where('subjek', 'LIKE', 'Request Quotation:%')
                ->count(),
            'quotation_baru' => DB::table('kontak')
                ->where('id_user', $userId)
                ->where('subjek', 'LIKE', 'Request Quotation:%')
                ->where('status_kontak', 'Baru')
                ->count(),
        ];

        // Lamaran terbaru
        $lamaran_terbaru = DB::table('pendaftaran_loker')
            ->join('loker', 'loker.id_loker', '=', 'pendaftaran_loker.id_loker')
            ->select('pendaftaran_loker.*', 'loker.judul_loker', 'loker.posisi', 'loker.slug_loker')
            ->where('pendaftaran_loker.id_user', $userId)
            ->orderBy('pendaftaran_loker.tanggal_pendaftaran', 'DESC')
            ->limit(5)
            ->get();

        // Quotation terbaru
        $quotation_terbaru = DB::table('kontak')
            ->where('id_user', $userId)
            ->where('subjek', 'LIKE', 'Request Quotation:%')
            ->orderBy('tanggal_kontak', 'DESC')
            ->limit(5)
            ->get();

        // Parse quotation data
        $quotation_terbaru->transform(function($item) {
            $produk = str_replace('Request Quotation: ', '', $item->subjek);
            $pesan_lines = explode("\n", $item->pesan);
            $detail = [];
            foreach($pesan_lines as $line) {
                if(strpos($line, 'Perusahaan:') !== false) {
                    $detail['perusahaan'] = trim(str_replace('Perusahaan: ', '', $line));
                } elseif(strpos($line, 'Produk:') !== false) {
                    $detail['produk'] = trim(str_replace('Produk: ', '', $line));
                } elseif(strpos($line, 'Quantity:') !== false) {
                    $detail['quantity'] = trim(str_replace('Quantity: ', '', $line));
                }
            }
            $item->detail = $detail;
            $item->produk_nama = $produk;
            return $item;
        });

        $data = [
            'title' => 'Dashboard Member - ' . $site->namaweb,
            'site' => $site,
            'user' => $user,
            'stats' => $stats,
            'lamaran_terbaru' => $lamaran_terbaru,
            'quotation_terbaru' => $quotation_terbaru
        ];

        return view('member.dashboard.index', $data);
    }
}
