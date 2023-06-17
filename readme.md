# Dental CRM



## Installation

Clone the repo locally:

```sh
git git@github.com:bibin0baby/dental-crm.git
cd dental-crm
```

Install PHP dependencies:

```sh
composer install
```

Install NPM dependencies:

```sh
npm ci
```

Build assets:

```sh
npm run dev
```

Setup configuration:

```sh
cp .env.example .env
```

Generate application key:

```sh
php artisan key:generate
```

Create an SQLite database. You can also use another database (MySQL, Postgres), simply update your configuration accordingly.

```sh
touch database/database.sqlite
```

Run database migrations:

```sh
php artisan migrate
```

Run database seeder:

```sh
php artisan db:seed
```

Run the dev server (the output will give the address):

```sh
php artisan serve
```

You're ready to go! Visit Dental CRM in your browser, and login with:

- **Username:** johndoe@example.com
- **Password:** secret

## Running tests

To run the Dental CRM tests, run:

```
phpunit
```
