<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('layanan', function (Blueprint $table) {
            // Add EN and JP columns
            if (!Schema::hasColumn('layanan', 'judul_en')) {
                $table->string('judul_en')->nullable()->after('judul');
                $table->string('judul_jp')->nullable()->after('judul_en');
            }
            if (!Schema::hasColumn('layanan', 'deskripsi_en')) {
                $table->text('deskripsi_en')->nullable()->after('deskripsi');
                $table->text('deskripsi_jp')->nullable()->after('deskripsi_en');
            }
            if (!Schema::hasColumn('layanan', 'fitur_en')) {
                $table->text('fitur_en')->nullable()->after('fitur');
                $table->text('fitur_jp')->nullable()->after('fitur_en');
            }
            if (!Schema::hasColumn('layanan', 'lokasi_en')) {
                $table->text('lokasi_en')->nullable()->after('lokasi');
                $table->text('lokasi_jp')->nullable()->after('lokasi_en');
            }
        });
    }

    public function down(): void
    {
        Schema::table('layanan', function (Blueprint $table) {
            // Drop EN and JP columns
            if (Schema::hasColumn('layanan', 'judul_en')) {
                $table->dropColumn(['judul_en', 'judul_jp']);
            }
            if (Schema::hasColumn('layanan', 'deskripsi_en')) {
                $table->dropColumn(['deskripsi_en', 'deskripsi_jp']);
            }
            if (Schema::hasColumn('layanan', 'fitur_en')) {
                $table->dropColumn(['fitur_en', 'fitur_jp']);
            }
            if (Schema::hasColumn('layanan', 'lokasi_en')) {
                $table->dropColumn(['lokasi_en', 'lokasi_jp']);
            }
        });
    }
};
