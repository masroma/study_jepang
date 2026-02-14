<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cek apakah admin sudah ada
        $existingAdmin = DB::table('users')
            ->where('username', 'admin')
            ->orWhere('email', 'admin@studyjepang.com')
            ->first();

        if (!$existingAdmin) {
            DB::table('users')->insert([
                'nama' => 'Administrator',
                'email' => 'admin@studyjepang.com',
                'username' => 'admin',
                'password' => sha1('admin123'), // Password: admin123
                'akses_level' => 'Admin',
                'kode_rahasia' => null,
                'gambar' => null,
                'tanggal' => now(),
            ]);

            $this->command->info('Admin account created successfully!');
            $this->command->info('Username: admin');
            $this->command->info('Password: admin123');
        } else {
            $this->command->warn('Admin account already exists!');
        }
    }
}
