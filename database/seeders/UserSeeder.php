<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'              => 'Félix Dorn',
            'email'             => 'felixdorn@protonmail.com',
            'password'          => bcrypt('password'),
            'email_verified_at' => now(),
        ]);
    }
}
