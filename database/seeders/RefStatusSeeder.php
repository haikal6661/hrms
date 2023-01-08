<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RefStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ref_status')->delete();

        DB::table('ref_status')->insert(array (
            0 =>
            array (
                'code' => '01',
                'desc' => 'Draft',
                'created_at' => Carbon::now(),
                'updated_at' => NULL,
            ),
            1 =>
            array (
                'code' => '02',
                'desc' => 'Active',
                'created_at' => Carbon::now(),
                'updated_at' => NULL,
            ),
            2 =>
            array (
                'code' => '03',
                'desc' => 'Inactive',
                'created_at' => Carbon::now(),
                'updated_at' => NULL,
            ),
            3 =>
            array (
                'code' => '04',
                'desc' => 'Submitted',
                'created_at' => Carbon::now(),
                'updated_at' => NULL,
            ),
            4 =>
            array (
                'code' => '05',
                'desc' => 'Waiting Approval',
                'created_at' => Carbon::now(),
                'updated_at' => NULL,
            ),
            5 =>
            array (
                'code' => '06',
                'desc' => 'Approved',
                'created_at' => Carbon::now(),
                'updated_at' => NULL,
            ),
            6 =>
            array (
                'code' => '07',
                'desc' => 'Accepted',
                'created_at' => Carbon::now(),
                'updated_at' => NULL,
            ),
            7 =>
            array (
                'code' => '08',
                'desc' => 'Rejected',
                'created_at' => Carbon::now(),
                'updated_at' => NULL,
            ),
            8 =>
            array (
                'code' => '09',
                'desc' => 'Success',
                'created_at' => Carbon::now(),
                'updated_at' => NULL,
            ),
            9 =>
            array (
                'code' => '10',
                'desc' => 'Failed',
                'created_at' => Carbon::now(),
                'updated_at' => NULL,
            ),
            10 =>
            array (
                'code' => '11',
                'desc' => 'Available',
                'created_at' => Carbon::now(),
                'updated_at' => NULL,
            ),
            11 =>
            array (
                'code' => '12',
                'desc' => 'Not Available',
                'created_at' => Carbon::now(),
                'updated_at' => NULL,
            ),
        )
        );
    }
}
