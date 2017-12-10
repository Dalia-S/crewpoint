<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $crew_names = ['John', 'Jane', 'Mary', 'Sarah', 'Peter', 'Tom', 'Jack', 'Fiona', 'Anna', 'Stephen', 'Julia', 'Robert'];
      $crew_surnames = ['Smith', 'Johnson', 'Peterson', 'Jones', 'Taylor', 'Williams'];
      $prefix = ['Captain', 'Old-salt', 'Shipmate', 'Pilot', 'Cadet', 'Navigator', 'Pirate', 'Deck-hand', 'Sea-dog', 'Yachtie', 'Mate', 'Mariner', 'Boater', 'Seafarer', 'Cruiser', 'Racer', 'Voyager', 'Water-dog', 'Windjammer', 'Cap', 'Coaster', 'Drifter', 'Explorer', 'Globe-trotter', 'Naval', 'Nautical', 'Officer', 'Salt-grass', 'Salt-water', 'Salted', 'Shipper'];
      $boat_names = ['Highwater', 'Seagull', 'Pura-Vida', 'Odyssey', 'Seahorse', 'Carpe-Diem', 'Blue-Whale', 'Sea-Spirit', 'Gypsea', 'Seafarer', 'Windsong'];
      $status = ['Active', 'Inactive'];

      // Admin
      DB::table('users')->insert([
          'created_at' => now(),
          'name' => 'Admin',
          'username' => 'Admin',
          'email' => 'admin@admin.com',
          'password' => bcrypt('password'),
          'type' => 'crew',
          'status' => 'Hidden',
          'role' => 'admin',
      ]);
      // Demo crew
      DB::table('users')->insert([
          'created_at' => now(),
          'name' => 'Jack Sparrow',
          'username' => 'Captain Jack',
          'email' => 'crew@crew.com',
          'password' => bcrypt('password'),
          'type' => 'crew',
          'status' => 'Hidden',
          'role' => 'demo',
      ]);
      // Demo boat
      DB::table('users')->insert([
          'created_at' => now(),
          'username' => 'Blue-Swan',
          'email' => 'boat@boat.com',
          'password' => bcrypt('password'),
          'type' => 'boat',
          'status' => 'Hidden',
          'role' => 'demo',
      ]);

      // Crew
      for ($i=0; $i < 100; $i++) {
        $name = $crew_names[rand(0, count($crew_names)-1)];
        $surname = $crew_surnames[rand(0, count($crew_surnames)-1)];
        $fullname = $name.' '.$surname;
        $username = $prefix[rand(0, count($prefix)-1)].' '.$name;
        $email = $name.$surname.rand(100, 900).'@'.uniqid().'mail.com';

        DB::table('users')->insert([
            'created_at' => now(),
            'name' => $fullname,
            'username' => $username,
            'email' => $email,
            'password' => bcrypt('pass123'),
            'type' => 'crew',
            'status' => $status[rand(0, 1)],
            'role' => 'user',
        ]);
      }

      // Boats
      for ($i=0; $i < 100; $i++) {
        $username = $boat_names[rand(0, count($boat_names)-1)];
        $email = $username.rand(100,999).'@'.uniqid().'mail.com';

        DB::table('users')->insert([
            'created_at' => now(),
            'username' => $username,
            'email' => $email,
            'password' => bcrypt('pass123'),
            'type' => 'boat',
            'status' => $status[rand(0, 1)],
            'role' => 'user',
        ]);
      }
    }
}
