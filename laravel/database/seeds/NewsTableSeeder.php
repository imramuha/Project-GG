<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class NewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('news')->insert([
            "title"=> "Game on",
            "created_at"=> Carbon::now()->format('Y-m-d H:i:s'),
            "text"=> "The gloves are on and we're ready to jump into this! Let's make a safe place for gamers that are hungry to find other gamers to play games with, let's make it happen!",
            "image"=> null,
            "user_id"=> 2,
        ]);
        DB::table('news')->insert([
            "title"=> "Gamers that cry",
            "created_at"=> Carbon::now()->format('Y-m-d H:i:s'),
            "text"=> "We're currently looking for gamers to test our beta version out. We would love to hear your cries and do our best to adjust and implment features to satisfy your needs.",
            "image"=> null,
            "user_id"=> 1,
        ]);
        DB::table('news')->insert([
            "title"=> "Lobby & Lounge",
            "created_at"=> Carbon::yesterday()->format('Y-m-d H:i:s'),
            "text"=> "Implemented a system where users can queue up for games and join lounges with other players based on the criteria they used during their queue! Next up: implementing group chat system to that lounge!",
            "image"=> null,
            "user_id"=> 2,
        ]);
        DB::table('news')->insert([
            "title"=> "So close to being launched!",
            "created_at"=> Carbon::tomorrow()->format('Y-m-d H:i:s'),
            "text"=> "Currently we're busy making sure everything works smoothly on launch, so a lot of testing and fixing, stay safe and keep tight everyone!",
            "image"=> null,
            "user_id"=> 3,
        ]);
    }
}
