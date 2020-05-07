<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'AdminGG',
            'email' => 'admin@gg.com',
            'password' => bcrypt('admin123'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'status_id' => '1',
        ]);
        DB::table('users')->insert([
            'username' => 'UserGG',
            'email' => 'user@gg.com',
            'password' => bcrypt('user123'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'status_id' => '1',
        ]);
        DB::table('users')->insert([
            'username' => 'ModGG',
            'email' => 'mod@gg.com',
            'password' => bcrypt('mod123'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'status_id' => '1',
        ]);
        DB::table('users')->insert([
            'username' => 'Peeka',
            'email' => 'peeka@gg.com',
            'password' => bcrypt('peeka123'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'status_id' => '3',
        ]);
        DB::table('users')->insert([
            'username' => 'LuvakvashGG',
            'email' => 'luvakvash@gg.com',
            'password' => bcrypt('luvakvash123'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'status_id' => '1',
        ]);

    }
}
