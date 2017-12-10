<?php

use Illuminate\Database\Seeder;

class ProfilePicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      for ($i=2; $i < 14; $i++) {
        DB::table('profiles')->insert([
            'created_at' => now(),
            'user_id' => $i,
            'attribute' => 'photo',
            'attribute_value' => $i,
        ]);
      }
      for ($i=105; $i < 115; $i++) {
        DB::table('profiles')->insert([
            'created_at' => now(),
            'user_id' => $i,
            'attribute' => 'photo',
            'attribute_value' => $i,
        ]);
      }
    }
}
