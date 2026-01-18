<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kontak_model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Kontak extends Controller
{
    // Index
    public function index()
    {
        if(Session()->get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);}
        $mykontak 	= new Kontak_model();
		$kontak 	= $mykontak->semua();

        $data = array(  'title'     => 'Data Pesan Kontak',
                        'kontak'    => $kontak,
                        'content'   => 'admin/kontak/index');
        return view('admin/layout/wrapper',$data);
    }

    // Cari
    public function cari(Request $request)
    {
        if(Session()->get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);}
        $mykontak 	= new Kontak_model();
        $keywords   = $request->keywords;
		$kontak 	= $mykontak->cari($keywords);

        $data = array(  'title'     => 'Data Pesan Kontak',
                        'kontak'    => $kontak,
                        'content'   => 'admin/kontak/index');
        return view('admin/layout/wrapper',$data);
    }

    // Status
    public function status_kontak($status_kontak)
    {
        if(Session()->get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);}
        $mykontak 	= new Kontak_model();
		$kontak 	= $mykontak->status($status_kontak);

        $data = array(  'title'     => 'Data Pesan Kontak',
                        'kontak'    => $kontak,
                        'content'   => 'admin/kontak/index');
        return view('admin/layout/wrapper',$data);
    }

    // Detail
    public function detail($id_kontak)
    {
        if(Session()->get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);}
        $mykontak 	= new Kontak_model();
		$kontak 	= $mykontak->detail($id_kontak);

        $data = array(  'title'     => 'Detail Pesan Kontak',
                        'kontak'    => $kontak,
                        'content'   => 'admin/kontak/detail');
        return view('admin/layout/wrapper',$data);
    }

    // Delete
    public function delete($id_kontak)
    {
        if(Session()->get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);}
        DB::table('kontak')->where('id_kontak',$id_kontak)->delete();
        return redirect('admin/kontak')->with(['sukses' => 'Data telah dihapus']);
    }

    // Proses
    public function proses(Request $request)
    {
        $site   = DB::table('konfigurasi')->first();
        // PROSES HAPUS MULTIPLE
        if(isset($_POST['hapus'])) {
            $id_kontaknya       = $request->id_kontak;
            for($i=0; $i < sizeof($id_kontaknya);$i++) {
                DB::table('kontak')->where('id_kontak',$id_kontaknya[$i])->delete();
            }
            return redirect('admin/kontak')->with(['sukses' => 'Data telah dihapus']);
        // PROSES SETTING DIBACA
        }elseif(isset($_POST['update'])) {
            $id_kontaknya       = $request->id_kontak;
            for($i=0; $i < sizeof($id_kontaknya);$i++) {
                DB::table('kontak')->where('id_kontak',$id_kontaknya[$i])->update([
                        'status_kontak'    => 'Dibaca'
                    ]);
            }
            return redirect('admin/kontak')->with(['sukses' => 'Data telah diupdate']);
        }
    }
}
