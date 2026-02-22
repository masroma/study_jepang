<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class Profile extends Controller
{
    // Index - Edit Profile
    public function index()
    {
        if(Session::get('username')=="") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }

        if(Session::get('akses_level') !== 'User') {
            return redirect('admin/v2')->with(['warning' => 'Akses ditolak']);
        }

        $site = DB::table('konfigurasi')->first();
        $user = DB::table('users')->where('id_user', Session::get('id_user'))->first();

        $data = [
            'title' => 'Profil Saya - ' . $site->namaweb,
            'site' => $site,
            'user' => $user
        ];

        return view('member.profile.index', $data);
    }

    // Update Profile
    public function update(Request $request)
    {
        if(Session::get('username')=="") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }

        if(Session::get('akses_level') !== 'User') {
            return redirect('admin/v2')->with(['warning' => 'Akses ditolak']);
        }

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.Session::get('id_user').',id_user',
            'whatsapp' => 'nullable|string|max:20',
        ]);

        $updateData = [
            'nama' => $request->nama,
            'email' => $request->email,
            'whatsapp' => $request->whatsapp,
            'updated_at' => now()
        ];

        // Upload gambar jika ada
        if($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $filenamewithextension = $image->getClientOriginalName();
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $input['nama_file'] = Str::slug($filename, '-').'-'.time().'.'.$image->getClientOriginalExtension();
            
            // Upload original image to S3
            $s3Path = 'assets/upload/user/' . $input['nama_file'];
            Storage::disk('s3')->put($s3Path, file_get_contents($image->getRealPath()), 'public');
            
            // Create thumbnail and upload to S3
            $img = Image::make($image->getRealPath())->resize(150, 150);
            $thumbnailPath = 'assets/upload/user/thumbs/' . $input['nama_file'];
            Storage::disk('s3')->put($thumbnailPath, $img->encode()->getEncoded(), 'public');
            
            $updateData['gambar'] = $input['nama_file'];
        }

        DB::table('users')
            ->where('id_user', Session::get('id_user'))
            ->update($updateData);

        // Update session
        Session::put('nama', $request->nama);
        Session::put('email', $request->email);

        return redirect('member/profile')->with(['sukses' => 'Profile berhasil diupdate']);
    }

    // Edit Password
    public function password()
    {
        if(Session::get('username')=="") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }

        if(Session::get('akses_level') !== 'User') {
            return redirect('admin/v2')->with(['warning' => 'Akses ditolak']);
        }

        $site = DB::table('konfigurasi')->first();
        $user = DB::table('users')->where('id_user', Session::get('id_user'))->first();

        $data = [
            'title' => 'Ubah Password - ' . $site->namaweb,
            'site' => $site,
            'user' => $user
        ];

        return view('member.profile.password', $data);
    }

    // Update Password
    public function updatePassword(Request $request)
    {
        if(Session::get('username')=="") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }

        if(Session::get('akses_level') !== 'User') {
            return redirect('admin/v2')->with(['warning' => 'Akses ditolak']);
        }

        $request->validate([
            'password_lama' => 'required',
            'password_baru' => 'required|min:6|confirmed',
        ]);

        $user = DB::table('users')->where('id_user', Session::get('id_user'))->first();

        // Cek password lama
        if(sha1($request->password_lama) != $user->password) {
            return redirect('member/password')->with(['warning' => 'Password lama tidak sesuai']);
        }

        // Update password baru
        DB::table('users')
            ->where('id_user', Session::get('id_user'))
            ->update([
                'password' => sha1($request->password_baru),
                'updated_at' => now()
            ]);

        return redirect('member/password')->with(['sukses' => 'Password berhasil diubah']);
    }
}
