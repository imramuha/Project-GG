<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

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
            "created_at"=> Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('games')->insert([
            "name" => "Teamfight Tactics",
            "created_at"=> Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('games')->insert([
            "name" => "Dead by Daylight",
            "created_at"=> Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('games')->insert([
            "name" => "Path of Exile",
            "created_at"=> Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('games')->insert([
            "name" => "Final Fantasy XIV",
            "created_at"=> Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('games')->insert([
            "name" => "Valorant",
            "created_at"=> Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('games')->insert([
            "name" => "Apex Legends",
            "created_at"=> Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('games')->insert([
            "name" => "MineCraft",
            "created_at"=> Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('games')->insert([
            "name" => "Counter-Strike: Global Offensive",
            "created_at"=> Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('games')->insert([
            "name" => "Dota 2",
            "created_at"=> Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('games')->insert([
            "name" => "Overwatch",
            "created_at"=> Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
