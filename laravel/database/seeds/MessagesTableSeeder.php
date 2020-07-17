<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('messages')->insert([
            'from' => 3,
            'to' => 1,
            'text' => "hi",
            'created_at' => Carbon::yesterday()->format('Y-m-d H:i:s'),
        ]);
           //
           DB::table('messages')->insert([
            'from' => 1,
            'to' => 3,
            'text' => "hiya, what's up?",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('messages')->insert([
            'from' => 3,
            'to' => 1,
            'text' => "nothing much really, how about yourself?",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('messages')->insert([
            'from' => 4,
            'to' => 3,
            'text' => "o-hiii, how is it going??",
            'created_at' => Carbon::tomorrow()->format('Y-m-d H:i:s'),
        ]);
    }
}
