<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\KisahSukses;

class KisahSuksesController extends Controller
{
    // Kisah Sukses page
    public function index()
    {
        $site_config = DB::table('konfigurasi')->first();

        if (!$site_config) {
            $site_config = (object) [
                'namaweb'   => 'Company Profile CMS',
                'tagline'   => 'Your Tagline Here',
                'deskripsi' => 'Site description',
                'keywords'  => 'keywords'
            ];
        }

        $kisah_sukses = KisahSukses::publish()->ordered()->get();
        
        // Add S3 URLs
        foreach ($kisah_sukses as $kisah) {
            if ($kisah->foto) {
                $kisah->foto_url = $this->getImageUrl($kisah->foto);
            }
        }

        $data = [
            'title'         => 'Kisah Sukses - ' . $site_config->namaweb,
            'deskripsi'     => 'Kisah Sukses Alumni - ' . $site_config->namaweb,
            'keywords'      => 'Kisah Sukses, Alumni, Testimoni',
            'site_config'   => $site_config,
            'kisah_sukses'  => $kisah_sukses
        ];

        return view('kisah-sukses', $data);
    }

    // Detail page
    public function detail($id_kisah)
    {
        $site_config = DB::table('konfigurasi')->first();

        if (!$site_config) {
            $site_config = (object) [
                'namaweb'   => 'Company Profile CMS',
                'tagline'   => 'Your Tagline Here',
                'deskripsi' => 'Site description',
                'keywords'  => 'keywords'
            ];
        }

        $kisah = KisahSukses::where('id_kisah', $id_kisah)
            ->where('status', 'Publish')
            ->firstOrFail();
        
        // Add S3 URL
        if ($kisah->foto) {
            $kisah->foto_url = $this->getImageUrl($kisah->foto);
        }

        // Get related kisah sukses
        $related_kisah = KisahSukses::where('id_kisah', '!=', $id_kisah)
            ->where('status', 'Publish')
            ->ordered()
            ->limit(3)
            ->get();
        
        foreach ($related_kisah as $related) {
            if ($related->foto) {
                $related->foto_url = $this->getImageUrl($related->foto);
            }
        }

        $data = [
            'title'         => $kisah->nama . ' - Kisah Sukses - ' . $site_config->namaweb,
            'deskripsi'     => strip_tags($kisah->testimoni ?? ''),
            'keywords'      => $kisah->nama . ', Kisah Sukses, Alumni',
            'site_config'   => $site_config,
            'kisah'         => $kisah,
            'related_kisah' => $related_kisah
        ];

        return view('kisah-sukses.detail', $data);
    }

    /**
     * Helper function to get image URL from S3 or local storage
     */
    private function getImageUrl($path)
    {
        try {
            if (empty($path)) {
                return null;
            }
            
            // Handle S3 paths (starts with assets/)
            if (strpos($path, 'assets/') === 0) {
                // Check if S3 is configured
                if (config('filesystems.disks.s3.key')) {
                    return Storage::disk('s3')->url($path);
                }
                // Fallback to local if S3 not configured
                return asset($path);
            }
            
            // Handle old paths that might still be in database
            if (strpos($path, 'image/') === 0) {
                $localPath = public_path($path);
                if (file_exists($localPath)) {
                    return asset($path);
                }
            }
            
            // For uploads/ paths (full path)
            if (strpos($path, 'uploads/') === 0) {
                // Try storage path first
                $storagePath = public_path('storage/' . $path);
                if (file_exists($storagePath)) {
                    return asset('storage/' . $path);
                }
                // Try direct public path
                $publicPath = public_path($path);
                if (file_exists($publicPath)) {
                    return asset($path);
                }
                // Return asset path anyway (might be symlinked)
                return asset('storage/' . $path);
            }
            
            // If it's just a filename, try different locations
            // Try storage/uploads/kisah-sukses/
            $storagePath = public_path('storage/uploads/kisah-sukses/' . $path);
            if (file_exists($storagePath)) {
                return asset('storage/uploads/kisah-sukses/' . $path);
            }
            
            // Try public/uploads/kisah-sukses/
            $publicPath = public_path('uploads/kisah-sukses/' . $path);
            if (file_exists($publicPath)) {
                return asset('uploads/kisah-sukses/' . $path);
            }
            
            // Last resort: try asset paths (might be symlinked)
            return asset('storage/uploads/kisah-sukses/' . $path);
        } catch (\Exception $e) {
            \Log::warning('Error getting image URL for path: ' . $path . ' - ' . $e->getMessage());
            return null;
        }
    }
}
