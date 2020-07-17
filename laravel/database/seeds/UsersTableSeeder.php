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
        ]);
        DB::table('users')->insert([
            'username' => 'UserGG',
            'email' => 'user@gg.com',
            'password' => bcrypt('user123'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('users')->insert([
            'username' => 'ModGG',
            'email' => 'mod@gg.com',
            'password' => bcrypt('mod123'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('users')->insert([
            'username' => 'Peeka',
            'email' => 'peeka@gg.com',
            'password' => bcrypt('peeka123'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('users')->insert([
            'username' => 'Luvakvash',
            'email' => 'luvakvash@gg.com',
            'password' => bcrypt('luvakvash123'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('users')->insert([
            'username' => 'Casual_Gamer',
            'email' => 'casual_gamer@gg.com',
            'password' => bcrypt('casualgamer123'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('users')->insert([
            'username' => 'NectaRay',
            'email' => 'nectaray@gg.com',
            'password' => bcrypt('nectaray123'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('users')->insert([
            'username' => 'DrPassy',
            'email' => 'drpassy@gg.com',
            'password' => bcrypt('drpassy123'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('users')->insert([
            'username' => 'Leori',
            'email' => 'leori@gg.com',
            'password' => bcrypt('leori123'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('users')->insert([
            'username' => 'Imosh',
            'email' => 'lmosh@gg.com',
            'password' => bcrypt('imosh123'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

    }
}
