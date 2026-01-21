<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendaftaranLokerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendaftaran_loker', function (Blueprint $table) {
            $table->id('id_pendaftaran');
            $table->unsignedBigInteger('id_loker');
            $table->string('nama');
            $table->string('email');
            $table->string('telepon');
            $table->text('alamat')->nullable();
            $table->string('pendidikan_terakhir')->nullable();
            $table->text('pengalaman')->nullable();
            $table->string('cv_file')->nullable();
            $table->text('catatan')->nullable();
            $table->enum('status_pendaftaran', ['Baru', 'Dibaca', 'Diproses', 'Diterima', 'Ditolak'])->default('Baru');
            $table->datetime('tanggal_pendaftaran');
            $table->timestamps();

            $table->foreign('id_loker')->references('id_loker')->on('loker')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pendaftaran_loker');
    }
}
