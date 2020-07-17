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
            'comment' => "I had fun playing with this player!!",
            'score' => "88",
            'user_id' => 7,
            'reviewer_id' => 3,
        ]);
        DB::table('reviews')->insert([
            'comment' => "Pretty chill, no drama, no nothing, just gameplay.",
            'score' => "68",
            'user_id' => 8,
            'reviewer_id' => 5,
        ]);
        DB::table('reviews')->insert([
            'comment' => "We stomped on them 'nemies, they'll remember that forever :D",
            'score' => "91",
            'user_id' => 6,
            'reviewer_id' => 5,
        ]);
        DB::table('reviews')->insert([
            'comment' => "This guy loves to talk and he's quite funny too xD",
            'score' => "81",
            'user_id' => 4,
            'reviewer_id' => 8,
        ]);
        
    }
}
