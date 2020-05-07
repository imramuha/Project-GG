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
            'user_id' => 5,
            'game_id' => 1,
            'data_id' => 2,
        ]);
    }
}
