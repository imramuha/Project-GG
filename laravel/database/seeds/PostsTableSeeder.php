<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

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
            "title"=> "EST 23m Looking for friendly people to play Dota 2 with",
            "subtitle"=> "Hi. Im just looking for anyone friendly and chill to play Dota with.",
            "text"=> "Would be nice if you have a mic and discord. If you wanna play sometime just send me a message.",
            'created_at' => Carbon::yesterday()->format('Y-m-d H:i:s'),
            "image"=> null,
            "user_id"=> 6,
        ]);
        DB::table('posts')->insert([
            "title"=> "23/F/UK/Warzone",
            "subtitle"=> "Looking for other gaming girls to play with.",
            "text"=> "Mostly warzone and COD multiplayer. I mostly play with a couple people from US and Holland they are super cool. I play on PS4. All time zones are good too as one of us are usually on. ",
            'created_at' => Carbon::yesterday()->format('Y-m-d H:i:s'),
            "image"=> null,
            "user_id"=> 7,
        ]);
        DB::table('posts')->insert([
            "title"=> "EST 23M Looking for friendly and chill people to play Fortnite with",
            "subtitle"=> "Hi, I'm just looking for anyone friendly to play some fortnite",
            "text"=> ". I mainly play for fun and to have a nice chat. So I would be nice if you have a mic. If you wanna play sometime just drop me a message",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            "image"=> null,
            "user_id"=> 6,
        ]);
        DB::table('posts')->insert([
            "title"=> "[EUW - LoL] ADC main LF friends to play Ranked/Draft/Arams",
            "subtitle"=> "Hey! I recently got back into league after about a year break. I'm looking for some people to chat/play with.",
            "text"=> "I play mainly ADC, secondary Jungle. A support duo would be sweet.

            I used to be in Gold, now probably Silver(haven't finished placements yet), I'll play with anyone regardless of rank though.
            
            I'm 26, never rage, flame or tilt. Just looking to have a chill time or climb some ranks. :)",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            "image"=> null,
            "user_id"=> 8,
        ]);
        DB::table('posts')->insert([
            "title"=> "Message from the moderation team",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            "subtitle"=> "Please stay alert!",
            "text"=> "Becareful with who you talk to, there is no place on the internet that is safe, so put the gaming gloves on and punch the evils away. Stay legendary - Mod-E",
            "image"=> null,
            "user_id"=> 3,
        ]);
        DB::table('posts')->insert([
            "title"=> "25M Be My Autochess Duo",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            "subtitle"=> "Hi I am looking for someone to play ranked autochess with occasionally. ",
            "text"=> "Rank isn't too important but preferably someone who is just barely rook or a division lower is fine, long as we get the season reward together.",
            "image"=> null,
            "user_id"=> 9,
        ]);
        DB::table('posts')->insert([
            "title"=> "21/CET PC Looking For Long Term Friendships/Gaming Buddies",
            'created_at' => Carbon::tomorrow()->format('Y-m-d H:i:s'),
            "subtitle"=> "Hey there! I'm from Sweden.",
            "text"=> "ooking for a friend (or a few to start up a group) to just hang out with on Discord, build a friendship, and play some video games. When I'm not gaming, I'm probably doing something outside, listening to music, playing with my cats, or whatever else I can find to occupy my time.
            Willing to get into anything with the right people. The right people would probably be mostly non-competitive, fun loving, hard to offend, and more decisive than me because I can't make a choice to save my life.",
            "image"=> null,
            "user_id"=> 5,
        ]);
        DB::table('posts')->insert([
            "title"=> "Looking for friends - 25 years old, dusty and also have quite the crusty",
            'created_at' => Carbon::tomorrow()->format('Y-m-d H:i:s'),
            "subtitle"=> "Any gamers out there that are down to play games with me?",
            "text"=> "So recently I found out this new game called, League o legende and it's been fun but kind of lonely. So if you're down to play, just hit me up (not literally or do it, I don't really care) or add me.",
            "image"=> null,
            "user_id"=> 4,
        ]);

    }
}
