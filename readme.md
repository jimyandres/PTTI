## Laravel PHP Framework

[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/laravel/framework)
[![Total Downloads](https://poser.pugx.org/laravel/framework/d/total.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/framework/v/unstable.svg)](https://packagist.org/packages/laravel/framework)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as authentication, routing, sessions, queueing, and caching.

Laravel is accessible, yet powerful, providing powerful tools needed for large, robust applications. A superb inversion of control container, expressive migration system, and tightly integrated unit testing support give you the tools you need to build any application with which you are tasked.

## Official Documentation

Documentation for the framework can be found on the [Laravel website](http://laravel.com/docs).

## Installation

1. Clone this repo with `git clone https://github.com/JohanQuiroga/PTTI.git`
1. On project folder run `composer install`
1. Create a MySQL database named **'pttibd'** and import DB structure from `pttibd.sql`
1. Create `.env` file with `cp .env.example .env`
1. Set needed environment variables on `.env`. Be careful to set the correct Database information.
1. On project folder run `php artisan db:seed` or import dummy data from `pttibd.sql`

## Executing the project

1. To run the project execute `php artisan serve`
1. Head over to http://localhost:8000

You may login using one of the following credentials:
  + Administrator role:
    - email: david-0296@hotmail.com
    - contraseña: admin
  + Student role:
    - email: pipe.0325@hotmail.com
    - contraseña: chimuelo
  + Psychologist role:
    - email: valenfranco@hotmail.com
    - contraseña: psicologo
  + Root role:
    - email: root@ptti.com
    - contraseña: root

## Problems

If you encounter any problem while installing or running this project feel free to open a thoroughly detailed issue on this repo or contact me via e-mail at quirogacj@utp.edu.co

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](http://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

### License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
