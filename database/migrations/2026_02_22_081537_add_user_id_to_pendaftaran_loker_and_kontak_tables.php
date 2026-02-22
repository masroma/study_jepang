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
        // Tambah user_id ke tabel pendaftaran_loker
        if (Schema::hasTable('pendaftaran_loker') && !Schema::hasColumn('pendaftaran_loker', 'id_user')) {
            Schema::table('pendaftaran_loker', function (Blueprint $table) {
                $table->unsignedBigInteger('id_user')->nullable()->after('id_pendaftaran');
                $table->foreign('id_user')->references('id_user')->on('users')->onDelete('set null');
            });
        }

        // Tambah user_id ke tabel kontak
        if (Schema::hasTable('kontak') && !Schema::hasColumn('kontak', 'id_user')) {
            Schema::table('kontak', function (Blueprint $table) {
                $table->unsignedBigInteger('id_user')->nullable()->after('id_kontak');
                $table->foreign('id_user')->references('id_user')->on('users')->onDelete('set null');
            });
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
