<?php

use Illuminate\Database\Seeder;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statuses')->insert([
            "name"=> "offline",
        ]);
        DB::table('statuses')->insert([
            "name"=> "ghost",
        ]);
        DB::table('statuses')->insert([
            "name"=> "online",
        ]);
        DB::table('statuses')->insert([
            "name"=> "afk",
        ]);
        DB::table('statuses')->insert([
            "name"=> "in-game",
        ]);
        DB::table('statuses')->insert([
            "name"=> "busy",
        ]);
        DB::table('statuses')->insert([
            "name"=> "temporary-banned",
        ]);
        DB::table('statuses')->insert([
            "name"=> "perma-bannaed",
        ]);
    }
}
