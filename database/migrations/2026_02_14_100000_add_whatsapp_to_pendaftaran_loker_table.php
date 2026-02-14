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
        Schema::table('pendaftaran_loker', function (Blueprint $table) {
            if (!Schema::hasColumn('pendaftaran_loker', 'whatsapp')) {
                $table->string('whatsapp')->nullable()->after('telepon');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pendaftaran_loker', function (Blueprint $table) {
            if (Schema::hasColumn('pendaftaran_loker', 'whatsapp')) {
                $table->dropColumn('whatsapp');
            }
        });
    }
};
