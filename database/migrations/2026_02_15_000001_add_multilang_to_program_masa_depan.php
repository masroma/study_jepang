<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('program_masa_depan', function (Blueprint $table) {
            // Add EN and JP columns (keep existing columns as _id for backward compatibility)
            if (!Schema::hasColumn('program_masa_depan', 'judul_en')) {
                $table->string('judul_en')->nullable()->after('judul');
                $table->string('judul_jp')->nullable()->after('judul_en');
            }
            if (!Schema::hasColumn('program_masa_depan', 'deskripsi_en')) {
                $table->text('deskripsi_en')->nullable()->after('deskripsi');
                $table->text('deskripsi_jp')->nullable()->after('deskripsi_en');
            }
            if (!Schema::hasColumn('program_masa_depan', 'lokasi_en')) {
                $table->string('lokasi_en')->nullable()->after('lokasi');
                $table->string('lokasi_jp')->nullable()->after('lokasi_en');
            }
            if (!Schema::hasColumn('program_masa_depan', 'durasi_en')) {
                $table->string('durasi_en')->nullable()->after('durasi');
                $table->string('durasi_jp')->nullable()->after('durasi_en');
            }
            if (!Schema::hasColumn('program_masa_depan', 'visa_en')) {
                $table->string('visa_en')->nullable()->after('visa');
                $table->string('visa_jp')->nullable()->after('visa_en');
            }
            if (!Schema::hasColumn('program_masa_depan', 'gaji_en')) {
                $table->string('gaji_en')->nullable()->after('gaji');
                $table->string('gaji_jp')->nullable()->after('gaji_en');
            }
            if (!Schema::hasColumn('program_masa_depan', 'sertifikat_en')) {
                $table->string('sertifikat_en')->nullable()->after('sertifikat');
                $table->string('sertifikat_jp')->nullable()->after('sertifikat_en');
            }
        });
    }

    public function down(): void
    {
        Schema::table('program_masa_depan', function (Blueprint $table) {
            // Drop EN and JP columns
            if (Schema::hasColumn('program_masa_depan', 'judul_en')) {
                $table->dropColumn(['judul_en', 'judul_jp']);
            }
            if (Schema::hasColumn('program_masa_depan', 'deskripsi_en')) {
                $table->dropColumn(['deskripsi_en', 'deskripsi_jp']);
            }
            if (Schema::hasColumn('program_masa_depan', 'lokasi_en')) {
                $table->dropColumn(['lokasi_en', 'lokasi_jp']);
            }
            if (Schema::hasColumn('program_masa_depan', 'durasi_en')) {
                $table->dropColumn(['durasi_en', 'durasi_jp']);
            }
            if (Schema::hasColumn('program_masa_depan', 'visa_en')) {
                $table->dropColumn(['visa_en', 'visa_jp']);
            }
            if (Schema::hasColumn('program_masa_depan', 'gaji_en')) {
                $table->dropColumn(['gaji_en', 'gaji_jp']);
            }
            if (Schema::hasColumn('program_masa_depan', 'sertifikat_en')) {
                $table->dropColumn(['sertifikat_en', 'sertifikat_jp']);
            }
        });
    }
};
