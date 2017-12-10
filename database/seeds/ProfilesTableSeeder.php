<?php

use Illuminate\Database\Seeder;

class ProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $crew_key = ['age', 'location', 'qualification', 'recom_no', 'about', 'miles'];
      $boat_key = ['boat_type', 'model', 'location', 'sailing_type', 'about', 'crew_size', 'contact_person'];

      $crew_names = ['John', 'Jane', 'Mary', 'Sarah', 'Peter', 'Tom', 'Jack', 'Fiona', 'Anna', 'Stephen', 'Julia', 'Robert'];
      $crew_surnames = ['Smith', 'Johnson', 'Peterson', 'Jones', 'Taylor', 'Williams'];

      $location = ['UK, Brighton', 'Spain, Palma', 'Australia, Sydney', 'Italy, Bari', 'Greece, Corfu'];
      $qualification = ['RYA Yachtmaster Offshore', 'RYA Competent Crew', 'RYA Day Skipper'];
      $boat_type = ['Sailing yacht', 'Catamaran', 'Motorboat'];
      $model = ['Bavaria 40', 'Lagoon 380', 'Oceanis 41', 'Jeanneau Sun Odyssey 50'];
      $sailing_type = ['Cruising', 'Racing', 'Delivery'];
      $dates = ['May 2015', 'June-July 2016', '10-25th August 2014', 'April 2010', 'September-October 2012', '15-20th June 2016'];
      $itineraries = ['St Lucia - Plymouth, UK', 'Balearic Islands', 'Malta - Palma - Brighton', 'Sydney - New Plymouth', 'Bodrum - Heraklion - Corfu'];
      $about = [
        'Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae.
          Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.',
        'Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.
          Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt',
        'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
          Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta'
      ];

      // Demo crew profile
      foreach ($crew_key as $key) {
        if($key == 'age'){
          $value = '45';
        } else if($key == 'location'){
          $value = 'Kingston, Jamaica';
        } else if($key == 'qualification'){
          $value = 'RYA Yachtmaster Offshore';
        } else if($key == 'about'){
          $value = $about[rand(0, count($about)-1)];
        } else if($key == 'miles'){
          $value = 'show';
        }
        DB::table('profiles')->insert([
            'created_at' => now(),
            'user_id' => '2',
            'attribute' => $key,
            'attribute_value' => $value,
        ]);
      }

      // Demo boat profile
      foreach ($boat_key as $key) {
        if($key == 'boat_type'){
          $value = 'Sailing yacht';
        } else if($key == 'location'){
          $value = 'UK, Brighton';
        } else if($key == 'model'){
          $value = 'Jeanneau Sun Odyssey 50';
        } else if($key == 'sailing_type'){
          $value = 'Cruising';
        } else if($key == 'about'){
          $value = $about[rand(0, count($about)-1)];
        } else if($key == 'crew_size'){
          $value = 'Skipper plus 5 crew';
        } else if($key == 'contact_person'){
          $value = 'Skipper Fiona Taylor';
        }
        DB::table('profiles')->insert([
            'created_at' => now(),
            'user_id' => '3',
            'attribute' => $key,
            'attribute_value' => $value,
        ]);
      }

      // Crew profiles
      for ($i=4; $i < 104; $i++) {
        foreach ($crew_key as $key) {
          if($key == 'age'){
            $value = strval(rand(20, 60));
          } else if($key == 'location'){
            $value = $location[rand(0, count($location)-1)];
          } else if($key == 'qualification'){
            $value = $qualification[rand(0, count($qualification)-1)];
          } else if($key == 'about'){
            $value = $about[rand(0, count($about)-1)];
          }
          DB::table('profiles')->insert([
              'created_at' => now(),
              'user_id' => $i,
              'attribute' => $key,
              'attribute_value' => $value,
          ]);
        }
      }

      // Boat profiles
      for ($i=104; $i < 204; $i++) {
        foreach ($boat_key as $key) {
          if($key == 'boat_type'){
            $value = $boat_type[rand(0, count($boat_type)-1)];
          } else if($key == 'location'){
            $value = $location[rand(0, count($location)-1)];
          } else if($key == 'model'){
            $value = $model[rand(0, count($model)-1)];
          } else if($key == 'sailing_type'){
            $value = $sailing_type[rand(0, count($sailing_type)-1)];
          } else if($key == 'about'){
            $value = $about[rand(0, count($about)-1)];
          } else if($key == 'crew_size'){
            $value = 'Skipper plus '.rand(3, 7).' crew';
          } else if($key == 'contact_person'){
            if(rand(1,2) == 1){
              $name = $crew_names[rand(0, count($crew_names)-1)];
              $surname = $crew_surnames[rand(0, count($crew_surnames)-1)];
              $value = 'Skipper '.$name.' '.$surname;
            } else {
              $name = $crew_names[rand(0, count($crew_names)-1)];
              $surname = $crew_surnames[rand(0, count($crew_surnames)-1)];
              $value = 'Owner '.$name.' '.$surname;
            }
          }
          DB::table('profiles')->insert([
              'created_at' => now(),
              'user_id' => $i,
              'attribute' => $key,
              'attribute_value' => $value,
          ]);
        }
      }
    }
}
