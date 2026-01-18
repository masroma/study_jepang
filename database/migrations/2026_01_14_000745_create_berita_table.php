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
    Schema::create('berita', function (Blueprint $table) {
        $table->bigIncrements('id_berita');        // primary key
        $table->string('judul')->nullable();
        $table->text('isi')->nullable();
        $table->string('jenis_berita')->nullable();   // Layanan / Berita
        $table->string('status_berita')->nullable();  // Publish / Draft
        $table->integer('urutan')->default(0);
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berita');
    }
};
