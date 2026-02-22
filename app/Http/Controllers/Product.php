<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class Product extends Controller
{
    // Halaman Produk / Komoditas
    public function index()
    {
        Paginator::useBootstrap();
        
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
        $produk_kategori = [
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
                    'harga' => 'Contact Us',
                    'kategori' => 'Hasil Pertanian'
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
                    'harga' => 'Contact Us',
                    'kategori' => 'Hasil Pertanian'
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
                    'harga' => 'Contact Us',
                    'kategori' => 'Seafood'
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
                    'harga' => 'Contact Us',
                    'kategori' => 'Seafood'
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
                    'harga' => 'Contact Us',
                    'kategori' => 'Manufaktur'
                ],
            ]
        ];

        // Flatten semua produk menjadi satu array
        $all_produk = collect();
        foreach ($produk_kategori as $kategori => $items) {
            foreach ($items as $item) {
                $all_produk->push($item);
            }
        }

        // Pagination menggunakan Laravel Collection
        $perPage = 16;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $itemsForCurrentPage = $all_produk->slice(($currentPage - 1) * $perPage, $perPage)->values();
        
        $produk = new LengthAwarePaginator(
            $itemsForCurrentPage,
            $all_produk->count(),
            $perPage,
            $currentPage,
            [
                'path' => request()->url(),
                'pageName' => 'page',
            ]
        );

        $data = [
            'title'         => 'Produk & Komoditas - ' . $site_config->namaweb,
            'deskripsi'     => 'Produk dan komoditas yang kami tawarkan',
            'keywords'      => 'produk, komoditas, ekspor, ' . $site_config->namaweb,
            'site_config'   => $site_config,
            'produk'        => $produk
        ];

        return view('product', $data);
    }

    // Helper method untuk mendapatkan semua produk
    private function getAllProducts()
    {
        $produk_kategori = [
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
                    'harga' => 'Contact Us',
                    'kategori' => 'Hasil Pertanian'
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
                    'harga' => 'Contact Us',
                    'kategori' => 'Hasil Pertanian'
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
                    'harga' => 'Contact Us',
                    'kategori' => 'Seafood'
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
                    'harga' => 'Contact Us',
                    'kategori' => 'Seafood'
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
                    'harga' => 'Contact Us',
                    'kategori' => 'Manufaktur'
                ],
            ]
        ];

        $all_produk = collect();
        foreach ($produk_kategori as $kategori => $items) {
            foreach ($items as $item) {
                $all_produk->push($item);
            }
        }

        return $all_produk;
    }

    // Halaman Request Quotation
    public function requestQuotation(Request $request)
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

        $produk_nama = $request->get('produk');
        $selected_produk = null;
        
        if ($produk_nama) {
            $all_produk = $this->getAllProducts();
            $selected_produk = $all_produk->firstWhere('nama', urldecode($produk_nama));
        }

        $data = [
            'title'         => 'Request Quotation - ' . $site_config->namaweb,
            'deskripsi'     => 'Request quotation untuk produk dan komoditas',
            'keywords'      => 'quotation, produk, komoditas, ' . $site_config->namaweb,
            'site_config'   => $site_config,
            'selected_produk' => $selected_produk,
            'all_produk'    => $this->getAllProducts()
        ];

        return view('product.request-quotation', $data);
    }

    // Kirim Request Quotation
    public function kirimQuotation(Request $request)
    {
        $request->validate([
            'nama'          => 'required|string|max:255',
            'email'         => 'required|email|max:255',
            'telepon'       => 'required|string|max:20',
            'perusahaan'    => 'nullable|string|max:255',
            'produk'       => 'required|string|max:255',
            'quantity'      => 'nullable|string|max:255',
            'kebutuhan'     => 'nullable|string|max:1000',
            'pesan'         => 'nullable|string|max:2000'
        ]);

        // Simpan ke database kontak dengan subjek khusus
        $kontakData = [
            'nama'           => $request->nama,
            'email'          => $request->email,
            'telepon'        => $request->telepon,
            'subjek'         => 'Request Quotation: ' . $request->produk,
            'pesan'          => "Perusahaan: " . ($request->perusahaan ?? '-') . "\n\n" .
                              "Produk: " . $request->produk . "\n" .
                              "Quantity: " . ($request->quantity ?? '-') . "\n" .
                              "Kebutuhan: " . ($request->kebutuhan ?? '-') . "\n\n" .
                              "Pesan: " . ($request->pesan ?? '-'),
            'tanggal_kontak' => now(),
            'status_kontak'  => 'Baru'
        ];

        // Jika user sudah login, simpan user_id
        if(\Illuminate\Support\Facades\Session::has('id_user') && \Illuminate\Support\Facades\Session::get('akses_level') === 'User') {
            $kontakData['id_user'] = \Illuminate\Support\Facades\Session::get('id_user');
        }

        DB::table('kontak')->insert($kontakData);

        // Redirect ke WhatsApp dengan pesan otomatis
        $site_config = DB::table('konfigurasi')->first();
        $waNumber = isset($site_config->telepon) ? preg_replace('/\D+/', '', $site_config->telepon) : '';
        
        if($waNumber) {
            $message = urlencode("Halo, saya ingin request quotation untuk produk:\n\n" .
                "📋 *Informasi Pribadi*\n" .
                "Nama: " . $request->nama . "\n" .
                "Email: " . $request->email . "\n" .
                "Telepon: " . $request->telepon . "\n" .
                "Perusahaan: " . ($request->perusahaan ?? '-') . "\n\n" .
                "📦 *Informasi Produk*\n" .
                "Produk: " . $request->produk . "\n" .
                "Quantity: " . ($request->quantity ?? '-') . "\n" .
                "Kebutuhan: " . ($request->kebutuhan ?? '-') . "\n\n" .
                "💬 *Pesan Tambahan*\n" .
                ($request->pesan ?? '-'));
            
            return redirect("https://wa.me/{$waNumber}?text={$message}");
        }
        
        // Jika tidak ada WhatsApp, redirect kembali dengan success message
        return redirect('produk/request-quotation')
            ->with('success', 'Request quotation berhasil dikirim. Tim kami akan menghubungi Anda segera.');
    }
}
