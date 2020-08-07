<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class LobbiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('lobbies')->insert([
            'name' => "testing lobby",
            'code' => "44",
            'created_at' => Carbon::yesterday()->format('Y-m-d H:i:s'),
        ]);
    }
}
