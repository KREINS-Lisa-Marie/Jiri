<?php

namespace Database\Seeders;

use App\Enums\ContactRoles;
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

/*        Jiri::factory()->count(3)->create([
            'user_id' => 1,
        ]);

        Jiri::factory()->count(5)->create([
            'user_id' => 2,
        ]);*/

        $contacts_user = Contact::factory()->count(3)->for($user)->create();
        $projects_user = Project::factory()->count(3)->for($user)->create();

        $contacts_user2=  Contact::factory()->count(3)->for($user2)->create();
        $projects_user2 = Project::factory()->count(3)->for($user2)->create();



        //Créer des jiris pour user
        $jiris_user = Jiri::factory()
            ->count(5)
            ->for($user)
            ->hasAttached($contacts_user, function () {
                    return [
                        'role' => rand(0, 1)
                            ? ContactRoles::Evaluators->value
                            : ContactRoles::Evaluated->value
                    ];
                }
            )
            ->hasAttached($projects_user)
            ->create();

        // Step 2: After creation, handle homework attachment for 'Evaluated' contacts
        foreach ($jiris_user as $jiri) {
            // Step 2.1: Get contacts with the 'Evaluated' role
            $evaluatedContacts = $jiri->contacts()
                ->wherePivot('role', ContactRoles::Evaluated->value)
                ->get();

            // Step 2.2: Get all homework IDs for the current Jiri
            $homeworkIds = $jiri->homeworks()->pluck('id');

            // Step 2.3: Attach each homework to each evaluated contact
            foreach ($evaluatedContacts as $contact) {
                $contact->homeworks()->attach($homeworkIds);
            }
        }


        //Créer des jiris pour user2
        $jiris_user2 = Jiri::factory()
            ->count(5)
            ->for($user2)
            ->hasAttached($contacts_user2, function () {
                return [
                    'role' => rand(0, 1)
                        ? ContactRoles::Evaluators->value
                        : ContactRoles::Evaluated->value
                ];
            }
            )
            ->hasAttached($projects_user2)
            ->create();

        // Step 2: After creation, handle homework attachment for 'Evaluated' contacts
        foreach ($jiris_user2 as $jiri) {
            // Step 2.1: Get contacts with the 'Evaluated' role
            $evaluatedContacts2 = $jiri->contacts()
                ->wherePivot('role', ContactRoles::Evaluated->value)
                ->get();

            // Step 2.2: Get all homework IDs for the current Jiri
            $homeworkIds2 = $jiri->homeworks()->pluck('id');

            // Step 2.3: Attach each homework to each evaluated contact
            foreach ($evaluatedContacts2 as $contact2) {
                $contact2->homeworks()->attach($homeworkIds2);
            }
        }
    }
}
