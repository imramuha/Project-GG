<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UserRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_roles')->insert([
            'user_id' => '1',
            'role_id' => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('user_roles')->insert([
            'user_id' => '2',
            'role_id' => '3',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('user_roles')->insert([
            'user_id' => '3',
            'role_id' => '2',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
