<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\Industri;

class IndustriController extends Controller
{
    // Index page - list all industries
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

        $industries = Industri::publish()->ordered()->get();
        
        // Add S3 URLs
        foreach ($industries as $item) {
            if ($item->gambar) {
                $item->gambar_url = $this->getImageUrl($item->gambar);
            }
        }

        $data = [
            'title'         => 'Industri - ' . $site_config->namaweb,
            'deskripsi'     => 'Industri - ' . $site_config->namaweb,
            'keywords'      => 'Industri, Industri Jepang',
            'site_config'   => $site_config,
            'industries'    => $industries
        ];

        return view('industri.index', $data);
    }

    // Detail page
    public function detail($id_industri)
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

        $industri = Industri::where('id_industri', $id_industri)
            ->where('status', 'Publish')
            ->firstOrFail();
        
        // Add S3 URL
        if ($industri->gambar) {
            $industri->gambar_url = $this->getImageUrl($industri->gambar);
        }

        // Get related industries
        $related_industries = Industri::where('id_industri', '!=', $id_industri)
            ->where('status', 'Publish')
            ->ordered()
            ->limit(3)
            ->get();
        
        foreach ($related_industries as $related) {
            if ($related->gambar) {
                $related->gambar_url = $this->getImageUrl($related->gambar);
            }
        }

        $data = [
            'title'         => $industri->nama . ' - ' . $site_config->namaweb,
            'deskripsi'     => strip_tags($industri->deskripsi ?? ''),
            'keywords'      => $industri->nama . ', Industri Jepang',
            'site_config'   => $site_config,
            'industri'      => $industri,
            'related_industries' => $related_industries
        ];

        return view('industri.detail', $data);
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
            // If path starts with image/industri/, it's old local path - try local first
            if (strpos($path, 'image/industri/') === 0) {
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
            
            // Handle old uploads/industri/ path
            if (strpos($path, 'uploads/industri/') === 0) {
                $oldPath = public_path('storage/' . $path);
                if (File::exists($oldPath)) {
                    return asset('storage/' . $path);
                }
                // Try S3 with new path format
                $s3Path = 'assets/upload/image/hero/' . basename($path);
                try {
                    return Storage::disk('s3')->url($s3Path);
                } catch (\Exception $e) {
                    // Ignore if fails
                }
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
                }
                // Return S3 URL anyway (file might exist even if check failed)
                try {
                    return Storage::disk('s3')->url($path);
                } catch (\Exception $e) {
                    // Ignore if fails
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
                return null;
            }
        } catch (\Exception $e) {
            return null;
        }
    }
}
