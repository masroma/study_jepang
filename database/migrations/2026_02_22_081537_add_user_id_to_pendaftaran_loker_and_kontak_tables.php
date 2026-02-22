<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Tambah user_id ke tabel pendaftaran_loker
        if (Schema::hasTable('pendaftaran_loker') && !Schema::hasColumn('pendaftaran_loker', 'id_user')) {
            Schema::table('pendaftaran_loker', function (Blueprint $table) {
                $table->integer('id_user')->nullable()->after('id_pendaftaran');
            });
            
            // Add foreign key separately using raw SQL to avoid type mismatch
            DB::statement('ALTER TABLE `pendaftaran_loker` ADD CONSTRAINT `pendaftaran_loker_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE SET NULL');
        }

        // Tambah user_id ke tabel kontak
        if (Schema::hasTable('kontak') && !Schema::hasColumn('kontak', 'id_user')) {
            Schema::table('kontak', function (Blueprint $table) {
                $table->integer('id_user')->nullable()->after('id_kontak');
            });
            
            // Add foreign key separately using raw SQL to avoid type mismatch
            DB::statement('ALTER TABLE `kontak` ADD CONSTRAINT `kontak_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE SET NULL');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Hapus user_id dari tabel kontak
        if (Schema::hasTable('kontak') && Schema::hasColumn('kontak', 'id_user')) {
            Schema::table('kontak', function (Blueprint $table) {
                $table->dropForeign(['id_user']);
                $table->dropColumn('id_user');
            });
        }

        // Hapus user_id dari tabel pendaftaran_loker
        if (Schema::hasTable('pendaftaran_loker') && Schema::hasColumn('pendaftaran_loker', 'id_user')) {
            Schema::table('pendaftaran_loker', function (Blueprint $table) {
                $table->dropForeign(['id_user']);
                $table->dropColumn('id_user');
            });
        }
    }
};
