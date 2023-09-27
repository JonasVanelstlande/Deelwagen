Info about the project
This project is setup using a local mysql server and the symfony cli, which both need to be installed and working

!!! Make sure your mysql server is running

To setup this project locally
1. start Symfony Server in dev environment
 - symfony server:start -d
2. install dependencies
 - composer install
3. initialize database
 - symfony console doctrine:database:create
4. migrate the tables for the database
 - symfony console doctrine:migrations:migrate
5. go to http://localhost:8000 to start using the app
