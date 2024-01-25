<?php

use Illuminate\Database\Seeder;

class LikedPostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('liked_posts')->insert([
            'user_id' => 1,
            'post_id' => 5,
        ]);
        DB::table('liked_posts')->insert([
            'user_id' => 2,
            'post_id' => 5,
        ]);
        DB::table('liked_posts')->insert([
            'user_id' => 3,
            'post_id' => 5,
        ]);
        DB::table('liked_posts')->insert([
            'user_id' => 4,
            'post_id' => 1,
        ]);
        DB::table('liked_posts')->insert([
            'user_id' => 5,
            'post_id' => 5,
        ]);
        DB::table('liked_posts')->insert([
            'user_id' => 5,
            'post_id' => 8,
        ]);
        DB::table('liked_posts')->insert([
            'user_id' => 6,
            'post_id' => 8,
        ]);
        DB::table('liked_posts')->insert([
            'user_id' => 7,
            'post_id' => 8,
        ]);
        DB::table('liked_posts')->insert([
            'user_id' => 8,
            'post_id' => 8,
        ]);
        DB::table('liked_posts')->insert([
            'user_id' => 9,
            'post_id' => 8,
        ]);
        DB::table('liked_posts')->insert([
            'user_id' => 6,
            'post_id' => 3,
        ]);
        DB::table('liked_posts')->insert([
            'user_id' => 7,
            'post_id' => 3,
        ]);
        DB::table('liked_posts')->insert([
            'user_id' => 9,
            'post_id' => 4,
        ]);
        DB::table('liked_posts')->insert([
            'user_id' => 5,
            'post_id' => 7,
        ]);
        DB::table('liked_posts')->insert([
            'user_id' => 7,
            'post_id' => 7,
        ]);
        
    }
}
