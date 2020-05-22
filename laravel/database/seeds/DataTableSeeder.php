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
            'data' => "Bronze",
        ]);
        DB::table('data')->insert([
            'username' => "Mr Penguin",
            'data' => "Unranked",
        ]);
        DB::table('data')->insert([
            'username' => "Imosh",
            'data' => "Platnium",
        ]);
        DB::table('data')->insert([
            'username' => "Muddykip",
            'data' => "Platnium",
        ]);
        DB::table('data')->insert([
            'username' => "muddyk",
            'data' => "",
        ]);
        DB::table('data')->insert([
            'username' => "Muddykipnew",
            'data' => "Platnium",
        ]);
        DB::table('data')->insert([
            'username' => "muddykyt",
            'data' => "",
        ]);
        DB::table('data')->insert([
            'username' => "MuddyKip",
            'data' => "",
        ]);
        DB::table('data')->insert([
            'username' => "Muddykip",
            'data' => "",
        ]);
        DB::table('data')->insert([
            'username' => "Muddy#4874",
            'data' => "",
        ]);
        DB::table('data')->insert([
            'username' => "Muddykip87",
            'data' => "platnium",
        ]);
        DB::table('data')->insert([
            'username' => "Muddy_kip",
            'data' => "",
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
