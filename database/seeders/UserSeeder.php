<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => strtoupper('superadmin'),
            'username' => 'superadmin',
            'email' => 'superadmin@gmail.com',
            'password' =>  Hash::make('asdqwe123'),
        ])->assignRole('Admin');
        // $user->assignRole('Admin');
    }
}
