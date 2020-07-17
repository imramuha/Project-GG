<?php

use Illuminate\Database\Seeder;

class DataTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('data')->insert([
            'username' => "Peeka",
            'data' => "Currently Iron and suffering",
        ]);
        DB::table('data')->insert([
            'username' => "Mr Penguin",
            'data' => "Unranked and slaying",
        ]);
        DB::table('data')->insert([
            'username' => "Muddy",
            'data' => "Platnium",
        ]);
        DB::table('data')->insert([
            'username' => "Muddykip",
            'data' => "Platnium",
        ]);
        DB::table('data')->insert([
            'username' => "muddyk",
            'data' => "Kind of lost at it.",
        ]);
        DB::table('data')->insert([
            'username' => "Muddykipnew",
            'data' => "Platnium",
        ]);
        DB::table('data')->insert([
            'username' => "muddykyt",
            'data' => "It's starting to get difficult..",
        ]);
        DB::table('data')->insert([
            'username' => "MuddyKip",
            'data' => "Don't remember joining it tbh",
        ]);
        DB::table('data')->insert([
            'username' => "Muddykip",
            'data' => "I like this game.",
        ]);
        DB::table('data')->insert([
            'username' => "Muddykip87",
            'data' => "platnium",
        ]);
        DB::table('data')->insert([
            'username' => "Muddy_kip",
            'data' => "Whatever.. I just am bad.",
        ]);
        DB::table('data')->insert([
            'username' => "Muddykip",
            'data' => "Kind good at this game",
        ]);
        DB::table('data')->insert([
            'username' => "muddyk",
            'data' => "I am bad at this :/",
        ]);
    }
}
