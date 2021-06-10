<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Yoshi',
                'username' => 'yoshi',
                'password' => Hash::make('yoshi2001'),
            ],
            [
                'name' => 'Budi',
                'username' => 'budi',
                'password' => Hash::make('budi2001'),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
