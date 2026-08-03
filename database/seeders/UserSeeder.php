<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@marketplace.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // User
        $users = [

            ['name'=>'Ahmad Fauzi','email'=>'ahmad@gmail.com'],
            ['name'=>'Budi Santoso','email'=>'budi@gmail.com'],
            ['name'=>'Citra Lestari','email'=>'citra@gmail.com'],
            ['name'=>'Dimas Saputra','email'=>'dimas@gmail.com'],
            ['name'=>'Eka Putri','email'=>'eka@gmail.com'],
            ['name'=>'Farhan Maulana','email'=>'farhan@gmail.com'],
            ['name'=>'Gita Permata','email'=>'gita@gmail.com'],
            ['name'=>'Hendra Wijaya','email'=>'hendra@gmail.com'],
            ['name'=>'Indah Sari','email'=>'indah@gmail.com'],
            ['name'=>'Joko Prasetyo','email'=>'joko@gmail.com'],
            ['name'=>'Kevin Setiawan','email'=>'kevin@gmail.com'],
            ['name'=>'Lina Marlina','email'=>'lina@gmail.com'],
            ['name'=>'Muhammad Rizki','email'=>'rizki@gmail.com'],
            ['name'=>'Nabila Putri','email'=>'nabila@gmail.com'],
            ['name'=>'Rafi Ramadhan','email'=>'rafi@gmail.com'],

        ];

        foreach ($users as $user) {

            User::create([

                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make('password'),
                'role' => 'user',

            ]);

        }
    }
}