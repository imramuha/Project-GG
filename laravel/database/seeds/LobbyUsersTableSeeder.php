<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class LobbyUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('lobby_users')->insert([
            'user_id' => "1",
            'lobby_id' => "1",
            'created_at' => Carbon::yesterday()->format('Y-m-d H:i:s'),
        ]);
        DB::table('lobby_users')->insert([
            'user_id' => "2",
            'lobby_id' => "1",
            'created_at' => Carbon::yesterday()->format('Y-m-d H:i:s'),
        ]);
    }
}
