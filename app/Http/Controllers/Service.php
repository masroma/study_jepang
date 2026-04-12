<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Service extends Controller
{
    // Halaman Layanan
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

        // Data layanan
        $layanan = [
            'customs_clearance' => [
                'judul' => 'Customs Clearance',
                'icon' => '📋',
                'deskripsi' => 'Jasa pengurusan bea cukai yang cepat dan profesional',
                'fitur' => [
                    'Pengurusan dokumen bea cukai',
                    'Perhitungan bea masuk/keluar',
                    'Pengurusan PIB (Pemberitahuan Impor Barang)',
                    'Pengurusan PEB (Pemberitahuan Ekspor Barang)',
                    'Coordination dengan customs broker',
                    'Fast track clearance untuk urgent shipment'
                ]
            ],
            'freight' => [
                'judul' => 'Freight Service',
                'icon' => '🚢',
                'deskripsi' => 'Layanan pengiriman via laut dan udara ke seluruh dunia',
                'sea_freight' => [
                    'judul' => 'Sea Freight',
                    'fitur' => [
                        'FCL (Full Container Load)',
                        'LCL (Less Container Load)',
                        'Rute ke Asia, Eropa, Amerika',
                        'Tracking real-time',
                        'Insurance coverage'
                    ]
                ],
                'air_freight' => [
                    'judul' => 'Air Freight',
                    'fitur' => [
                        'Express delivery',
                        'Door to door service',
                        'Priority handling',
                        'Real-time tracking',
                        'Insurance coverage'
                    ]
                ]
            ],
            'warehousing' => [
                'judul' => 'Warehousing',
                'icon' => '🏭',
                'deskripsi' => 'Fasilitas gudang modern dengan sistem manajemen terintegrasi',
                'fitur' => [
                    'Gudang berpendingin (cold storage)',
                    'Gudang kering (dry storage)',
                    'Sistem inventory real-time',
                    'Forklift & handling equipment',
                    'Security 24/7',
                    'Fumigation service',
                    'Cross-docking facility'
                ],
                'lokasi' => [
                    'Jakarta - 5,000 m²',
                    'Surabaya - 3,000 m²',
                    'Medan - 2,000 m²'
                ]
            ]
        ];

        $data = [
            'title'         => 'Layanan - ' . $site_config->namaweb,
            'deskripsi'     => 'Layanan customs clearance, freight, dan warehousing',
            'keywords'      => 'layanan, customs, freight, warehousing, ' . $site_config->namaweb,
            'site_config'   => $site_config,
            'layanan'        => $layanan
        ];

        return view('service', $data);
    }
}
