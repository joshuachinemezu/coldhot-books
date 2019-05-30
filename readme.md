# Building an Online Book Library API using Laravel

This is an API for an online book library using Laravel.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites

What things you need to install the software.

-   Git.
-   PHP.
-   Composer.
-   Laravel CLI.
-   A webserver like Nginx or Apache.

### Install

Clone the git repository on your computer

`$ git clone https://github.com/joshuachinemezu/coldhot-books.git`

You can also download the entire repository as a zip file and unpack in on your computer if you do not have git

After cloning the application, you need to install it's dependencies.

```
$ cd coldhot-books
$ composer install
```

### Setup

-   When you are done with installation, copy the `.env.example` file to `.env`

    `$ cp .env.example .env`

*   Generate the application key

    `$ php artisan key:generate`

-   Add your database credentials to the necessary `env` fields

-   Migrate the application

    `$ php artisan migrate`

### Run tests

To ensure all units of the application are working

`$ ./vendor/bin/phpunit`

### Run the application

`$ php artisan serve`

### Endpoints

Below are lists of endpoints, more information about parameters to be passed and guidelines on endpoint usage can be found on the POSTMAN collection url:
https://www.getpostman.com/collections/5ea9192afdfa81e1ded4

-   [Create Book](http://127.0.0.1:8000/api/v1/books) - POST - http://127.0.0.1:8000/api/v1/books

-   [Get External Books from Ice Fire Books](http://127.0.0.1:8000/api/external-books/A%20Game%20of%20Thrones) - GET - http://127.0.0.1:8000/api/external-books/A%20Game%20of%20Thrones

-   [List all Books](http://127.0.0.1:8000/api/v1/books) - GET- http://127.0.0.1:8000/api/v1/books

-   [Get a Particular Book](http://127.0.0.1:8000/api/v1/books/:book_id) - GET- http://127.0.0.1:8000/api/v1/books/:book_id

-   [Update a Particular Book](http://127.0.0.1:8000/api/v1/books/:book_id) - PATCH/PUT- http://127.0.0.1:8000/api/v1/books/:book_id

-   [Delete a Particular Book](http://127.0.0.1:8000/api/v1/books/:book_id) - DELETE - http://127.0.0.1:8000/api/v1/books/:book_id

## Built With

-   [Laravel](https://laravel.com) - The PHP framework for building the API endpoints needed for the application
-   [Ice and Fire](https://www.anapioficeandfire.com) - An API of Ice And Fire. All the data from the universe of Ice And Fire you've ever wanted!

## Acknowledgments

-   [Laravel](https://laravel.com) - The excellent documentation explaining how to get started with Laravel and Laravel Passport made it easy to provide a step by step guide for beginners to follow the application
-   [Ice and Fire](https://www.anapioficeandfire.com/Documentation) - Concise documentation
