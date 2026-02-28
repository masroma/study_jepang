<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Image;
use App\Models\HomeContent;
use Illuminate\Support\Facades\Storage;

class HomeContentController extends Controller
{
    // Index
    public function index()
    {
        if (Session()->get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        $contents = HomeContent::orderBy('urutan', 'ASC')->get();
        $data = array(
            'title' => 'Kelola Konten Halaman Utama',
            'contents' => $contents,
            'content' => 'admin/home_content/index'
        );
        return view('admin/layout/wrapper', $data);
    }

    // Tambah
    public function tambah()
    {
        if (Session()->get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        $data = array(
            'title' => 'Tambah Konten Halaman Utama',
            'content' => 'admin/home_content/tambah'
        );
        return view('admin/layout/wrapper', $data);
    }

    // Edit
    public function edit($id)
    {
        if (Session()->get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        $content = HomeContent::find($id);
        $data = array(
            'title' => 'Edit Konten Halaman Utama',
            'content' => $content,
            'content_view' => 'admin/home_content/edit'
        );
        return view('admin/layout/wrapper', $data);
    }

    // Proses Tambah
    public function tambah_proses(Request $request)
    {
        if (Session()->get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        request()->validate([
            'section' => 'required',
            'content' => 'required'
        ]);

        $image = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $s3Path = 'upload/' . $filename;
            Storage::disk('public')->put($s3Path, file_get_contents($file->getRealPath()), 'public');
            $image = $filename;
        }

        $video = null;
        if ($request->hasFile('video')) {
            $file = $request->file('video');
            $filename = time() . '_' . $file->getClientOriginalName();
            $s3Path = 'upload/' . $filename;
            Storage::disk('public')->put($s3Path, file_get_contents($file->getRealPath()), 'public');
            $video = $filename;
        }

        HomeContent::create([
            'section' => $request->section,
            'content' => $request->content,
            'image' => $image,
            'video' => $video,
            'link' => $request->link,
            'active' => $request->active ? 1 : 0,
            'urutan' => $request->urutan ?? 0
        ]);

        return redirect('admin/home_content')->with(['sukses' => 'Konten telah ditambah']);
    }

    // Proses Edit
    public function edit_proses(Request $request)
    {
        if (Session()->get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        request()->validate([
            'section' => 'required',
            'content' => 'required'
        ]);

        $content = HomeContent::find($request->id);
        $image = $content->image;
        if ($request->hasFile('image')) {
            // Delete old image
            if ($content->image && Storage::disk('public')->exists('upload/' . $content->image)) {
                Storage::disk('public')->delete('upload/' . $content->image);
            }
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $s3Path = 'upload/' . $filename;
            Storage::disk('public')->put($s3Path, file_get_contents($file->getRealPath()), 'public');
            $image = $filename;
        }

        $video = $content->video;
        if ($request->hasFile('video')) {
            // Delete old video
            if ($content->video && Storage::disk('public')->exists('upload/' . $content->video)) {
                Storage::disk('public')->delete('upload/' . $content->video);
            }
            $file = $request->file('video');
            $filename = time() . '_' . $file->getClientOriginalName();
            $s3Path = 'upload/' . $filename;
            Storage::disk('public')->put($s3Path, file_get_contents($file->getRealPath()), 'public');
            $video = $filename;
        }

        $content->update([
            'section' => $request->section,
            'content' => $request->content,
            'image' => $image,
            'video' => $video,
            'link' => $request->link,
            'active' => $request->active ? 1 : 0,
            'urutan' => $request->urutan ?? 0
        ]);

        return redirect('admin/home_content')->with(['sukses' => 'Konten telah diupdate']);
    }

    // Delete
    public function delete($id)
    {
        if (Session()->get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        $content = HomeContent::find($id);
        if ($content->image && Storage::disk('public')->exists('upload/' . $content->image)) {
            Storage::disk('public')->delete('upload/' . $content->image);
        }
        if ($content->video && Storage::disk('public')->exists('upload/' . $content->video)) {
            Storage::disk('public')->delete('upload/' . $content->video);
        }
        $content->delete();
        return redirect('admin/home_content')->with(['sukses' => 'Konten telah dihapus']);
    }
}
