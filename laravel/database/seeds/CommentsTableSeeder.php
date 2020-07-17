<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('comments')->insert([
            'comment' => "I'll add! Support main ^^",
            'user_id' => 6,
            'post_id' => 1,
        ]);
        DB::table('comments')->insert([
            'comment' => "Sent you a request, I'm a support main as well. S3 70% WR.",
            'user_id' => 7,
            'post_id' => 1,
        ]);
        DB::table('comments')->insert([
            'comment' => "Omg.. Hi there!! Let's be friends, even though I am not that OLD I can still help you feel young (21 btw).",
            'user_id' => 5,
            'post_id' => 8,
        ]);
        DB::table('comments')->insert([
            'comment' => "I feel attacked??",
            'user_id' => 8,
            'post_id' => 8,
        ]);
        DB::table('comments')->insert([
            'comment' => "It's all good hunny, let the haters hate while you be the skinny legend. Sle",
            'user_id' => 9,
            'post_id' => 8,
        ]);
    }
}
