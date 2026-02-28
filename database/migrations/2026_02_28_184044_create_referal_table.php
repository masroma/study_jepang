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
        if (!Schema::hasTable('referal')) {
            Schema::create('referal', function (Blueprint $table) {
                $table->id('id_referal');
                $table->unsignedBigInteger('id_mitra');
                $table->string('nama', 100);
                $table->string('email', 100);
                $table->string('telepon', 20);
                $table->enum('program', ['Kerja', 'Pendidikan'])->default('Kerja');
                $table->text('catatan')->nullable();
                $table->enum('status', ['Pending', 'Diterima', 'Ditolak'])->default('Pending');
                $table->datetime('tanggal');
                $table->timestamps();

                $table->index('status');
            });

            // Add foreign key separately using raw SQL
            \Illuminate\Support\Facades\DB::statement('ALTER TABLE `referal` ADD CONSTRAINT `referal_id_mitra_foreign` FOREIGN KEY (`id_mitra`) REFERENCES `mitra` (`id_mitra`) ON DELETE CASCADE');
        } else {
            // Table exists, check if foreign key exists
            $foreignKeys = \Illuminate\Support\Facades\DB::select("
                SELECT CONSTRAINT_NAME 
                FROM information_schema.KEY_COLUMN_USAGE 
                WHERE TABLE_SCHEMA = DATABASE() 
                AND TABLE_NAME = 'referal' 
                AND CONSTRAINT_NAME = 'referal_id_mitra_foreign'
            ");
            
            if (empty($foreignKeys)) {
                // Add foreign key if it doesn't exist
                \Illuminate\Support\Facades\DB::statement('ALTER TABLE `referal` ADD CONSTRAINT `referal_id_mitra_foreign` FOREIGN KEY (`id_mitra`) REFERENCES `mitra` (`id_mitra`) ON DELETE CASCADE');
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop foreign key first
        \Illuminate\Support\Facades\DB::statement('ALTER TABLE `referal` DROP FOREIGN KEY `referal_id_mitra_foreign`');
        Schema::dropIfExists('referal');
    }
};
