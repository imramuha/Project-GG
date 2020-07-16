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
            "title"=> "News 1",
            "created_at"=> Carbon::now()->format('Y-m-d H:i:s'),
            "text"=> "Feb 22, 2022",
            "image"=> null,
            "user_id"=> 2,
        ]);
        DB::table('news')->insert([
            "title"=> "News 2",
            "created_at"=> Carbon::now()->format('Y-m-d H:i:s'),
            "text"=> "March 4, 2022",
            "image"=> null,
            "user_id"=> 1,
        ]);
        DB::table('news')->insert([
            "title"=> "News 3",
            "created_at"=> Carbon::now()->format('Y-m-d H:i:s'),
            "text"=> "June 12, 2022",
            "image"=> null,
            "user_id"=> 2,
        ]);
        DB::table('news')->insert([
            "title"=> "news 4",
            "created_at"=> Carbon::now()->format('Y-m-d H:i:s'),
            "text"=> "July 28, 2022",
            "image"=> null,
            "user_id"=> 3,
        ]);
    }
}
