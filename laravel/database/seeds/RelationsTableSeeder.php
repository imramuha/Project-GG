<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class RelationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('relations')->insert([
            'name' => 'pending_first_second',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('relations')->insert([
            'name' => 'pending_second_first',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('relations')->insert([
            'name' => 'friends',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('relations')->insert([
            'name' => 'block_first_second',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('relations')->insert([
            'name' => 'block_second_first',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('relations')->insert([
            'name' => 'block_both',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
