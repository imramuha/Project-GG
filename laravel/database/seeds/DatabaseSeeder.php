<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(PermissionsTableSeeder::class);
        //$this->call(RolesTableSeeder::class);
        //$this->call(RolePermissionsTableSeeder::class);
        //$this->call(UsersTableSeeder::class);
        $this->call(UserRolesTableSeeder::class);
        //$this->call(RelationsTableSeeder::class);
        //$this->call(UserRelationsTableSeeder::class);
    }
}
