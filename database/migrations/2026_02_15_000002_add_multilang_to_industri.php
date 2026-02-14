<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('industri', function (Blueprint $table) {
            // Add EN and JP columns
            if (!Schema::hasColumn('industri', 'nama_en')) {
                $table->string('nama_en')->nullable()->after('nama');
                $table->string('nama_jp')->nullable()->after('nama_en');
            }
            if (!Schema::hasColumn('industri', 'sub_nama_en')) {
                $table->string('sub_nama_en')->nullable()->after('sub_nama');
                $table->string('sub_nama_jp')->nullable()->after('sub_nama_en');
            }
            if (!Schema::hasColumn('industri', 'deskripsi_en')) {
                $table->text('deskripsi_en')->nullable()->after('deskripsi');
                $table->text('deskripsi_jp')->nullable()->after('deskripsi_en');
            }
        });
    }

    public function down(): void
    {
        Schema::table('industri', function (Blueprint $table) {
            // Drop EN and JP columns
            if (Schema::hasColumn('industri', 'nama_en')) {
                $table->dropColumn(['nama_en', 'nama_jp']);
            }
            if (Schema::hasColumn('industri', 'sub_nama_en')) {
                $table->dropColumn(['sub_nama_en', 'sub_nama_jp']);
            }
            if (Schema::hasColumn('industri', 'deskripsi_en')) {
                $table->dropColumn(['deskripsi_en', 'deskripsi_jp']);
            }
        });
    }
};
