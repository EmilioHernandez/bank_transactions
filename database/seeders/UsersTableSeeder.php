<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        User::factory()->create([
            'name' => 'Emilio Hernández',
            'email' => 'emilio25informatic@gmail.com',
        ]);
    }
}
