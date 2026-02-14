<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Schema;

class DashboardV2 extends Controller
{
    // Index Dashboard
    public function index()
    {
        if(Session::get('username')=="") {
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }

        $site = DB::table('konfigurasi')->first();
        $user = DB::table('users')->where('id_user', Session::get('id_user'))->first();

        // Statistik dengan pengecekan tabel
        $stats = [
            'berita' => Schema::hasTable('berita') ? DB::table('berita')->where('jenis_berita', 'Berita')->count() : 0,
            'layanan' => Schema::hasTable('berita') ? DB::table('berita')->where('jenis_berita', 'Layanan')->count() : 0,
            'galeri' => Schema::hasTable('galeri') ? DB::table('galeri')->count() : 0,
            'agenda' => Schema::hasTable('agenda') ? DB::table('agenda')->count() : 0,
            'video' => Schema::hasTable('video') ? DB::table('video')->count() : 0,
            'staff' => Schema::hasTable('staff') ? DB::table('staff')->count() : 0,
            'loker' => Schema::hasTable('loker') ? DB::table('loker')->count() : 0,
            'kontak' => Schema::hasTable('kontak') ? DB::table('kontak')->where('status_kontak', 'Baru')->count() : 0,
            // Statistik baru
            'product' => Schema::hasTable('produk') ? DB::table('produk')->count() : (Schema::hasTable('product') ? DB::table('product')->count() : 0),
            'pelamar' => Schema::hasTable('pendaftaran_loker') ? DB::table('pendaftaran_loker')->count() : 0,
            'industri' => Schema::hasTable('industri') ? DB::table('industri')->count() : 0,
        ];

        $data = [
            'title' => 'Dashboard - ' . $site->namaweb,
            'site' => $site,
            'user' => $user,
            'stats' => $stats
        ];

        return view('admin.v2.dashboard.index', $data);
    }

    // Edit Profile
    public function editProfile()
    {
        if(Session::get('username')=="") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }

        $site = DB::table('konfigurasi')->first();
        $user = DB::table('users')->where('id_user', Session::get('id_user'))->first();

        $data = [
            'title' => 'Edit Profile - ' . $site->namaweb,
            'site' => $site,
            'user' => $user
        ];

        return view('admin.v2.profile.edit', $data);
    }

    // Update Profile
    public function updateProfile(Request $request)
    {
        if(Session::get('username')=="") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'username' => 'required|string|max:255|unique:users,username,'.Session::get('id_user').',id_user',
        ]);

        $updateData = [
            'nama' => $request->nama,
            'username' => $request->username,
            'updated_at' => now()
        ];

        if($request->email) {
            $updateData['email'] = $request->email;
        }

        DB::table('users')
            ->where('id_user', Session::get('id_user'))
            ->update($updateData);

        // Update session
        Session::put('nama', $request->nama);
        Session::put('username', $request->username);
        if($request->email) {
            Session::put('email', $request->email);
        }

        return redirect('admin/v2/profile/edit')->with(['sukses' => 'Profile berhasil diupdate']);
    }

    // Edit Password
    public function editPassword()
    {
        if(Session::get('username')=="") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }

        $site = DB::table('konfigurasi')->first();
        $user = DB::table('users')->where('id_user', Session::get('id_user'))->first();

        $data = [
            'title' => 'Ubah Password - ' . $site->namaweb,
            'site' => $site,
            'user' => $user
        ];

        return view('admin.v2.password.edit', $data);
    }

    // Update Password
    public function updatePassword(Request $request)
    {
        if(Session::get('username')=="") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }

        $request->validate([
            'password_lama' => 'required',
            'password_baru' => 'required|min:6|confirmed',
        ]);

        $user = DB::table('users')->where('id_user', Session::get('id_user'))->first();

        // Cek password lama
        if(sha1($request->password_lama) != $user->password) {
            return redirect('admin/v2/password/edit')->with(['warning' => 'Password lama tidak sesuai']);
        }

        // Update password baru
        DB::table('users')
            ->where('id_user', Session::get('id_user'))
            ->update([
                'password' => sha1($request->password_baru),
                'updated_at' => now()
            ]);

        return redirect('admin/v2/password/edit')->with(['sukses' => 'Password berhasil diubah']);
    }

    // Logout
    public function logout()
    {
        Session::forget('id_user');
        Session::forget('nama');
        Session::forget('username');
        Session::forget('akses_level');
        return redirect('login')->with(['sukses' => 'Anda berhasil logout']);
    }
}
