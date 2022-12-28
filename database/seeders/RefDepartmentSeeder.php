<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RefDepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ref_department')->delete();

        DB::table('ref_department')->insert(array (
            0 =>
            array (
                'code' => '01',
                'desc' => 'Administration',
                'created_at' => Carbon::now(),
                'updated_at' => NULL,
            ),
            1 =>
            array (
                'code' => '02',
                'desc' => 'Marketing and sales',
                'created_at' => Carbon::now(),
                'updated_at' => NULL,
            ),
            2 =>
            array (
                'code' => '03',
                'desc' => 'Accounting and finance',
                'created_at' => Carbon::now(),
                'updated_at' => NULL,
            ),
            3 =>
            array (
                'code' => '04',
                'desc' => 'Software/Application',
                'created_at' => Carbon::now(),
                'updated_at' => NULL,
            ),
            4 =>
            array (
                'code' => '05',
                'desc' => 'Hardware/Network',
                'created_at' => Carbon::now(),
                'updated_at' => NULL,
            ),
        )
        );
    }
}
