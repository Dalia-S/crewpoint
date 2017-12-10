<?php

use Illuminate\Database\Seeder;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $subject = [
        'Welcome!', 'Regarding the Bermuda trip', 'Our last meeting', 'Regarding your recommendation for John Smith', 'Delivery to St Lucia'
      ];
      $text = [
        'Temporibus

          autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.

          Cheers!',

        'Nemo enim ipsam

          voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.

          Thank you!',

        'Ut enim ad minim veniam,

           quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.

           Kind regards'
      ];
      // Demo crew
      for ($i=0; $i < 30; $i++) {
          DB::table('messages')->insert([
              'created_at' => now(),
              'from_id' => rand(3, 205),
              'to_id' => '2',
              'subject' => $subject[rand(0, count($subject)-1)],
              'message' => $text[rand(0, count($text)-1)],
              'unread' => true,
              'show_sndr' => true,
              'show_rcvr' => true
          ]);
      }
      for ($i=0; $i < 25; $i++) {
          DB::table('messages')->insert([
              'created_at' => now(),
              'from_id' => '2',
              'to_id' => rand(3, 205),
              'subject' => $subject[rand(0, count($subject)-1)],
              'message' => $text[rand(0, count($text)-1)],
              'unread' => true,
              'show_sndr' => true,
              'show_rcvr' => true
          ]);
      }
      // Demo boat
      for ($i=0; $i < 30; $i++) {
          DB::table('messages')->insert([
              'created_at' => now(),
              'from_id' => rand(2, 205),
              'to_id' => '3',
              'subject' => $subject[rand(0, count($subject)-1)],
              'message' => $text[rand(0, count($text)-1)],
              'unread' => true,
              'show_sndr' => true,
              'show_rcvr' => true
          ]);
      }
      for ($i=0; $i < 20; $i++) {
          DB::table('messages')->insert([
              'created_at' => now(),
              'from_id' => '3',
              'to_id' => rand(4, 205),
              'subject' => $subject[rand(0, count($subject)-1)],
              'message' => $text[rand(0, count($text)-1)],
              'unread' => true,
              'show_sndr' => true,
              'show_rcvr' => true
          ]);
      }

      DB::delete('DELETE messages FROM messages
                LEFT JOIN users ON messages.from_id = users.id
                WHERE users.username IS NULL;');
      DB::delete('DELETE messages FROM messages
                LEFT JOIN users ON messages.to_id = users.id
                WHERE users.username IS NULL;');
    }
}
