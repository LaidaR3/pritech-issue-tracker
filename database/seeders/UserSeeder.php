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
            'name' => 'John Smith',
            'email' => 'john@example.com',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'Laida Rusinovci',
            'email' => 'laida@gmail.com',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'Adea Mustafa',
            'email' => 'adea@gmail.com',
            'password' => Hash::make('password'),
        ]);
    }
}