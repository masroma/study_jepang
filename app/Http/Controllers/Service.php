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
            'export_service' => [
                'judul' => 'Export Service',
                'icon' => '📤',
                'deskripsi' => 'Layanan ekspor lengkap untuk produk Anda ke berbagai negara tujuan',
                'fitur' => [
                    'Dokumentasi ekspor lengkap',
                    'Pengurusan izin ekspor',
                    'Quality control & inspection',
                    'Packing & labeling sesuai standar internasional',
                    'Negosiasi dengan buyer internasional',
                    'Follow-up dan after sales service'
                ]
            ],
            'import_service' => [
                'judul' => 'Import Service',
                'icon' => '📥',
                'deskripsi' => 'Layanan impor terpercaya untuk kebutuhan bisnis Anda',
                'fitur' => [
                    'Pengurusan izin impor',
                    'Dokumentasi impor lengkap',
                    'Quality inspection di negara asal',
                    'Negosiasi harga dengan supplier',
                    'Pengurusan bea cukai',
                    'Delivery sampai gudang'
                ]
            ],
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
            'deskripsi'     => 'Layanan ekspor-impor, customs clearance, freight, dan warehousing',
            'keywords'      => 'layanan, export, import, freight, warehousing, ' . $site_config->namaweb,
            'site_config'   => $site_config,
            'layanan'        => $layanan
        ];

        return view('service', $data);
    }
}
