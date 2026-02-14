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
        Schema::create('hero_sliders', function (Blueprint $table) {
            $table->bigIncrements('id_hero');
            $table->string('title_id')->nullable();
            $table->string('title_en')->nullable();
            $table->string('title_jp')->nullable();
            $table->string('subtitle_id')->nullable();
            $table->string('subtitle_en')->nullable();
            $table->string('subtitle_jp')->nullable();
            $table->string('country_id')->nullable();
            $table->string('country_en')->nullable();
            $table->string('country_jp')->nullable();
            $table->text('description_id')->nullable();
            $table->text('description_en')->nullable();
            $table->text('description_jp')->nullable();
            $table->string('background_image')->nullable();
            $table->string('person_image')->nullable();
            $table->string('button_text_id')->nullable();
            $table->string('button_text_en')->nullable();
            $table->string('button_text_jp')->nullable();
            $table->string('button_link')->nullable();
            $table->string('video_link')->nullable();
            $table->json('person_images')->nullable(); // Array of person image URLs
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
        Schema::dropIfExists('hero_sliders');
    }
};
