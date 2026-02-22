<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Quotation extends Controller
{
    // Index - Daftar semua quotation
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
        $query = DB::table('kontak')
            ->where('id_user', $userId)
            ->where('subjek', 'LIKE', 'Request Quotation:%');

        if($request->status) {
            $query->where('status_kontak', $request->status);
        }

        $quotations = $query->orderBy('tanggal_kontak', 'DESC')
            ->paginate(10);

        // Parse data quotation
        $quotations->getCollection()->transform(function($item) {
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
                } elseif(strpos($line, 'Kebutuhan:') !== false) {
                    $detail['kebutuhan'] = trim(str_replace('Kebutuhan: ', '', $line));
                } elseif(strpos($line, 'Pesan:') !== false) {
                    $detail['pesan'] = trim(str_replace('Pesan: ', '', $line));
                }
            }
            $item->detail = $detail;
            $item->produk_nama = $produk;
            return $item;
        });

        $data = [
            'title' => 'Request Quotation Saya - ' . $site->namaweb,
            'site' => $site,
            'quotations' => $quotations,
            'current_status' => $request->status ?? 'all'
        ];

        return view('member.quotation.index', $data);
    }

    // Detail quotation
    public function detail($id_kontak)
    {
        if(Session::get('username')=="") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }

        if(Session::get('akses_level') !== 'User') {
            return redirect('admin/v2')->with(['warning' => 'Akses ditolak']);
        }

        $site = DB::table('konfigurasi')->first();
        $userId = Session::get('id_user');

        $quotation = DB::table('kontak')
            ->where('id_kontak', $id_kontak)
            ->where('id_user', $userId)
            ->where('subjek', 'LIKE', 'Request Quotation:%')
            ->first();

        if(!$quotation) {
            return redirect('member/quotation')->with(['warning' => 'Request quotation tidak ditemukan']);
        }

        // Parse detail
        $produk = str_replace('Request Quotation: ', '', $quotation->subjek);
        $pesan_lines = explode("\n", $quotation->pesan);
        $detail = [];
        foreach($pesan_lines as $line) {
            if(strpos($line, 'Perusahaan:') !== false) {
                $detail['perusahaan'] = trim(str_replace('Perusahaan: ', '', $line));
            } elseif(strpos($line, 'Produk:') !== false) {
                $detail['produk'] = trim(str_replace('Produk: ', '', $line));
            } elseif(strpos($line, 'Quantity:') !== false) {
                $detail['quantity'] = trim(str_replace('Quantity: ', '', $line));
            } elseif(strpos($line, 'Kebutuhan:') !== false) {
                $detail['kebutuhan'] = trim(str_replace('Kebutuhan: ', '', $line));
            } elseif(strpos($line, 'Pesan:') !== false) {
                $detail['pesan'] = trim(str_replace('Pesan: ', '', $line));
            }
        }
        $quotation->detail = $detail;
        $quotation->produk_nama = $produk;

        $data = [
            'title' => 'Detail Request Quotation - ' . $site->namaweb,
            'site' => $site,
            'quotation' => $quotation
        ];

        return view('member.quotation.detail', $data);
    }

    // Form baru
    public function baru()
    {
        if(Session::get('username')=="") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }

        if(Session::get('akses_level') !== 'User') {
            return redirect('admin/v2')->with(['warning' => 'Akses ditolak']);
        }

        $site = DB::table('konfigurasi')->first();
        $user = DB::table('users')->where('id_user', Session::get('id_user'))->first();

        // Get all products
        $all_produk = [];
        if(DB::table('information_schema.tables')->where('table_schema', DB::getDatabaseName())->where('table_name', 'produk')->exists()) {
            $produk_kategori = DB::table('produk')
                ->join('kategori_produk', 'kategori_produk.id_kategori_produk', '=', 'produk.id_kategori_produk')
                ->select('produk.*', 'kategori_produk.nama_kategori_produk')
                ->where('produk.status_produk', 'Publish')
                ->orderBy('kategori_produk.urutan', 'ASC')
                ->orderBy('produk.urutan', 'ASC')
                ->get()
                ->groupBy('nama_kategori_produk');
        }

        $data = [
            'title' => 'Request Quotation Baru - ' . $site->namaweb,
            'site' => $site,
            'user' => $user,
            'all_produk' => $all_produk ?? []
        ];

        return view('member.quotation.baru', $data);
    }

    // Kirim quotation
    public function kirim(Request $request)
    {
        if(Session::get('username')=="") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }

        if(Session::get('akses_level') !== 'User') {
            return redirect('admin/v2')->with(['warning' => 'Akses ditolak']);
        }

        $request->validate([
            'produk'       => 'required|string|max:255',
            'quantity'      => 'nullable|string|max:255',
            'kebutuhan'     => 'nullable|string|max:1000',
            'pesan'         => 'nullable|string|max:2000'
        ]);

        $user = DB::table('users')->where('id_user', Session::get('id_user'))->first();

        // Simpan ke database kontak dengan subjek khusus
        $kontakData = [
            'nama'           => $user->nama,
            'email'          => $user->email,
            'telepon'        => $user->whatsapp ?? '-',
            'subjek'         => 'Request Quotation: ' . $request->produk,
            'pesan'          => "Perusahaan: " . ($request->perusahaan ?? '-') . "\n\n" .
                              "Produk: " . $request->produk . "\n" .
                              "Quantity: " . ($request->quantity ?? '-') . "\n" .
                              "Kebutuhan: " . ($request->kebutuhan ?? '-') . "\n\n" .
                              "Pesan: " . ($request->pesan ?? '-'),
            'tanggal_kontak' => now(),
            'status_kontak'  => 'Baru',
            'id_user'        => Session::get('id_user')
        ];

        DB::table('kontak')->insert($kontakData);

        return redirect('member/quotation')->with(['sukses' => 'Request quotation berhasil dikirim. Tim kami akan menghubungi Anda segera.']);
    }
}
