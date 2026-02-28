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
        if (!Schema::hasTable('withdraw')) {
            Schema::create('withdraw', function (Blueprint $table) {
                $table->id('id_withdraw');
                $table->unsignedBigInteger('id_mitra');
                $table->decimal('jumlah', 15, 2);
                $table->string('bank', 50);
                $table->string('rekening', 50);
                $table->string('nama_rekening', 100);
                $table->enum('status', ['Pending', 'Diproses', 'Selesai', 'Ditolak'])->default('Pending');
                $table->datetime('tanggal');
                $table->text('catatan')->nullable();
                $table->timestamps();

                $table->index('status');
            });

            // Add foreign key separately using raw SQL
            \Illuminate\Support\Facades\DB::statement('ALTER TABLE `withdraw` ADD CONSTRAINT `withdraw_id_mitra_foreign` FOREIGN KEY (`id_mitra`) REFERENCES `mitra` (`id_mitra`) ON DELETE CASCADE');
        } else {
            // Table exists, check if foreign key exists
            $foreignKeys = \Illuminate\Support\Facades\DB::select("
                SELECT CONSTRAINT_NAME 
                FROM information_schema.KEY_COLUMN_USAGE 
                WHERE TABLE_SCHEMA = DATABASE() 
                AND TABLE_NAME = 'withdraw' 
                AND CONSTRAINT_NAME = 'withdraw_id_mitra_foreign'
            ");
            
            if (empty($foreignKeys)) {
                // Add foreign key if it doesn't exist
                \Illuminate\Support\Facades\DB::statement('ALTER TABLE `withdraw` ADD CONSTRAINT `withdraw_id_mitra_foreign` FOREIGN KEY (`id_mitra`) REFERENCES `mitra` (`id_mitra`) ON DELETE CASCADE');
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop foreign key first
        \Illuminate\Support\Facades\DB::statement('ALTER TABLE `withdraw` DROP FOREIGN KEY `withdraw_id_mitra_foreign`');
        Schema::dropIfExists('withdraw');
    }
};
