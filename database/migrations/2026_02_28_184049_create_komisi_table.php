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
        Schema::create('komisi', function (Blueprint $table) {
            $table->id('id_komisi');
            $table->unsignedBigInteger('id_mitra');
            $table->unsignedBigInteger('id_referal');
            $table->decimal('jumlah_komisi', 15, 2);
            $table->enum('status', ['Pending', 'Paid'])->default('Pending');
            $table->datetime('tanggal');
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('id_mitra')->references('id_mitra')->on('mitra')->onDelete('cascade');
            $table->foreign('id_referal')->references('id_referal')->on('referal')->onDelete('cascade');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('komisi');
    }
};
