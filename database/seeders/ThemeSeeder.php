<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('systems')->insert([
            'key' => 'color',
            'value' => '#f7bf29',
            'date_and_time' => Carbon::now(),
            'created_by' => 1
        ]);
        DB::table('systems')->insert([
            'key' => 'font',
            'value' => '1',
            'date_and_time' => Carbon::now(),
            'created_by' => 1
        ]);
    }
}
