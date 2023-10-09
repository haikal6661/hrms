<?php

namespace Database\Seeders;

use App\Models\Staff;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Staff::create([
            'user_id' => 2,
            'fullname' => 'Haikal Nur Ariff',
            'email' => 'haikal@yopmail.com',
            'ic_no' => '941213095053',
            'address' => 'Putra Perdana,Puchong',
            'phone_no' => '0174177192',
            'position_id' => 8,
            'department_id' => 4,
            'is_active' => 1,
        ]);

        Staff::create([
            'user_id' => 3,
            'fullname' => 'Naim Hariz',
            'email' => 'naim@yopmail.com',
            'address' => 'Putra Perdana,Puchong',
            'position_id' => 8,
            'department_id' => 4,
            'is_active' => 1,
        ]);

        Staff::create([
            'user_id' => 4,
            'fullname' => 'Aqil',
            'email' => 'aqil@yopmail.com',
            'address' => 'Putra Perdana,Puchong',
            'position_id' => 8,
            'department_id' => 4,
            'is_active' => 1,
        ]);

        Staff::create([
            'user_id' => 5,
            'fullname' => 'Helmi Hasnei',
            'email' => 'helmi@yopmail.com',
            'address' => 'Putra Perdana,Puchong',
            'position_id' => 12,
            'department_id' => 4,
            'is_active' => 1,
        ]);

        Staff::create([
            'user_id' => 6,
            'fullname' => 'Faris Haikal',
            'email' => 'faris@yopmail.com',
            'address' => 'Banting,Selangor',
            'position_id' => 9,
            'department_id' => 5,
            'is_active' => 1,
        ]);

        Staff::create([
            'user_id' => 7,
            'fullname' => 'Idlan',
            'email' => 'idlan@yopmail.com',
            'address' => 'Putra Perdana,Puchong',
            'position_id' => 8,
            'department_id' => 4,
            'is_active' => 1,
        ]);

        Staff::create([
            'user_id' => 8,
            'fullname' => 'Wan',
            'email' => 'wan@yopmail.com',
            'address' => 'Putra Perdana,Puchong',
            'position_id' => 8,
            'department_id' => 4,
            'is_active' => 1,
        ]);

        Staff::create([
            'user_id' => 9,
            'fullname' => 'Syamimi',
            'email' => 'syamimi@yopmail.com',
            'address' => 'Putra Perdana,Puchong',
            'position_id' => 11,
            'department_id' => 4,
            'is_active' => 1,
        ]);

        Staff::create([
            'user_id' => 10,
            'fullname' => 'Aishah Salim',
            'email' => 'aishah@yopmail.com',
            'address' => 'Putra Perdana,Puchong',
            'position_id' => 14,
            'department_id' => 1,
            'is_active' => 1,
        ]);

        Staff::create([
            'user_id' => 11,
            'fullname' => 'Suherman',
            'email' => 'suherman@yopmail.com',
            'address' => 'Putra Perdana,Puchong',
            'position_id' => 2,
            'department_id' => 4,
            'is_supervisor' => 1,
            'is_active' => 1,
        ]);
    }
}
