<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'user',
                'email' => 'user@gmail.com',
                'nim' => '18416255201201',
                'phone' => '085154324133',
                'password' => Hash::make('12345'),
                'role' => 'mahasiswa'
            ],
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('12345'),
                'role' => 'admin'
            ]
        ];

        foreach($users as $user){
            User::create($user);
        }
    }
}
