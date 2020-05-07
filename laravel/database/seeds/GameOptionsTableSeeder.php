<?php

use Illuminate\Database\Seeder;

class GameOptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('game_options')->insert([
            'game_id' => 1,
            'option_id' => 1,
        ]);
        DB::table('game_options')->insert([
            'game_id' => 1,
            'option_id' => 2,
        ]);
        DB::table('game_options')->insert([
            'game_id' => 1,
            'option_id' => 3,
        ]);
        DB::table('game_options')->insert([
            'game_id' => 2,
            'option_id' => 4,
        ]);
        DB::table('game_options')->insert([
            'game_id' => 2,
            'option_id' => 1,
        ]);
        DB::table('game_options')->insert([
            'game_id' => 3,
            'option_id' => 6,
        ]);
        DB::table('game_options')->insert([
            'game_id' => 3,
            'option_id' => 7,
        ]);
        DB::table('game_options')->insert([
            'game_id' => 3,
            'option_id' => 8,
        ]);
        DB::table('game_options')->insert([
            'game_id' => 3,
            'option_id' => 9,
        ]);
        DB::table('game_options')->insert([
            'game_id' => 4,
            'option_id' => 10,
        ]);
        DB::table('game_options')->insert([
            'game_id' => 4,
            'option_id' => 11,
        ]);
        DB::table('game_options')->insert([
            'game_id' => 5,
            'option_id' => 12,
        ]);
        DB::table('game_options')->insert([
            'game_id' => 5,
            'option_id' => 13,
        ]);
    }
}
