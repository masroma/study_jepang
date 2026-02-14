<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('konfigurasi', function (Blueprint $table) {
            if (!Schema::hasColumn('konfigurasi', 'whatsapp')) {
                $table->string('whatsapp')->nullable()->after('hp');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('konfigurasi', function (Blueprint $table) {
            if (Schema::hasColumn('konfigurasi', 'whatsapp')) {
                $table->dropColumn('whatsapp');
            }
        });
    }
};
