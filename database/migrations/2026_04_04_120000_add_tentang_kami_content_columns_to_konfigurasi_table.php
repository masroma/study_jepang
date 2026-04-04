<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Kolom untuk halaman Tentang Kami (admin v2) — aman jika sudah ada di DB produksi.
     */
    public function up(): void
    {
        Schema::table('konfigurasi', function (Blueprint $table) {
            if (!Schema::hasColumn('konfigurasi', 'visi')) {
                $table->text('visi')->nullable();
            }
            if (!Schema::hasColumn('konfigurasi', 'misi')) {
                $table->text('misi')->nullable();
            }
            if (!Schema::hasColumn('konfigurasi', 'sejarah')) {
                $table->text('sejarah')->nullable();
            }
            if (!Schema::hasColumn('konfigurasi', 'nilai_perusahaan')) {
                $table->text('nilai_perusahaan')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('konfigurasi', function (Blueprint $table) {
            if (Schema::hasColumn('konfigurasi', 'nilai_perusahaan')) {
                $table->dropColumn('nilai_perusahaan');
            }
            if (Schema::hasColumn('konfigurasi', 'sejarah')) {
                $table->dropColumn('sejarah');
            }
            if (Schema::hasColumn('konfigurasi', 'misi')) {
                $table->dropColumn('misi');
            }
            if (Schema::hasColumn('konfigurasi', 'visi')) {
                $table->dropColumn('visi');
            }
        });
    }
};
