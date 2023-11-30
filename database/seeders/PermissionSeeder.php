<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Permission::create(['name' => 'create staff']);
        Permission::create(['name' => 'view staff']);
        Permission::create(['name' => 'update staff']);
        Permission::create(['name' => 'delete staff']);
        Permission::create(['name' => 'request leave']);
        Permission::create(['name' => 'view leave application']);
        Permission::create(['name' => 'create leave balance']);
        Permission::create(['name' => 'create leave entitlement']);
        Permission::create(['name' => 'update leave balance']);
        Permission::create(['name' => 'update leave entitlement']);

    }
}
