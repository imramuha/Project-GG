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
            'relation_id' => 1,
            'user_id_one' => 1,
            'user_id_two' => 2,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('user_relations')->insert([
            'relation_id' => 3,
            'user_id_one' => 1,
            'user_id_two' => 3,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('user_relations')->insert([
            'relation_id' => 4,
            'user_id_one' => 2,
            'user_id_two' => 3,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('user_relations')->insert([
            'relation_id' => 3,
            'user_id_one' => 5,
            'user_id_two' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('user_relations')->insert([
            'relation_id' => 3,
            'user_id_one' => 4,
            'user_id_two' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
