<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompanyProfile extends Controller
{
    // Halaman Company Profile / About Us
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

        // Data legalitas (bisa dari database atau hardcoded untuk sementara)
        $legalitas = [
            'badan_hukum' => 'PT. Meghantara Global Group',
            'izin_usaha' => 'SIUP No. 123/2024',
            'npwp' => '01.234.567.8-901.000',
            'alamat' => 'Jl. Contoh No. 123, Jakarta, Indonesia'
        ];

        // Data visi-misi
        $visi_misi = [
            'visi' => 'Menjadi perusahaan ekspor-impor terdepan yang menghubungkan Indonesia dengan pasar global, khususnya Jepang, dengan komitmen pada kualitas, keandalan, dan kepuasan pelanggan.',
            'misi' => [
                'Menyediakan produk berkualitas tinggi dengan standar internasional',
                'Membangun jaringan bisnis yang kuat dengan partner di berbagai negara',
                'Memberikan layanan ekspor-impor yang profesional dan terpercaya',
                'Mengembangkan SDM yang kompeten dan berintegritas',
                'Berkontribusi pada pertumbuhan ekonomi nasional melalui perdagangan internasional'
            ]
        ];

        // Data pengalaman & partner negara
        $pengalaman = [
            'tahun_pengalaman' => '10+',
            'jumlah_transaksi' => '500+',
            'partner_negara' => [
                ['nama' => 'Jepang', 'flag' => 'jp', 'sejak' => '2015'],
                ['nama' => 'China', 'flag' => 'cn', 'sejak' => '2016'],
                ['nama' => 'Korea Selatan', 'flag' => 'kr', 'sejak' => '2017'],
                ['nama' => 'Singapura', 'flag' => 'sg', 'sejak' => '2018'],
                ['nama' => 'Malaysia', 'flag' => 'my', 'sejak' => '2019'],
            ]
        ];

        $data = [
            'title'         => 'Tentang Kami - ' . $site_config->namaweb,
            'deskripsi'     => 'Profil perusahaan ' . $site_config->namaweb,
            'keywords'      => 'tentang kami, company profile, ' . $site_config->namaweb,
            'site_config'   => $site_config,
            'legalitas'     => $legalitas,
            'visi_misi'     => $visi_misi,
            'pengalaman'    => $pengalaman
        ];

        return view('company-profile', $data);
    }
}
