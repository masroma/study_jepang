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
        Schema::table('loker', function (Blueprint $table) {
            if (!Schema::hasColumn('loker', 'tipe_loker')) {
                $table->enum('tipe_loker', ['instruktur', 'luar_negeri'])->default('instruktur')->after('status_loker');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('loker', function (Blueprint $table) {
            if (Schema::hasColumn('loker', 'tipe_loker')) {
                $table->dropColumn('tipe_loker');
            }
        });
    }
};
