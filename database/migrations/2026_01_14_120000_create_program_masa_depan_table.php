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
        Schema::create('program_masa_depan', function (Blueprint $table) {
            $table->bigIncrements('id_program');
            $table->string('judul');
            $table->string('gambar')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('lokasi')->nullable();
            $table->string('durasi')->nullable();
            $table->string('visa')->nullable();
            $table->string('gaji')->nullable();
            $table->string('sertifikat')->nullable();
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
        Schema::dropIfExists('program_masa_depan');
    }
};
