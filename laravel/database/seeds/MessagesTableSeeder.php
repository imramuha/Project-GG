<?php

use Illuminate\Database\Seeder;

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
        ]);
           //
           DB::table('messages')->insert([
            'from' => 1,
            'to' => 3,
            'text' => "hiya, what's up?",
        ]);
        DB::table('messages')->insert([
            'from' => 3,
            'to' => 1,
            'text' => "nothing much really, how about yourself?",
        ]);
        DB::table('messages')->insert([
            'from' => 4,
            'to' => 3,
            'text' => "omgg hiii, how is it going??",
        ]);
    }
}
