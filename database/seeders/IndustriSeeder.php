<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class IndustriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $industris = [
            [
                'nama' => 'Manufaktur & Otomotif',
                'sub_nama' => 'Manufacturing & Automotive',
                'gambar' => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=800&q=80',
                'deskripsi' => 'Industri manufaktur dan otomotif adalah salah satu sektor terbesar di Jepang. Kami memiliki kerjasama dengan perusahaan-perusahaan terkemuka seperti Toyota, Honda, dan Nissan.',
                'urutan' => 1,
                'status' => 'Publish',
            ],
            [
                'nama' => 'Teknologi & Elektronik',
                'sub_nama' => 'Technology & Electronics',
                'gambar' => 'https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=800&q=80',
                'deskripsi' => 'Sektor teknologi dan elektronik Jepang dikenal dengan inovasi dan kualitasnya. Perusahaan seperti Sony, Panasonic, dan Sharp menawarkan peluang karir yang menarik.',
                'urutan' => 2,
                'status' => 'Publish',
            ],
            [
                'nama' => 'Kesehatan & Perawatan',
                'sub_nama' => 'Healthcare & Caregiving',
                'gambar' => 'https://images.unsplash.com/photo-1631217314831-c6227db76b6e?auto=format&fit=crop&w=800&q=80',
                'deskripsi' => 'Dengan populasi yang menua, sektor kesehatan dan perawatan di Jepang terus berkembang. Peluang kerja sebagai caregiver sangat terbuka lebar.',
                'urutan' => 3,
                'status' => 'Publish',
            ],
            [
                'nama' => 'Hospitality & Pariwisata',
                'sub_nama' => 'Hospitality & Tourism',
                'gambar' => 'https://images.unsplash.com/photo-1564501049412-61c2a3083791?auto=format&fit=crop&w=800&q=80',
                'deskripsi' => 'Industri hospitality dan pariwisata Jepang menawarkan pengalaman kerja yang dinamis. Bekerja di hotel, restoran, dan fasilitas pariwisata dengan standar internasional.',
                'urutan' => 4,
                'status' => 'Publish',
            ],
            [
                'nama' => 'Konstruksi & Infrastruktur',
                'sub_nama' => 'Construction & Infrastructure',
                'gambar' => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?auto=format&fit=crop&w=800&q=80',
                'deskripsi' => 'Sektor konstruksi di Jepang dikenal dengan teknologi canggih dan standar keselamatan yang tinggi. Peluang kerja di berbagai proyek infrastruktur besar.',
                'urutan' => 5,
                'status' => 'Publish',
            ],
            [
                'nama' => 'Pertanian & Perikanan',
                'sub_nama' => 'Agriculture & Fishery',
                'gambar' => 'https://images.unsplash.com/photo-1500937386664-56d1dfef3854?auto=format&fit=crop&w=800&q=80',
                'deskripsi' => 'Industri pertanian dan perikanan Jepang menggunakan teknologi modern. Bekerja di lingkungan yang sehat dengan produk berkualitas tinggi.',
                'urutan' => 6,
                'status' => 'Publish',
            ],
            [
                'nama' => 'Makanan & Minuman',
                'sub_nama' => 'Food & Beverage',
                'gambar' => 'https://images.unsplash.com/photo-1555396273-367ea4eb4db5?auto=format&fit=crop&w=800&q=80',
                'deskripsi' => 'Industri makanan dan minuman Jepang terkenal dengan kualitas dan inovasinya. Peluang kerja di restoran, pabrik makanan, dan catering services.',
                'urutan' => 7,
                'status' => 'Publish',
            ],
            [
                'nama' => 'Retail & Perdagangan',
                'sub_nama' => 'Retail & Commerce',
                'gambar' => 'https://images.unsplash.com/photo-1441986300917-64674bd600d8?auto=format&fit=crop&w=800&q=80',
                'deskripsi' => 'Sektor retail dan perdagangan di Jepang sangat berkembang. Bekerja di convenience store, supermarket, dan toko retail dengan sistem yang terorganisir.',
                'urutan' => 8,
                'status' => 'Publish',
            ],
            [
                'nama' => 'Logistik & Transportasi',
                'sub_nama' => 'Logistics & Transportation',
                'gambar' => 'https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=800&q=80',
                'deskripsi' => 'Sektor logistik dan transportasi Jepang sangat efisien dan modern. Peluang kerja di gudang, distribusi, dan manajemen supply chain dengan teknologi canggih.',
                'urutan' => 9,
                'status' => 'Publish',
            ],
            [
                'nama' => 'Energi & Utilitas',
                'sub_nama' => 'Energy & Utilities',
                'gambar' => 'https://images.unsplash.com/photo-1466611653911-95081537e5b7?auto=format&fit=crop&w=800&q=80',
                'deskripsi' => 'Industri energi dan utilitas Jepang fokus pada energi terbarukan dan efisiensi. Peluang kerja di pembangkit listrik, pengelolaan air, dan infrastruktur energi.',
                'urutan' => 10,
                'status' => 'Publish',
            ],
        ];

        DB::table('industri')->insert($industris);
    }
}
