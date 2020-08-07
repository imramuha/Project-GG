<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class GroupMessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('group_messages')->insert([
            'user_id' => 3,
            'lobby_id' => 1,
            'text' => "hi",
            'created_at' => Carbon::yesterday()->format('Y-m-d H:i:s'),
        ]);
        //
        DB::table('group_messages')->insert([
            'user_id' => 1,
            'lobby_id' => 1,
            'text' => "hiya, what's up?",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('group_messages')->insert([
            'user_id' => 3,
            'lobby_id' => 1,
            'text' => "nothing much really, how about yourself?",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('group_messages')->insert([
            'user_id' => 4,
            'lobby_id' => 1,
            'text' => "o-hiii, how is it going??",
            'created_at' => Carbon::tomorrow()->format('Y-m-d H:i:s'),
        ]);
    }
}
