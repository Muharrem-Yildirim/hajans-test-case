# hajans-test-case

RESTful API for products. You can make test requests with `postman_collection.json` postman collection.

## Installation

1- Install packages

```Bash
composer install
```

2- Rename .env.example to .env and fill out credentials or create it manually

```Bash
DB_CONNECTION_STRING='mysql:host=localhost;dbname=hajans-test-case'
DB_USERNAME=root
DB_PASSWORD=''

API_KEY=test
```

3- Run `php src/Setup/setup.php` in command line to import SQL.
