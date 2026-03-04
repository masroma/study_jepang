<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\HeroSlider;

class SliderController extends Controller
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
        $query = HeroSlider::orderBy('urutan', 'ASC')->orderBy('id_hero', 'DESC');
        
        // Search
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title_id', 'LIKE', "%{$search}%")
                  ->orWhere('title_en', 'LIKE', "%{$search}%")
                  ->orWhere('title_jp', 'LIKE', "%{$search}%")
                  ->orWhere('subtitle_id', 'LIKE', "%{$search}%")
                  ->orWhere('subtitle_en', 'LIKE', "%{$search}%")
                  ->orWhere('subtitle_jp', 'LIKE', "%{$search}%")
                  ->orWhere('description_id', 'LIKE', "%{$search}%")
                  ->orWhere('description_en', 'LIKE', "%{$search}%")
                  ->orWhere('description_jp', 'LIKE', "%{$search}%");
            });
        }
        
        // Filter status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }
        
        $sliders = $query->paginate($perPage)->withQueryString();
        
        // Add image URLs to each slider safely
        // Use getCollection() to modify items in paginated result
        $sliders->getCollection()->transform(function ($slider) {
            // Only show person_image in index
            if ($slider->person_image) {
                $slider->image_url = $this->getImageUrl($slider->person_image);
            } else {
                $slider->image_url = null;
            }
            return $slider;
        });
        
        $data = [
            'title' => 'Kelola Slider Homepage - ' . $site->namaweb,
            'site' => $site,
            'sliders' => $sliders,
            'current_search' => $request->search ?? '',
            'current_status' => $request->status ?? '',
            'current_per_page' => $perPage
        ];
        
        return view('admin.v2.slider.index', $data);
    }

    // Tambah
    public function tambah()
    {
        if (Session::get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        
        $site = DB::table('konfigurasi')->first();
        
        $data = [
            'title' => 'Tambah Slider Homepage - ' . $site->namaweb,
            'site' => $site
        ];
        
        return view('admin.v2.slider.tambah', $data);
    }

    // Edit
    public function edit($id)
    {
        if (Session::get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        
        $site = DB::table('konfigurasi')->first();
        
        $slider = HeroSlider::find($id);
        
        if (!$slider) {
            return redirect('admin/v2/slider')->with(['warning' => 'Slider tidak ditemukan']);
        }
        
        // Decode person_images if it's a JSON string (for display in view)
        if ($slider->person_images && is_string($slider->person_images)) {
            $decoded = json_decode($slider->person_images, true);
            if (is_array($decoded)) {
                $slider->person_images = $decoded;
            }
        }
        
        // Add image URLs safely
        $slider->background_image_url = $slider->background_image ? $this->getImageUrl($slider->background_image) : null;
        $slider->person_image_url = $slider->person_image ? $this->getImageUrl($slider->person_image) : null;
        
        // Add URLs for person_images array
        if (!empty($slider->person_images) && is_array($slider->person_images)) {
            $slider->person_images_urls = [];
            foreach ($slider->person_images as $img) {
                if (!empty($img)) {
                    $slider->person_images_urls[] = $this->getImageUrl($img);
                } else {
                    $slider->person_images_urls[] = null;
                }
            }
        } else {
            $slider->person_images_urls = [];
        }
        
        $data = [
            'title' => 'Edit Slider Homepage - ' . $site->namaweb,
            'site' => $site,
            'slider' => $slider
        ];
        
        return view('admin.v2.slider.edit', $data);
    }

    // Proses Tambah
    public function tambah_proses(Request $request)
    {
        if (Session::get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        
        $request->validate([
            'title_id' => 'required',
            'urutan' => 'nullable|integer',
            'background_image' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:5120', // Max 5MB
            'person_image' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:5120', // Max 5MB
            'person_images.*' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:5120', // Max 5MB per file
        ]);

        // Upload background image
        $background_image = null;
        if ($request->hasFile('background_image')) {
            $file = $request->file('background_image');
            // Validate file size (5MB = 5242880 bytes)
            if ($file->getSize() > 5242880) {
                return redirect()->back()->withInput()->with(['warning' => 'Ukuran file background image terlalu besar. Maksimal 5MB']);
            }
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $s3Path = 'assets/upload/image/hero/' . $filename;
            Storage::disk('s3')->put($s3Path, file_get_contents($file->getRealPath()), 'public');
            $background_image = $s3Path;
        }

        // Upload person_image (single image)
        $person_image = null;
        if ($request->hasFile('person_image')) {
            $file = $request->file('person_image');
            // Validate file size (5MB = 5242880 bytes)
            if ($file->getSize() > 5242880) {
                return redirect()->back()->withInput()->with(['warning' => 'Ukuran file person image terlalu besar. Maksimal 5MB']);
            }
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $s3Path = 'assets/upload/image/hero/' . $filename;
            Storage::disk('s3')->put($s3Path, file_get_contents($file->getRealPath()), 'public');
            $person_image = $s3Path;
        }

        // Handle person_images (multiple images)
        $person_images = [];
        if ($request->hasFile('person_images')) {
            foreach ($request->file('person_images') as $file) {
                // Validate file size (5MB = 5242880 bytes)
                if ($file->getSize() > 5242880) {
                    return redirect()->back()->withInput()->with(['warning' => 'Salah satu file person images terlalu besar. Maksimal 5MB per file']);
                }
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $s3Path = 'assets/upload/image/hero/' . $filename;
                Storage::disk('s3')->put($s3Path, file_get_contents($file->getRealPath()), 'public');
                $person_images[] = $s3Path;
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

        return redirect('admin/v2/slider')->with(['sukses' => 'Slider telah ditambah']);
    }

    // Proses Edit
    public function edit_proses(Request $request)
    {
        if (Session::get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        
        $request->validate([
            'id_hero' => 'required|exists:hero_sliders,id_hero',
            'title_id' => 'required',
            'urutan' => 'nullable|integer',
            'background_image' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:5120', // Max 5MB
            'person_image' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:5120', // Max 5MB
            'person_images.*' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:5120', // Max 5MB per file
        ]);

        $slider = HeroSlider::find($request->id_hero);
        
        if (!$slider) {
            return redirect('admin/v2/slider')->with(['warning' => 'Slider tidak ditemukan']);
        }

        // Update background image
        $background_image = $slider->background_image;
        if ($request->hasFile('background_image')) {
            $file = $request->file('background_image');
            // Validate file size (5MB = 5242880 bytes)
            if ($file->getSize() > 5242880) {
                return redirect()->back()->withInput()->with(['warning' => 'Ukuran file background image terlalu besar. Maksimal 5MB']);
            }
            // Delete old image
            if ($slider->background_image) {
                try {
                    if (Storage::disk('s3')->exists($slider->background_image)) {
                        Storage::disk('s3')->delete($slider->background_image);
                    }
                } catch (\Exception $e) {
                    // Log error but continue - file might not exist in S3
                    Log::warning('Error checking/deleting background_image from S3: ' . $e->getMessage() . ' - Path: ' . $slider->background_image);
                }
            }
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $s3Path = 'assets/upload/image/hero/' . $filename;
            Storage::disk('s3')->put($s3Path, file_get_contents($file->getRealPath()), 'public');
            $background_image = $s3Path;
        }

        // Handle person_image (single image)
        $person_image = $slider->person_image;
        if ($request->hasFile('person_image')) {
            $file = $request->file('person_image');
            // Validate file size (5MB = 5242880 bytes)
            if ($file->getSize() > 5242880) {
                return redirect()->back()->withInput()->with(['warning' => 'Ukuran file person image terlalu besar. Maksimal 5MB']);
            }
            // Delete old image
            if ($slider->person_image) {
                try {
                    if (Storage::disk('s3')->exists($slider->person_image)) {
                        Storage::disk('s3')->delete($slider->person_image);
                    }
                } catch (\Exception $e) {
                    // Log error but continue - file might not exist in S3
                    Log::warning('Error checking/deleting person_image from S3: ' . $e->getMessage() . ' - Path: ' . $slider->person_image);
                }
            }
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $s3Path = 'assets/upload/image/hero/' . $filename;
            Storage::disk('s3')->put($s3Path, file_get_contents($file->getRealPath()), 'public');
            $person_image = $s3Path;
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
                    if ($oldImage) {
                        try {
                            if (Storage::disk('s3')->exists($oldImage)) {
                                Storage::disk('s3')->delete($oldImage);
                            }
                        } catch (\Exception $e) {
                            // Log error but continue - file might not exist in S3
                            Log::warning('Error checking/deleting person_images from S3: ' . $e->getMessage() . ' - Path: ' . $oldImage);
                        }
                    }
                }
            }
            
            // Upload new person_images
            $person_images = [];
            foreach ($request->file('person_images') as $file) {
                // Validate file size (5MB = 5242880 bytes)
                if ($file->getSize() > 5242880) {
                    return redirect()->back()->withInput()->with(['warning' => 'Salah satu file person images terlalu besar. Maksimal 5MB per file']);
                }
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $s3Path = 'assets/upload/image/hero/' . $filename;
                Storage::disk('s3')->put($s3Path, file_get_contents($file->getRealPath()), 'public');
                $person_images[] = $s3Path;
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
            $updateData['person_images'] = !empty($person_images) ? json_encode($person_images) : ($slider->person_images ?? null);
        }

        $slider->update($updateData);

        return redirect('admin/v2/slider')->with(['sukses' => 'Slider telah diupdate']);
    }

    // Delete
    public function delete($id)
    {
        if (Session::get('username') == "") {
            return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        
        $slider = HeroSlider::find($id);
        
        if (!$slider) {
            return redirect('admin/v2/slider')->with(['warning' => 'Slider tidak ditemukan']);
        }

        // Delete images
        if ($slider->background_image) {
            try {
                if (Storage::disk('s3')->exists($slider->background_image)) {
                    Storage::disk('s3')->delete($slider->background_image);
                }
            } catch (\Exception $e) {
                Log::warning('Error checking/deleting background_image from S3: ' . $e->getMessage() . ' - Path: ' . $slider->background_image);
            }
        }
        
        if ($slider->person_image) {
            try {
                if (Storage::disk('s3')->exists($slider->person_image)) {
                    Storage::disk('s3')->delete($slider->person_image);
                }
            } catch (\Exception $e) {
                Log::warning('Error checking/deleting person_image from S3: ' . $e->getMessage() . ' - Path: ' . $slider->person_image);
            }
        }
        
        // Handle person_images - decode if JSON string
        $person_images = $slider->person_images;
        if (is_string($person_images)) {
            $person_images = json_decode($person_images, true) ?? [];
        }
        if (!empty($person_images) && is_array($person_images)) {
            foreach ($person_images as $image) {
                if ($image) {
                    try {
                        if (Storage::disk('s3')->exists($image)) {
                            Storage::disk('s3')->delete($image);
                        }
                    } catch (\Exception $e) {
                        Log::warning('Error checking/deleting person_images from S3: ' . $e->getMessage() . ' - Path: ' . $image);
                    }
                }
            }
        }

        $slider->delete();
        
        return redirect('admin/v2/slider')->with(['sukses' => 'Slider telah dihapus']);
    }

    /**
     * Helper function to get image URL from S3
     */
    private function getImageUrl($path)
    {
        try {
            if (empty($path)) {
                return null;
            }
            
            // Handle old paths that might still be in database (for backward compatibility)
            // If path starts with image/slider/, it's old local path - try local first
            if (strpos($path, 'image/slider/') === 0) {
                $localPath = public_path($path);
                if (File::exists($localPath)) {
                    return asset($path);
                }
                // If not found locally, try to construct S3 URL anyway (might be migrated)
                // Convert old path to new S3 path format
                $s3Path = 'assets/upload/image/hero/' . basename($path);
                try {
                    if (Storage::disk('s3')->exists($s3Path)) {
                        return Storage::disk('s3')->url($s3Path);
                    }
                } catch (\Exception $e) {
                    // Ignore S3 check error for old paths
                }
                // Try direct S3 URL with old path (in case file was uploaded with old path)
                try {
                    return Storage::disk('s3')->url($path);
                } catch (\Exception $e) {
                    // Ignore if fails
                }
                return null;
            }
            
            // For new S3 paths (assets/upload/image/hero/)
            if (strpos($path, 'assets/upload/image/hero/') === 0) {
                try {
                    // Try to check if exists in S3
                    if (Storage::disk('s3')->exists($path)) {
                        return Storage::disk('s3')->url($path);
                    }
                } catch (\Exception $e) {
                    // If check fails, still try to return URL (file might exist but check failed)
                    Log::warning('Error checking S3 file existence: ' . $e->getMessage() . ' - Path: ' . $path);
                }
                // Return S3 URL anyway (file might exist even if check failed)
                try {
                    return Storage::disk('s3')->url($path);
                } catch (\Exception $e) {
                    Log::error('Error getting S3 URL: ' . $e->getMessage() . ' - Path: ' . $path);
                }
                // Fallback to local storage check
                $oldPath = public_path('storage/' . $path);
                if (File::exists($oldPath)) {
                    return asset('storage/' . $path);
                }
                return null;
            }
            
            // For any other path, try S3 first
            try {
                return Storage::disk('s3')->url($path);
            } catch (\Exception $e) {
                Log::warning('Error getting S3 URL for path: ' . $path . ' - ' . $e->getMessage());
                return null;
            }
        } catch (\Exception $e) {
            Log::error('Error getting image URL: ' . $e->getMessage() . ' - Path: ' . $path);
            return null;
        }
    }
}
