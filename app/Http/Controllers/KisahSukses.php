<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Berita_model;
use App\Models\KisahSukses;

class KisahSukses extends Controller
{
    public function index()
    {
        $site_config = DB::table('konfigurasi')->first();
        
        // Ambil data dari model KisahSukses
        $kisah_sukses = KisahSukses::publish()->ordered()->get();
        
        // Add S3 URLs to each kisah sukses
        foreach ($kisah_sukses as $kisah) {
            if ($kisah->foto) {
                $kisah->foto_url = $this->getImageUrl($kisah->foto);
            }
            if ($kisah->video_file) {
                $kisah->video_file_url = $this->getVideoUrl($kisah->video_file);
            }
        }
        
        // Ambil video testimoni jika ada
        $video_testimoni = DB::table('video')
            ->where('judul', 'like', '%testimoni%')
            ->orWhere('judul', 'like', '%kisah%')
            ->orderBy('id_video', 'DESC')
            ->limit(3)
            ->get();

        $data = array(
            'title' => 'Kisah Sukses - ' . $site_config->namaweb,
            'deskripsi' => 'Kisah Sukses Alumni - ' . $site_config->namaweb,
            'keywords' => 'Kisah Sukses, Testimoni, Alumni',
            'site_config' => $site_config,
            'kisah_sukses' => $kisah_sukses,
            'video_testimoni' => $video_testimoni
        );
        
        return view('kisah-sukses', $data);
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
            // Check if file exists in S3
            if (Storage::disk('s3')->exists($path)) {
                return Storage::disk('s3')->url($path);
            }
            // Handle old paths that might still be in database (for backward compatibility)
            // Try to find in old local storage
            if (strpos($path, 'uploads/kisah-sukses/') === 0 && strpos($path, '/videos/') === false) {
                $oldPath = public_path('storage/' . $path);
                if (file_exists($oldPath)) {
                    return asset('storage/' . $path);
                }
            }
            // If path starts with image/kisah-sukses/, try to find in local
            if (strpos($path, 'image/kisah-sukses/') === 0 && strpos($path, '/videos/') === false) {
                $localPath = public_path($path);
                if (file_exists($localPath)) {
                    return asset($path);
                }
            }
            // Return null if file doesn't exist
            return null;
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Helper function to get video URL from S3
     */
    private function getVideoUrl($path)
    {
        try {
            if (empty($path)) {
                return null;
            }
            // Check if file exists in S3
            if (Storage::disk('s3')->exists($path)) {
                return Storage::disk('s3')->url($path);
            }
            // Handle old paths that might still be in database (for backward compatibility)
            // Try to find in old local storage
            if (strpos($path, 'uploads/kisah-sukses/videos/') === 0) {
                $oldPath = public_path('storage/' . $path);
                if (file_exists($oldPath)) {
                    return asset('storage/' . $path);
                }
            }
            // If path starts with image/kisah-sukses/videos/, try to find in local
            if (strpos($path, 'image/kisah-sukses/videos/') === 0) {
                $localPath = public_path($path);
                if (file_exists($localPath)) {
                    return asset($path);
                }
            }
            // Return null if file doesn't exist
            return null;
        } catch (\Exception $e) {
            return null;
        }
    }
}
