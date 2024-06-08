# Saas Project - MasterGym

my final thesis project with my friend @arisandiyudiarta.

MasterGym is management gym application with multi tenancy architecture system. user can create own dashboard to handle system gym on user business.

## Stack tech

`Laravel` as backend

`Vuejs` as frontend

`inertiajs` as interaction between backend and frontend stack

`Postgresql` as database

## Setup

Clone this project

```
git clone
```

Install depedencies

```
composer install && yarn install
```

copy .env.example

```
cp .env.example .env
```

generate key laravel

```
php artisan key:generate
```

migration and make seeder

```
php artisan migrate && php artisan db:seed
```

running a project

```
php artisan serve --port=80
yarn dev
```
