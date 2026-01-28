<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserDatabaseSeeder extends Seeder
{
    
    public function run(): void
    {
        User::firstOrCreate([
            'name' => 'kal',
            'email' => 'abc@gmail.com',
            'password' => Hash::make('&*hgf54')
        ]);
    }
}
