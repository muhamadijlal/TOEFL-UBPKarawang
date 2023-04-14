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
            // [
            //     'nama' => 'user',
            //     'email' => 'user@gmail.com',
            //     'role' => 'mahasiswa',
            //     'password' => Hash::make('12345'),
            // ],
            [
                'nama' => 'admin',
                'email' => 'admin@gmail.com',
                'role' => 'admin',
                'password' => Hash::make('12345'),
            ]
        ];

        foreach($users as $user){
            User::create($user);
        }
    }
}
