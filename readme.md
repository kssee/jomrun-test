## About Application

The application shall allow users to register, login, view list of movies and add a movie to favorite list

- The application shall provide user the ability to register.
- The application shall provide user the ability to login.
- The application shall provide user the ability to view a list of available movies.
- The application shall provide user the ability to add a movie to user’s favorite list.
- The application shall provide user the ability to view his favorite list.

## Installation Guide

To run the application successfully, please make sure you have a web server with PHP version >= 7.1.3 , MySQL server, and [composer](https://getcomposer.org/download/) installed in your local machine. More information you can refer to [Laravel Installation Page](https://laravel.com/docs/5.7). 

Once you clone the repo and setup your local environment successfully, please run below command to setup the application.

Go to your project directory and run
> composer update

Setup environment variable by run
> cp .env.example .env

> php artisan key:generate 

Modify application environment to meet your local environment by run 
> vi .env

Load DB structure and dummy data by run
> php artisan migrate --seed
 
Put application online by run
> php artisan serve


