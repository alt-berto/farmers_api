# FARMERS API

Proyecto Elaborado en PHP 7 con Lumen


# Requirements

* PHP > 7.3
* MySQL
* Composer https://getcomposer.org/download/
* Lumen 7.x https://lumen.laravel.com/docs/7.x#installing-lumen
*

## How to run the project
* Run $`composer install`
* Run $`php artisan swagger-lume:publish`
* Run $`php -S localhost:8000 -t public`

## Official Documentation

* Run $`php artisan swagger-lume:generate`
* Go to: http://localhost:8000/api/documentation


# Configs
* Copy *.env.example*/ to *.env* file with de database settings.
* Run $`php artisan migrate` to sycn database tables.

# Seeds
* Run the following commands to enter data into the database.
* Run $`php artisan db:seed`


The Lumen framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
