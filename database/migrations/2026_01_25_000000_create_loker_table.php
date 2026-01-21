<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLokerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loker', function (Blueprint $table) {
            $table->id('id_loker');
            $table->string('judul_loker');
            $table->string('slug_loker')->unique();
            $table->text('deskripsi_singkat')->nullable();
            $table->text('isi_loker');
            $table->string('posisi');
            $table->string('lokasi_kerja')->nullable();
            $table->string('tipe_kerja')->nullable(); // Full-time, Part-time, Contract
            $table->text('persyaratan')->nullable();
            $table->text('tanggung_jawab')->nullable();
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->enum('status_loker', ['Publish', 'Draft', 'Tutup'])->default('Publish');
            $table->string('gambar')->nullable();
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loker');
    }
}
