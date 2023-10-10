<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RefLeaveTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ref_leave_type')->delete();

        DB::table('ref_leave_type')->insert(array (
            0 =>
            array (
                'code' => '01',
                'desc' => 'Annual Leave',
                'created_at' => Carbon::now(),
                'updated_at' => NULL,
            ),
            1 =>
            array (
                'code' => '02',
                'desc' => 'Sick Leave',
                'created_at' => Carbon::now(),
                'updated_at' => NULL,
            ),
            2 =>
            array (
                'code' => '03',
                'desc' => 'Paternity Leave',
                'created_at' => Carbon::now(),
                'updated_at' => NULL,
            ),
            3 =>
            array (
                'code' => '04',
                'desc' => 'Maternity Leave',
                'created_at' => Carbon::now(),
                'updated_at' => NULL,
            ),
            4 =>
            array (
                'code' => '05',
                'desc' => 'Marriage Leave',
                'created_at' => Carbon::now(),
                'updated_at' => NULL,
            ),
            5 =>
            array (
                'code' => '06',
                'desc' => 'Compassionate Leave',
                'created_at' => Carbon::now(),
                'updated_at' => NULL,
            ),
            6 =>
            array (
                'code' => '07',
                'desc' => 'Unpaid Leave',
                'created_at' => Carbon::now(),
                'updated_at' => NULL,
            ),
        )
        );
    }
}
