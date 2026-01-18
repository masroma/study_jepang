<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

        $data = [
            'title'         => 'Kisah Sukses - ' . $site_config->namaweb,
            'deskripsi'     => 'Kisah Sukses Alumni - ' . $site_config->namaweb,
            'keywords'      => 'Kisah Sukses, Alumni, Testimoni',
            'site_config'   => $site_config,
            'kisah_sukses'  => $kisah_sukses
        ];

        return view('kisah-sukses', $data);
    }
}
