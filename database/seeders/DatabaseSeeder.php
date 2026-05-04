<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
<<<<<<< HEAD
            'role' => 'admin',
=======
>>>>>>> 242cfb05772f2d21cfdc1a1aa710c56c1a596536
            'password' => Hash::make('11111111'),
        ]);
    }
}
