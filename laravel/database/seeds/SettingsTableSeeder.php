<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('settings')->insert([
            'user_id' => '3',
            'nightmode' => true,
            'anonymity' => true,
            'voice' => false,
            'language' => 'English',
            'timezone' => '(UTC) Dublin, Lisbon',
        ]);
    }
}
