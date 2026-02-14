<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Clear all existing data first
        $this->command->info('Clearing existing data...');
        $this->call([
            ClearDataSeeder::class,
        ]);

        // Seed all tables with dummy data
        $this->command->info('Seeding database with dummy data...');
        $this->call([
            AdminSeeder::class,
            KonfigurasiSeeder::class,
            KategoriSeeder::class,
            BeritaSeeder::class,
            GaleriSeeder::class,
            VideoSeeder::class,
            ProgramMasaDepanSeeder::class,
            IndustriSeeder::class,
            KisahSuksesSeeder::class,
            HeroSliderSeeder::class,
            LokerSeeder::class,
        ]);

        // Only seed blog_posts if table exists
        if (Schema::hasTable('blog_posts')) {
            $this->call([BlogPostSeeder::class]);
        }

        $this->command->info('Database seeding completed successfully!');
    }
}
