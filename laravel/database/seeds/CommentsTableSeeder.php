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
            'comment' => "Plat",
            'user_id' => 2,
            'post_id' => 1,
        ]);
        DB::table('comments')->insert([
            'comment' => "comment",
            'user_id' => 3,
            'post_id' => 1,
        ]);
        DB::table('comments')->insert([
            'comment' => "apples",
            'user_id' => 4,
            'post_id' => 1,
        ]);
        DB::table('comments')->insert([
            'comment' => "Pieneapplest",
            'user_id' => 5,
            'post_id' => 1,
        ]);
        DB::table('comments')->insert([
            'comment' => "Platypus",
            'user_id' => 5,
            'post_id' => 2,
        ]);
    }
}
