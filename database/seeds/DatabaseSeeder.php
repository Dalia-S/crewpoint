<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $this->call(UsersTableSeeder::class);
      $this->call(ProfilesTableSeeder::class);
      $this->call(LogsTableSeeder::class);
      $this->call(MessagesTableSeeder::class);
      $this->call(RecommendationsTableSeeder::class);
      $this->call(ProfilePicSeeder::class);
    }
}
