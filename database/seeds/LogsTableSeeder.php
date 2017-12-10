<?php

use Illuminate\Database\Seeder;

class LogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $dates = ['May 2015', 'June-July 2016', '10-25th August 2014', 'April 2010', 'September-October 2012', '15-20th June 2016'];
      $itineraries = ['St Lucia - Plymouth, UK', 'Balearic Islands', 'Malta - Palma - Brighton', 'Sydney - New Plymouth', 'Bodrum - Heraklion - Corfu'];
      $text = [
        'Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus.
          Saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium.
          Totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.',
        'Nemo enim ipsam voluptatem quia voluptas sit. Aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam.
          Eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.',
        'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
          Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
      ];

      // Demo crew
      for ($i=0; $i < 5; $i++) {
          DB::table('logs')->insert([
              'created_at' => now(),
              'user_id' => '2',
              'dates' => $dates[rand(0, count($dates)-1)],
              'itinerary' => $itineraries[rand(0, count($itineraries)-1)],
              'description' => $text[rand(0, count($text)-1)],
              'miles' => rand(100, 800),
          ]);
      }
      // Demo boat
      for ($i=0; $i < 6; $i++) {
          DB::table('logs')->insert([
              'created_at' => now(),
              'user_id' => '3',
              'dates' => $dates[rand(0, count($dates)-1)],
              'itinerary' => $itineraries[rand(0, count($itineraries)-1)],
              'description' => $text[rand(0, count($text)-1)],
          ]);
      }
      // All
      for ($i=0; $i < 300; $i++) {
          DB::table('logs')->insert([
              'created_at' => now(),
              'user_id' => rand(2, 205),
              'dates' => $dates[rand(0, count($dates)-1)],
              'itinerary' => $itineraries[rand(0, count($itineraries)-1)],
              'description' => $text[rand(0, count($text)-1)],
              'miles' => rand(100, 800),
          ]);
      }
      DB::delete('DELETE logs FROM logs
                LEFT JOIN users ON logs.user_id = users.id
                WHERE users.username IS NULL;');
    }
}
