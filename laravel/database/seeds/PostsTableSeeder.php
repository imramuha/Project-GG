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
            "time"=> "12:00",
            "date"=> "Feb 22, 2022",
            "user_id"=> 2,
        ]);
        DB::table('posts')->insert([
            "title"=> "Cat Cabaret",
            "time"=> "9:00",
            "date"=> "March 4, 2022",
            "user_id"=> 1,
        ]);
        DB::table('posts')->insert([
            "title"=> "Doggy Day",
            "time"=> "1:00",
            "date"=> "June 12, 2022",
            "user_id"=> 2,
        ]);
        DB::table('posts')->insert([
            "title"=> "Feline Frenzy",
            "time"=> "8:00",
            "date"=> "July 28, 2022",
            "user_id"=> 3,
        ]);

    }
}
