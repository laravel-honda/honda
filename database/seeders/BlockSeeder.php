<?php

namespace Database\Seeders;

use App\Models\Block;
use App\Models\User;
use Illuminate\Database\Seeder;

class BlockSeeder extends Seeder
{
    public function run(): void
    {
        Block::factory()->count(100)->create([
            'user_id' => User::first(),
        ]);
    }
}
