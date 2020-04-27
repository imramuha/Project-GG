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
            "id" => "1234",
            "title"=> "Puppy Parade",
            "time"=> "12:00",
            "date"=> "Feb 22, 2022"
        ]);
        DB::table('posts')->insert([
            "id"=> "1584",
            "title"=> "Cat Cabaret",
            "time"=> "9:00",
            "date"=> "March 4, 2022"
        ]);
        DB::table('posts')->insert([
            "id"=> "2794",
            "title"=> "Doggy Day",
            "time"=> "1:00",
            "date"=> "June 12, 2022"
        ]);
        DB::table('posts')->insert([
            "id"=> "4619",
            "title"=> "Feline Frenzy",
            "time"=> "8:00",
            "date"=> "July 28, 2022"
        ]);

    }
}
