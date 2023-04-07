<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

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
                'name' => 'user',
                'email' => 'user@gmail.com',
                'nim' => '18416255201201',
                'password' => Hash::make('12345'),
                'role' => 'mahasiswa'
            ],
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'nim' => '000000000000000',
                'role' => 'admin',
                'password' => Hash::make('12345'),
            ]
        ];

        foreach($users as $user){
            User::create($user);
        }
    }
}
