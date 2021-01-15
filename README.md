# Getting started

## Installation

Clone the repository

    git clone https://github.com/nelsonrrj/laravel-test.git

Switch to the repo folder

    cd laravel-test
    
Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Make sure you set the correct database connection information before running the migrations** [Environment variables](#environment-variables)

    php artisan migrate --seed
    php artisan passport:install
    php artisan serve

## Unit test

Run tests

    php artisan test
