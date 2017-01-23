Capgemini Core/AppBundle
========================

    Projekt oparty o framework Symfony3
    Implementacja REST'owego backendu


Wymagania::

    - PostgreSQL # baza danych skonfigurowana zgodnie z core/app/config/parameters.yml
    - Nginx      # serwer stron www
    - Php7       # php-fpm w wersji 7


Konfiguracja::

    - serwer www konfigurujemy zgodnie z ``` https://github.com/odolhado/capgeminiEnviroment ```


Uruchomienie::
    ``` /var/www/core$ php bin/console doctrine:database:create ```  # tworzymy baze danych
    ``` php bin/console doctrine:schema:update ```                   # aktualizujemy schemat bazy danych
    ``` /var/www/core$ php bin/console server:run ```           # w przypadku braku postwionego serwera, uruchamiamy serwer wewnetrzny
    ``` http://0.0.0.0:8000/app_dev.php/person/12345 ```        # wlaczamy przegladarke na tej stronie
    ``` http://127.0.0.1:8000/app_dev.php/person/12345 ```      # lub na tej stronie               
    
    
    
   