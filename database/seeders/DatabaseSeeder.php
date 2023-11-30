<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\RefLeaveType;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(RefPositionSeeder::class);
        $this->call(RefDepartmentSeeder::class);
        $this->call(RefLeaveTypeSeeder::class);
        $this->call(RefStatusSeeder::class);
        $this->call(StaffSeeder::class);
        $this->call(RefGenderSeeder::class);
        $this->call(LeaveSeeder::class);
        $this->call(PermissionSeeder::class);
    }
}
