<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KonfigurasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('konfigurasi')->insert([
            'namaweb' => 'Company Profile CMS',
            'tagline' => 'Your Tagline Here',
            'tentang' => 'About us content',
            'website' => 'https://example.com',
            'email' => 'info@example.com',
            'alamat' => 'Your Address',
            'telepon' => '123456789',
            'deskripsi' => 'Site description',
            'keywords' => 'keywords',
            'id_user' => 1, // Assuming user id 1 exists
        ]);
    }
}
