<?php

use Illuminate\Database\Seeder;

class OptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('options')->insert([
            "name" => "Diamond",
        ]);
        DB::table('options')->insert([
            "name" => "Platnium",
        ]);
        DB::table('options')->insert([
            "name" => "Gold",
        ]);
        DB::table('options')->insert([
            "name" => "Bronze",
        ]);
        DB::table('options')->insert([
            "name" => "Iron",
        ]);
       
        DB::table('options')->insert([
            "name" => "10-15",
        ]);
        DB::table('options')->insert([
            "name" => "6-9",
        ]);
        DB::table('options')->insert([
            "name" => "16-20",
        ]);
        DB::table('options')->insert([
            "name" => "1-5",
        ]);
        DB::table('options')->insert([
            "name" => "Standard",
        ]);
        DB::table('options')->insert([
            "name" => "Active",
        ]);
        DB::table('options')->insert([
            "name" => "Raid",
        ]);
        DB::table('options')->insert([
            "name" => "Chill",
        ]);
    }
}
