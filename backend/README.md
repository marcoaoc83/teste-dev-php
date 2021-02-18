#PUZL back-end 


## Tecnologia

- Laravel 8
- PHPUnit Test Case/Test Coverage
- Mysql

## Instalação

- composer install
- cp .env.example .env
- Update .env and set your database credentials
- php artisan key:generate
- php artisan migrate
- php artisan db:seed
- php artisan serve

## Install with Docker

- `docker-compose up -d`
- `php artisan migrate`
- `php artisan db:seed`
- `php artisan passport:install`

- DBhost: yourIP:3306, user: test, Password: test


## Unit Test

#### run PHPUnit

```bash
# run PHPUnit all test cases
vendor/bin/phpunit

