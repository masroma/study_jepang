<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BlogPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('blog_posts')->insert([
            // 1. Tips & Trik
            [
                'judul' => 'Metode Efektif Belajar Bahasa Jepang di Jemari Edu',
                'slug' => 'metode-efektif-belajar-bahasa-jepang',
                'konten' => 'Program pembelajaran bahasa Jepang kami dirancang dengan kurikulum internasional yang telah terbukti efektif. Dengan instruktur berpengalaman, kami membantu Anda mencapai target JLPT dari level N5 hingga N1. 

Metode pembelajaran kami menggabungkan:
- Pembelajaran interaktif yang menyenangkan
- Praktek konversasi langsung
- Pemahaman budaya Jepang
- Persiapan ujian JLPT yang terstruktur
- Akses ke materi digital yang lengkap

Ribuan siswa telah berhasil mencapai target mereka bersama Jemari Edu. Bergabunglah dengan komunitas pembelajar kami hari ini!',
                'deskripsi_singkat' => 'Program pembelajaran bahasa Jepang kami dirancang dengan kurikulum internasional. Instruktur berpengalaman siap membantu Anda mencapai target JLPT dari N5 hingga N1.',
                'kategori' => 'Pendidikan',
                'gambar' => 'https://images.unsplash.com/photo-1528164344705-47542687000d?auto=format&fit=crop&w=500&q=60',
                'penulis' => 'Tim Jemari Edu',
                'tanggal_publish' => Carbon::createFromDate(2025, 1, 18),
                'status' => 'publish',
                'views' => 245,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // 2. Panduan
            [
                'judul' => 'Prosedur Lengkap Visa Kerja Tokutei Ginou di Jepang',
                'slug' => 'prosedur-visa-kerja-tokutei-ginou-jepang',
                'konten' => 'Visa Tokutei Ginou (Specified Skilled Worker) adalah salah satu peluang terbaik untuk bekerja di Jepang. Berikut adalah panduan lengkap proses aplikasinya:

PERSYARATAN UMUM:
- Usia minimal 18 tahun
- Kesehatan fisik prima
- Lulus pemeriksaan kesehatan
- Tidak memiliki catatan kriminal
- Kemampuan bahasa Jepang N4 ke atas

DOKUMEN YANG DIBUTUHKAN:
1. Paspor yang masih berlaku (minimal 2 tahun)
2. Sertifikat JLPT N4 atau sejenisnya
3. Sertifikat kesehatan dari rumah sakit terakreditasi
4. Ijazah pendidikan terakhir
5. Surat keterangan kelakuan baik
6. Kartu keluarga dan akta lahir (legalisir)
7. Pernyataan tidak ada hubungan keluarga dengan majikan

PROSES APLIKASI:
Tahap 1: Registrasi dan berkas
Tahap 2: Interview awal
Tahap 3: Medical checkup
Tahap 4: Approval dari immigration
Tahap 5: Penerbitan visa
Tahap 6: Keberangkatan ke Jepang

Total waktu proses: 2-4 bulan tergantung dari perusahaan dan dokumen.

Kami siap membantu Anda di setiap tahap prosesnya!',
                'deskripsi_singkat' => 'Pelajari persyaratan visa kerja terampil (Tokutei Ginou), dokumen yang dibutuhkan, dan proses aplikasi dari awal hingga keberangkatan ke Jepang bersama kami.',
                'kategori' => 'Panduan',
                'gambar' => 'https://images.unsplash.com/photo-1493976040374-85c8e12f0c0e?auto=format&fit=crop&w=500&q=60',
                'penulis' => 'Konsultan Visa Jemari Edu',
                'tanggal_publish' => Carbon::createFromDate(2025, 1, 16),
                'status' => 'publish',
                'views' => 512,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // 3. Budaya
            [
                'judul' => 'Etika & Norma Budaya Kerja di Jepang yang Perlu Diketahui',
                'slug' => 'etika-budaya-kerja-jepang',
                'konten' => 'Budaya kerja Jepang sangat berbeda dengan budaya kerja di Indonesia. Memahami norma-norma ini penting untuk kesuksesan karir Anda di Jepang.

KONSEP PENTING DALAM BUDAYA KERJA JEPANG:

1. KEIGO (敬語 - Bahasa Hormat)
Penggunaan bahasa hormat yang tepat adalah fondasi dari sopan santun Jepang. Selalu gunakan keigo ketika berbicara dengan atasan atau klien.

2. OCHA-NOMU (お茶のむ - Minum Teh Sambil Berbicara)
Ini adalah momen informal di mana rekan kerja bisa mengobrol santai. Jangan lewatkan kesempatan ini untuk membangun hubungan baik.

3. HARMONY (和 - Wa)
Harmoni dalam kelompok sangat dihargai. Hindari konflik terbuka dan selalu cari solusi yang menguntungkan semua pihak.

4. OVERTIME (加班 - Kasan)
Bekerja lembur adalah bagian dari budaya kerja. Namun di era modern, perusahaan mulai membatasi ini demi work-life balance.

5. LOYALITAS PERUSAHAAN
Menunjukkan dedikasi kepada perusahaan sangat penting. Ini bukan hanya tentang bekerja, tapi tentang menjadi bagian dari keluarga perusahaan.

6. PRESENTASI DAN LAPORAN
Detail sangat penting. Laporan harus akurat, terstruktur, dan profesional.

TIPS PRAKTIS:
- Datang tepat waktu (lebih baik 10 menit lebih awal)
- Perhatikan dress code
- Hormati hierarki perusahaan
- Jangan ambil keputusan sendiri tanpa approval atasan
- Belajar tentang perusahaan Anda sebelum bergabung
- Tunjukkan antusiasme dan kemauan belajar

Dengan pemahaman budaya kerja Jepang yang baik, Anda akan dapat beradaptasi dengan lebih mudah!',
                'deskripsi_singkat' => 'Pahami budaya kerja Jepang, mulai dari hormat kepada atasan, konsep ocha-nomu, hingga pentingnya harmoni dalam bekerja di perusahaan Jepang.',
                'kategori' => 'Budaya',
                'gambar' => 'https://images.unsplash.com/photo-1493804714600-bb3c7c9351a2?auto=format&fit=crop&w=500&q=60',
                'penulis' => 'Mentor Jemari Edu',
                'tanggal_publish' => Carbon::createFromDate(2025, 1, 14),
                'status' => 'publish',
                'views' => 389,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // 4. Tips & Trik - JLPT
            [
                'judul' => 'Strategi Ampuh Lulus JLPT N3 Dalam 6 Bulan Bersama Kami',
                'slug' => 'strategi-lulus-jlpt-n3-enam-bulan',
                'konten' => 'JLPT (Japanese Language Proficiency Test) N3 adalah target yang realistis untuk dicapai dalam 6 bulan dengan strategi yang tepat. Program intensif kami telah membantu ribuan siswa mencapai target ini.

RENCANA BELAJAR TERSTRUKTUR:

BULAN 1-2: DASAR KUAT
- Kuasai kanji 300+ karakter
- Pelajari grammar dasar hingga N3
- Bangun vocabulary 1500-2000 kata
- Latihan mendengarkan setiap hari

BULAN 3-4: INTENSITAS TINGGI
- Praktek soal JLPT secara rutin
- Tingkatkan kecepatan membaca
- Fokus pada area yang lemah
- Simulasi ujian penuh

BULAN 5-6: FINAL PUSH
- Review semua materi
- Latihan soal intensif
- Mock test reguler
- Fine-tuning strategi ujian

TIPS SUKSES:
✓ Belajar konsisten 2-3 jam setiap hari
✓ Bergabung dengan study group
✓ Dengarkan podcast Jepang
✓ Tonton anime/drama Jepang dengan subtitle
✓ Cari native speaker untuk practice
✓ Jangan takut membuat kesalahan
✓ Monitor progress secara rutin

MATERI PEMBELAJARAN:
- Kanji: Fokus pada kanji N3 yang paling sering muncul
- Grammar: Pelajari pola-pola dasar terlebih dahulu
- Listening: Mulai dengan kecepatan lambat, tingkatkan secara bertahap
- Reading: Latihan dengan berbagai jenis teks

Dengan komitmen penuh dan bimbingan mentor profesional kami, kesuksesan JLPT N3 Anda sudah di depan mata!',
                'deskripsi_singkat' => 'Program intensif kami telah membantu ribuan siswa lulus JLPT dengan metode pembelajaran yang terbukti efektif dan didukung instruktur profesional.',
                'kategori' => 'Tips & Trik',
                'gambar' => 'https://images.unsplash.com/photo-1543269865-cbf427effbad?auto=format&fit=crop&w=500&q=60',
                'penulis' => 'Koordinator JLPT Jemari Edu',
                'tanggal_publish' => Carbon::createFromDate(2025, 1, 12),
                'status' => 'publish',
                'views' => 678,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // 5. Karier
            [
                'judul' => 'Peluang Karier Terbaik di Industri Manufaktur Jepang',
                'slug' => 'peluang-karier-industri-manufaktur-jepang',
                'konten' => 'Industri manufaktur Jepang adalah salah satu yang terbesar di dunia dan menawarkan banyak peluang karier menarik untuk pekerja asing.

INDUSTRI MANUFAKTUR UTAMA:

1. OTOMOTIF
Perusahaan: Toyota, Honda, Nissan, Mitsubishi, Mazda
Posisi: Assembly worker, Quality control, Maintenance technician
Gaji: ¥2.5 - 3.5 juta/bulan (tergantung pengalaman)
Benefit: Asuransi kesehatan, Tunjangan keluarga, Bonus

2. ELEKTRONIK
Perusahaan: Sony, Panasonic, Sharp, Toshiba
Posisi: Production worker, Inspector, Line leader
Gaji: ¥2.3 - 3.2 juta/bulan
Benefit: Training berkala, Karir advancement, Housing support

3. MESIN INDUSTRI
Perusahaan: Fanuc, Daikin, Kawasaki Heavy Industries
Posisi: Operator, Technician, Programmer
Gaji: ¥2.8 - 4 juta/bulan
Benefit: Skill development, Overseas training, Premium bonuses

4. KIMIA DAN MATERIAL
Perusahaan: Asahi, Sumitomo, Mitsubishi Chemical
Posisi: Production staff, Lab technician, Safety officer
Gaji: ¥2.5 - 3.5 juta/bulan
Benefit: Research opportunities, Education support

KUALIFIKASI YANG DICARI:
- Sertifikat JLPT N4 minimum
- Kesehatan prima
- Disiplin dan tanggung jawab tinggi
- Kemampuan bekerja dalam tim
- Kemauan belajar

PENGEMBANGAN KARIER:
Year 1: Adapting dan learning phase
Year 2-3: Increased responsibility
Year 3-5: Leadership opportunities
Year 5+: Senior management options

Jemari Edu memiliki partnership dengan puluhan perusahaan manufaktur terkemuka di Jepang. Mari bersama kami wujudkan karier Anda di Jepang!',
                'deskripsi_singkat' => 'Jelajahi peluang kerja di sektor manufaktur, elektronik, otomotif, dan industri terkemuka lainnya dengan gaji kompetitif dan lingkungan kerja modern.',
                'kategori' => 'Karier',
                'gambar' => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=500&q=60',
                'penulis' => 'Placement Officer Jemari Edu',
                'tanggal_publish' => Carbon::createFromDate(2025, 1, 10),
                'status' => 'publish',
                'views' => 823,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // 6. Lifestyle
            [
                'judul' => 'Panduan Lengkap Hidup di Jepang: Akomodasi & Biaya Hidup',
                'slug' => 'panduan-hidup-jepang-akomodasi-biaya-hidup',
                'konten' => 'Mempersiapkan hidup di Jepang memerlukan perencanaan yang matang, terutama dalam hal akomodasi dan budget. Berikut panduan lengkap untuk Anda.

MENCARI AKOMODASI:

1. DORMITORY (寮 - Ryou)
Kelebihan: Murah, sudah furnished, ada komunitas
Biaya: ¥3,000 - 6,000/bulan
Lokasi: Dekat dengan pabrik/perusahaan

2. APARTMENT (アパート)
Kelebihan: Privasi, flexibility, pilihan banyak
Biaya: ¥5,000 - 12,000/bulan (1 kamar)
Deposit: Biasanya 1-2 bulan sewa

3. SHARED HOUSE (シェアハウス)
Kelebihan: Affordable, social, sudah termasuk utilities
Biaya: ¥4,000 - 8,000/bulan
Lokasi: Berbagai pilihan di kota-kota besar

BIAYA HIDUP BULANAN RATA-RATA:

Tempat Tinggal: ¥5,000 - 8,000
Makanan: ¥6,000 - 10,000
Transportasi: ¥1,000 - 3,000
Utilitas (listrik, air, gas): ¥2,000 - 4,000
Asuransi kesehatan: ¥1,500 - 3,000
Telepon/Internet: ¥2,000 - 3,000
Hiburan/Lainnya: ¥2,000 - 5,000

TOTAL: ¥19,500 - 36,000/bulan

TIPS MENGHEMAT:
✓ Gunakan public transportation (railcard)
✓ Belanja di convenience store untuk diskon
✓ Masak di rumah daripada eat out
✓ Gunakan free wifi di kafe dan toko
✓ Manfaatkan community events gratis
✓ Kumpulkan loyalty points

INFRASTRUKTUR PENTING:
- My Number Card (untuk pajak, asuransi, bank)
- Bank Account (memudahkan gaji diterima)
- Health Insurance (wajib)
- Mobile Phone dengan kontrak lokal
- Transportasi card (Suica/Pasmo)

ADAPTASI DAN BUDAYA:
- Jadilah bagian dari komunitas lokal
- Ikuti community clean-up events
- Hormati peraturan apartment/dorm
- Perhatikan jadwal sampah
- Buat teman lokal untuk networking
- Ikuti acara community center

Dengan perencanaan yang baik, hidup di Jepang menjadi pengalaman yang menyenangkan dan bermakna!',
                'deskripsi_singkat' => 'Informasi praktis mencari tempat tinggal, biaya hidup bulanan di berbagai kota Jepang, tips menghemat, dan panduan adaptasi hidup baru Anda.',
                'kategori' => 'Lifestyle',
                'gambar' => 'https://images.unsplash.com/photo-1488646953014-85cb44e25828?auto=format&fit=crop&w=500&q=60',
                'penulis' => 'Alumni Mentor Jemari Edu',
                'tanggal_publish' => Carbon::createFromDate(2025, 1, 8),
                'status' => 'publish',
                'views' => 1042,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // 7. Pendidikan - Beasiswa
            [
                'judul' => 'Program Beasiswa Studi Bahasa Jepang di Universitas Terkemuka',
                'slug' => 'program-beasiswa-studi-jepang-universitas',
                'konten' => 'Jemari Edu memiliki kerjasama dengan universitas terkemuka di Jepang yang menawarkan program beasiswa untuk pelajar internasional.

UNIVERSITAS PARTNER KAMI:

1. TOKYO UNIVERSITY OF FOREIGN STUDIES (TUFS)
Program: Japanese Language & Culture
Durasi: 6 bulan - 2 tahun
Beasiswa: Penuh hingga 50%
Keuntungan: Lokasi strategis, mentor profesional, networking luas

2. OSAKA UNIVERSITY OF EDUCATION
Program: Advanced Japanese Studies
Durasi: 1-2 tahun
Beasiswa: Partial hingga penuh
Keuntungan: Kualitas pengajar internasional, dormitory disediakan

3. KYOTO UNIVERSITY OF FOREIGN LANGUAGES
Program: Japanese Language Mastery
Durasi: 6 bulan - 1 tahun
Beasiswa: Penuh untuk top students
Keuntungan: Budaya Kyoto yang kaya, kualitas tinggi

PERSYARATAN BEASISWA:
- JLPT N3 minimum
- Nilai akademis yang baik
- Essay motivasi yang kuat
- Referensi dari guru/mentor
- Batas usia (biasanya 18-35 tahun)
- Kesehatan prima

PROSES APLIKASI:
1. Pendaftaran awal (form Jemari Edu)
2. Assessment dan interview
3. Submission ke universitas
4. Waiting list period (2-3 bulan)
5. Approval dan visa sponsorship
6. Berangkat ke Jepang

BIAYA YANG DITANGGUNG BEASISWA:
✓ Tuition fee
✓ Accommodation di dormitory
✓ Health insurance
✓ Material pembelajaran
✓ Beberapa beasiswa mencakup flight ticket

BANTUAN JEMARI EDU:
- Mempersiapkan dokumen aplikasi
- Interview practice
- Language training sebelum berangkat
- Airport pickup
- Orientation di Jepang
- Ongoing support selama studi

Jadilah bagian dari ribuan alumni kami yang sukses! Daftar sekarang untuk konsultasi beasiswa gratis.',
                'deskripsi_singkat' => 'Jemari Edu memiliki kerjasama dengan universitas terkemuka di Jepang. Dapatkan kesempatan beasiswa penuh untuk studi bahasa dan budaya Jepang.',
                'kategori' => 'Pendidikan',
                'gambar' => 'https://images.unsplash.com/photo-1591157675276-91d4c6a83d47?auto=format&fit=crop&w=500&q=60',
                'penulis' => 'Education Coordinator Jemari Edu',
                'tanggal_publish' => Carbon::createFromDate(2025, 1, 6),
                'status' => 'publish',
                'views' => 456,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // 8. Karier - Healthcare
            [
                'judul' => 'Menjadi Caregiver di Jepang: Peluang Karier di Sektor Kesehatan',
                'slug' => 'caregiver-jepang-peluang-sektor-kesehatan',
                'konten' => 'Sektor kesehatan dan perawatan lansia di Jepang membuka peluang besar bagi pekerja asing. Jepang menghadapi tantangan aging population dan membutuhkan caregiver yang terlatih.

POSISI YANG TERSEDIA:

1. CAREGIVER (介護職)
Deskripsi: Memberikan perawatan dasar kepada lansia
Gaji: ¥2.4 - 3.2 juta/bulan
Jam kerja: Shift (pagi/malam)
Training: Disediakan perusahaan

2. NURSE ASSISTANT
Deskripsi: Membantu perawat di rumah sakit/clinic
Gaji: ¥2.6 - 3.5 juta/bulan
Jam kerja: Shift reguler
Requirement: JLPT N3+

3. HOUSEKEEPING ASSISTANT
Deskripsi: Membersihkan fasilitas kesehatan
Gaji: ¥2.2 - 2.8 juta/bulan
Jam kerja: Reguler (pagi)
Requirement: JLPT N4

PERSYARATAN MINIMUM:
✓ Usia 20-65 tahun
✓ JLPT N4 (untuk caregiver) hingga N3
✓ Fisik sehat dan fit
✓ Attitude positif dan empati
✓ Bersedia bekerja shift/weekend
✓ Sertifikat kesehatan lengkap

TRAINING DAN SERTIFIKASI:
Semua caregiver baru akan mendapat:
- On-the-job training 1-3 bulan
- Sertifikasi internal perusahaan
- Kesempatan untuk dapatkan Care Worker Certificate (Kaigo Fukushi Shikaku)
- Continuous education program

KEUNTUNGAN BEKERJA DI SEKTOR INI:
→ Job security yang tinggi
→ Benefit kesehatan lengkap
→ Overtime pay yang menarik
→ Kesempatan naik jabatan
→ Visa sponsorship stabil
→ Community support yang kuat
→ Skill yang valuable untuk karier jangka panjang

PERKEMBANGAN KARIER:
Year 1: Basic training & adaptation
Year 2-3: Senior caregiver opportunities
Year 3+: Supervisor atau team leader roles

TESTIMONI ALUMNI:
"Bekerja sebagai caregiver membuat saya belajar banyak tentang Japanese culture dan memberikan kepuasan tersendiri membantu lansia Jepang." - Ibu Siti, Osaka

Sektor kesehatan adalah investasi terbaik untuk karir jangka panjang Anda di Jepang!',
                'deskripsi_singkat' => 'Jepang membutuhkan caregiver terampil. Pelajari peluang karier di sektor kesehatan, gaji kompetitif, dan program training profesional kami.',
                'kategori' => 'Karier',
                'gambar' => 'https://images.unsplash.com/photo-1631217314831-c6227db76b6e?auto=format&fit=crop&w=500&q=60',
                'penulis' => 'Healthcare Consultant Jemari Edu',
                'tanggal_publish' => Carbon::createFromDate(2025, 1, 4),
                'status' => 'publish',
                'views' => 567,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
