<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('produk', function (Blueprint $table) {
            // Add EN and JP columns
            if (!Schema::hasColumn('produk', 'nama_en')) {
                $table->string('nama_en')->nullable()->after('nama');
                $table->string('nama_jp')->nullable()->after('nama_en');
            }
            if (!Schema::hasColumn('produk', 'kategori_en')) {
                $table->string('kategori_en')->nullable()->after('kategori');
                $table->string('kategori_jp')->nullable()->after('kategori_en');
            }
            if (!Schema::hasColumn('produk', 'deskripsi_en')) {
                $table->text('deskripsi_en')->nullable()->after('deskripsi');
                $table->text('deskripsi_jp')->nullable()->after('deskripsi_en');
            }
            if (!Schema::hasColumn('produk', 'spesifikasi_en')) {
                $table->text('spesifikasi_en')->nullable()->after('spesifikasi');
                $table->text('spesifikasi_jp')->nullable()->after('spesifikasi_en');
            }
            if (!Schema::hasColumn('produk', 'asal_en')) {
                $table->string('asal_en')->nullable()->after('asal');
                $table->string('asal_jp')->nullable()->after('asal_en');
            }
            if (!Schema::hasColumn('produk', 'sertifikasi_en')) {
                $table->string('sertifikasi_en')->nullable()->after('sertifikasi');
                $table->string('sertifikasi_jp')->nullable()->after('sertifikasi_en');
            }
            if (!Schema::hasColumn('produk', 'kemasan_en')) {
                $table->string('kemasan_en')->nullable()->after('kemasan');
                $table->string('kemasan_jp')->nullable()->after('kemasan_en');
            }
        });
    }

    public function down(): void
    {
        Schema::table('produk', function (Blueprint $table) {
            // Drop EN and JP columns
            if (Schema::hasColumn('produk', 'nama_en')) {
                $table->dropColumn(['nama_en', 'nama_jp']);
            }
            if (Schema::hasColumn('produk', 'kategori_en')) {
                $table->dropColumn(['kategori_en', 'kategori_jp']);
            }
            if (Schema::hasColumn('produk', 'deskripsi_en')) {
                $table->dropColumn(['deskripsi_en', 'deskripsi_jp']);
            }
            if (Schema::hasColumn('produk', 'spesifikasi_en')) {
                $table->dropColumn(['spesifikasi_en', 'spesifikasi_jp']);
            }
            if (Schema::hasColumn('produk', 'asal_en')) {
                $table->dropColumn(['asal_en', 'asal_jp']);
            }
            if (Schema::hasColumn('produk', 'sertifikasi_en')) {
                $table->dropColumn(['sertifikasi_en', 'sertifikasi_jp']);
            }
            if (Schema::hasColumn('produk', 'kemasan_en')) {
                $table->dropColumn(['kemasan_en', 'kemasan_jp']);
            }
        });
    }
};
