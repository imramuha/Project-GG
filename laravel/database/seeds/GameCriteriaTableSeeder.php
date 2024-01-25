<?php

use Illuminate\Database\Seeder;

class GameCriteriaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('game_criteria')->insert([
            'game_id' => 1,
            'criterion_id' => 1,
        ]);
        DB::table('game_criteria')->insert([
            'game_id' => 1,
            'criterion_id' => 2,
        ]);
        DB::table('game_criteria')->insert([
            'game_id' => 1,
            'criterion_id' => 3,
        ]);
        DB::table('game_criteria')->insert([
            'game_id' => 2,
            'criterion_id' => 4,
        ]);
        DB::table('game_criteria')->insert([
            'game_id' => 2,
            'criterion_id' => 1,
        ]);
        DB::table('game_criteria')->insert([
            'game_id' => 3,
            'criterion_id' => 6,
        ]);
        DB::table('game_criteria')->insert([
            'game_id' => 3,
            'criterion_id' => 7,
        ]);
        DB::table('game_criteria')->insert([
            'game_id' => 3,
            'criterion_id' => 8,
        ]);
        DB::table('game_criteria')->insert([
            'game_id' => 3,
            'criterion_id' => 9,
        ]);
        DB::table('game_criteria')->insert([
            'game_id' => 4,
            'criterion_id' => 10,
        ]);
        DB::table('game_criteria')->insert([
            'game_id' => 4,
            'criterion_id' => 11,
        ]);
        DB::table('game_criteria')->insert([
            'game_id' => 5,
            'criterion_id' => 12,
        ]);
        DB::table('game_criteria')->insert([
            'game_id' => 5,
            'criterion_id' => 13,
        ]);
        DB::table('game_criteria')->insert([
            'game_id' => 6,
            'criterion_id' => 27,
        ]);
        DB::table('game_criteria')->insert([
            'game_id' => 6,
            'criterion_id' => 28,
        ]);
        DB::table('game_criteria')->insert([
            'game_id' => 6,
            'criterion_id' => 29,
        ]);
        DB::table('game_criteria')->insert([
            'game_id' => 7,
            'criterion_id' => 25,
        ]);
        DB::table('game_criteria')->insert([
            'game_id' => 7,
            'criterion_id' => 26,
        ]);
        DB::table('game_criteria')->insert([
            'game_id' => 8,
            'criterion_id' => 23,
        ]);
        DB::table('game_criteria')->insert([
            'game_id' => 8,
            'criterion_id' => 24,
        ]);
        DB::table('game_criteria')->insert([
            'game_id' => 9,
            'criterion_id' => 22,
        ]);
        DB::table('game_criteria')->insert([
            'game_id' => 9,
            'criterion_id' => 21,
        ]);
        DB::table('game_criteria')->insert([
            'game_id' => 9,
            'criterion_id' => 20,
        ]);
        DB::table('game_criteria')->insert([
            'game_id' => 10,
            'criterion_id' => 19,
        ]);
        DB::table('game_criteria')->insert([
            'game_id' => 10,
            'criterion_id' => 18,
        ]);
        DB::table('game_criteria')->insert([
            'game_id' => 10,
            'criterion_id' => 17,
        ]);
        DB::table('game_criteria')->insert([
            'game_id' => 11,
            'criterion_id' => 16,
        ]);
        DB::table('game_criteria')->insert([
            'game_id' => 11,
            'criterion_id' => 15,
        ]);
        DB::table('game_criteria')->insert([
            'game_id' => 11,
            'criterion_id' => 14,
        ]);
    }
}
