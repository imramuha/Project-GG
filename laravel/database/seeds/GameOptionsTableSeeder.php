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
        DB::table('game_options')->insert([
            'game_id' => 6,
            'option_id' => 27,
        ]);
        DB::table('game_options')->insert([
            'game_id' => 6,
            'option_id' => 28,
        ]);
        DB::table('game_options')->insert([
            'game_id' => 6,
            'option_id' => 29,
        ]);
        DB::table('game_options')->insert([
            'game_id' => 7,
            'option_id' => 25,
        ]);
        DB::table('game_options')->insert([
            'game_id' => 7,
            'option_id' => 26,
        ]);
        DB::table('game_options')->insert([
            'game_id' => 8,
            'option_id' => 23,
        ]);
        DB::table('game_options')->insert([
            'game_id' => 8,
            'option_id' => 24,
        ]);
        DB::table('game_options')->insert([
            'game_id' => 9,
            'option_id' => 22,
        ]);
        DB::table('game_options')->insert([
            'game_id' => 9,
            'option_id' => 21,
        ]);
        DB::table('game_options')->insert([
            'game_id' => 9,
            'option_id' => 20,
        ]);
        DB::table('game_options')->insert([
            'game_id' => 10,
            'option_id' => 19,
        ]);
        DB::table('game_options')->insert([
            'game_id' => 10,
            'option_id' => 18,
        ]);
        DB::table('game_options')->insert([
            'game_id' => 10,
            'option_id' => 17,
        ]);
        DB::table('game_options')->insert([
            'game_id' => 11,
            'option_id' => 16,
        ]);
        DB::table('game_options')->insert([
            'game_id' => 11,
            'option_id' => 15,
        ]);
        DB::table('game_options')->insert([
            'game_id' => 11,
            'option_id' => 14,
        ]);
    }
}
