<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Product extends Controller
{
    // Halaman Produk / Komoditas
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

        // Data produk per kategori
        $produk = [
            'hasil_pertanian' => [
                [
                    'nama' => 'Kopi Arabika',
                    'gambar' => asset('template/img/image5.png'),
                    'spesifikasi' => [
                        'Grade' => 'Premium',
                        'Asal' => 'Sumatera, Indonesia',
                        'Kadar Air' => 'Max 12%',
                        'Kemasan' => '25kg/karung',
                        'Sertifikasi' => 'Organic Certified'
                    ],
                    'moq' => '1 Container (20ft)',
                    'harga' => 'Contact Us'
                ],
                [
                    'nama' => 'Lada Hitam',
                    'gambar' => asset('template/img/image6.png'),
                    'spesifikasi' => [
                        'Grade' => 'ASTA Grade 1',
                        'Asal' => 'Lampung, Indonesia',
                        'Kadar Air' => 'Max 12%',
                        'Kemasan' => '25kg/karung',
                        'Sertifikasi' => 'HACCP'
                    ],
                    'moq' => '1 Container (20ft)',
                    'harga' => 'Contact Us'
                ],
            ],
            'seafood' => [
                [
                    'nama' => 'Udang Vannamei',
                    'gambar' => asset('template/img/image7.jpg'),
                    'spesifikasi' => [
                        'Ukuran' => '31/35, 36/40, 41/50',
                        'Asal' => 'Tambak Indonesia',
                        'Grade' => 'A',
                        'Kemasan' => '10kg/box (IQF)',
                        'Sertifikasi' => 'HACCP, BRC'
                    ],
                    'moq' => '1 Container (40ft)',
                    'harga' => 'Contact Us'
                ],
                [
                    'nama' => 'Ikan Tuna',
                    'gambar' => asset('template/img/image8.png'),
                    'spesifikasi' => [
                        'Jenis' => 'Yellowfin Tuna',
                        'Asal' => 'Samudera Indonesia',
                        'Grade' => 'Sashimi Grade',
                        'Kemasan' => '10kg/box (Frozen)',
                        'Sertifikasi' => 'MSC Certified'
                    ],
                    'moq' => '1 Container (40ft)',
                    'harga' => 'Contact Us'
                ],
            ],
            'manufaktur' => [
                [
                    'nama' => 'Furnitur Rotan',
                    'gambar' => asset('template/img/image5.png'),
                    'spesifikasi' => [
                        'Bahan' => 'Rotan Asli',
                        'Asal' => 'Cirebon, Indonesia',
                        'Finishing' => 'Natural / Stained',
                        'Kemasan' => 'Custom',
                        'Sertifikasi' => 'FSC Certified'
                    ],
                    'moq' => '1 Container (20ft)',
                    'harga' => 'Contact Us'
                ],
            ]
        ];

        $data = [
            'title'         => 'Produk & Komoditas - ' . $site_config->namaweb,
            'deskripsi'     => 'Produk dan komoditas yang kami tawarkan',
            'keywords'      => 'produk, komoditas, ekspor, ' . $site_config->namaweb,
            'site_config'   => $site_config,
            'produk'        => $produk
        ];

        return view('product', $data);
    }
}
