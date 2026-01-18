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
    Schema::create('galeri', function (Blueprint $table) {
        $table->bigIncrements('id_galeri');   // sesuai controller
        $table->string('judul')->nullable();
        $table->string('gambar')->nullable();
        $table->string('jenis_galeri')->nullable(); // Homepage / Galeri / dll
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galeri');
    }
};
