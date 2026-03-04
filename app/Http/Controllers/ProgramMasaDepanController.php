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
     * Helper function to get image URL (local or S3).
     *
     * NOTE:
     * - Disamakan dengan helper di Admin V2 agar path gambar konsisten.
     */
    private function getImageUrl($path)
    {
        try {
            if (empty($path)) {
                return null;
            }

            // Handle old local path: image/program-masa-depan/...
            if (strpos($path, 'image/program-masa-depan/') === 0) {
                $localPath = public_path($path);
                if (file_exists($localPath)) {
                    return asset($path);
                }

                // Jika sudah dimigrasi ke S3 dengan format baru, coba hero folder
                $s3Path = 'assets/upload/image/hero/' . basename($path);
                try {
                    if (\Storage::disk('s3')->exists($s3Path)) {
                        return \Storage::disk('s3')->url($s3Path);
                    }
                } catch (\Exception $e) {
                    // Abaikan error cek S3
                }

                // Terakhir, coba langsung pakai path lama di S3
                try {
                    return \Storage::disk('s3')->url($path);
                } catch (\Exception $e) {
                    return null;
                }
            }

            // Handle old uploads/program/ path (local atau S3)
            if (strpos($path, 'uploads/program/') === 0) {
                $oldPath = public_path('storage/' . $path);
                if (file_exists($oldPath)) {
                    return asset('storage/' . $path);
                }

                // Coba S3 dengan format baru
                $s3Path = 'assets/upload/image/hero/' . basename($path);
                try {
                    return \Storage::disk('s3')->url($s3Path);
                } catch (\Exception $e) {
                    // Abaikan jika gagal
                }
            }

            // Jika path sudah format baru S3: assets/upload/image/hero/...
            if (strpos($path, 'assets/upload/image/hero/') === 0) {
                try {
                    if (\Storage::disk('s3')->exists($path)) {
                        return \Storage::disk('s3')->url($path);
                    }
                } catch (\Exception $e) {
                    // Jika cek gagal, tetap coba return URL-nya
                }

                try {
                    return \Storage::disk('s3')->url($path);
                } catch (\Exception $e) {
                    // Fallback ke local storage jika ada
                    $oldPath = public_path('storage/' . $path);
                    if (file_exists($oldPath)) {
                        return asset('storage/' . $path);
                    }
                    return null;
                }
            }

            // Path lain: coba S3 langsung
            try {
                return \Storage::disk('s3')->url($path);
            } catch (\Exception $e) {
                return null;
            }
        } catch (\Exception $e) {
            return null;
        }
    }
}
