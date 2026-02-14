<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoris = [
            [
                'nama_kategori' => 'Program Pendidikan',
                'slug_kategori' => 'program-pendidikan',
            ],
            [
                'nama_kategori' => 'Berita & Update',
                'slug_kategori' => 'berita-update',
            ],
            [
                'nama_kategori' => 'Kisah Sukses',
                'slug_kategori' => 'kisah-sukses',
            ],
            [
                'nama_kategori' => 'Tips & Panduan',
                'slug_kategori' => 'tips-panduan',
            ],
            [
                'nama_kategori' => 'Lowongan Kerja',
                'slug_kategori' => 'lowongan-kerja',
            ],
            [
                'nama_kategori' => 'Event & Kegiatan',
                'slug_kategori' => 'event-kegiatan',
            ],
        ];

        DB::table('kategori')->insert($kategoris);
    }
}
