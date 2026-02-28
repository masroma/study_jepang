<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Image;
use App\Models\Loker_model;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class Loker extends Controller
{
    // Main page
    public function index()
    {
        if(Session::get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);}
        $myloker = new Loker_model();
        $loker = $myloker->semua();

        $data = array(  'title'     => 'Data Lowongan Kerja (Loker)',
                        'loker'     => $loker,
                        'content'   => 'admin/loker/index'
                    );
        return view('admin/layout/wrapper',$data);
    }

    // Cari
    public function cari(Request $request)
    {
        if(Session::get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);}
        $myloker = new Loker_model();
        $keywords = $request->keywords;
        $loker = $myloker->cari($keywords);

        $data = array(  'title'     => 'Data Lowongan Kerja (Loker)',
                        'loker'     => $loker,
                        'content'   => 'admin/loker/index'
                    );
        return view('admin/layout/wrapper',$data);
    }

    // Status
    public function status_loker($status_loker)
    {
        if(Session::get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);}
        $myloker = new Loker_model();
        $loker = $myloker->status($status_loker);

        $data = array(  'title'     => 'Data Lowongan Kerja (Loker)',
                        'loker'     => $loker,
                        'content'   => 'admin/loker/index'
                    );
        return view('admin/layout/wrapper',$data);
    }

    // Tambah
    public function tambah()
    {
        if(Session::get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);}

        $data = array(  'title'     => 'Tambah Lowongan Kerja',
                        'content'   => 'admin/loker/tambah'
                    );
        return view('admin/layout/wrapper',$data);
    }

    // Edit
    public function edit($id_loker)
    {
        if(Session::get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);}
        $myloker = new Loker_model();
        $loker = $myloker->detail($id_loker);

        $data = array(  'title'     => 'Edit Lowongan Kerja',
                        'loker'     => $loker,
                        'content'   => 'admin/loker/edit'
                    );
        return view('admin/layout/wrapper',$data);
    }

    // Delete
    public function delete($id_loker)
    {
        if(Session::get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);}
        
        $myloker = new Loker_model();
        $loker = $myloker->detail($id_loker);
        
        // Hapus gambar jika ada
        if($loker->gambar && Storage::disk('public')->exists('assets/upload/image/loker/'.$loker->gambar)) {
            Storage::disk('public')->delete('assets/upload/image/loker/'.$loker->gambar);
        }
        
        DB::table('loker')->where('id_loker',$id_loker)->delete();
        return redirect('admin/loker')->with(['sukses' => 'Data telah dihapus']);
    }

    // Proses
    public function proses(Request $request)
    {
        $site = DB::table('konfigurasi')->first();
        $pengalihan = $request->pengalihan;
        
        // PROSES HAPUS MULTIPLE
        if(isset($_POST['hapus'])) {
            $id_lokernya = $request->id_loker;
            for($i=0; $i < sizeof($id_lokernya);$i++) {
                $loker = DB::table('loker')->where('id_loker',$id_lokernya[$i])->first();
                if($loker->gambar && Storage::disk('public')->exists('assets/upload/image/loker/'.$loker->gambar)) {
                    Storage::disk('public')->delete('assets/upload/image/loker/'.$loker->gambar);
                }
                DB::table('loker')->where('id_loker',$id_lokernya[$i])->delete();
            }
            return redirect($pengalihan)->with(['sukses' => 'Data telah dihapus']);
        // PROSES SETTING PUBLISH
        }elseif(isset($_POST['publish'])) {
            $id_lokernya = $request->id_loker;
            for($i=0; $i < sizeof($id_lokernya);$i++) {
                DB::table('loker')->where('id_loker',$id_lokernya[$i])->update([
                        'status_loker' => 'Publish'
                    ]);
            }
            return redirect($pengalihan)->with(['sukses' => 'Data telah diubah menjadi Publish']);
        // PROSES SETTING DRAFT
        }elseif(isset($_POST['draft'])) {
            $id_lokernya = $request->id_loker;
            for($i=0; $i < sizeof($id_lokernya);$i++) {
                DB::table('loker')->where('id_loker',$id_lokernya[$i])->update([
                        'status_loker' => 'Draft'
                    ]);
            }
            return redirect($pengalihan)->with(['sukses' => 'Data telah diubah menjadi Draft']);
        // PROSES SETTING TUTUP
        }elseif(isset($_POST['tutup'])) {
            $id_lokernya = $request->id_loker;
            for($i=0; $i < sizeof($id_lokernya);$i++) {
                DB::table('loker')->where('id_loker',$id_lokernya[$i])->update([
                        'status_loker' => 'Tutup'
                    ]);
            }
            return redirect($pengalihan)->with(['sukses' => 'Data telah diubah menjadi Tutup']);
        }
    }

    // Tambah Proses
    public function tambah_proses(Request $request)
    {
        if(Session::get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);}

        $request->validate([
            'judul_loker' => 'required|string|max:255',
            'posisi' => 'required|string|max:255',
            'isi_loker' => 'required|string',
            'tipe_loker' => 'required|in:instruktur,luar_negeri',
            'status_loker' => 'required|in:Publish,Draft,Tutup'
        ]);

        $slug_loker = Str::slug($request->judul_loker, '-');

        // Cek slug unique
        $cek_slug = DB::table('loker')->where('slug_loker', $slug_loker)->count();
        if($cek_slug > 0) {
            $slug_loker = $slug_loker . '-' . time();
        }

        // Upload gambar
        $gambar = null;
        if($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $gambar = time().'.'.$image->getClientOriginalExtension();
            $s3Path = 'assets/upload/image/loker/' . $gambar;
            Storage::disk('public')->put($s3Path, file_get_contents($image->getRealPath()), 'public');
        }

        $data = [
            'judul_loker' => $request->judul_loker,
            'slug_loker' => $slug_loker,
            'deskripsi_singkat' => $request->deskripsi_singkat,
            'isi_loker' => $request->isi_loker,
            'posisi' => $request->posisi,
            'lokasi_kerja' => $request->lokasi_kerja,
            'tipe_kerja' => $request->tipe_kerja,
            'tipe_loker' => $request->tipe_loker,
            'persyaratan' => $request->persyaratan,
            'tanggung_jawab' => $request->tanggung_jawab,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'status_loker' => $request->status_loker,
            'gambar' => $gambar,
            'urutan' => $request->urutan ?? 0,
            'created_at' => now(),
            'updated_at' => now()
        ];

        DB::table('loker')->insert($data);

        return redirect('admin/loker')->with(['sukses' => 'Data telah ditambahkan']);
    }

    // Edit Proses
    public function edit_proses(Request $request)
    {
        if(Session::get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);}

        $request->validate([
            'judul_loker' => 'required|string|max:255',
            'posisi' => 'required|string|max:255',
            'isi_loker' => 'required|string',
            'tipe_loker' => 'required|in:instruktur,luar_negeri',
            'status_loker' => 'required|in:Publish,Draft,Tutup'
        ]);

        $id_loker = $request->id_loker;
        $myloker = new Loker_model();
        $loker = $myloker->detail($id_loker);

        $slug_loker = Str::slug($request->judul_loker, '-');

        // Cek slug unique
        $cek_slug = DB::table('loker')->where('slug_loker', $slug_loker)->where('id_loker', '!=', $id_loker)->count();
        if($cek_slug > 0) {
            $slug_loker = $slug_loker . '-' . time();
        }

        // Upload gambar baru
        $gambar = $loker->gambar;
        if($request->hasFile('gambar')) {
            // Hapus gambar lama
            if($gambar && Storage::disk('public')->exists('assets/upload/image/loker/'.$gambar)) {
                Storage::disk('public')->delete('assets/upload/image/loker/'.$gambar);
            }

            $image = $request->file('gambar');
            $gambar = time().'.'.$image->getClientOriginalExtension();
            $s3Path = 'assets/upload/image/loker/' . $gambar;
            Storage::disk('public')->put($s3Path, file_get_contents($image->getRealPath()), 'public');
        }

        $data = [
            'judul_loker' => $request->judul_loker,
            'slug_loker' => $slug_loker,
            'deskripsi_singkat' => $request->deskripsi_singkat,
            'isi_loker' => $request->isi_loker,
            'posisi' => $request->posisi,
            'lokasi_kerja' => $request->lokasi_kerja,
            'tipe_kerja' => $request->tipe_kerja,
            'tipe_loker' => $request->tipe_loker,
            'persyaratan' => $request->persyaratan,
            'tanggung_jawab' => $request->tanggung_jawab,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'status_loker' => $request->status_loker,
            'gambar' => $gambar,
            'urutan' => $request->urutan ?? 0,
            'updated_at' => now()
        ];

        DB::table('loker')->where('id_loker', $id_loker)->update($data);

        return redirect('admin/loker')->with(['sukses' => 'Data telah diperbarui']);
    }
}
