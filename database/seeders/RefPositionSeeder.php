<?php

namespace Database\Seeders;

use App\Models\RefPosition;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RefPositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ref_position')->delete();

        DB::table('ref_position')->insert(array (
            0 =>
            array (
                'code' => '01',
                'desc' => 'Chief Information Officer (CIO)',
                'created_at' => Carbon::now(),
                'updated_at' => NULL,
            ),
            1 =>
            array (
                'code' => '02',
                'desc' => 'Chief Technology Officer (CTO)',
                'created_at' => Carbon::now(),
                'updated_at' => NULL,
            ),
            2 =>
            array (
                'code' => '03',
                'desc' => 'Solutions Architect',
                'created_at' => Carbon::now(),
                'updated_at' => NULL,
            ),
            3 =>
            array (
                'code' => '04',
                'desc' => 'Technical Architect',
                'created_at' => Carbon::now(),
                'updated_at' => NULL,
            ),
            4 =>
            array (
                'code' => '05',
                'desc' => 'Network Administrator',
                'created_at' => Carbon::now(),
                'updated_at' => NULL,
            ),
            5 =>
            array (
                'code' => '06',
                'desc' => 'Network Engineer',
                'created_at' => Carbon::now(),
                'updated_at' => NULL,
            ),
            6 =>
            array (
                'code' => '07',
                'desc' => 'DevOps Engineer',
                'created_at' => Carbon::now(),
                'updated_at' => NULL,
            ),
            7 =>
            array (
                'code' => '08',
                'desc' => 'Web Developer',
                'created_at' => Carbon::now(),
                'updated_at' => NULL,
            ),
            8 =>
            array (
                'code' => '09',
                'desc' => 'Help Desk support specialist',
                'created_at' => Carbon::now(),
                'updated_at' => NULL,
            ),
            9 =>
            array (
                'code' => '10',
                'desc' => 'Project Manager',
                'created_at' => Carbon::now(),
                'updated_at' => NULL,
            ),
            10 =>
            array (
                'code' => '11',
                'desc' => 'Business Analytics (BA)',
                'created_at' => Carbon::now(),
                'updated_at' => NULL,
            ),
            11 =>
            array (
                'code' => '12',
                'desc' => 'System Tester',
                'created_at' => Carbon::now(),
                'updated_at' => NULL,
            ),
            12 =>
            array (
                'code' => '13',
                'desc' => 'Human Resources',
                'created_at' => Carbon::now(),
                'updated_at' => NULL,
            ),
            13 =>
            array (
                'code' => '14',
                'desc' => 'Office Clerk',
                'created_at' => Carbon::now(),
                'updated_at' => NULL,
            ),
            14 =>
            array (
                'code' => '15',
                'desc' => 'Account Executive',
                'created_at' => Carbon::now(),
                'updated_at' => NULL,
            ),
            15 =>
            array (
                'code' => '16',
                'desc' => 'Administrative Assistant',
                'created_at' => Carbon::now(),
                'updated_at' => NULL,
            ),
            16 =>
            array (
                'code' => '17',
                'desc' => 'Sales Manager',
                'created_at' => Carbon::now(),
                'updated_at' => NULL,
            ),
            17 =>
            array (
                'code' => '18',
                'desc' => 'Sales Engineer',
                'created_at' => Carbon::now(),
                'updated_at' => NULL,
            ),
            18 =>
            array (
                'code' => '19',
                'desc' => 'Sales Analyst',
                'created_at' => Carbon::now(),
                'updated_at' => NULL,
            ),
        )
        );
    }
}
