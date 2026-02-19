<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'      => 'Luffy',
            'email'     => 'luffy@gmail.com',
            'password'  => Hash::make('luffy12345'),
            'role_id'   => 1
        ]);
        User::create([
            'name'      => 'Zoro',
            'email'     => 'zoro@gmail.com',
            'password'  => Hash::make('zoro12345'),
            'role_id'   => 2
        ]);
        User::create([
            'name'      => 'Shanks',
            'email'     => 'shanks@gmail.com',
            'password'  => Hash::make('shanks12345'),
            'role_id'   => 2
        ]);
        User::create([
            'name'      => 'Jiro',
            'email'     => 'jiro@gmail.com',
            'password'  => Hash::make('jiro12345'),
            'role_id'   => 2
        ]);
    }
}
