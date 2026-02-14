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
        Schema::create('layanan', function (Blueprint $table) {
            $table->bigIncrements('id_layanan');
            $table->string('judul');
            $table->string('slug')->unique()->nullable();
            $table->string('icon')->nullable(); // Icon atau emoji
            $table->text('deskripsi')->nullable();
            $table->text('fitur')->nullable(); // JSON atau text untuk daftar fitur
            $table->text('lokasi')->nullable(); // Untuk layanan seperti warehousing
            $table->string('gambar')->nullable();
            $table->integer('urutan')->default(0);
            $table->enum('status', ['Publish', 'Draft'])->default('Publish');
            $table->timestamps();
            $table->index('status');
            $table->index('slug');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layanan');
    }
};
