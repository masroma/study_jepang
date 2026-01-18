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
        Schema::create('home_contents', function (Blueprint $table) {
            $table->id();
            $table->string('section'); // e.g., 'hero_title', 'hero_subtitle', 'button_text', 'slider', 'about', dll.
            $table->text('content')->nullable(); // teks, HTML, atau JSON
            $table->string('image')->nullable(); // path gambar
            $table->string('video')->nullable(); // path video
            $table->string('link')->nullable(); // link untuk button
            $table->boolean('active')->default(true);
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_contents');
    }
};
