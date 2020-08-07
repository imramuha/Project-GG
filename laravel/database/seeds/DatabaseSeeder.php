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
        $this->call(PermissionsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(StatusesTableSeeder::class);
        $this->call(RolePermissionsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ReviewsTableSeeder::class);
        $this->call(RelationsTableSeeder::class);
        $this->call(UserRelationsTableSeeder::class);
        $this->call(PostsTableSeeder::class);
        $this->call(CommentsTableSeeder::class);
        $this->call(LikedPostsTableSeeder::class);
        $this->call(GamesTableSeeder::class);
        $this->call(DataTableSeeder::class);
        $this->call(CriteriaTableSeeder::class);
        $this->call(GameCriteriaTableSeeder::class);
        $this->call(UserGameDataTableSeeder::class);
        $this->call(MessagesTableSeeder::class);
        $this->call(LobbiesTableSeeder::class);
        $this->call(LobbyUsersTableSeeder::class);
        $this->call(GroupMessagesTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(NewsTableSeeder::class);
        $this->call(ReportsTableSeeder::class);
    }
}
