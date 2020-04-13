<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UserRelationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_relations')->insert([
            'user_relation_id' => 1,
            'user_one_id' => 1,
            'user_two_id' => 2,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('user_relations')->insert([
            'user_relation_id' => 3,
            'user_one_id' => 3,
            'user_two_id' => 2,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
