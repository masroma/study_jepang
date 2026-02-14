<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('berita', function (Blueprint $table) {
            // Add EN and JP columns if they don't exist
            if (!Schema::hasColumn('berita', 'judul_berita_en')) {
                $table->string('judul_berita_en')->nullable()->after('judul_berita');
                $table->string('judul_berita_jp')->nullable()->after('judul_berita_en');
            }
            if (!Schema::hasColumn('berita', 'isi_en')) {
                $table->text('isi_en')->nullable()->after('isi');
                $table->text('isi_jp')->nullable()->after('isi_en');
            }
            if (!Schema::hasColumn('berita', 'keywords_en')) {
                $table->text('keywords_en')->nullable()->after('keywords');
                $table->text('keywords_jp')->nullable()->after('keywords_en');
            }
        });
    }

    public function down(): void
    {
        Schema::table('berita', function (Blueprint $table) {
            // Drop EN and JP columns
            if (Schema::hasColumn('berita', 'judul_berita_en')) {
                $table->dropColumn(['judul_berita_en', 'judul_berita_jp']);
            }
            if (Schema::hasColumn('berita', 'isi_en')) {
                $table->dropColumn(['isi_en', 'isi_jp']);
            }
            if (Schema::hasColumn('berita', 'keywords_en')) {
                $table->dropColumn(['keywords_en', 'keywords_jp']);
            }
        });
    }
};
