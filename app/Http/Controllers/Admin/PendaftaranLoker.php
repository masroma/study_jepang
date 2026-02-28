<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PendaftaranLoker_model;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class PendaftaranLoker extends Controller
{
    // Index
    public function index()
    {
        if(Session::get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);}
        $mypendaftaran = new PendaftaranLoker_model();
        $pendaftaran = $mypendaftaran->semua();

        $data = array(  'title'         => 'Data Pendaftaran Lowongan Kerja',
                        'pendaftaran'   => $pendaftaran,
                        'content'       => 'admin/pendaftaran_loker/index');
        return view('admin/layout/wrapper',$data);
    }

    // Cari
    public function cari(Request $request)
    {
        if(Session::get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);}
        $mypendaftaran = new PendaftaranLoker_model();
        $keywords = $request->keywords;
        $pendaftaran = $mypendaftaran->cari($keywords);

        $data = array(  'title'         => 'Data Pendaftaran Lowongan Kerja',
                        'pendaftaran'   => $pendaftaran,
                        'content'       => 'admin/pendaftaran_loker/index');
        return view('admin/layout/wrapper',$data);
    }

    // Status
    public function status_pendaftaran($status_pendaftaran)
    {
        if(Session::get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);}
        $mypendaftaran = new PendaftaranLoker_model();
        $pendaftaran = $mypendaftaran->status($status_pendaftaran);

        $data = array(  'title'         => 'Data Pendaftaran Lowongan Kerja',
                        'pendaftaran'   => $pendaftaran,
                        'content'       => 'admin/pendaftaran_loker/index');
        return view('admin/layout/wrapper',$data);
    }

    // Detail
    public function detail($id_pendaftaran)
    {
        if(Session::get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);}
        $mypendaftaran = new PendaftaranLoker_model();
        $pendaftaran = $mypendaftaran->detail($id_pendaftaran);

        $data = array(  'title'         => 'Detail Pendaftaran Lowongan Kerja',
                        'pendaftaran'   => $pendaftaran,
                        'content'       => 'admin/pendaftaran_loker/detail');
        return view('admin/layout/wrapper',$data);
    }

    // Delete
    public function delete($id_pendaftaran)
    {
        if(Session::get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);}
        
        $mypendaftaran = new PendaftaranLoker_model();
        $pendaftaran = $mypendaftaran->detail($id_pendaftaran);
        
        // Hapus file CV jika ada
        if($pendaftaran->cv_file && Storage::disk('public')->exists('assets/upload/file/cv/'.$pendaftaran->cv_file)) {
            Storage::disk('public')->delete('assets/upload/file/cv/'.$pendaftaran->cv_file);
        }
        
        DB::table('pendaftaran_loker')->where('id_pendaftaran',$id_pendaftaran)->delete();
        return redirect('admin/pendaftaran-loker')->with(['sukses' => 'Data telah dihapus']);
    }

    // Proses
    public function proses(Request $request)
    {
        $site = DB::table('konfigurasi')->first();
        // PROSES HAPUS MULTIPLE
        if(isset($_POST['hapus'])) {
            $id_pendaftarannya = $request->id_pendaftaran;
            for($i=0; $i < sizeof($id_pendaftarannya);$i++) {
                $pendaftaran = DB::table('pendaftaran_loker')->where('id_pendaftaran',$id_pendaftarannya[$i])->first();
                if($pendaftaran->cv_file && file_exists(public_path('assets/upload/file/cv/'.$pendaftaran->cv_file))) {
                    unlink(public_path('assets/upload/file/cv/'.$pendaftaran->cv_file));
                }
                DB::table('pendaftaran_loker')->where('id_pendaftaran',$id_pendaftarannya[$i])->delete();
            }
            return redirect('admin/pendaftaran-loker')->with(['sukses' => 'Data telah dihapus']);
        // PROSES SETTING DIBACA
        }elseif(isset($_POST['update'])) {
            $id_pendaftarannya = $request->id_pendaftaran;
            for($i=0; $i < sizeof($id_pendaftarannya);$i++) {
                DB::table('pendaftaran_loker')->where('id_pendaftaran',$id_pendaftarannya[$i])->update([
                        'status_pendaftaran' => 'Dibaca'
                    ]);
            }
            return redirect('admin/pendaftaran-loker')->with(['sukses' => 'Data telah diupdate']);
        }
    }
}
