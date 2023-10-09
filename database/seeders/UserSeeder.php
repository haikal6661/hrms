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

        User::create([
            'name' => strtoupper('haikal'),
            'username' => 'haikal',
            'email' => 'haikal@yopmail.com',
            'password' =>  Hash::make('asdqwe123'),
        ])->assignRole('User');

        User::create([
            'name' => strtoupper('naim'),
            'username' => 'naim',
            'email' => 'naim@yopmail.com',
            'password' =>  Hash::make('asdqwe123'),
        ])->assignRole('User');

        User::create([
            'name' => strtoupper('aqil'),
            'username' => 'aqil',
            'email' => 'aqil@yopmail.com',
            'password' =>  Hash::make('asdqwe123'),
        ])->assignRole('User');

        User::create([
            'name' => strtoupper('helmi'),
            'username' => 'helmi',
            'email' => 'helmi@yopmail.com',
            'password' =>  Hash::make('asdqwe123'),
        ])->assignRole('User');

        User::create([
            'name' => strtoupper('faris'),
            'username' => 'faris',
            'email' => 'faris@yopmail.com',
            'password' =>  Hash::make('asdqwe123'),
        ])->assignRole('User');

        User::create([
            'name' => strtoupper('idlan'),
            'username' => 'idlan',
            'email' => 'idlan@yopmail.com',
            'password' =>  Hash::make('asdqwe123'),
        ])->assignRole('User');

        User::create([
            'name' => strtoupper('wan'),
            'username' => 'wan',
            'email' => 'wan@yopmail.com',
            'password' =>  Hash::make('asdqwe123'),
        ])->assignRole('User');

        User::create([
            'name' => strtoupper('syamimi'),
            'username' => 'syamimi',
            'email' => 'syamimi@yopmail.com',
            'password' =>  Hash::make('asdqwe123'),
        ])->assignRole('User');

        User::create([
            'name' => strtoupper('aishah'),
            'username' => 'aishah',
            'email' => 'aishah@yopmail.com',
            'password' =>  Hash::make('asdqwe123'),
        ])->assignRole('User');

        User::create([
            'name' => strtoupper('suherman'),
            'username' => 'suherman',
            'email' => 'suherman@yopmail.com',
            'password' =>  Hash::make('asdqwe123'),
        ])->assignRole('HOD');
    }
}
