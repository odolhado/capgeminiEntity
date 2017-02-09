Capgemini Core/AppBundle
========================
    Project based on framework Symfony3
    RESTfull backend


Requirements::
    - PostgreSQL # data base # configured with - core/app/config/parameters.yml
    - Nginx      # server www 
    - Php7       # php-fpm # in version 7


Environment::
    ``` https://github.com/odolhado/capgeminiEnviroment ```

Startup::
    ``` /var/www/core$ php bin/console server:run ```           # run development server
    
Helpful commands:
    ``` /var/www/core$ php bin/console doctrine:database:create ```     # create database
    ``` php bin/console doctrine:schema:update ```                      # actualise database schema 
   