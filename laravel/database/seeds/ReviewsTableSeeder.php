<?php

use Illuminate\Database\Seeder;

class ReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reviews')->insert([
            'comment' => "This is my reviews",
            'score' => "22",
            'user_id' => 1,
            'reviewer_id' => 3,
        ]);
        DB::table('reviews')->insert([
            'comment' => "This is my review 3",
            'score' => "88",
            'user_id' => 1,
            'reviewer_id' => 4,
        ]);
        DB::table('reviews')->insert([
            'comment' => "This is my review 5",
            'score' => "68",
            'user_id' => 1,
            'reviewer_id' => 5,
        ]);
        DB::table('reviews')->insert([
            'comment' => "This is my review 4",
            'score' => "55",
            'user_id' => 2,
            'reviewer_id' => 2,
        ]);
        
    }
}
