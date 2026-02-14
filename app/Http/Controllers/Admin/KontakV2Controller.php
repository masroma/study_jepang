<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class KontakV2Controller extends Controller
{
    // Index
    public function index(Request $request)
    {
        if (Session::get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        
        $site = DB::table('konfigurasi')->first();
        
        // Filter kontak (exclude request quotation karena sudah ada modul terpisah)
        $query = DB::table('kontak')
            ->where('subjek', 'NOT LIKE', 'Request Quotation:%')
            ->orderBy('tanggal_kontak', 'DESC');
        
        // Pencarian
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%")
                  ->orWhere('telepon', 'LIKE', "%{$search}%")
                  ->orWhere('subjek', 'LIKE', "%{$search}%")
                  ->orWhere('pesan', 'LIKE', "%{$search}%");
            });
        }
        
        // Filter status
        if ($request->has('status') && $request->status != '') {
            $query->where('status_kontak', $request->status);
        }
        
        // Per page (default 10)
        $perPage = $request->get('per_page', 10);
        $perPage = in_array($perPage, [10, 25, 50, 100]) ? $perPage : 10;
        
        $kontaks = $query->paginate($perPage)->withQueryString();
        
        // Statistik
        $stats = [
            'total' => DB::table('kontak')->where('subjek', 'NOT LIKE', 'Request Quotation:%')->count(),
            'baru' => DB::table('kontak')->where('subjek', 'NOT LIKE', 'Request Quotation:%')->where('status_kontak', 'Baru')->count(),
            'dibaca' => DB::table('kontak')->where('subjek', 'NOT LIKE', 'Request Quotation:%')->where('status_kontak', 'Dibaca')->count(),
        ];
        
        $data = [
            'title' => 'Kontak Kami - ' . $site->namaweb,
            'site' => $site,
            'kontaks' => $kontaks,
            'stats' => $stats,
            'current_status' => $request->status ?? '',
            'current_search' => $request->search ?? '',
            'current_per_page' => $perPage
        ];
        
        return view('admin.v2.kontak.index', $data);
    }

    // Detail
    public function detail($id_kontak)
    {
        if (Session::get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        
        $site = DB::table('konfigurasi')->first();
        $kontak = DB::table('kontak')
            ->where('id_kontak', $id_kontak)
            ->where('subjek', 'NOT LIKE', 'Request Quotation:%')
            ->first();
        
        if (!$kontak) {
            return redirect('admin/v2/kontak')->with(['warning' => 'Pesan kontak tidak ditemukan']);
        }
        
        $data = [
            'title' => 'Detail Kontak - ' . $site->namaweb,
            'site' => $site,
            'kontak' => $kontak
        ];
        
        return view('admin.v2.kontak.detail', $data);
    }

    // Update Status
    public function update_status(Request $request)
    {
        if (Session::get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        
        $request->validate([
            'id_kontak' => 'required|exists:kontak,id_kontak',
            'status_kontak' => 'required|in:Baru,Dibaca'
        ]);

        DB::table('kontak')
            ->where('id_kontak', $request->id_kontak)
            ->update([
                'status_kontak' => $request->status_kontak
            ]);

        return redirect()->back()->with(['sukses' => 'Status kontak berhasil diperbarui']);
    }

    // Delete
    public function delete($id_kontak)
    {
        if (Session::get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        
        $kontak = DB::table('kontak')
            ->where('id_kontak', $id_kontak)
            ->where('subjek', 'NOT LIKE', 'Request Quotation:%')
            ->first();
        
        if (!$kontak) {
            return redirect('admin/v2/kontak')->with(['warning' => 'Pesan kontak tidak ditemukan']);
        }
        
        DB::table('kontak')->where('id_kontak', $id_kontak)->delete();

        return redirect('admin/v2/kontak')->with(['sukses' => 'Pesan kontak berhasil dihapus']);
    }
}
