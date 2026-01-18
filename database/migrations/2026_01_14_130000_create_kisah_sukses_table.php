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
        Schema::create('kisah_sukses', function (Blueprint $table) {
            $table->bigIncrements('id_kisah');
            $table->string('nama');
            $table->string('pekerjaan');
            $table->string('lokasi');
            $table->text('testimoni');
            $table->string('foto')->nullable();
            $table->string('program')->nullable(); // JLPT N3, Tokutei Ginou, Caregiver, Internship
            $table->integer('tahun')->nullable();
            $table->integer('rating')->default(5); // 1-5 stars
            $table->text('video_url')->nullable(); // untuk video testimoni
            $table->string('video_file')->nullable(); // untuk upload video file
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
        Schema::dropIfExists('kisah_sukses');
    }
};
