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
            'user_id' => 5,
            'post_id' => 6,
        ]);
        DB::table('liked_posts')->insert([
            'user_id' => 5,
            'post_id' => 5,
        ]);
        DB::table('liked_posts')->insert([
            'user_id' => 4,
            'post_id' => 6,
        ]);
        DB::table('liked_posts')->insert([
            'user_id' => 2,
            'post_id' => 6,
        ]);
        DB::table('liked_posts')->insert([
            'user_id' => 4,
            'post_id' => 7,
        ]);
        DB::table('liked_posts')->insert([
            'user_id' => 5,
            'post_id' => 7,
        ]);
        
    }
}
