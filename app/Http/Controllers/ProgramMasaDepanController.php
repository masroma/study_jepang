<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ProgramMasaDepan;

class ProgramMasaDepanController extends Controller
{
    // Index page - list all programs
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

        $programs = ProgramMasaDepan::publish()->ordered()->get();
        
        // Add S3 URLs
        foreach ($programs as $program) {
            if ($program->gambar) {
                $program->gambar_url = $this->getImageUrl($program->gambar);
            }
        }

        $data = [
            'title'         => 'Program Masa Depan - ' . $site_config->namaweb,
            'deskripsi'     => 'Program Masa Depan - ' . $site_config->namaweb,
            'keywords'      => 'Program Masa Depan, Program Jepang',
            'site_config'   => $site_config,
            'programs'      => $programs
        ];

        return view('program-masa-depan.index', $data);
    }

    // Detail page
    public function detail($id_program)
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

        $program = ProgramMasaDepan::where('id_program', $id_program)
            ->where('status', 'Publish')
            ->firstOrFail();
        
        // Add S3 URL
        if ($program->gambar) {
            $program->gambar_url = $this->getImageUrl($program->gambar);
        }

        // Get related programs
        $related_programs = ProgramMasaDepan::where('id_program', '!=', $id_program)
            ->where('status', 'Publish')
            ->ordered()
            ->limit(3)
            ->get();
        
        foreach ($related_programs as $related) {
            if ($related->gambar) {
                $related->gambar_url = $this->getImageUrl($related->gambar);
            }
        }

        $data = [
            'title'         => $program->judul . ' - ' . $site_config->namaweb,
            'deskripsi'     => strip_tags($program->deskripsi ?? ''),
            'keywords'      => $program->judul . ', Program Jepang',
            'site_config'   => $site_config,
            'program'       => $program,
            'related_programs' => $related_programs
        ];

        return view('program-masa-depan.detail', $data);
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
            return asset('storage/uploads/program/' . $path);
        } catch (\Exception $e) {
            return null;
        }
    }
}
