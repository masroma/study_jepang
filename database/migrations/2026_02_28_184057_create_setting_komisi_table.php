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
        if (!Schema::hasTable('setting_komisi')) {
            Schema::create('setting_komisi', function (Blueprint $table) {
                $table->id('id_setting');
                $table->enum('jenis', ['Kerja', 'Pendidikan']);
                $table->decimal('persentase_komisi', 5, 2)->nullable();
                $table->decimal('nominal_komisi', 15, 2)->nullable();
                $table->enum('tipe_komisi', ['Persentase', 'Nominal'])->default('Nominal');
                $table->enum('status', ['Aktif', 'Nonaktif'])->default('Aktif');
                $table->datetime('tanggal_update');
                $table->timestamps();

                $table->unique('jenis');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setting_komisi');
    }
};
