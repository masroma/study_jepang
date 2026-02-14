<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use App\Models\HeroSlider;
use App\Models\Konfigurasi_model;

class HeroSliderController extends Controller
{
    // Index
    public function index()
    {
        if (Session()->get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        
        $mysite = new Konfigurasi_model();
        $site = $mysite->listing();
        
        $sliders = HeroSlider::orderBy('urutan', 'ASC')->orderBy('id_hero', 'DESC')->get();
        
        $data = array(
            'title' => 'Kelola Hero Slider - ' . $site->namaweb,
            'sliders' => $sliders,
            'content' => 'admin/hero_slider/index'
        );
        return view('admin/layout/wrapper', $data);
    }

    // Tambah
    public function tambah()
    {
        if (Session()->get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        
        $mysite = new Konfigurasi_model();
        $site = $mysite->listing();
        
        $data = array(
            'title' => 'Tambah Hero Slider - ' . $site->namaweb,
            'content' => 'admin/hero_slider/tambah'
        );
        return view('admin/layout/wrapper', $data);
    }

    // Edit
    public function edit($id)
    {
        if (Session()->get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        
        $mysite = new Konfigurasi_model();
        $site = $mysite->listing();
        
        $slider = HeroSlider::find($id);
        
        if (!$slider) {
            return redirect('admin/hero-slider')->with(['warning' => 'Hero slider tidak ditemukan']);
        }
        
        // Decode person_images if it's a JSON string (for display in view)
        if ($slider->person_images && is_string($slider->person_images)) {
            $decoded = json_decode($slider->person_images, true);
            if (is_array($decoded)) {
                $slider->person_images = $decoded;
            }
        }
        
        $data = array(
            'title' => 'Edit Hero Slider - ' . $site->namaweb,
            'slider' => $slider,
            'content' => 'admin/hero_slider/edit'
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
            'title_id' => 'required',
            'urutan' => 'nullable|integer',
        ]);

        // Upload background image
        $background_image = null;
        if ($request->hasFile('background_image')) {
            $file = $request->file('background_image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $s3Path = 'assets/upload/image/hero/' . $filename;
            Storage::disk('s3')->put($s3Path, file_get_contents($file->getRealPath()), 'public');
            $background_image = 'assets/upload/image/hero/' . $filename;
        }

        // Upload person image
        $person_image = null;
        if ($request->hasFile('person_image')) {
            $file = $request->file('person_image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $s3Path = 'assets/upload/image/hero/' . $filename;
            Storage::disk('s3')->put($s3Path, file_get_contents($file->getRealPath()), 'public');
            $person_image = 'assets/upload/image/hero/' . $filename;
        }

        // Handle person_images (multiple images)
        $person_images = [];
        if ($request->hasFile('person_images')) {
            foreach ($request->file('person_images') as $file) {
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $s3Path = 'assets/upload/image/hero/' . $filename;
                Storage::disk('s3')->put($s3Path, file_get_contents($file->getRealPath()), 'public');
                $person_images[] = 'assets/upload/image/hero/' . $filename;
            }
        }

        // Prepare create data
        $createData = [
            'title_id' => $request->title_id,
            'title_en' => $request->title_en,
            'title_jp' => $request->title_jp,
            'subtitle_id' => $request->subtitle_id,
            'subtitle_en' => $request->subtitle_en,
            'subtitle_jp' => $request->subtitle_jp,
            'country_id' => $request->country_id,
            'country_en' => $request->country_en,
            'country_jp' => $request->country_jp,
            'description_id' => $request->description_id,
            'description_en' => $request->description_en,
            'description_jp' => $request->description_jp,
            'background_image' => $background_image,
            'person_image' => $person_image,
            'button_text_id' => $request->button_text_id,
            'button_text_en' => $request->button_text_en,
            'button_text_jp' => $request->button_text_jp,
            'button_link' => $request->button_link,
            'video_link' => $request->video_link,
            'urutan' => $request->urutan ?? 0,
            'status' => $request->status ?? 'Publish'
        ];

        // Only add person_images if column exists in database
        if (Schema::hasColumn('hero_sliders', 'person_images')) {
            $createData['person_images'] = !empty($person_images) ? json_encode($person_images) : null;
        }

        HeroSlider::create($createData);

        return redirect('admin/hero-slider')->with(['sukses' => 'Hero slider telah ditambah']);
    }

    // Proses Edit
    public function edit_proses(Request $request)
    {
        if (Session()->get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        
        request()->validate([
            'id_hero' => 'required|exists:hero_sliders,id_hero',
            'title_id' => 'required',
            'urutan' => 'nullable|integer',
        ]);

        $slider = HeroSlider::find($request->id_hero);
        
        if (!$slider) {
            return redirect('admin/hero-slider')->with(['warning' => 'Hero slider tidak ditemukan']);
        }

        // Update background image
        $background_image = $slider->background_image;
        if ($request->hasFile('background_image')) {
            // Delete old image
            if ($slider->background_image && Storage::disk('s3')->exists($slider->background_image)) {
                Storage::disk('s3')->delete($slider->background_image);
            }
            $file = $request->file('background_image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $s3Path = 'assets/upload/image/hero/' . $filename;
            Storage::disk('s3')->put($s3Path, file_get_contents($file->getRealPath()), 'public');
            $background_image = 'assets/upload/image/hero/' . $filename;
        }

        // Update person image
        $person_image = $slider->person_image;
        if ($request->hasFile('person_image')) {
            // Delete old image
            if ($slider->person_image && Storage::disk('s3')->exists($slider->person_image)) {
                Storage::disk('s3')->delete($slider->person_image);
            }
            $file = $request->file('person_image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $s3Path = 'assets/upload/image/hero/' . $filename;
            Storage::disk('s3')->put($s3Path, file_get_contents($file->getRealPath()), 'public');
            $person_image = 'assets/upload/image/hero/' . $filename;
        }

        // Handle person_images (multiple images) - INI YANG DIHAPUS, BUKAN person_image
        $person_images = $slider->person_images ?? null;
        // Decode if it's a JSON string
        if (is_string($person_images)) {
            $person_images = json_decode($person_images, true) ?? [];
        }
        if (!is_array($person_images)) {
            $person_images = [];
        }

        if ($request->hasFile('person_images')) {
            // Delete old person_images (multiple images) - BUKAN person_image (single)
            if (!empty($person_images) && is_array($person_images)) {
                foreach ($person_images as $oldImage) {
                    if ($oldImage && Storage::disk('s3')->exists($oldImage)) {
                        Storage::disk('s3')->delete($oldImage);
                    }
                }
            }
            
            // Upload new person_images
            $person_images = [];
            foreach ($request->file('person_images') as $file) {
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $s3Path = 'assets/upload/image/hero/' . $filename;
                Storage::disk('s3')->put($s3Path, file_get_contents($file->getRealPath()), 'public');
                $person_images[] = 'assets/upload/image/hero/' . $filename;
            }
        }

        // Prepare update data
        $updateData = [
            'title_id' => $request->title_id,
            'title_en' => $request->title_en,
            'title_jp' => $request->title_jp,
            'subtitle_id' => $request->subtitle_id,
            'subtitle_en' => $request->subtitle_en,
            'subtitle_jp' => $request->subtitle_jp,
            'country_id' => $request->country_id,
            'country_en' => $request->country_en,
            'country_jp' => $request->country_jp,
            'description_id' => $request->description_id,
            'description_en' => $request->description_en,
            'description_jp' => $request->description_jp,
            'background_image' => $background_image,
            'person_image' => $person_image,
            'button_text_id' => $request->button_text_id,
            'button_text_en' => $request->button_text_en,
            'button_text_jp' => $request->button_text_jp,
            'button_link' => $request->button_link,
            'video_link' => $request->video_link,
            'urutan' => $request->urutan ?? $slider->urutan,
            'status' => $request->status ?? $slider->status
        ];

        // Only add person_images if column exists in database
        if (Schema::hasColumn('hero_sliders', 'person_images')) {
            $updateData['person_images'] = !empty($person_images) ? json_encode($person_images) : $slider->person_images;
        }

        $slider->update($updateData);

        return redirect('admin/hero-slider')->with(['sukses' => 'Hero slider telah diupdate']);
    }

    // Delete
    public function delete($id)
    {
        if (Session()->get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        
        $slider = HeroSlider::find($id);
        
        if (!$slider) {
            return redirect('admin/hero-slider')->with(['warning' => 'Hero slider tidak ditemukan']);
        }

        // Delete images
        if ($slider->background_image && Storage::disk('s3')->exists($slider->background_image)) {
            Storage::disk('s3')->delete($slider->background_image);
        }
        
        if ($slider->person_image && Storage::disk('s3')->exists($slider->person_image)) {
            Storage::disk('s3')->delete($slider->person_image);
        }
        
        if (!empty($slider->person_images) && is_array($slider->person_images)) {
            foreach ($slider->person_images as $image) {
                if ($image && Storage::disk('s3')->exists($image)) {
                    Storage::disk('s3')->delete($image);
                }
            }
        }

        $slider->delete();
        
        return redirect('admin/hero-slider')->with(['sukses' => 'Hero slider telah dihapus']);
    }
}
