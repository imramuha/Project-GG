<?php

use Illuminate\Database\Seeder;

class UserGameDataTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('user_game_data')->insert([
            'user_id' => 4,
            'game_id' => 1,
            'data_id' => 1,
        ]);
        DB::table('user_game_data')->insert([
            'user_id' => 3,
            'game_id' => 1,
            'data_id' => 3,
        ]);
        DB::table('user_game_data')->insert([
            'user_id' => 3,
            'game_id' => 2,
            'data_id' => 5,
        ]);
        DB::table('user_game_data')->insert([
            'user_id' => 3,
            'game_id' => 3,
            'data_id' => 6,
        ]);
        DB::table('user_game_data')->insert([
            'user_id' => 3,
            'game_id' => 13,
            'data_id' => 10,
        ]);
        DB::table('user_game_data')->insert([
            'user_id' => 3,
            'game_id' => 4,
            'data_id' => 7,
        ]);
        DB::table('user_game_data')->insert([
            'user_id' => 3,
            'game_id' => 5,
            'data_id' => 8,
        ]);
        DB::table('user_game_data')->insert([
            'user_id' => 3,
            'game_id' => 6,
            'data_id' => 9,
        ]);
        DB::table('user_game_data')->insert([
            'user_id' => 3,
            'game_id' => 7,
            'data_id' => 10,
        ]);
        DB::table('user_game_data')->insert([
            'user_id' => 3,
            'game_id' => 8,
            'data_id' => 11,
        ]);
        DB::table('user_game_data')->insert([
            'user_id' => 3,
            'game_id' => 9,
            'data_id' => 12,
        ]);
        DB::table('user_game_data')->insert([
            'user_id' => 3,
            'game_id' => 10,
            'data_id' => 13,
        ]);
        DB::table('user_game_data')->insert([
            'user_id' => 3,
            'game_id' => 11,
            'data_id' => 14,
        ]);
    }
}
