<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Contact;
use App\Models\Organization;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\RolesSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $account = Account::create(['name' => 'Dental CRM']);

        $this->call([
            RolesSeeder::class
        ]);
        // $this->call([
        //     UserSeeder::class, false, $account
        // ]);
        $users = [
            [
                'first_name' => 'admin',
                'last_name' => 'super',
                'email' => 'admin@dentalcrm.com',
                'password' => 'secret',
                'owner' => true,
                'role' => 'admin',
            ],
            [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'doctor@dentalcrm.com',
                'password' => 'password',
                'owner' => false,
                'role' => 'doctor',
            ],
            [
                'first_name' => 'salma',
                'last_name' => 'Hayek',
                'email' => 'receptionist@dentalcrm.com',
                'password' => 'password',
                'owner' => false,
                'role' => 'standard',
            ]
        ];

        foreach($users as $user) {
            $created_user = User::create([
                'account_id' => $account->id,
                'first_name' => $user['first_name'],
                'last_name' => $user['last_name'],
                'email' => $user['email'],
                'password' => Hash::make($user['password']),
                'owner' => $user['owner'],
            ]);

            $created_user->assignRole($user['role']);
        }
        //User::factory(5)->create(['account_id' => $account->id]);

        $organizations = Organization::factory(100)
            ->create(['account_id' => $account->id]);

        Contact::factory(100)
            ->create(['account_id' => $account->id])
            ->each(function ($contact) use ($organizations) {
                $contact->update(['organization_id' => $organizations->random()->id]);
            });
    }
}
