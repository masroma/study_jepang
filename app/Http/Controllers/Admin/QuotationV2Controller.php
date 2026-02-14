<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class QuotationV2Controller extends Controller
{
    // Index
    public function index(Request $request)
    {
        if (Session::get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        
        $site = DB::table('konfigurasi')->first();
        
        // Filter request quotation dari tabel kontak
        $query = DB::table('kontak')
            ->where('subjek', 'LIKE', 'Request Quotation:%')
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
        
        $quotations = $query->paginate($perPage)->withQueryString();
        
        // Parse data quotation dari pesan
        $quotations->getCollection()->transform(function($item) {
            // Extract produk dari subjek
            $produk = str_replace('Request Quotation: ', '', $item->subjek);
            
            // Parse pesan untuk mendapatkan detail
            $pesan_lines = explode("\n", $item->pesan);
            $detail = [
                'perusahaan' => '',
                'produk' => $produk,
                'quantity' => '',
                'kebutuhan' => '',
                'pesan' => ''
            ];
            
            $current_section = '';
            foreach ($pesan_lines as $line) {
                $line = trim($line);
                if (strpos($line, 'Perusahaan:') === 0) {
                    $detail['perusahaan'] = str_replace('Perusahaan: ', '', $line);
                } elseif (strpos($line, 'Produk:') === 0) {
                    $detail['produk'] = str_replace('Produk: ', '', $line);
                } elseif (strpos($line, 'Quantity:') === 0) {
                    $detail['quantity'] = str_replace('Quantity: ', '', $line);
                } elseif (strpos($line, 'Kebutuhan:') === 0) {
                    $detail['kebutuhan'] = str_replace('Kebutuhan: ', '', $line);
                } elseif (strpos($line, 'Pesan:') === 0) {
                    $current_section = 'pesan';
                    $detail['pesan'] = str_replace('Pesan: ', '', $line);
                } elseif ($current_section == 'pesan' && !empty($line)) {
                    $detail['pesan'] .= "\n" . $line;
                } elseif (strpos($line, 'Kebutuhan:') !== false && empty($detail['kebutuhan'])) {
                    // Handle kebutuhan yang mungkin multi-line
                    $detail['kebutuhan'] = str_replace('Kebutuhan: ', '', $line);
                }
            }
            
            $item->detail = $detail;
            return $item;
        });
        
        // Statistik
        $stats = [
            'total' => DB::table('kontak')->where('subjek', 'LIKE', 'Request Quotation:%')->count(),
            'baru' => DB::table('kontak')->where('subjek', 'LIKE', 'Request Quotation:%')->where('status_kontak', 'Baru')->count(),
            'dibaca' => DB::table('kontak')->where('subjek', 'LIKE', 'Request Quotation:%')->where('status_kontak', 'Dibaca')->count(),
        ];
        
        $data = [
            'title' => 'Request Quotation Produk - ' . $site->namaweb,
            'site' => $site,
            'quotations' => $quotations,
            'stats' => $stats,
            'current_status' => $request->status ?? '',
            'current_search' => $request->search ?? '',
            'current_per_page' => $perPage
        ];
        
        return view('admin.v2.quotation.index', $data);
    }

    // Detail
    public function detail($id_kontak)
    {
        if (Session::get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        
        $site = DB::table('konfigurasi')->first();
        $quotation = DB::table('kontak')
            ->where('id_kontak', $id_kontak)
            ->where('subjek', 'LIKE', 'Request Quotation:%')
            ->first();
        
        if (!$quotation) {
            return redirect('admin/v2/quotation')->with(['warning' => 'Request quotation tidak ditemukan']);
        }
        
        // Parse detail dari pesan
        $produk = str_replace('Request Quotation: ', '', $quotation->subjek);
        $pesan_lines = explode("\n", $quotation->pesan);
        $detail = [
            'perusahaan' => '',
            'produk' => $produk,
            'quantity' => '',
            'kebutuhan' => '',
            'pesan' => ''
        ];
        
        $current_section = '';
        foreach ($pesan_lines as $line) {
            $line = trim($line);
            if (strpos($line, 'Perusahaan:') === 0) {
                $detail['perusahaan'] = str_replace('Perusahaan: ', '', $line);
            } elseif (strpos($line, 'Produk:') === 0) {
                $detail['produk'] = str_replace('Produk: ', '', $line);
            } elseif (strpos($line, 'Quantity:') === 0) {
                $detail['quantity'] = str_replace('Quantity: ', '', $line);
            } elseif (strpos($line, 'Kebutuhan:') === 0) {
                $detail['kebutuhan'] = str_replace('Kebutuhan: ', '', $line);
            } elseif (strpos($line, 'Pesan:') === 0) {
                $current_section = 'pesan';
                $detail['pesan'] = str_replace('Pesan: ', '', $line);
            } elseif ($current_section == 'pesan' && !empty($line)) {
                $detail['pesan'] .= "\n" . $line;
            } elseif (strpos($line, 'Kebutuhan:') !== false && empty($detail['kebutuhan'])) {
                $detail['kebutuhan'] = str_replace('Kebutuhan: ', '', $line);
            }
        }
        
        $quotation->detail = $detail;
        
        $data = [
            'title' => 'Detail Request Quotation - ' . $site->namaweb,
            'site' => $site,
            'quotation' => $quotation
        ];
        
        return view('admin.v2.quotation.detail', $data);
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

        return redirect()->back()->with(['sukses' => 'Status request quotation berhasil diperbarui']);
    }

    // Delete
    public function delete($id_kontak)
    {
        if (Session::get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        
        $quotation = DB::table('kontak')
            ->where('id_kontak', $id_kontak)
            ->where('subjek', 'LIKE', 'Request Quotation:%')
            ->first();
        
        if (!$quotation) {
            return redirect('admin/v2/quotation')->with(['warning' => 'Request quotation tidak ditemukan']);
        }
        
        DB::table('kontak')->where('id_kontak', $id_kontak)->delete();

        return redirect('admin/v2/quotation')->with(['sukses' => 'Request quotation berhasil dihapus']);
    }
}
