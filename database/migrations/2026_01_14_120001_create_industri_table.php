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
        Schema::create('industri', function (Blueprint $table) {
            $table->bigIncrements('id_industri');
            $table->string('nama');
            $table->string('sub_nama')->nullable();
            $table->string('gambar')->nullable();
            $table->text('deskripsi')->nullable();
            $table->integer('urutan')->default(0);
            $table->enum('status', ['Publish', 'Draft'])->default('Publish');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('industri');
    }
};
