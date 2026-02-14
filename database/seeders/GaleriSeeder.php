<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class GaleriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userId = DB::table('users')->first()->id_user ?? 1;
        
        $galeris = [
            // Homepage Slider
            [
                'id_kategori_galeri' => 0,
                'id_user' => $userId,
                'bahasa' => 'ID',
                'judul_galeri' => 'Program Belajar Bahasa Jepang',
                'gambar' => 'https://images.unsplash.com/photo-1528164344705-47542687000d?auto=format&fit=crop&w=1200&q=80',
                'jenis_galeri' => 'Homepage',
                'isi' => null,
                'website' => null,
                'hits' => 0,
                'popup_status' => 'Publish',
                'urutan' => 1,
                'status_text' => 'Ya',
            ],
            [
                'id_kategori_galeri' => 0,
                'id_user' => $userId,
                'bahasa' => 'ID',
                'judul_galeri' => 'Kerja di Jepang',
                'gambar' => 'https://images.unsplash.com/photo-1493976040374-85c8e12f0c0e?auto=format&fit=crop&w=1200&q=80',
                'jenis_galeri' => 'Homepage',
                'isi' => null,
                'website' => null,
                'hits' => 0,
                'popup_status' => 'Publish',
                'urutan' => 2,
                'status_text' => 'Ya',
            ],
            [
                'id_kategori_galeri' => 0,
                'id_user' => $userId,
                'bahasa' => 'ID',
                'judul_galeri' => 'Kisah Sukses Alumni',
                'gambar' => 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?auto=format&fit=crop&w=1200&q=80',
                'jenis_galeri' => 'Homepage',
                'isi' => null,
                'website' => null,
                'hits' => 0,
                'popup_status' => 'Publish',
                'urutan' => 3,
                'status_text' => 'Ya',
            ],
            [
                'id_kategori_galeri' => 0,
                'id_user' => $userId,
                'bahasa' => 'ID',
                'judul_galeri' => 'Program Magang Jepang',
                'gambar' => 'https://images.unsplash.com/photo-1543269865-cbf427effbad?auto=format&fit=crop&w=1200&q=80',
                'jenis_galeri' => 'Homepage',
                'isi' => null,
                'website' => null,
                'hits' => 0,
                'popup_status' => 'Publish',
                'urutan' => 4,
                'status_text' => 'Ya',
            ],
            [
                'id_kategori_galeri' => 0,
                'id_user' => $userId,
                'bahasa' => 'ID',
                'judul_galeri' => 'Kelas Bahasa Jepang',
                'gambar' => 'https://images.unsplash.com/photo-1488646953014-85cb44e25828?auto=format&fit=crop&w=1200&q=80',
                'jenis_galeri' => 'Homepage',
                'isi' => null,
                'website' => null,
                'hits' => 0,
                'popup_status' => 'Publish',
                'urutan' => 5,
                'status_text' => 'Ya',
            ],
            // Beritapage
            [
                'id_kategori_galeri' => 0,
                'id_user' => $userId,
                'bahasa' => 'ID',
                'judul_galeri' => 'Berita & Update',
                'gambar' => 'https://images.unsplash.com/photo-1504711434969-e33886168f5c?auto=format&fit=crop&w=1200&q=80',
                'jenis_galeri' => 'Beritapage',
                'isi' => null,
                'website' => null,
                'hits' => 0,
                'popup_status' => 'Publish',
                'urutan' => 1,
                'status_text' => 'Ya',
            ],
            // Galeri
            [
                'id_kategori_galeri' => 0,
                'id_user' => $userId,
                'bahasa' => 'ID',
                'judul_galeri' => 'Kegiatan Kelas',
                'gambar' => 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=800&q=80',
                'jenis_galeri' => 'Galeri',
                'isi' => null,
                'website' => null,
                'hits' => 0,
                'popup_status' => 'Publish',
                'urutan' => 1,
                'status_text' => 'Ya',
            ],
            [
                'id_kategori_galeri' => 0,
                'id_user' => $userId,
                'bahasa' => 'ID',
                'judul_galeri' => 'Wisuda Alumni',
                'gambar' => 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?auto=format&fit=crop&w=800&q=80',
                'jenis_galeri' => 'Galeri',
                'isi' => null,
                'website' => null,
                'hits' => 0,
                'popup_status' => 'Publish',
                'urutan' => 2,
                'status_text' => 'Ya',
            ],
            [
                'id_kategori_galeri' => 0,
                'id_user' => $userId,
                'bahasa' => 'ID',
                'judul_galeri' => 'Workshop Bahasa Jepang',
                'gambar' => 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=800&q=80',
                'jenis_galeri' => 'Galeri',
                'isi' => null,
                'website' => null,
                'hits' => 0,
                'popup_status' => 'Publish',
                'urutan' => 3,
                'status_text' => 'Ya',
            ],
            [
                'id_kategori_galeri' => 0,
                'id_user' => $userId,
                'bahasa' => 'ID',
                'judul_galeri' => 'Kunjungan Perusahaan',
                'gambar' => 'https://images.unsplash.com/photo-1556761175-5973dc0f32e7?auto=format&fit=crop&w=800&q=80',
                'jenis_galeri' => 'Galeri',
                'isi' => null,
                'website' => null,
                'hits' => 0,
                'popup_status' => 'Publish',
                'urutan' => 4,
                'status_text' => 'Ya',
            ],
        ];

        DB::table('galeri')->insert($galeris);
    }
}
