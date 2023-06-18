<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Account;
use App\Models\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run($account = null)
    {

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
    }
}
