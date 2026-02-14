<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Schema;

class Setting extends Controller
{
    // Index - Tampilkan form setting
    public function index()
    {
        if(Session::get('username')=="") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }

        $site = DB::table('konfigurasi')->first();
        
        if(!$site) {
            // Buat data default jika belum ada
            $insertData = [
                'namaweb' => 'Meghantara Global Group',
                'nama_singkat' => 'MEGHANTARA',
                'tagline' => 'Study & Work in Japan',
                'bahasa' => 'ID'
            ];
            
            $id = DB::table('konfigurasi')->insertGetId($insertData);
            $site = DB::table('konfigurasi')->where('id_konfigurasi', $id)->first();
        }

        $data = [
            'title' => 'Pengaturan Website - ' . $site->namaweb,
            'site' => $site
        ];

        return view('admin.v2.setting.index', $data);
    }

    // Update Setting
    public function update(Request $request)
    {
        if(Session::get('username')=="") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }

        $request->validate([
            'namaweb' => 'required|string|max:200',
            'nama_singkat' => 'nullable|string|max:200',
            'tagline' => 'nullable|string|max:200',
            'email' => 'nullable|email|max:255',
            'telepon' => 'nullable|string|max:50',
            'whatsapp' => 'nullable|string|max:50',
            'alamat' => 'nullable|string',
            'website' => 'nullable|url|max:255',
        ]);

        $updateData = [
            'namaweb' => $request->namaweb,
            'nama_singkat' => $request->nama_singkat,
            'tagline' => $request->tagline,
            'tagline2' => $request->tagline2,
            'deskripsi' => $request->deskripsi,
            'website' => $request->website,
            'email' => $request->email,
            'email_cadangan' => $request->email_cadangan,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
            'hp' => $request->hp,
            'whatsapp' => $request->whatsapp,
            'fax' => $request->fax,
            'keywords' => $request->keywords,
            'metatext' => $request->metatext,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'instagram' => $request->instagram,
            'nama_facebook' => $request->nama_facebook,
            'nama_twitter' => $request->nama_twitter,
            'nama_instagram' => $request->nama_instagram,
            'google_map' => $request->google_map,
            'text_bawah_peta' => $request->text_bawah_peta,
            'link_bawah_peta' => $request->link_bawah_peta,
            'id_user' => Session::get('id_user')
        ];

        // Hapus null values (kecuali yang memang boleh null)
        $updateData = array_filter($updateData, function($value) {
            return $value !== null;
        });

        DB::table('konfigurasi')
            ->where('id_konfigurasi', $request->id_konfigurasi)
            ->update($updateData);

        return redirect('admin/v2/setting')->with(['sukses' => 'Pengaturan website berhasil diupdate']);
    }
}
