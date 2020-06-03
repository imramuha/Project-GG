<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            "title"=> "Puppy Parade",
            "subtitle"=> "12:00",
            "text"=> "Feb 22, 2022",
            "image"=> null,
            "user_id"=> 2,
        ]);
        DB::table('posts')->insert([
            "title"=> "Cat Cabaret",
            "subtitle"=> "9:00",
            "text"=> "March 4, 2022",
            "image"=> null,
            "user_id"=> 1,
        ]);
        DB::table('posts')->insert([
            "title"=> "Doggy Day",
            "subtitle"=> "1:00",
            "text"=> "June 12, 2022",
            "image"=> null,
            "user_id"=> 2,
        ]);
        DB::table('posts')->insert([
            "title"=> "Feline Frenzy",
            "subtitle"=> "8:00",
            "text"=> "July 28, 2022",
            "image"=> null,
            "user_id"=> 3,
        ]);
        DB::table('posts')->insert([
            "title"=> "Smite vs LOL - what do you prefer and why?",
            "subtitle"=> "7:00",
            "text"=> "July 27, 2020",
            "image"=> null,
            "user_id"=> 3,
        ]);
        DB::table('posts')->insert([
            "title"=> "Looking for duo - Silver/Gold (toplaner here)",
            "subtitle"=> "11:00",
            "text"=> "July 11, 2020",
            "image"=> null,
            "user_id"=> 3,
        ]);
        DB::table('posts')->insert([
            "title"=> "Looking for group - Silver/Gold (toplaner here)",
            "subtitle"=> "10:00",
            "text"=> "July 21, 2020",
            "image"=> null,
            "user_id"=> 3,
        ]);
        DB::table('posts')->insert([
            "title"=> "Looking for friends - Tryndamaere main",
            "subtitle"=> "9:00",
            "text"=> "July 26, 2020",
            "image"=> null,
            "user_id"=> 3,
        ]);

    }
}
