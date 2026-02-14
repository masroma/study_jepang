<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProgramMasaDepanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $programs = [];
        
        // Base programs data
        $basePrograms = [
            // Manufaktur & Otomotif (10 programs)
            ['judul' => 'Program Tokutei Ginou - Manufaktur Otomotif', 'lokasi' => 'Tokyo, Osaka, Aichi', 'gaji' => '¥2.5 - 3.5 Juta/Bulan', 'sertifikat' => 'Sertifikat Keahlian Manufaktur Otomotif', 'gambar' => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=800&q=80'],
            ['judul' => 'Program Assembly Worker - Toyota', 'lokasi' => 'Aichi, Toyota City', 'gaji' => '¥2.6 - 3.4 Juta/Bulan', 'sertifikat' => 'Toyota Assembly Certificate', 'gambar' => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=800&q=80'],
            ['judul' => 'Program Production Worker - Honda', 'lokasi' => 'Saitama, Tochigi', 'gaji' => '¥2.5 - 3.3 Juta/Bulan', 'sertifikat' => 'Honda Production Certificate', 'gambar' => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=800&q=80'],
            ['judul' => 'Program Quality Control - Nissan', 'lokasi' => 'Kanagawa, Yokohama', 'gaji' => '¥2.7 - 3.6 Juta/Bulan', 'sertifikat' => 'Nissan QC Certificate', 'gambar' => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=800&q=80'],
            ['judul' => 'Program Machine Operator - Mitsubishi', 'lokasi' => 'Aichi, Nagoya', 'gaji' => '¥2.6 - 3.5 Juta/Bulan', 'sertifikat' => 'Mitsubishi Operator Certificate', 'gambar' => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=800&q=80'],
            ['judul' => 'Program Maintenance Technician - Mazda', 'lokasi' => 'Hiroshima', 'gaji' => '¥2.8 - 3.7 Juta/Bulan', 'sertifikat' => 'Mazda Maintenance Certificate', 'gambar' => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=800&q=80'],
            ['judul' => 'Program Welder - Automotive Parts', 'lokasi' => 'Tokyo, Saitama', 'gaji' => '¥2.9 - 3.8 Juta/Bulan', 'sertifikat' => 'Automotive Welding Certificate', 'gambar' => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=800&q=80'],
            ['judul' => 'Program Forklift Operator - Warehouse', 'lokasi' => 'Tokyo, Yokohama', 'gaji' => '¥2.4 - 3.2 Juta/Bulan', 'sertifikat' => 'Forklift Operator License', 'gambar' => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=800&q=80'],
            ['judul' => 'Program Line Leader - Production', 'lokasi' => 'Osaka, Aichi', 'gaji' => '¥3.0 - 3.9 Juta/Bulan', 'sertifikat' => 'Production Leadership Certificate', 'gambar' => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=800&q=80'],
            ['judul' => 'Program Parts Inspector - Quality', 'lokasi' => 'Aichi, Kanagawa', 'gaji' => '¥2.7 - 3.6 Juta/Bulan', 'sertifikat' => 'Parts Inspection Certificate', 'gambar' => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=800&q=80'],
            
            // Elektronik & Teknologi (10 programs)
            ['judul' => 'Program Production Worker - Sony', 'lokasi' => 'Tokyo, Kanagawa', 'gaji' => '¥2.5 - 3.4 Juta/Bulan', 'sertifikat' => 'Sony Production Certificate', 'gambar' => 'https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=800&q=80'],
            ['judul' => 'Program Electronics Assembly - Panasonic', 'lokasi' => 'Osaka, Shiga', 'gaji' => '¥2.4 - 3.3 Juta/Bulan', 'sertifikat' => 'Panasonic Assembly Certificate', 'gambar' => 'https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=800&q=80'],
            ['judul' => 'Program Quality Inspector - Sharp', 'lokasi' => 'Osaka, Nara', 'gaji' => '¥2.6 - 3.5 Juta/Bulan', 'sertifikat' => 'Sharp QC Certificate', 'gambar' => 'https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=800&q=80'],
            ['judul' => 'Program Component Tester - Toshiba', 'lokasi' => 'Tokyo, Kanagawa', 'gaji' => '¥2.5 - 3.4 Juta/Bulan', 'sertifikat' => 'Toshiba Testing Certificate', 'gambar' => 'https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=800&q=80'],
            ['judul' => 'Program PCB Assembly - Electronics', 'lokasi' => 'Tokyo, Osaka', 'gaji' => '¥2.6 - 3.5 Juta/Bulan', 'sertifikat' => 'PCB Assembly Certificate', 'gambar' => 'https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=800&q=80'],
            ['judul' => 'Program Device Calibration - Tech', 'lokasi' => 'Tokyo, Kanagawa', 'gaji' => '¥2.7 - 3.6 Juta/Bulan', 'sertifikat' => 'Calibration Technician Certificate', 'gambar' => 'https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=800&q=80'],
            ['judul' => 'Program Packaging Worker - Electronics', 'lokasi' => 'Osaka, Aichi', 'gaji' => '¥2.3 - 3.1 Juta/Bulan', 'sertifikat' => 'Packaging Certificate', 'gambar' => 'https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=800&q=80'],
            ['judul' => 'Program Material Handler - Tech', 'lokasi' => 'Tokyo, Yokohama', 'gaji' => '¥2.4 - 3.2 Juta/Bulan', 'sertifikat' => 'Material Handling Certificate', 'gambar' => 'https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=800&q=80'],
            ['judul' => 'Program Lab Technician - R&D', 'lokasi' => 'Tokyo, Kanagawa', 'gaji' => '¥2.8 - 3.7 Juta/Bulan', 'sertifikat' => 'R&D Lab Technician Certificate', 'gambar' => 'https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=800&q=80'],
            ['judul' => 'Program Product Tester - Quality', 'lokasi' => 'Osaka, Tokyo', 'gaji' => '¥2.6 - 3.5 Juta/Bulan', 'sertifikat' => 'Product Testing Certificate', 'gambar' => 'https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=800&q=80'],
            
            // Healthcare & Caregiving (8 programs)
            ['judul' => 'Program Caregiver - Healthcare', 'lokasi' => 'Osaka, Kyoto, Fukuoka', 'gaji' => '¥2.4 - 3.2 Juta/Bulan', 'sertifikat' => 'Care Worker Certificate', 'gambar' => 'https://images.unsplash.com/photo-1631217314831-c6227db76b6e?auto=format&fit=crop&w=800&q=80'],
            ['judul' => 'Program Nurse Assistant - Hospital', 'lokasi' => 'Tokyo, Osaka, Yokohama', 'gaji' => '¥2.6 - 3.5 Juta/Bulan', 'sertifikat' => 'Nurse Assistant Certificate', 'gambar' => 'https://images.unsplash.com/photo-1631217314831-c6227db76b6e?auto=format&fit=crop&w=800&q=80'],
            ['judul' => 'Program Housekeeping - Medical', 'lokasi' => 'Tokyo, Osaka, Kyoto', 'gaji' => '¥2.2 - 2.9 Juta/Bulan', 'sertifikat' => 'Medical Housekeeping Certificate', 'gambar' => 'https://images.unsplash.com/photo-1631217314831-c6227db76b6e?auto=format&fit=crop&w=800&q=80'],
            ['judul' => 'Program Elderly Care - Facility', 'lokasi' => 'Osaka, Fukuoka, Sendai', 'gaji' => '¥2.4 - 3.1 Juta/Bulan', 'sertifikat' => 'Elderly Care Certificate', 'gambar' => 'https://images.unsplash.com/photo-1631217314831-c6227db76b6e?auto=format&fit=crop&w=800&q=80'],
            ['judul' => 'Program Rehabilitation Assistant', 'lokasi' => 'Tokyo, Osaka, Nagoya', 'gaji' => '¥2.5 - 3.3 Juta/Bulan', 'sertifikat' => 'Rehabilitation Assistant Certificate', 'gambar' => 'https://images.unsplash.com/photo-1631217314831-c6227db76b6e?auto=format&fit=crop&w=800&q=80'],
            ['judul' => 'Program Medical Equipment Operator', 'lokasi' => 'Tokyo, Osaka', 'gaji' => '¥2.7 - 3.5 Juta/Bulan', 'sertifikat' => 'Medical Equipment Certificate', 'gambar' => 'https://images.unsplash.com/photo-1631217314831-c6227db76b6e?auto=format&fit=crop&w=800&q=80'],
            ['judul' => 'Program Pharmacy Assistant', 'lokasi' => 'Tokyo, Osaka, Kyoto', 'gaji' => '¥2.5 - 3.3 Juta/Bulan', 'sertifikat' => 'Pharmacy Assistant Certificate', 'gambar' => 'https://images.unsplash.com/photo-1631217314831-c6227db76b6e?auto=format&fit=crop&w=800&q=80'],
            ['judul' => 'Program Health Care Worker', 'lokasi' => 'Osaka, Fukuoka, Sapporo', 'gaji' => '¥2.4 - 3.2 Juta/Bulan', 'sertifikat' => 'Health Care Worker Certificate', 'gambar' => 'https://images.unsplash.com/photo-1631217314831-c6227db76b6e?auto=format&fit=crop&w=800&q=80'],
            
            // Hospitality & Tourism (8 programs)
            ['judul' => 'Program Hotel Staff - Hospitality', 'lokasi' => 'Tokyo, Osaka, Kyoto', 'gaji' => '¥2.3 - 3.0 Juta/Bulan', 'sertifikat' => 'Hospitality Service Certificate', 'gambar' => 'https://images.unsplash.com/photo-1564501049412-61c2a3083791?auto=format&fit=crop&w=800&q=80'],
            ['judul' => 'Program Restaurant Staff - Service', 'lokasi' => 'Tokyo, Osaka, Fukuoka', 'gaji' => '¥2.3 - 3.1 Juta/Bulan', 'sertifikat' => 'Restaurant Service Certificate', 'gambar' => 'https://images.unsplash.com/photo-1564501049412-61c2a3083791?auto=format&fit=crop&w=800&q=80'],
            ['judul' => 'Program Front Desk - Hotel', 'lokasi' => 'Tokyo, Osaka, Yokohama', 'gaji' => '¥2.4 - 3.2 Juta/Bulan', 'sertifikat' => 'Front Desk Certificate', 'gambar' => 'https://images.unsplash.com/photo-1564501049412-61c2a3083791?auto=format&fit=crop&w=800&q=80'],
            ['judul' => 'Program Kitchen Staff - Culinary', 'lokasi' => 'Tokyo, Osaka, Kyoto', 'gaji' => '¥2.3 - 3.0 Juta/Bulan', 'sertifikat' => 'Culinary Certificate', 'gambar' => 'https://images.unsplash.com/photo-1564501049412-61c2a3083791?auto=format&fit=crop&w=800&q=80'],
            ['judul' => 'Program Housekeeping - Hotel', 'lokasi' => 'Tokyo, Osaka, Fukuoka', 'gaji' => '¥2.2 - 2.9 Juta/Bulan', 'sertifikat' => 'Hotel Housekeeping Certificate', 'gambar' => 'https://images.unsplash.com/photo-1564501049412-61c2a3083791?auto=format&fit=crop&w=800&q=80'],
            ['judul' => 'Program Tour Guide Assistant', 'lokasi' => 'Tokyo, Kyoto, Nara', 'gaji' => '¥2.4 - 3.2 Juta/Bulan', 'sertifikat' => 'Tour Guide Certificate', 'gambar' => 'https://images.unsplash.com/photo-1564501049412-61c2a3083791?auto=format&fit=crop&w=800&q=80'],
            ['judul' => 'Program Event Staff - Tourism', 'lokasi' => 'Tokyo, Osaka, Yokohama', 'gaji' => '¥2.3 - 3.1 Juta/Bulan', 'sertifikat' => 'Event Staff Certificate', 'gambar' => 'https://images.unsplash.com/photo-1564501049412-61c2a3083791?auto=format&fit=crop&w=800&q=80'],
            ['judul' => 'Program Ryokan Staff - Traditional', 'lokasi' => 'Kyoto, Hakone, Atami', 'gaji' => '¥2.3 - 3.0 Juta/Bulan', 'sertifikat' => 'Ryokan Service Certificate', 'gambar' => 'https://images.unsplash.com/photo-1564501049412-61c2a3083791?auto=format&fit=crop&w=800&q=80'],
            
            // Construction & Infrastructure (7 programs)
            ['judul' => 'Program Construction Worker', 'lokasi' => 'Tokyo, Osaka, Yokohama', 'gaji' => '¥2.8 - 3.8 Juta/Bulan', 'sertifikat' => 'Construction Skills Certificate', 'gambar' => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?auto=format&fit=crop&w=800&q=80'],
            ['judul' => 'Program Welder - Construction', 'lokasi' => 'Tokyo, Osaka, Kobe', 'gaji' => '¥2.9 - 3.9 Juta/Bulan', 'sertifikat' => 'Construction Welding Certificate', 'gambar' => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?auto=format&fit=crop&w=800&q=80'],
            ['judul' => 'Program Carpenter - Building', 'lokasi' => 'Tokyo, Osaka, Nagoya', 'gaji' => '¥2.8 - 3.7 Juta/Bulan', 'sertifikat' => 'Carpentry Certificate', 'gambar' => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?auto=format&fit=crop&w=800&q=80'],
            ['judul' => 'Program Concrete Worker', 'lokasi' => 'Tokyo, Osaka, Yokohama', 'gaji' => '¥2.7 - 3.6 Juta/Bulan', 'sertifikat' => 'Concrete Work Certificate', 'gambar' => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?auto=format&fit=crop&w=800&q=80'],
            ['judul' => 'Program Scaffolding Worker', 'lokasi' => 'Tokyo, Osaka, Kobe', 'gaji' => '¥2.8 - 3.7 Juta/Bulan', 'sertifikat' => 'Scaffolding Certificate', 'gambar' => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?auto=format&fit=crop&w=800&q=80'],
            ['judul' => 'Program Heavy Equipment Operator', 'lokasi' => 'Tokyo, Osaka, Yokohama', 'gaji' => '¥3.0 - 4.0 Juta/Bulan', 'sertifikat' => 'Heavy Equipment License', 'gambar' => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?auto=format&fit=crop&w=800&q=80'],
            ['judul' => 'Program Building Maintenance', 'lokasi' => 'Tokyo, Osaka, Nagoya', 'gaji' => '¥2.7 - 3.6 Juta/Bulan', 'sertifikat' => 'Building Maintenance Certificate', 'gambar' => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?auto=format&fit=crop&w=800&q=80'],
            
            // Agriculture & Fishery (4 programs)
            ['judul' => 'Program Agriculture Worker', 'lokasi' => 'Hokkaido, Aomori, Shizuoka', 'gaji' => '¥2.2 - 3.0 Juta/Bulan', 'sertifikat' => 'Agriculture Skills Certificate', 'gambar' => 'https://images.unsplash.com/photo-1500937386664-56d1dfef3854?auto=format&fit=crop&w=800&q=80'],
            ['judul' => 'Program Fishery Worker', 'lokasi' => 'Hokkaido, Aomori, Miyagi', 'gaji' => '¥2.3 - 3.1 Juta/Bulan', 'sertifikat' => 'Fishery Skills Certificate', 'gambar' => 'https://images.unsplash.com/photo-1500937386664-56d1dfef3854?auto=format&fit=crop&w=800&q=80'],
            ['judul' => 'Program Livestock Worker', 'lokasi' => 'Hokkaido, Aomori, Iwate', 'gaji' => '¥2.2 - 3.0 Juta/Bulan', 'sertifikat' => 'Livestock Management Certificate', 'gambar' => 'https://images.unsplash.com/photo-1500937386664-56d1dfef3854?auto=format&fit=crop&w=800&q=80'],
            ['judul' => 'Program Food Processing Worker', 'lokasi' => 'Hokkaido, Aomori, Shizuoka', 'gaji' => '¥2.3 - 3.1 Juta/Bulan', 'sertifikat' => 'Food Processing Certificate', 'gambar' => 'https://images.unsplash.com/photo-1500937386664-56d1dfef3854?auto=format&fit=crop&w=800&q=80'],
            
            // Food Service (3 programs)
            ['judul' => 'Program Food Service Worker', 'lokasi' => 'Tokyo, Osaka, Fukuoka', 'gaji' => '¥2.3 - 3.1 Juta/Bulan', 'sertifikat' => 'Food Service Certificate', 'gambar' => 'https://images.unsplash.com/photo-1555396273-367ea4eb4db5?auto=format&fit=crop&w=800&q=80'],
            ['judul' => 'Program Sushi Chef Assistant', 'lokasi' => 'Tokyo, Osaka, Kyoto', 'gaji' => '¥2.4 - 3.2 Juta/Bulan', 'sertifikat' => 'Sushi Preparation Certificate', 'gambar' => 'https://images.unsplash.com/photo-1555396273-367ea4eb4db5?auto=format&fit=crop&w=800&q=80'],
            ['judul' => 'Program Catering Staff', 'lokasi' => 'Tokyo, Osaka, Yokohama', 'gaji' => '¥2.3 - 3.0 Juta/Bulan', 'sertifikat' => 'Catering Service Certificate', 'gambar' => 'https://images.unsplash.com/photo-1555396273-367ea4eb4db5?auto=format&fit=crop&w=800&q=80'],
        ];
        
        // Generate descriptions for each program
        $descriptions = [
            'Program kerja terampil dengan gaji kompetitif dan benefit lengkap. Cocok untuk Anda yang ingin bekerja di industri ini dengan standar internasional.',
            'Kesempatan emas untuk bekerja di perusahaan terkemuka dengan pelatihan lengkap dan kesempatan pengembangan karir yang baik.',
            'Program profesional dengan dukungan penuh dari tim kami. Dapatkan pengalaman kerja yang berharga dan skill yang diakui internasional.',
            'Bergabunglah dengan ribuan alumni yang telah sukses. Program ini menawarkan gaji kompetitif dan lingkungan kerja yang aman dan nyaman.',
            'Peluang kerja dengan visa terjamin dan proses legal. Kami membantu Anda dari awal hingga berangkat ke Jepang dengan support penuh.',
        ];
        
        $urutan = 1;
        foreach ($basePrograms as $program) {
            $programs[] = [
                'judul' => $program['judul'],
                'gambar' => $program['gambar'],
                'deskripsi' => $descriptions[array_rand($descriptions)],
                'lokasi' => $program['lokasi'],
                'durasi' => '5 Tahun',
                'visa' => 'Tokutei Ginou',
                'gaji' => $program['gaji'],
                'sertifikat' => $program['sertifikat'],
                'urutan' => $urutan++,
                'status' => 'Publish',
            ];
        }
        
        DB::table('program_masa_depan')->insert($programs);
    }
}
