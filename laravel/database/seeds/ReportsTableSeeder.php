<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ReportsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('reports')->insert([
            'reason' => "this person was very toxic!",
            'type' => "profile",
            'type_id' => '7',
            'reporter_id' => '3',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('reports')->insert([
            'reason' => "Testing report number 2!",
            'type' => "profile",
            'type_id' => '1',
            'reporter_id' => '3',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('reports')->insert([
            'reason' => "testing report number 3!",
            'type' => "profile",
            'type_id' => '2',
            'reporter_id' => '3',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
