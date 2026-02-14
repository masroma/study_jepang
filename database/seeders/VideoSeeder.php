<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userId = DB::table('users')->first()->id_user ?? 1;
        
        $videos = [
            [
                'judul' => 'Testimoni Alumni: Sukses Bekerja di Jepang',
                'posisi' => 'Homepage',
                'keterangan' => 'Dengarkan pengalaman langsung dari alumni kami yang telah berhasil bekerja di Jepang melalui program kami.',
                'video' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'urutan' => 1,
                'bahasa' => 'Indonesia',
                'gambar' => 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?auto=format&fit=crop&w=800&q=80',
                'id_user' => $userId,
            ],
            [
                'judul' => 'Program Belajar Bahasa Jepang di Meganthara Group',
                'posisi' => 'Homepage',
                'keterangan' => 'Lihat bagaimana proses pembelajaran bahasa Jepang di kelas kami dengan metode yang interaktif dan menyenangkan.',
                'video' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'urutan' => 2,
                'bahasa' => 'Indonesia',
                'gambar' => 'https://images.unsplash.com/photo-1528164344705-47542687000d?auto=format&fit=crop&w=800&q=80',
                'id_user' => $userId,
            ],
            [
                'judul' => 'Tips Lulus JLPT N3 dalam 6 Bulan',
                'posisi' => 'Homepage',
                'keterangan' => 'Panduan lengkap dari mentor kami tentang strategi efektif untuk lulus JLPT N3 dalam waktu singkat.',
                'video' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'urutan' => 3,
                'bahasa' => 'Indonesia',
                'gambar' => 'https://images.unsplash.com/photo-1543269865-cbf427effbad?auto=format&fit=crop&w=800&q=80',
                'id_user' => $userId,
            ],
        ];

        DB::table('video')->insert($videos);
    }
}
