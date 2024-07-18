<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    
    public function run(): void
    {
        User::create([
            'name' =>'Manager',
            'role_id' => 1,
            'email'=>'manage@kroxus.uz',
            'password' => Hash::make('password'),

        ]);
        User::create([
            'name' =>'Client',
            'role_id' => 2,
            'email'=>'client@kroxus.uz',
            'password' => Hash::make('password'),

        ]);
    }
}
