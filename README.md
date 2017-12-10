# Crew Point
Baltic Talents Academy PHP course project

You can see a working version of this project here: https://crewpoint.salted.lt 
 
If you wish to run the project locally, you will need: 
- wamp or xampp (http://www.wampserver.com/en/ or https://www.apachefriends.org/) 
- composer (https://getcomposer.org/download/) 
 
Once you have the above installed, follow these steps: 
- create a database locally named "crewpoint" 
- clone or download this project 
- open .env file (root folder) and fill the database information (username and password) 
- in the console (cmd) go to this project's root directory (crewpoint) 
- run: composer install 
- run: php artisan migrate 
- run: php artisan db:seed
- run: php artisan storage:link 
- run: php artisan serve 
 
You can now access this project at localhost:8000 
