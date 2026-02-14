<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('loker', function (Blueprint $table) {
            // Add EN and JP columns
            if (!Schema::hasColumn('loker', 'judul_loker_en')) {
                $table->string('judul_loker_en')->nullable()->after('judul_loker');
                $table->string('judul_loker_jp')->nullable()->after('judul_loker_en');
            }
            if (!Schema::hasColumn('loker', 'deskripsi_singkat_en')) {
                $table->text('deskripsi_singkat_en')->nullable()->after('deskripsi_singkat');
                $table->text('deskripsi_singkat_jp')->nullable()->after('deskripsi_singkat_en');
            }
            if (!Schema::hasColumn('loker', 'isi_loker_en')) {
                $table->text('isi_loker_en')->nullable()->after('isi_loker');
                $table->text('isi_loker_jp')->nullable()->after('isi_loker_en');
            }
            if (!Schema::hasColumn('loker', 'posisi_en')) {
                $table->string('posisi_en')->nullable()->after('posisi');
                $table->string('posisi_jp')->nullable()->after('posisi_en');
            }
            if (!Schema::hasColumn('loker', 'lokasi_kerja_en')) {
                $table->string('lokasi_kerja_en')->nullable()->after('lokasi_kerja');
                $table->string('lokasi_kerja_jp')->nullable()->after('lokasi_kerja_en');
            }
            if (!Schema::hasColumn('loker', 'tipe_kerja_en')) {
                $table->string('tipe_kerja_en')->nullable()->after('tipe_kerja');
                $table->string('tipe_kerja_jp')->nullable()->after('tipe_kerja_en');
            }
            if (!Schema::hasColumn('loker', 'persyaratan_en')) {
                $table->text('persyaratan_en')->nullable()->after('persyaratan');
                $table->text('persyaratan_jp')->nullable()->after('persyaratan_en');
            }
            if (!Schema::hasColumn('loker', 'tanggung_jawab_en')) {
                $table->text('tanggung_jawab_en')->nullable()->after('tanggung_jawab');
                $table->text('tanggung_jawab_jp')->nullable()->after('tanggung_jawab_en');
            }
        });
    }

    public function down(): void
    {
        Schema::table('loker', function (Blueprint $table) {
            // Drop EN and JP columns
            if (Schema::hasColumn('loker', 'judul_loker_en')) {
                $table->dropColumn(['judul_loker_en', 'judul_loker_jp']);
            }
            if (Schema::hasColumn('loker', 'deskripsi_singkat_en')) {
                $table->dropColumn(['deskripsi_singkat_en', 'deskripsi_singkat_jp']);
            }
            if (Schema::hasColumn('loker', 'isi_loker_en')) {
                $table->dropColumn(['isi_loker_en', 'isi_loker_jp']);
            }
            if (Schema::hasColumn('loker', 'posisi_en')) {
                $table->dropColumn(['posisi_en', 'posisi_jp']);
            }
            if (Schema::hasColumn('loker', 'lokasi_kerja_en')) {
                $table->dropColumn(['lokasi_kerja_en', 'lokasi_kerja_jp']);
            }
            if (Schema::hasColumn('loker', 'tipe_kerja_en')) {
                $table->dropColumn(['tipe_kerja_en', 'tipe_kerja_jp']);
            }
            if (Schema::hasColumn('loker', 'persyaratan_en')) {
                $table->dropColumn(['persyaratan_en', 'persyaratan_jp']);
            }
            if (Schema::hasColumn('loker', 'tanggung_jawab_en')) {
                $table->dropColumn(['tanggung_jawab_en', 'tanggung_jawab_jp']);
            }
        });
    }
};
