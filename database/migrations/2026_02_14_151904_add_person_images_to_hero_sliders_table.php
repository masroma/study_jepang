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
        Schema::table('hero_sliders', function (Blueprint $table) {
            // Add person_images column if it doesn't exist
            if (!Schema::hasColumn('hero_sliders', 'person_images')) {
                $table->json('person_images')->nullable()->after('video_link');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hero_sliders', function (Blueprint $table) {
            // Drop person_images column if it exists
            if (Schema::hasColumn('hero_sliders', 'person_images')) {
                $table->dropColumn('person_images');
            }
        });
    }
};
