<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class BeritaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get kategori ID (assuming first kategori exists)
        $kategoriId = DB::table('kategori')->where('slug_kategori', 'berita-update')->value('id_kategori') ?? 1;
        $userId = DB::table('users')->first()->id_user ?? 1;

        // Berita
        $beritas = [
            [
                'id_user' => $userId,
                'id_kategori' => $kategoriId,
                'bahasa' => 'ID',
                'updater' => 'Admin',
                'slug_berita' => 'pembukaan-kelas-baru-bahasa-jepang-2025',
                'judul_berita' => 'Pembukaan Kelas Baru Bahasa Jepang 2025',
                'isi' => '<h2>Program Baru Dibuka!</h2>
                <p>Kami dengan bangga mengumumkan pembukaan kelas baru bahasa Jepang untuk tahun 2025. Program ini dirancang khusus untuk membantu Anda mencapai target JLPT dari level N5 hingga N1 dengan metode pembelajaran yang interaktif dan menyenangkan.</p>
                <h3>Keunggulan Program:</h3>
                <ul>
                    <li>Instruktur native speaker berpengalaman</li>
                    <li>Kurikulum terstruktur dan teruji</li>
                    <li>Kelas kecil dengan perhatian personal</li>
                    <li>Materi digital lengkap</li>
                    <li>Praktek konversasi langsung</li>
                </ul>
                <p>Daftar sekarang dan dapatkan diskon early bird 20% untuk pendaftaran sebelum 31 Januari 2025!</p>',
                'status_berita' => 'Publish',
                'jenis_berita' => 'Berita',
                'keywords' => 'bahasa jepang, kelas baru, program 2025, JLPT, study jepang',
                'gambar' => 'https://images.unsplash.com/photo-1528164344705-47542687000d?auto=format&fit=crop&w=800&q=80',
                'icon' => 'fa fa-graduation-cap',
                'hits' => 245,
                'urutan' => 1,
                'tanggal_post' => Carbon::now()->subDays(5),
                'tanggal_publish' => Carbon::now()->subDays(5),
            ],
            [
                'id_user' => $userId,
                'id_kategori' => $kategoriId,
                'bahasa' => 'ID',
                'updater' => 'Admin',
                'slug_berita' => 'kerjasama-dengan-15-perusahaan-jepang',
                'judul_berita' => 'Kerjasama dengan 15 Perusahaan Jepang untuk Program Magang',
                'isi' => '<h2>Peluang Magang Terbuka Lebar</h2>
                <p>Meganthara Group dengan bangga mengumumkan kerjasama strategis dengan 15 perusahaan besar di Jepang untuk program magang dan kerja. Perusahaan-perusahaan ini berasal dari berbagai sektor industri yang menjanjikan.</p>
                <h3>Sektor Industri:</h3>
                <ul>
                    <li><strong>Manufaktur:</strong> Toyota, Honda, Panasonic</li>
                    <li><strong>Teknologi:</strong> Sony, Sharp, Toshiba</li>
                    <li><strong>Hospitality:</strong> Hotel chains terkemuka</li>
                    <li><strong>Retail:</strong> Convenience store networks</li>
                    <li><strong>Healthcare:</strong> Rumah sakit dan care facilities</li>
                </ul>
                <p>Program ini memberikan kesempatan emas untuk mendapatkan pengalaman kerja langsung di Jepang dengan gaji kompetitif dan benefit lengkap.</p>',
                'status_berita' => 'Publish',
                'jenis_berita' => 'Berita',
                'keywords' => 'kerjasama, perusahaan jepang, magang, lowongan kerja',
                'gambar' => 'https://images.unsplash.com/photo-1493976040374-85c8e12f0c0e?auto=format&fit=crop&w=800&q=80',
                'icon' => 'fa fa-handshake',
                'hits' => 512,
                'urutan' => 2,
                'tanggal_post' => Carbon::now()->subDays(10),
                'tanggal_publish' => Carbon::now()->subDays(10),
            ],
            [
                'id_user' => $userId,
                'id_kategori' => $kategoriId,
                'bahasa' => 'ID',
                'updater' => 'Admin',
                'slug_berita' => 'sukses-1000-alumni-bekerja-di-jepang',
                'judul_berita' => 'Pencapaian Milestone: 1000 Alumni Berhasil Bekerja di Jepang',
                'isi' => '<h2>Pencapaian Luar Biasa!</h2>
                <p>Kami sangat bangga mengumumkan bahwa telah mencapai milestone penting: <strong>1000 alumni berhasil bekerja di Jepang</strong> melalui program kami!</p>
                <h3>Statistik Alumni:</h3>
                <ul>
                    <li>1000+ alumni bekerja di berbagai sektor</li>
                    <li>85% mendapatkan kontrak permanen</li>
                    <li>Rata-rata gaji: ¥2.5 - 4 juta/bulan</li>
                    <li>Tingkat kepuasan: 92%</li>
                </ul>
                <p>Terima kasih kepada semua alumni yang telah mempercayai kami. Kesuksesan Anda adalah motivasi kami untuk terus membantu lebih banyak orang mewujudkan impian bekerja di Jepang.</p>',
                'status_berita' => 'Publish',
                'jenis_berita' => 'Berita',
                'keywords' => 'alumni, sukses, milestone, pencapaian',
                'gambar' => 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?auto=format&fit=crop&w=800&q=80',
                'icon' => 'fa fa-trophy',
                'hits' => 678,
                'urutan' => 3,
                'tanggal_post' => Carbon::now()->subDays(15),
                'tanggal_publish' => Carbon::now()->subDays(15),
            ],
            [
                'id_user' => $userId,
                'id_kategori' => $kategoriId,
                'bahasa' => 'ID',
                'updater' => 'Admin',
                'slug_berita' => 'program-beasiswa-bahasa-jepang-2025',
                'judul_berita' => 'Program Beasiswa Bahasa Jepang 2025 Dibuka',
                'isi' => '<h2>Kesempatan Emas untuk Belajar Gratis!</h2>
                <p>Program beasiswa bahasa Jepang 2025 telah dibuka! Kami menawarkan 50 slot beasiswa penuh untuk program intensif 6 bulan.</p>
                <h3>Persyaratan:</h3>
                <ul>
                    <li>Usia 18-35 tahun</li>
                    <li>Lulusan SMA/SMK/Sederajat</li>
                    <li>Memiliki motivasi kuat untuk belajar</li>
                    <li>Bersedia mengikuti program penuh</li>
                </ul>
                <h3>Benefit Beasiswa:</h3>
                <ul>
                    <li>Tuition fee 100% gratis</li>
                    <li>Materi pembelajaran lengkap</li>
                    <li>Sertifikat resmi</li>
                    <li>Kesempatan magang di Jepang</li>
                </ul>
                <p>Pendaftaran dibuka hingga 28 Februari 2025. Jangan lewatkan kesempatan ini!</p>',
                'status_berita' => 'Publish',
                'jenis_berita' => 'Berita',
                'keywords' => 'beasiswa, program gratis, bahasa jepang, kesempatan',
                'gambar' => 'https://images.unsplash.com/photo-1591157675276-91d4c6a83d47?auto=format&fit=crop&w=800&q=80',
                'icon' => 'fa fa-gift',
                'hits' => 823,
                'urutan' => 4,
                'tanggal_post' => Carbon::now()->subDays(20),
                'tanggal_publish' => Carbon::now()->subDays(20),
            ],
        ];

        // Layanan
        $layanans = [
            [
                'id_user' => $userId,
                'id_kategori' => 0,
                'bahasa' => 'ID',
                'updater' => 'Admin',
                'slug_berita' => 'program-belajar-bahasa-jepang',
                'judul_berita' => 'Program Belajar Bahasa Jepang',
                'isi' => '<h2>Program Belajar Bahasa Jepang Profesional</h2>
                <p>Program pembelajaran bahasa Jepang kami dirancang dengan kurikulum internasional yang telah terbukti efektif. Dengan instruktur berpengalaman, kami membantu Anda mencapai target JLPT dari level N5 hingga N1.</p>
                <h3>Keunggulan Program:</h3>
                <ul>
                    <li>Pembelajaran interaktif yang menyenangkan</li>
                    <li>Praktek konversasi langsung</li>
                    <li>Pemahaman budaya Jepang</li>
                    <li>Persiapan ujian JLPT yang terstruktur</li>
                    <li>Akses ke materi digital yang lengkap</li>
                </ul>',
                'status_berita' => 'Publish',
                'jenis_berita' => 'Layanan',
                'keywords' => 'belajar bahasa jepang, JLPT, kursus',
                'gambar' => 'https://images.unsplash.com/photo-1528164344705-47542687000d?auto=format&fit=crop&w=800&q=80',
                'icon' => 'fa fa-book',
                'hits' => 0,
                'urutan' => 1,
                'tanggal_post' => Carbon::now(),
                'tanggal_publish' => Carbon::now(),
            ],
            [
                'id_user' => $userId,
                'id_kategori' => 0,
                'bahasa' => 'ID',
                'updater' => 'Admin',
                'slug_berita' => 'program-kerja-di-jepang',
                'judul_berita' => 'Program Kerja di Jepang',
                'isi' => '<h2>Program Kerja di Jepang</h2>
                <p>Kami membantu Anda mendapatkan kesempatan kerja di Jepang dengan berbagai program yang sesuai dengan kualifikasi dan minat Anda.</p>
                <h3>Program yang Tersedia:</h3>
                <ul>
                    <li>Tokutei Ginou (Specified Skilled Worker)</li>
                    <li>Technical Intern Training Program</li>
                    <li>Working Holiday Visa</li>
                    <li>Student Visa dengan Part-time Work</li>
                </ul>',
                'status_berita' => 'Publish',
                'jenis_berita' => 'Layanan',
                'keywords' => 'kerja di jepang, visa kerja, lowongan',
                'gambar' => 'https://images.unsplash.com/photo-1493976040374-85c8e12f0c0e?auto=format&fit=crop&w=800&q=80',
                'icon' => 'fa fa-briefcase',
                'hits' => 0,
                'urutan' => 2,
                'tanggal_post' => Carbon::now(),
                'tanggal_publish' => Carbon::now(),
            ],
            [
                'id_user' => $userId,
                'id_kategori' => 0,
                'bahasa' => 'ID',
                'updater' => 'Admin',
                'slug_berita' => 'konsultasi-visa-dan-dokumen',
                'judul_berita' => 'Konsultasi Visa dan Dokumen',
                'isi' => '<h2>Konsultasi Visa dan Dokumen</h2>
                <p>Tim konsultan kami siap membantu Anda dalam proses pengurusan visa dan dokumen yang diperlukan untuk bekerja atau belajar di Jepang.</p>
                <h3>Layanan yang Kami Berikan:</h3>
                <ul>
                    <li>Konsultasi visa gratis</li>
                    <li>Bantuan pengurusan dokumen</li>
                    <li>Panduan lengkap proses aplikasi</li>
                    <li>Follow-up hingga visa diterbitkan</li>
                </ul>',
                'status_berita' => 'Publish',
                'jenis_berita' => 'Layanan',
                'keywords' => 'visa, dokumen, konsultasi',
                'gambar' => 'https://images.unsplash.com/photo-1450101499163-c8848c66ca85?auto=format&fit=crop&w=800&q=80',
                'icon' => 'fa fa-file-alt',
                'hits' => 0,
                'urutan' => 3,
                'tanggal_post' => Carbon::now(),
                'tanggal_publish' => Carbon::now(),
            ],
        ];

        DB::table('berita')->insert(array_merge($beritas, $layanans));
    }
}
