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
        Schema::create('konfigurasi', function (Blueprint $table) {
            $table->id('id_konfigurasi');
            $table->string('namaweb')->nullable();
            $table->string('nama_singkat')->nullable();
            $table->string('singkatan')->nullable();
            $table->string('tagline')->nullable();
            $table->string('tagline2')->nullable();
            $table->text('tentang')->nullable();
            $table->string('website')->nullable();
            $table->string('email')->nullable();
            $table->string('email_cadangan')->nullable();
            $table->text('alamat')->nullable();
            $table->string('telepon')->nullable();
            $table->string('hp')->nullable();
            $table->string('fax')->nullable();
            $table->text('deskripsi')->nullable();
            $table->text('keywords')->nullable();
            $table->text('metatext')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->string('nama_facebook')->nullable();
            $table->string('nama_twitter')->nullable();
            $table->string('nama_instagram')->nullable();
            $table->text('google_map')->nullable();
            $table->text('text_bawah_peta')->nullable();
            $table->string('link_bawah_peta')->nullable();
            $table->text('cara_pesan')->nullable();
            $table->string('logo')->nullable();
            $table->string('icon')->nullable();
            $table->string('gambar')->nullable();
            $table->text('panduan_pembayaran')->nullable();
            $table->unsignedBigInteger('id_user')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('konfigurasi');
    }
};
