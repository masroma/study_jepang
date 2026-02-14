<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ClearDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * This seeder will truncate all tables (except migrations and users)
     * to clear existing data before seeding new dummy data.
     */
    public function run(): void
    {
        // Disable foreign key checks (MySQL/MariaDB)
        if (DB::getDriverName() === 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        }

        // List of tables to truncate (excluding system tables)
        $tables = [
            'berita',
            'kategori',
            'galeri',
            'video',
            'konfigurasi',
            'program_masa_depan',
            'industri',
            'kisah_sukses',
            'hero_sliders',
            'loker',
            'pendaftaran_loker',
            'home_contents',
            'blog_posts',
        ];

        foreach ($tables as $table) {
            if (Schema::hasTable($table)) {
                try {
                    DB::table($table)->truncate();
                    $this->command->info("✓ Cleared table: {$table}");
                } catch (\Exception $e) {
                    // If truncate fails, try delete all
                    try {
                        DB::table($table)->delete();
                        $this->command->info("✓ Deleted all from table: {$table}");
                    } catch (\Exception $e2) {
                        $this->command->warn("✗ Failed to clear table: {$table} - {$e2->getMessage()}");
                    }
                }
            } else {
                $this->command->warn("⚠ Table does not exist: {$table}");
            }
        }

        // Re-enable foreign key checks (MySQL/MariaDB)
        if (DB::getDriverName() === 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }

        $this->command->info('✓ All data cleared successfully!');
    }
}
