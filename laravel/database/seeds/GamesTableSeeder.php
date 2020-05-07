<?php

use Illuminate\Database\Seeder;

class GamesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('games')->insert([
            "name" => "League of Legends",
            "option" => "Rank",
        ]);
        DB::table('games')->insert([
            "name" => "Teamfight Tactics",
            "option" => "Rank",
        ]);
        DB::table('games')->insert([
            "name" => "Dead by Daylight",
            "option" => "Rank",
        ]);
        DB::table('games')->insert([
            "name" => "Path of Exile",
            "option" => "League",
        ]);
        DB::table('games')->insert([
            "name" => "Final Fantasy XIV",
            "option" => "Activity",
        ]);
    }
}
