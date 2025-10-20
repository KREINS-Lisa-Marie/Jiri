<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\Jiri;
use App\Models\Project;
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

        $user = User::factory()->create([
            'name' => 'Anika',
            'email' => 'anika@gmail.com',
            'password' => Hash::make('test'),
        ]);

        $user2 = User::factory()->create();

        Jiri::factory()->count(3)->create([
            'user_id' => 1,
        ]);

        Jiri::factory()->count(5)->create([
            'user_id' => 2,
        ]);

        Contact::factory()->count(3)->for($user)->create();
        Contact::factory()->count(3)->for($user2)->create();
        Project::factory()->count(3)->for($user)->create();
        Project::factory()->count(3)->for($user2)->create();
    }
}
