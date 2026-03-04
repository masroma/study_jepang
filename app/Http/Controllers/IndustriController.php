<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            
            // Handle old paths that might still be in database
            if (strpos($path, 'image/') === 0) {
                $localPath = public_path($path);
                if (file_exists($localPath)) {
                    return asset($path);
                }
            }
            
            // For uploads/ paths
            if (strpos($path, 'uploads/') === 0) {
                $oldPath = public_path('storage/' . $path);
                if (file_exists($oldPath)) {
                    return asset('storage/' . $path);
                }
                // Try direct asset path
                return asset('storage/' . $path);
            }
            
            // Try direct asset path
            return asset('storage/uploads/industri/' . $path);
        } catch (\Exception $e) {
            return null;
        }
    }
}
