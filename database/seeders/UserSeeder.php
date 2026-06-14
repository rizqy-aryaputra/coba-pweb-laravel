<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@secondchance.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        $users = [

            ['Wonwu', 'wonwu@gmail.com'],
            ['Kimming', 'kimming@gmail.com'],
            ['Bonon', 'bonon@gmail.com'],
            ['Joshua', 'joshua@gmail.com'],
            ['Hoshi', 'hoshi@gmail.com'],

            ['Kai', 'kai@gmail.com'],
            ['Sehun', 'sehun@gmail.com'],
            ['Suho', 'suho@gmail.com'],
            ['Chanyeol', 'chanyeol@gmail.com'],
            ['D.O', 'do@gmail.com'],

        ];

        foreach ($users as $user) {

            User::create([
                'name' => $user[0],
                'email' => $user[1],
                'password' => Hash::make('password'),
                'role' => 'customer',
            ]);

        }
    }
}