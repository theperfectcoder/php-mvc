# REST API-PHP-MVC
REST API simple with pure PHP and MVC model.

# Installation

1. composer install
2. import random_numbers.sql

# Run server and enjoy
php -S localhost:8000 -t public

# Routes

- "/api/get-all" => 'HomeController@getAll',
- "/api/generate" => 'HomeController@generate',
- "/api/retrieve/$id" => 'HomeController@retrieve',
- "/api/update/$id" => 'HomeController@update',
- "/api/delete/$id" => 'HomeController@delete',

