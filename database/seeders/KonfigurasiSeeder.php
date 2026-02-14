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
            'namaweb' => 'Meganthara Group',
            'nama_singkat' => 'Meganthara Group',
            'singkatan' => 'JE',
            'tagline' => 'Wujudkan Impian Bekerja di Jepang',
            'tagline2' => 'Program Profesional dengan Gaji Kompetitif',
            'tentang' => 'Meganthara Group adalah lembaga pendidikan dan pelatihan yang fokus pada program kerja dan belajar di Jepang. Kami telah membantu lebih dari 1000 alumni berhasil bekerja di berbagai sektor industri di Jepang dengan gaji kompetitif dan benefit lengkap.',
            'website' => 'https://jemariedu.com',
            'email' => 'info@jemariedu.com',
            'email_cadangan' => 'contact@jemariedu.com',
            'alamat' => 'Jl. Raya Pendidikan No. 123, Jakarta Selatan, DKI Jakarta 12345',
            'telepon' => '+62 21 1234 5678',
            'hp' => '+62 812 3456 7890',
            'fax' => '+62 21 1234 5679',
            'deskripsi' => 'Meganthara Group - Program kerja dan belajar di Jepang dengan kurikulum profesional. Dapatkan gaji kompetitif, benefit lengkap, dan kesempatan pengembangan karir di Jepang.',
            'keywords' => 'kerja di jepang, belajar bahasa jepang, program jepang, visa jepang, lowongan jepang, JLPT, tokutei ginou, caregiver jepang',
            'metatext' => 'Meganthara Group membantu Anda mewujudkan impian bekerja di Jepang dengan program profesional dan terpercaya.',
            'facebook' => 'https://facebook.com/jemariedu',
            'twitter' => 'https://twitter.com/jemariedu',
            'instagram' => 'https://instagram.com/jemariedu',
            'nama_facebook' => 'Meganthara Group',
            'nama_twitter' => '@jemariedu',
            'nama_instagram' => '@jemariedu',
            'google_map' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.1234567890!2d106.1234567!3d-6.1234567!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwMDcnMjQuNCJTIDEwNsKwMDcnMjQuNCJF!5e0!3m2!1sen!2sid!4v1234567890123!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>',
            'text_bawah_peta' => 'Kunjungi kantor kami untuk konsultasi langsung',
            'link_bawah_peta' => '/kontak',
            'cara_pesan' => 'Hubungi kami melalui telepon, email, atau datang langsung ke kantor kami. Tim konsultan kami siap membantu Anda.',
            'logo' => '/assets/images/logo.png',
            'icon' => '/assets/images/favicon.ico',
            'gambar' => '/assets/images/hero-image.jpg',
            'id_user' => 1,
        ]);
    }
}
