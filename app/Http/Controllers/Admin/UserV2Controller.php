<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Image;

class UserV2Controller extends Controller
{
    // Index
    public function index(Request $request)
    {
        if (Session::get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        
        $site = DB::table('konfigurasi')->first();
        
        // Per page (default 10)
        $perPage = $request->get('per_page', 10);
        $perPage = in_array($perPage, [10, 25, 50, 100]) ? $perPage : 10;
        
        // Query
        $query = DB::table('users')->orderBy('id_user', 'DESC');
        
        // Search
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'LIKE', "%{$search}%")
                  ->orWhere('username', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }
        
        // Filter akses_level
        if ($request->has('akses_level') && $request->akses_level != '') {
            $query->where('akses_level', $request->akses_level);
        }
        
        $users = $query->paginate($perPage)->withQueryString();
        
        $data = [
            'title' => 'Manajemen User - ' . $site->namaweb,
            'site' => $site,
            'users' => $users,
            'current_search' => $request->search ?? '',
            'current_akses_level' => $request->akses_level ?? '',
            'current_per_page' => $perPage
        ];
        
        return view('admin.v2.user.index', $data);
    }

    // Tambah
    public function tambah()
    {
        if (Session::get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        
        $site = DB::table('konfigurasi')->first();
        
        $data = [
            'title' => 'Tambah User - ' . $site->namaweb,
            'site' => $site
        ];
        
        return view('admin.v2.user.tambah', $data);
    }

    // Edit
    public function edit($id_user)
    {
        if (Session::get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        
        $site = DB::table('konfigurasi')->first();
        $user = DB::table('users')->where('id_user', $id_user)->first();
        
        if (!$user) {
            return redirect('admin/v2/user')->with(['warning' => 'User tidak ditemukan']);
        }
        
        $data = [
            'title' => 'Edit User - ' . $site->namaweb,
            'site' => $site,
            'user' => $user
        ];
        
        return view('admin.v2.user.edit', $data);
    }

    // Proses Tambah
    public function tambah_proses(Request $request)
    {
        if (Session::get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        
        $request->validate([
            'nama' => 'required|string|max:50',
            'username' => 'required|string|max:32|unique:users,username',
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:6',
            'akses_level' => 'required|in:Admin,User',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:8024'
        ]);

        $data = [
            'nama' => $request->nama,
            'username' => $request->username,
            'email' => $request->email,
            'password' => sha1($request->password),
            'akses_level' => $request->akses_level,
            'tanggal' => now()
        ];

        // Upload gambar
        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $filenamewithextension = $image->getClientOriginalName();
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $nama_file = Str::slug($filename, '-') . '-' . time() . '.' . $image->getClientOriginalExtension();
            
            // Upload original image to S3
            $s3Path = 'assets/upload/user/' . $nama_file;
            Storage::disk('s3')->put($s3Path, file_get_contents($image->getRealPath()), 'public');
            
            // Create thumbnail and upload to S3
            $img = Image::make($image->getRealPath())->resize(150, 150);
            $thumbnailPath = 'assets/upload/user/thumbs/' . $nama_file;
            Storage::disk('s3')->put($thumbnailPath, $img->encode()->getEncoded(), 'public');
            
            $data['gambar'] = $nama_file;
        }

        DB::table('users')->insert($data);

        return redirect('admin/v2/user')->with(['sukses' => 'User berhasil ditambahkan']);
    }

    // Proses Edit
    public function edit_proses(Request $request)
    {
        if (Session::get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        
        $request->validate([
            'id_user' => 'required|exists:users,id_user',
            'nama' => 'required|string|max:50',
            'username' => 'required|string|max:32|unique:users,username,' . $request->id_user . ',id_user',
            'email' => 'required|email|max:255',
            'password' => 'nullable|string|min:6',
            'akses_level' => 'required|in:Admin,User',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:8024'
        ]);

        $user = DB::table('users')->where('id_user', $request->id_user)->first();
        
        if (!$user) {
            return redirect('admin/v2/user')->with(['warning' => 'User tidak ditemukan']);
        }

        $data = [
            'nama' => $request->nama,
            'username' => $request->username,
            'email' => $request->email,
            'akses_level' => $request->akses_level,
            'tanggal' => now()
        ];

        // Update password jika diisi
        if ($request->filled('password')) {
            $data['password'] = sha1($request->password);
        }

        // Upload gambar baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($user->gambar) {
                $oldImagePath = 'assets/upload/user/' . $user->gambar;
                $oldThumbPath = 'assets/upload/user/thumbs/' . $user->gambar;
                if (Storage::disk('s3')->exists($oldImagePath)) {
                    Storage::disk('s3')->delete($oldImagePath);
                }
                if (Storage::disk('s3')->exists($oldThumbPath)) {
                    Storage::disk('s3')->delete($oldThumbPath);
                }
            }

            $image = $request->file('gambar');
            $filenamewithextension = $image->getClientOriginalName();
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $nama_file = Str::slug($filename, '-') . '-' . time() . '.' . $image->getClientOriginalExtension();
            
            // Upload original image to S3
            $s3Path = 'assets/upload/user/' . $nama_file;
            Storage::disk('s3')->put($s3Path, file_get_contents($image->getRealPath()), 'public');
            
            // Create thumbnail and upload to S3
            $img = Image::make($image->getRealPath())->resize(150, 150);
            $thumbnailPath = 'assets/upload/user/thumbs/' . $nama_file;
            Storage::disk('s3')->put($thumbnailPath, $img->encode()->getEncoded(), 'public');
            
            $data['gambar'] = $nama_file;
        }

        DB::table('users')->where('id_user', $request->id_user)->update($data);

        return redirect('admin/v2/user')->with(['sukses' => 'User berhasil diperbarui']);
    }

    // Delete
    public function delete($id_user)
    {
        if (Session::get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        
        $user = DB::table('users')->where('id_user', $id_user)->first();
        
        if (!$user) {
            return redirect('admin/v2/user')->with(['warning' => 'User tidak ditemukan']);
        }

        // Hapus gambar jika ada
        if ($user->gambar) {
            $oldImagePath = 'assets/upload/user/' . $user->gambar;
            $oldThumbPath = 'assets/upload/user/thumbs/' . $user->gambar;
            if (Storage::disk('s3')->exists($oldImagePath)) {
                Storage::disk('s3')->delete($oldImagePath);
            }
            if (Storage::disk('s3')->exists($oldThumbPath)) {
                Storage::disk('s3')->delete($oldThumbPath);
            }
        }
        
        DB::table('users')->where('id_user', $id_user)->delete();

        return redirect('admin/v2/user')->with(['sukses' => 'User berhasil dihapus']);
    }
}
