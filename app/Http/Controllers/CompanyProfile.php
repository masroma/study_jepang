<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CompanyProfile extends Controller
{
    /** Fallback jika kolom kosong / belum diisi di admin */
    private function defaultVisiMisi(): array
    {
        return [
            'visi' => 'Menjadi perusahaan ekspor-impor terdepan yang menghubungkan Indonesia dengan pasar global, khususnya Jepang, dengan komitmen pada kualitas, keandalan, dan kepuasan pelanggan.',
            'misi' => [
                'Menyediakan produk berkualitas tinggi dengan standar internasional',
                'Membangun jaringan bisnis yang kuat dengan partner di berbagai negara',
                'Memberikan layanan ekspor-impor yang profesional dan terpercaya',
                'Mengembangkan SDM yang kompeten dan berintegritas',
                'Berkontribusi pada pertumbuhan ekonomi nasional melalui perdagangan internasional',
            ],
        ];
    }

    /**
     * Visi & misi dari tabel konfigurasi (admin Tentang Kami); misi = satu poin per baris.
     */
    private function visiMisiFromConfig(object $site_config): array
    {
        $defaults = $this->defaultVisiMisi();

        $visi = data_get($site_config, 'visi');
        $visi = is_string($visi) ? trim($visi) : '';
        if ($visi === '') {
            $visi = $defaults['visi'];
        }

        $misiRaw = data_get($site_config, 'misi');
        $misiList = [];
        if (is_string($misiRaw) && trim($misiRaw) !== '') {
            $misiList = $this->linesFromText($misiRaw);
        }
        if ($misiList === []) {
            $misiList = $defaults['misi'];
        }

        return [
            'visi' => $visi,
            'misi' => $misiList,
        ];
    }

    private function linesFromText(?string $raw): array
    {
        if (!is_string($raw) || trim($raw) === '') {
            return [];
        }

        return collect(preg_split("/\r\n|\r|\n/", $raw))
            ->map(fn ($line) => trim($line))
            ->filter()
            ->values()
            ->all();
    }

    /**
     * Legalitas: nama & alamat dari konfigurasi; SIUP/NPWP fallback (belum ada field di admin).
     */
    private function legalitasFromConfig(object $site): array
    {
        $badan = trim((string) data_get($site, 'nama_singkat'));
        if ($badan === '') {
            $badan = trim((string) data_get($site, 'namaweb'));
        }
        if ($badan === '') {
            $badan = 'PT. Meghantara Global Group';
        }

        $alamat = trim((string) data_get($site, 'alamat'));
        if ($alamat === '') {
            $alamat = 'Jl. Contoh No. 123, Jakarta, Indonesia';
        }

        $izin = trim((string) data_get($site, 'izin_usaha'));
        if ($izin === '') {
            $izin = 'SIUP No. 123/2024';
        }

        $npwp = trim((string) data_get($site, 'npwp'));
        if ($npwp === '') {
            $npwp = '01.234.567.8-901.000';
        }

        return [
            'badan_hukum' => $badan,
            'izin_usaha' => $izin,
            'npwp' => $npwp,
            'alamat' => $alamat,
        ];
    }

    private function heroSubtitleFromConfig(object $site): string
    {
        $t = trim((string) data_get($site, 'tagline'));
        if ($t !== '') {
            return $t;
        }
        $t = trim((string) data_get($site, 'deskripsi'));
        if ($t !== '') {
            return Str::limit($t, 280);
        }
        $tentang = trim((string) data_get($site, 'tentang'));
        if ($tentang !== '') {
            return Str::limit(strip_tags($tentang), 220);
        }

        return 'Profil perusahaan, visi-misi, dan pengalaman kami dalam menghubungkan Indonesia dengan pasar global.';
    }

    private function visiMisiIntroFromConfig(object $site): string
    {
        $t = trim((string) data_get($site, 'tagline2'));
        if ($t !== '') {
            return $t;
        }
        $t = trim((string) data_get($site, 'tagline'));
        if ($t !== '') {
            return $t;
        }
        $t = trim((string) data_get($site, 'metatext'));
        if ($t !== '') {
            return $t;
        }

        return 'Komitmen kami untuk menjadi mitra terpercaya dalam perdagangan internasional';
    }

    /**
     * URL gambar tentang kami (S3 / lokal / path lama), selaras dengan admin v2.
     */
    private function resolveTentangKamiImageUrl(?string $path): ?string
    {
        try {
            if (empty($path)) {
                return null;
            }
            if (preg_match('#^https?://#i', $path)) {
                return $path;
            }

            if (Storage::disk('s3')->exists($path)) {
                return Storage::disk('s3')->url($path);
            }

            if (str_starts_with($path, 'assets/upload/image/')) {
                $oldPath = public_path('storage/' . $path);
                if (File::exists($oldPath)) {
                    return asset('storage/' . $path);
                }
            }

            if (str_starts_with($path, 'image/tentang-kami/')) {
                $localPath = public_path($path);
                if (File::exists($localPath)) {
                    return asset($path);
                }
            }

            $trim = ltrim($path, '/');
            if (File::exists(public_path($trim))) {
                return asset($trim);
            }

            return null;
        } catch (\Exception $e) {
            Log::error('CompanyProfile image URL: ' . $e->getMessage());

            return null;
        }
    }

    public function index()
    {
        $site_config = DB::table('konfigurasi')->first();

        if (!$site_config) {
            $site_config = (object) [
                'namaweb'   => 'Company Profile CMS',
                'tagline'   => 'Your Tagline Here',
                'deskripsi' => 'Site description',
                'keywords'  => 'keywords',
            ];
        }

        $legalitas = $this->legalitasFromConfig($site_config);
        $visi_misi = $this->visiMisiFromConfig($site_config);

        $tentang = trim((string) data_get($site_config, 'tentang'));
        $sejarah = trim((string) data_get($site_config, 'sejarah'));
        $nilaiLines = $this->linesFromText(data_get($site_config, 'nilai_perusahaan'));

        $tentang_gambar_url = $this->resolveTentangKamiImageUrl(
            is_string(data_get($site_config, 'gambar')) ? data_get($site_config, 'gambar') : null
        );

        $nama_display = trim((string) data_get($site_config, 'nama_singkat'));
        if ($nama_display === '') {
            $nama_display = trim((string) data_get($site_config, 'namaweb'));
        }
        if ($nama_display === '') {
            $nama_display = 'Company Profile';
        }

        $pengalaman = [
            'tahun_pengalaman' => '10+',
            'jumlah_transaksi' => '500+',
            'partner_negara' => [
                ['nama' => 'Jepang', 'flag' => 'jp', 'sejak' => '2015'],
                ['nama' => 'China', 'flag' => 'cn', 'sejak' => '2016'],
                ['nama' => 'Korea Selatan', 'flag' => 'kr', 'sejak' => '2017'],
                ['nama' => 'Singapura', 'flag' => 'sg', 'sejak' => '2018'],
                ['nama' => 'Malaysia', 'flag' => 'my', 'sejak' => '2019'],
            ],
        ];

        $pageDeskripsi = trim((string) data_get($site_config, 'deskripsi'));
        if ($pageDeskripsi === '') {
            $pageDeskripsi = 'Profil perusahaan ' . data_get($site_config, 'namaweb');
        }

        $data = [
            'title'              => 'Tentang Kami - ' . data_get($site_config, 'namaweb'),
            'deskripsi'          => $pageDeskripsi,
            'keywords'           => 'tentang kami, company profile, ' . data_get($site_config, 'namaweb'),
            'site_config'        => $site_config,
            'legalitas'          => $legalitas,
            'visi_misi'          => $visi_misi,
            'pengalaman'         => $pengalaman,
            'hero_subtitle'      => $this->heroSubtitleFromConfig($site_config),
            'visi_misi_intro'    => $this->visiMisiIntroFromConfig($site_config),
            'nama_display'       => $nama_display,
            'tentang'            => $tentang,
            'tentang_gambar_url' => $tentang_gambar_url,
            'sejarah'            => $sejarah,
            'nilai_perusahaan'   => $nilaiLines,
        ];

        return view('company-profile', $data);
    }
}
