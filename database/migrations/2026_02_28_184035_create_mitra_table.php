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
        if (!Schema::hasTable('mitra')) {
            Schema::create('mitra', function (Blueprint $table) {
                $table->id('id_mitra');
                $table->integer('id_user');
                $table->string('kode_referal', 50)->unique();
                $table->decimal('saldo', 15, 2)->default(0);
                $table->enum('status', ['Aktif', 'Nonaktif'])->default('Aktif');
                $table->datetime('tanggal_daftar');
                $table->timestamps();

                $table->index('kode_referal');
            });

            // Add foreign key separately using raw SQL to avoid type mismatch
            \Illuminate\Support\Facades\DB::statement('ALTER TABLE `mitra` ADD CONSTRAINT `mitra_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE');
        } else {
            // Table exists, check and fix column type if needed
            $columnInfo = \Illuminate\Support\Facades\DB::select("
                SELECT DATA_TYPE, COLUMN_TYPE 
                FROM information_schema.COLUMNS 
                WHERE TABLE_SCHEMA = DATABASE() 
                AND TABLE_NAME = 'mitra' 
                AND COLUMN_NAME = 'id_user'
            ");
            
            if (!empty($columnInfo) && (strpos($columnInfo[0]->COLUMN_TYPE, 'bigint') !== false || strpos($columnInfo[0]->COLUMN_TYPE, 'unsigned') !== false)) {
                // Alter column type to match users table (int)
                \Illuminate\Support\Facades\DB::statement('ALTER TABLE `mitra` MODIFY COLUMN `id_user` INT NOT NULL');
            }
            
            // Check if foreign key exists
            $foreignKeys = \Illuminate\Support\Facades\DB::select("
                SELECT CONSTRAINT_NAME 
                FROM information_schema.KEY_COLUMN_USAGE 
                WHERE TABLE_SCHEMA = DATABASE() 
                AND TABLE_NAME = 'mitra' 
                AND CONSTRAINT_NAME = 'mitra_id_user_foreign'
            ");
            
            if (empty($foreignKeys)) {
                // Add foreign key if it doesn't exist
                \Illuminate\Support\Facades\DB::statement('ALTER TABLE `mitra` ADD CONSTRAINT `mitra_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE');
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop foreign key first
        \Illuminate\Support\Facades\DB::statement('ALTER TABLE `mitra` DROP FOREIGN KEY `mitra_id_user_foreign`');
        Schema::dropIfExists('mitra');
    }
};
