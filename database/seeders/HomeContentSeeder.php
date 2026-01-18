<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\Models\HomeContent;

class HomeContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!Schema::hasTable('home_contents')) {
            Schema::create('home_contents', function (Blueprint $table) {
                $table->id();
                $table->string('section');
                $table->text('content')->nullable();
                $table->string('image')->nullable();
                $table->string('video')->nullable();
                $table->string('link')->nullable(); // Tambahkan kolom link
                $table->boolean('active')->default(true);
                $table->integer('urutan')->default(0);
                $table->timestamps();
            });
        } else {
            // Jika tabel sudah ada, tambahkan kolom link jika belum ada
            if (!Schema::hasColumn('home_contents', 'link')) {
                Schema::table('home_contents', function (Blueprint $table) {
                    $table->string('link')->nullable()->after('video');
                });
            }
        }

        HomeContent::create([
            'section' => 'hero_title',
            'content' => 'Program Resmi',
            'active' => 1,
            'urutan' => 1
        ]);

        HomeContent::create([
            'section' => 'hero_subtitle',
            'content' => 'Belajar & Kerja',
            'active' => 1,
            'urutan' => 2
        ]);

        HomeContent::create([
            'section' => 'hero_description',
            'content' => 'Raih beasiswa pendidikan dan karier di Jepang dengan mentor yang sudah berpengalaman, jaringan luas, dan sertifikat pelatihan yang terakreditasi.',
            'active' => 1,
            'urutan' => 3
        ]);

        HomeContent::create([
            'section' => 'button_text',
            'content' => 'Daftar Sekarang',
            'link' => 'daftar',
            'active' => 1,
            'urutan' => 4
        ]);

        HomeContent::create([
            'section' => 'section_title',
            'content' => 'Jepang Menanti<br />Anda',
            'active' => 1,
            'urutan' => 5
        ]);

        HomeContent::create([
            'section' => 'section_description',
            'content' => 'Pilihan universitas dan sekolah bahasa terbaik menanti. Kami bekerja sama dengan lembaga pendidikan resmi yang terdaftar, memberikan jaminan kualitas dan legalitas. Peluang karier global menanti Anda dengan standar gaji internasional yang kompetitif.',
            'active' => 1,
            'urutan' => 6
        ]);

        HomeContent::create([
            'section' => 'more_button',
            'content' => 'Selengkapnya',
            'active' => 1,
            'urutan' => 7
        ]);
    }
}
