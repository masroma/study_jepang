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
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->bigIncrements('id_post');
            $table->string('judul')->nullable();
            $table->string('slug')->unique()->nullable();
            $table->text('konten')->nullable();
            $table->text('deskripsi_singkat')->nullable();
            $table->string('kategori')->nullable(); // Tips & Trik, Panduan, Karier, Budaya, Lifestyle, Pendidikan
            $table->string('gambar')->nullable();
            $table->string('penulis')->nullable();
            $table->date('tanggal_publish')->nullable();
            $table->enum('status', ['draft', 'publish'])->default('draft');
            $table->integer('views')->default(0);
            $table->timestamps();
            $table->index('slug');
            $table->index('kategori');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_posts');
    }
};
