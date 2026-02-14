<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class LokerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lokers = [
            [
                'judul_loker' => 'Lowongan Production Worker - Toyota Aichi',
                'slug_loker' => 'lowongan-production-worker-toyota-aichi',
                'deskripsi_singkat' => 'Dibutuhkan Production Worker untuk pabrik Toyota di Aichi. Gaji kompetitif dengan benefit lengkap.',
                'isi_loker' => '<h2>Deskripsi Pekerjaan</h2>
                <p>Kami mencari Production Worker untuk bekerja di pabrik Toyota di Aichi, Jepang. Posisi ini menawarkan gaji kompetitif dan benefit lengkap.</p>
                <h3>Persyaratan:</h3>
                <ul>
                    <li>Usia 20-35 tahun</li>
                    <li>JLPT N4 minimum</li>
                    <li>Kesehatan prima</li>
                    <li>Disiplin dan bertanggung jawab</li>
                    <li>Bersedia bekerja shift</li>
                </ul>
                <h3>Gaji & Benefit:</h3>
                <ul>
                    <li>Gaji: ¥2.5 - 3.2 Juta/Bulan</li>
                    <li>Asuransi kesehatan</li>
                    <li>Tunjangan keluarga</li>
                    <li>Bonus tahunan</li>
                    <li>Training lengkap</li>
                </ul>',
                'posisi' => 'Production Worker',
                'lokasi_kerja' => 'Aichi, Jepang',
                'tipe_kerja' => 'Full-time',
                'persyaratan' => 'JLPT N4, Kesehatan prima, Disiplin',
                'tanggung_jawab' => 'Operasi mesin produksi, Quality control, Maintenance dasar',
                'tanggal_mulai' => Carbon::now()->addMonths(2),
                'tanggal_selesai' => Carbon::now()->addMonths(3),
                'status_loker' => 'Publish',
                'gambar' => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=800&q=80',
                'urutan' => 1,
            ],
            [
                'judul_loker' => 'Lowongan Caregiver - Osaka Care Facility',
                'slug_loker' => 'lowongan-caregiver-osaka-care-facility',
                'deskripsi_singkat' => 'Dibutuhkan Caregiver untuk fasilitas perawatan lansia di Osaka. Pelatihan lengkap disediakan.',
                'isi_loker' => '<h2>Deskripsi Pekerjaan</h2>
                <p>Kami mencari Caregiver untuk bekerja di fasilitas perawatan lansia di Osaka. Posisi ini sangat cocok untuk Anda yang memiliki jiwa sosial tinggi.</p>
                <h3>Persyaratan:</h3>
                <ul>
                    <li>Usia 20-50 tahun</li>
                    <li>JLPT N3 minimum</li>
                    <li>Fisik sehat dan fit</li>
                    <li>Empati dan sabar</li>
                    <li>Bersedia bekerja shift</li>
                </ul>
                <h3>Gaji & Benefit:</h3>
                <ul>
                    <li>Gaji: ¥2.4 - 3.0 Juta/Bulan</li>
                    <li>Asuransi kesehatan lengkap</li>
                    <li>Training on-the-job</li>
                    <li>Kesempatan sertifikasi</li>
                    <li>Overtime pay</li>
                </ul>',
                'posisi' => 'Caregiver',
                'lokasi_kerja' => 'Osaka, Jepang',
                'tipe_kerja' => 'Full-time',
                'persyaratan' => 'JLPT N3, Fisik sehat, Empati tinggi',
                'tanggung_jawab' => 'Merawat lansia, Membantu aktivitas sehari-hari, Dokumentasi',
                'tanggal_mulai' => Carbon::now()->addMonths(1),
                'tanggal_selesai' => Carbon::now()->addMonths(2),
                'status_loker' => 'Publish',
                'gambar' => 'https://images.unsplash.com/photo-1631217314831-c6227db76b6e?auto=format&fit=crop&w=800&q=80',
                'urutan' => 2,
            ],
            [
                'judul_loker' => 'Lowongan Hotel Staff - Tokyo',
                'slug_loker' => 'lowongan-hotel-staff-tokyo',
                'deskripsi_singkat' => 'Dibutuhkan Hotel Staff untuk hotel bintang 4 di Tokyo. Lingkungan kerja internasional dan dinamis.',
                'isi_loker' => '<h2>Deskripsi Pekerjaan</h2>
                <p>Kami mencari Hotel Staff untuk bekerja di hotel bintang 4 di Tokyo. Posisi ini menawarkan pengalaman kerja di industri hospitality yang dinamis.</p>
                <h3>Persyaratan:</h3>
                <ul>
                    <li>Usia 20-35 tahun</li>
                    <li>JLPT N3 minimum</li>
                    <li>Kemampuan komunikasi baik</li>
                    <li>Ramah dan profesional</li>
                    <li>Bersedia bekerja shift</li>
                </ul>
                <h3>Gaji & Benefit:</h3>
                <ul>
                    <li>Gaji: ¥2.3 - 2.9 Juta/Bulan</li>
                    <li>Asuransi kesehatan</li>
                    <li>Makan siang gratis</li>
                    <li>Training service excellence</li>
                    <li>Kesempatan promosi</li>
                </ul>',
                'posisi' => 'Hotel Staff',
                'lokasi_kerja' => 'Tokyo, Jepang',
                'tipe_kerja' => 'Full-time',
                'persyaratan' => 'JLPT N3, Komunikasi baik, Ramah',
                'tanggung_jawab' => 'Melayani tamu, Housekeeping, Front desk',
                'tanggal_mulai' => Carbon::now()->addMonths(2),
                'tanggal_selesai' => Carbon::now()->addMonths(3),
                'status_loker' => 'Publish',
                'gambar' => 'https://images.unsplash.com/photo-1564501049412-61c2a3083791?auto=format&fit=crop&w=800&q=80',
                'urutan' => 3,
            ],
            [
                'judul_loker' => 'Lowongan Machine Operator - Honda Saitama',
                'slug_loker' => 'lowongan-machine-operator-honda-saitama',
                'deskripsi_singkat' => 'Dibutuhkan Machine Operator untuk pabrik Honda di Saitama. Gaji menarik dengan benefit lengkap.',
                'isi_loker' => '<h2>Deskripsi Pekerjaan</h2>
                <p>Kami mencari Machine Operator untuk bekerja di pabrik Honda di Saitama. Posisi ini menawarkan kesempatan belajar teknologi otomotif Jepang.</p>
                <h3>Persyaratan:</h3>
                <ul>
                    <li>Usia 20-40 tahun</li>
                    <li>JLPT N4 minimum</li>
                    <li>Kesehatan prima</li>
                    <li>Disiplin dan teliti</li>
                    <li>Bersedia bekerja shift</li>
                </ul>
                <h3>Gaji & Benefit:</h3>
                <ul>
                    <li>Gaji: ¥2.6 - 3.4 Juta/Bulan</li>
                    <li>Asuransi kesehatan</li>
                    <li>Tunjangan transport</li>
                    <li>Bonus tahunan</li>
                    <li>Training berkala</li>
                </ul>',
                'posisi' => 'Machine Operator',
                'lokasi_kerja' => 'Saitama, Jepang',
                'tipe_kerja' => 'Full-time',
                'persyaratan' => 'JLPT N4, Kesehatan prima, Teliti',
                'tanggung_jawab' => 'Operasi mesin produksi, Quality check, Maintenance',
                'tanggal_mulai' => Carbon::now()->addMonths(2),
                'tanggal_selesai' => Carbon::now()->addMonths(3),
                'status_loker' => 'Publish',
                'gambar' => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=800&q=80',
                'urutan' => 4,
            ],
            [
                'judul_loker' => 'Lowongan Quality Control - Panasonic Osaka',
                'slug_loker' => 'lowongan-quality-control-panasonic-osaka',
                'deskripsi_singkat' => 'Dibutuhkan Quality Control untuk pabrik Panasonic di Osaka. Kesempatan belajar teknologi canggih.',
                'isi_loker' => '<h2>Deskripsi Pekerjaan</h2>
                <p>Kami mencari Quality Control untuk bekerja di pabrik Panasonic di Osaka. Posisi ini menawarkan kesempatan belajar standar kualitas Jepang.</p>
                <h3>Persyaratan:</h3>
                <ul>
                    <li>Usia 20-35 tahun</li>
                    <li>JLPT N4 minimum</li>
                    <li>Teliti dan detail-oriented</li>
                    <li>Kemampuan analisis baik</li>
                    <li>Bersedia bekerja shift</li>
                </ul>
                <h3>Gaji & Benefit:</h3>
                <ul>
                    <li>Gaji: ¥2.7 - 3.5 Juta/Bulan</li>
                    <li>Asuransi kesehatan</li>
                    <li>Tunjangan keluarga</li>
                    <li>Bonus performa</li>
                    <li>Training quality system</li>
                </ul>',
                'posisi' => 'Quality Control',
                'lokasi_kerja' => 'Osaka, Jepang',
                'tipe_kerja' => 'Full-time',
                'persyaratan' => 'JLPT N4, Teliti, Detail-oriented',
                'tanggung_jawab' => 'Inspeksi produk, Quality testing, Dokumentasi',
                'tanggal_mulai' => Carbon::now()->addMonths(1),
                'tanggal_selesai' => Carbon::now()->addMonths(2),
                'status_loker' => 'Publish',
                'gambar' => 'https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=800&q=80',
                'urutan' => 5,
            ],
            [
                'judul_loker' => 'Lowongan Construction Worker - Tokyo',
                'slug_loker' => 'lowongan-construction-worker-tokyo',
                'deskripsi_singkat' => 'Dibutuhkan Construction Worker untuk proyek konstruksi di Tokyo. Gaji tinggi dengan benefit lengkap.',
                'isi_loker' => '<h2>Deskripsi Pekerjaan</h2>
                <p>Kami mencari Construction Worker untuk bekerja di proyek konstruksi di Tokyo. Posisi ini menawarkan gaji tinggi dan kesempatan belajar teknologi konstruksi modern.</p>
                <h3>Persyaratan:</h3>
                <ul>
                    <li>Usia 20-45 tahun</li>
                    <li>JLPT N4 minimum</li>
                    <li>Fisik kuat dan sehat</li>
                    <li>Disiplin dan safety-conscious</li>
                    <li>Bersedia bekerja outdoor</li>
                </ul>
                <h3>Gaji & Benefit:</h3>
                <ul>
                    <li>Gaji: ¥2.8 - 3.8 Juta/Bulan</li>
                    <li>Asuransi kesehatan</li>
                    <li>Tunjangan transport</li>
                    <li>Overtime pay tinggi</li>
                    <li>Safety equipment disediakan</li>
                </ul>',
                'posisi' => 'Construction Worker',
                'lokasi_kerja' => 'Tokyo, Jepang',
                'tipe_kerja' => 'Full-time',
                'persyaratan' => 'JLPT N4, Fisik kuat, Safety-conscious',
                'tanggung_jawab' => 'Pekerjaan konstruksi, Mengikuti safety protocol, Teamwork',
                'tanggal_mulai' => Carbon::now()->addMonths(2),
                'tanggal_selesai' => Carbon::now()->addMonths(3),
                'status_loker' => 'Publish',
                'gambar' => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?auto=format&fit=crop&w=800&q=80',
                'urutan' => 6,
            ],
            [
                'judul_loker' => 'Lowongan Restaurant Staff - Kyoto',
                'slug_loker' => 'lowongan-restaurant-staff-kyoto',
                'deskripsi_singkat' => 'Dibutuhkan Restaurant Staff untuk restoran tradisional di Kyoto. Belajar budaya kuliner Jepang.',
                'isi_loker' => '<h2>Deskripsi Pekerjaan</h2>
                <p>Kami mencari Restaurant Staff untuk bekerja di restoran tradisional di Kyoto. Posisi ini menawarkan kesempatan belajar budaya kuliner Jepang autentik.</p>
                <h3>Persyaratan:</h3>
                <ul>
                    <li>Usia 20-35 tahun</li>
                    <li>JLPT N3 minimum</li>
                    <li>Ramah dan komunikatif</li>
                    <li>Minat di bidang kuliner</li>
                    <li>Bersedia bekerja shift</li>
                </ul>
                <h3>Gaji & Benefit:</h3>
                <ul>
                    <li>Gaji: ¥2.3 - 3.0 Juta/Bulan</li>
                    <li>Asuransi kesehatan</li>
                    <li>Makan gratis</li>
                    <li>Training culinary</li>
                    <li>Tips dari pelanggan</li>
                </ul>',
                'posisi' => 'Restaurant Staff',
                'lokasi_kerja' => 'Kyoto, Jepang',
                'tipe_kerja' => 'Full-time',
                'persyaratan' => 'JLPT N3, Ramah, Minat kuliner',
                'tanggung_jawab' => 'Melayani pelanggan, Persiapan makanan, Cleaning',
                'tanggal_mulai' => Carbon::now()->addMonths(1),
                'tanggal_selesai' => Carbon::now()->addMonths(2),
                'status_loker' => 'Publish',
                'gambar' => 'https://images.unsplash.com/photo-1555396273-367ea4eb4db5?auto=format&fit=crop&w=800&q=80',
                'urutan' => 7,
            ],
            [
                'judul_loker' => 'Lowongan Welder - Shipyard Kobe',
                'slug_loker' => 'lowongan-welder-shipyard-kobe',
                'deskripsi_singkat' => 'Dibutuhkan Welder untuk galangan kapal di Kobe. Gaji tinggi dengan skill development.',
                'isi_loker' => '<h2>Deskripsi Pekerjaan</h2>
                <p>Kami mencari Welder untuk bekerja di galangan kapal di Kobe. Posisi ini menawarkan gaji tinggi dan kesempatan mengembangkan skill welding dengan standar internasional.</p>
                <h3>Persyaratan:</h3>
                <ul>
                    <li>Usia 20-40 tahun</li>
                    <li>JLPT N4 minimum</li>
                    <li>Pengalaman welding (preferred)</li>
                    <li>Fisik sehat</li>
                    <li>Safety-conscious</li>
                </ul>
                <h3>Gaji & Benefit:</h3>
                <ul>
                    <li>Gaji: ¥2.9 - 3.9 Juta/Bulan</li>
                    <li>Asuransi kesehatan</li>
                    <li>Tunjangan skill</li>
                    <li>Overtime pay tinggi</li>
                    <li>Training welding techniques</li>
                </ul>',
                'posisi' => 'Welder',
                'lokasi_kerja' => 'Kobe, Jepang',
                'tipe_kerja' => 'Full-time',
                'persyaratan' => 'JLPT N4, Pengalaman welding, Safety-conscious',
                'tanggung_jawab' => 'Welding pekerjaan, Quality check, Maintenance equipment',
                'tanggal_mulai' => Carbon::now()->addMonths(2),
                'tanggal_selesai' => Carbon::now()->addMonths(3),
                'status_loker' => 'Publish',
                'gambar' => 'https://images.unsplash.com/photo-1544551763-46a013bb70d5?auto=format&fit=crop&w=800&q=80',
                'urutan' => 8,
            ],
            [
                'judul_loker' => 'Lowongan Nurse Assistant - Tokyo Hospital',
                'slug_loker' => 'lowongan-nurse-assistant-tokyo-hospital',
                'deskripsi_singkat' => 'Dibutuhkan Nurse Assistant untuk rumah sakit di Tokyo. Peluang karir di sektor kesehatan.',
                'isi_loker' => '<h2>Deskripsi Pekerjaan</h2>
                <p>Kami mencari Nurse Assistant untuk bekerja di rumah sakit di Tokyo. Posisi ini menawarkan peluang karir di sektor kesehatan dengan pelatihan lengkap.</p>
                <h3>Persyaratan:</h3>
                <ul>
                    <li>Usia 20-40 tahun</li>
                    <li>JLPT N3 minimum</li>
                    <li>Fisik sehat dan fit</li>
                    <li>Empati dan sabar</li>
                    <li>Bersedia bekerja shift</li>
                </ul>
                <h3>Gaji & Benefit:</h3>
                <ul>
                    <li>Gaji: ¥2.6 - 3.5 Juta/Bulan</li>
                    <li>Asuransi kesehatan lengkap</li>
                    <li>Training medis</li>
                    <li>Kesempatan sertifikasi</li>
                    <li>Overtime pay</li>
                </ul>',
                'posisi' => 'Nurse Assistant',
                'lokasi_kerja' => 'Tokyo, Jepang',
                'tipe_kerja' => 'Full-time',
                'persyaratan' => 'JLPT N3, Fisik sehat, Empati tinggi',
                'tanggung_jawab' => 'Membantu perawat, Perawatan pasien, Dokumentasi medis',
                'tanggal_mulai' => Carbon::now()->addMonths(1),
                'tanggal_selesai' => Carbon::now()->addMonths(2),
                'status_loker' => 'Publish',
                'gambar' => 'https://images.unsplash.com/photo-1631217314831-c6227db76b6e?auto=format&fit=crop&w=800&q=80',
                'urutan' => 9,
            ],
            [
                'judul_loker' => 'Lowongan Forklift Operator - Warehouse Yokohama',
                'slug_loker' => 'lowongan-forklift-operator-warehouse-yokohama',
                'deskripsi_singkat' => 'Dibutuhkan Forklift Operator untuk gudang di Yokohama. Gaji stabil dengan benefit lengkap.',
                'isi_loker' => '<h2>Deskripsi Pekerjaan</h2>
                <p>Kami mencari Forklift Operator untuk bekerja di gudang di Yokohama. Posisi ini menawarkan gaji stabil dan kesempatan belajar sistem logistik Jepang yang efisien.</p>
                <h3>Persyaratan:</h3>
                <ul>
                    <li>Usia 20-40 tahun</li>
                    <li>JLPT N4 minimum</li>
                    <li>Memiliki SIM forklift (preferred)</li>
                    <li>Teliti dan hati-hati</li>
                    <li>Bersedia bekerja shift</li>
                </ul>
                <h3>Gaji & Benefit:</h3>
                <ul>
                    <li>Gaji: ¥2.4 - 3.2 Juta/Bulan</li>
                    <li>Asuransi kesehatan</li>
                    <li>Tunjangan transport</li>
                    <li>Training forklift</li>
                    <li>Bonus performa</li>
                </ul>',
                'posisi' => 'Forklift Operator',
                'lokasi_kerja' => 'Yokohama, Jepang',
                'tipe_kerja' => 'Full-time',
                'persyaratan' => 'JLPT N4, SIM forklift, Teliti',
                'tanggung_jawab' => 'Operasi forklift, Loading/unloading, Inventory management',
                'tanggal_mulai' => Carbon::now()->addMonths(2),
                'tanggal_selesai' => Carbon::now()->addMonths(3),
                'status_loker' => 'Publish',
                'gambar' => 'https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=800&q=80',
                'urutan' => 10,
            ],
        ];

        DB::table('loker')->insert($lokers);
    }
}
