<?php

namespace Database\Seeders;

use App\Models\Jiri;
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

/*        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);*/

        User::factory()->create([
            'name' => 'Anika',
            'email' => 'anika@gmail.com',
            'password' => Hash::make('test'),
        ]);

        Jiri::factory()->count(3)->create([
            'user_id'=>1
        ]);

        Jiri::factory()->count(5)->create();
    }
}
