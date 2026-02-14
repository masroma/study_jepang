<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kisah_sukses', function (Blueprint $table) {
            // Add EN and JP columns
            if (!Schema::hasColumn('kisah_sukses', 'nama_en')) {
                $table->string('nama_en')->nullable()->after('nama');
                $table->string('nama_jp')->nullable()->after('nama_en');
            }
            if (!Schema::hasColumn('kisah_sukses', 'pekerjaan_en')) {
                $table->string('pekerjaan_en')->nullable()->after('pekerjaan');
                $table->string('pekerjaan_jp')->nullable()->after('pekerjaan_en');
            }
            if (!Schema::hasColumn('kisah_sukses', 'lokasi_en')) {
                $table->string('lokasi_en')->nullable()->after('lokasi');
                $table->string('lokasi_jp')->nullable()->after('lokasi_en');
            }
            if (!Schema::hasColumn('kisah_sukses', 'testimoni_en')) {
                $table->text('testimoni_en')->nullable()->after('testimoni');
                $table->text('testimoni_jp')->nullable()->after('testimoni_en');
            }
            if (!Schema::hasColumn('kisah_sukses', 'program_en')) {
                $table->string('program_en')->nullable()->after('program');
                $table->string('program_jp')->nullable()->after('program_en');
            }
        });
    }

    public function down(): void
    {
        Schema::table('kisah_sukses', function (Blueprint $table) {
            // Drop EN and JP columns
            if (Schema::hasColumn('kisah_sukses', 'nama_en')) {
                $table->dropColumn(['nama_en', 'nama_jp']);
            }
            if (Schema::hasColumn('kisah_sukses', 'pekerjaan_en')) {
                $table->dropColumn(['pekerjaan_en', 'pekerjaan_jp']);
            }
            if (Schema::hasColumn('kisah_sukses', 'lokasi_en')) {
                $table->dropColumn(['lokasi_en', 'lokasi_jp']);
            }
            if (Schema::hasColumn('kisah_sukses', 'testimoni_en')) {
                $table->dropColumn(['testimoni_en', 'testimoni_jp']);
            }
            if (Schema::hasColumn('kisah_sukses', 'program_en')) {
                $table->dropColumn(['program_en', 'program_jp']);
            }
        });
    }
};
