<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

       User::create([
            'name' => 'Admin Quantum',
            'email' => 'admin@quantum.com',
            'role' => 'admin',
            'password' => hash::make('password123'),
            'remember_token' => Str::random(10),
        ]);

        // Siswa
        for ($i = 1; $i <= 5; $i++) {
            User::create([
                'name' => "Siswa {$i}",
                'email' => "siswa{$i}@mail.com",
                'role' => 'siswa',
                'password' => Hash::make('password123'),
                'remember_token' => Str::random(10),
            ]);
        }

        
    }
}
