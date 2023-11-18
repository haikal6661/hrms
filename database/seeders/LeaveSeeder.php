<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LeaveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('staff_leave')->delete();

        DB::table('staff_leave')->insert(array (

            0 =>
            array (
                'id' => 1,
                'staff_id' => 1,
                'leave_type_id' => 1,
                'balance' => 12,
                'entitlement' => 12,
                'created_at' => Carbon::now(),
                'updated_at' => NULL,
            ),

            1 =>
            array (
                'id' => 2,
                'staff_id' => 1,
                'leave_type_id' => 2,
                'balance' => 25,
                'entitlement' => 25,
                'created_at' => Carbon::now(),
                'updated_at' => NULL,
            ),

            2 =>
            array (
                'id' => 3,
                'staff_id' => 1,
                'leave_type_id' => 3,
                'balance' => 8,
                'entitlement' => 8,
                'created_at' => Carbon::now(),
                'updated_at' => NULL,
            ),

            3 =>
            array (
                'id' => 4,
                'staff_id' => 1,
                'leave_type_id' => 4,
                'balance' => 10,
                'entitlement' => 10,
                'created_at' => Carbon::now(),
                'updated_at' => NULL,
            ),

            4 =>
            array (
                'id' => 5,
                'staff_id' => 1,
                'leave_type_id' => 5,
                'balance' => 5,
                'entitlement' => 5,
                'created_at' => Carbon::now(),
                'updated_at' => NULL,
            ),

            5 =>
            array (
                'id' => 6,
                'staff_id' => 1,
                'leave_type_id' => 6,
                'balance' => 10,
                'entitlement' => 10,
                'created_at' => Carbon::now(),
                'updated_at' => NULL,
            ),

            6 =>
            array (
                'id' => 7,
                'staff_id' => 1,
                'leave_type_id' => 7,
                'balance' => 30,
                'entitlement' => 30,
                'created_at' => Carbon::now(),
                'updated_at' => NULL,
            ),

            7 =>
            array (
                'id' => 8,
                'staff_id' => 2,
                'leave_type_id' => 1,
                'balance' => 12,
                'entitlement' => 12,
                'created_at' => Carbon::now(),
                'updated_at' => NULL,
            ),

            8 =>
            array (
                'id' => 9,
                'staff_id' => 2,
                'leave_type_id' => 2,
                'balance' => 25,
                'entitlement' => 25,
                'created_at' => Carbon::now(),
                'updated_at' => NULL,
            ),

            9 =>
            array (
                'id' => 10,
                'staff_id' => 2,
                'leave_type_id' => 3,
                'balance' => 8,
                'entitlement' => 8,
                'created_at' => Carbon::now(),
                'updated_at' => NULL,
            ),

            10 =>
            array (
                'id' => 11,
                'staff_id' => 2,
                'leave_type_id' => 4,
                'balance' => 10,
                'entitlement' => 10,
                'created_at' => Carbon::now(),
                'updated_at' => NULL,
            ),

            11 =>
            array (
                'id' => 12,
                'staff_id' => 2,
                'leave_type_id' => 5,
                'balance' => 5,
                'entitlement' => 5,
                'created_at' => Carbon::now(),
                'updated_at' => NULL,
            ),

            12 =>
            array (
                'id' => 13,
                'staff_id' => 2,
                'leave_type_id' => 6,
                'balance' => 10,
                'entitlement' => 10,
                'created_at' => Carbon::now(),
                'updated_at' => NULL,
            ),

            13 =>
            array (
                'id' => 14,
                'staff_id' => 2,
                'leave_type_id' => 7,
                'balance' => 30,
                'entitlement' => 30,
                'created_at' => Carbon::now(),
                'updated_at' => NULL,
            ),

        )
        );
    }
}
