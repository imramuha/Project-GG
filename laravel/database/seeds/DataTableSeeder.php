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
    }
}
