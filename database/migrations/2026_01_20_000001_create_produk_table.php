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
        Schema::create('produk', function (Blueprint $table) {
            $table->bigIncrements('id_produk');
            $table->string('nama');
            $table->string('slug')->unique()->nullable();
            $table->string('kategori')->nullable(); // Hasil Pertanian, Seafood, Manufaktur, dll
            $table->text('deskripsi')->nullable();
            $table->text('spesifikasi')->nullable(); // JSON atau text untuk spesifikasi produk
            $table->string('gambar')->nullable();
            $table->string('moq')->nullable(); // Minimum Order Quantity
            $table->string('harga')->nullable();
            $table->string('asal')->nullable(); // Asal produk
            $table->string('sertifikasi')->nullable(); // Sertifikasi produk
            $table->string('kemasan')->nullable(); // Kemasan produk
            $table->integer('urutan')->default(0);
            $table->enum('status', ['Publish', 'Draft'])->default('Publish');
            $table->timestamps();
            $table->index('kategori');
            $table->index('status');
            $table->index('slug');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};
