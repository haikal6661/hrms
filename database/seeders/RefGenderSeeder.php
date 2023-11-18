<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RefGenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ref_gender')->delete();

        DB::table('ref_gender')->insert(array (

            0 =>
            array (
                'code' => '01',
                'desc' => 'Male',
                'created_at' => Carbon::now(),
                'updated_at' => NULL,
            ),

            1 =>
            array (
                'code' => '02',
                'desc' => 'Female',
                'created_at' => Carbon::now(),
                'updated_at' => NULL,
            ),
        )
        );
    }
}
