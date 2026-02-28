<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Schema;
use App\Models\Mitra;
use App\Models\Referal;
use App\Models\Komisi;
use App\Models\Withdraw;
use App\Models\SettingKomisi;
use Illuminate\Support\Str;

class MitraV2Controller extends Controller
{
    // Setting Komisi
    public function settingKomisi()
    {
        if(Session::get('username')=="") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }

        $site = DB::table('konfigurasi')->first();
        $settings = SettingKomisi::all();

        $data = [
            'title' => 'Setting Komisi Mitra - ' . $site->namaweb,
            'site' => $site,
            'settings' => $settings
        ];

        return view('admin.v2.mitra.setting_komisi', $data);
    }

    // Update Setting Komisi
    public function updateSettingKomisi(Request $request)
    {
        if(Session::get('username')=="") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }

        $request->validate([
            'kerja_tipe' => 'required|in:Persentase,Nominal',
            'kerja_persentase' => 'nullable|numeric|min:0|max:100',
            'kerja_nominal' => 'nullable|numeric|min:0',
            'pendidikan_tipe' => 'required|in:Persentase,Nominal',
            'pendidikan_persentase' => 'nullable|numeric|min:0|max:100',
            'pendidikan_nominal' => 'nullable|numeric|min:0',
        ]);

        // Update atau create setting untuk Kerja
        $settingKerja = SettingKomisi::where('jenis', 'Kerja')->first();
        if($settingKerja) {
            $settingKerja->update([
                'tipe_komisi' => $request->kerja_tipe,
                'persentase_komisi' => $request->kerja_tipe == 'Persentase' ? $request->kerja_persentase : null,
                'nominal_komisi' => $request->kerja_tipe == 'Nominal' ? $request->kerja_nominal : null,
                'tanggal_update' => now()
            ]);
        } else {
            SettingKomisi::create([
                'jenis' => 'Kerja',
                'tipe_komisi' => $request->kerja_tipe,
                'persentase_komisi' => $request->kerja_tipe == 'Persentase' ? $request->kerja_persentase : null,
                'nominal_komisi' => $request->kerja_tipe == 'Nominal' ? $request->kerja_nominal : null,
                'status' => 'Aktif',
                'tanggal_update' => now()
            ]);
        }

        // Update atau create setting untuk Pendidikan
        $settingPendidikan = SettingKomisi::where('jenis', 'Pendidikan')->first();
        if($settingPendidikan) {
            $settingPendidikan->update([
                'tipe_komisi' => $request->pendidikan_tipe,
                'persentase_komisi' => $request->pendidikan_tipe == 'Persentase' ? $request->pendidikan_persentase : null,
                'nominal_komisi' => $request->pendidikan_tipe == 'Nominal' ? $request->pendidikan_nominal : null,
                'tanggal_update' => now()
            ]);
        } else {
            SettingKomisi::create([
                'jenis' => 'Pendidikan',
                'tipe_komisi' => $request->pendidikan_tipe,
                'persentase_komisi' => $request->pendidikan_tipe == 'Persentase' ? $request->pendidikan_persentase : null,
                'nominal_komisi' => $request->pendidikan_tipe == 'Nominal' ? $request->pendidikan_nominal : null,
                'status' => 'Aktif',
                'tanggal_update' => now()
            ]);
        }

        return redirect('admin/v2/mitra/setting-komisi')->with(['sukses' => 'Setting komisi berhasil diupdate']);
    }

    // List Mitra
    public function index()
    {
        if(Session::get('username')=="") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }

        $site = DB::table('konfigurasi')->first();
        $mitras = Mitra::with('user')
            ->orderBy('tanggal_daftar', 'DESC')
            ->get();

        $data = [
            'title' => 'Daftar Mitra - ' . $site->namaweb,
            'site' => $site,
            'mitras' => $mitras
        ];

        return view('admin.v2.mitra.index', $data);
    }

    // Data Referal
    public function referal()
    {
        if(Session::get('username')=="") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }

        $site = DB::table('konfigurasi')->first();
        $referals = Referal::with('mitra.user')
            ->orderBy('tanggal', 'DESC')
            ->get();

        $data = [
            'title' => 'Data Referal Mitra - ' . $site->namaweb,
            'site' => $site,
            'referals' => $referals
        ];

        return view('admin.v2.mitra.referal', $data);
    }

    // Update Status Referal
    public function updateStatusReferal(Request $request, $id_referal)
    {
        if(Session::get('username')=="") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }

        $request->validate([
            'status' => 'required|in:Diterima,Ditolak'
        ]);

        $referal = Referal::find($id_referal);
        if(!$referal) {
            return redirect('admin/v2/mitra/referal')->with(['warning' => 'Referal tidak ditemukan']);
        }

        $referal->update(['status' => $request->status]);

        // Jika diterima, buat komisi dan tambahkan ke saldo mitra
        if($request->status == 'Diterima') {
            $mitra = Mitra::find($referal->id_mitra);
            $setting = SettingKomisi::where('jenis', $referal->program)->where('status', 'Aktif')->first();

            if($setting && $mitra) {
                $jumlahKomisi = 0;
                if($setting->tipe_komisi == 'Nominal') {
                    $jumlahKomisi = $setting->nominal_komisi;
                } elseif($setting->tipe_komisi == 'Persentase') {
                    // Jika persentase, perlu nilai dasar (misalnya dari program atau paket)
                    // Untuk sementara, kita gunakan nominal default
                    $jumlahKomisi = $setting->persentase_komisi * 1000000 / 100; // Contoh: 10% dari 1 juta
                }

                // Buat komisi
                Komisi::create([
                    'id_mitra' => $mitra->id_mitra,
                    'id_referal' => $referal->id_referal,
                    'jumlah_komisi' => $jumlahKomisi,
                    'status' => 'Paid',
                    'tanggal' => now(),
                    'keterangan' => 'Komisi dari referal ' . $referal->nama . ' - Program ' . $referal->program
                ]);

                // Tambahkan ke saldo mitra
                $mitra->increment('saldo', $jumlahKomisi);
            }
        }

        return redirect('admin/v2/mitra/referal')->with(['sukses' => 'Status referal berhasil diupdate']);
    }

    // List Withdraw
    public function withdraw()
    {
        if(Session::get('username')=="") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }

        $site = DB::table('konfigurasi')->first();
        $withdraws = Withdraw::with('mitra.user')
            ->orderBy('tanggal', 'DESC')
            ->get();

        $data = [
            'title' => 'List Withdraw Mitra - ' . $site->namaweb,
            'site' => $site,
            'withdraws' => $withdraws
        ];

        return view('admin.v2.mitra.withdraw', $data);
    }

    // Update Status Withdraw
    public function updateStatusWithdraw(Request $request, $id_withdraw)
    {
        if(Session::get('username')=="") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }

        $request->validate([
            'status' => 'required|in:Diproses,Selesai,Ditolak',
            'catatan' => 'nullable|string'
        ]);

        $withdraw = Withdraw::find($id_withdraw);
        if(!$withdraw) {
            return redirect('admin/v2/mitra/withdraw')->with(['warning' => 'Withdraw tidak ditemukan']);
        }

        $withdraw->update([
            'status' => $request->status,
            'catatan' => $request->catatan
        ]);

        // Jika ditolak, kembalikan saldo ke mitra
        if($request->status == 'Ditolak') {
            $mitra = Mitra::find($withdraw->id_mitra);
            if($mitra) {
                $mitra->increment('saldo', $withdraw->jumlah);
            }
        }

        return redirect('admin/v2/mitra/withdraw')->with(['sukses' => 'Status withdraw berhasil diupdate']);
    }

    // Lihat Komisi Mitra
    public function komisi($id_mitra)
    {
        if(Session::get('username')=="") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }

        $site = DB::table('konfigurasi')->first();
        $mitra = Mitra::with('user')->find($id_mitra);
        
        if(!$mitra) {
            return redirect('admin/v2/mitra')->with(['warning' => 'Mitra tidak ditemukan']);
        }

        $komisis = Komisi::where('id_mitra', $id_mitra)
            ->with('referal')
            ->orderBy('tanggal', 'DESC')
            ->get();

        $data = [
            'title' => 'Komisi Mitra - ' . $site->namaweb,
            'site' => $site,
            'mitra' => $mitra,
            'komisis' => $komisis
        ];

        return view('admin.v2.mitra.komisi', $data);
    }
}
