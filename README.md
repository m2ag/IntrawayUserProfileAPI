# User Profile API

### Requirements 

 * PHP >= 5.6.4
 * OpenSSL PHP Extension
 * PDO PHP Extension
 * Mbstring PHP Extension
 * Tokenizer PHP Extension
 * XML PHP Extension
 * MySQL
 * Composer [https://getcomposer.org/](https://getcomposer.org/)

### Installation 

Download the github repository:

```sh
$ git clone https://github.com/m2ag/IntrawayUserProfileAPI.git
$ cd IntrawayUserProfileAPI/
$ composer install
```

Create a database in Mysql and rename the .env.example file to .env

```sh
$ mv .env.example .env
```

Open .env file and enter your database credentials.

```sh
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret
```

Run the following commands:

```sh
$ php artisan key:generate
$ php artisan migrate
$ php artisan serve
```

### Running with curl

For create a user

```sh
$ curl -H 'content-type: application/json' -v -X POST -d '{"id":"1","name":"James","email":"james@gmail.com","image":"jm10.png"}' http://127.0.0.1:8000/api/users 
```

For get a user

```sh
$ curl -H 'content-type: application/json' -v -X GET http://127.0.0.1:8000/api/users/1
```

For get all users

```sh
$ curl -H 'content-type: application/json' -v -X GET http://127.0.0.1:8000/api/users
```

For modify a user 

```sh
$ curl -H 'content-type: application/json' -v -X PUT -d '{"name":"James Rodriguez","email":"james.rodriguez@gmail.com","image":"james.png"}'  http://127.0.0.1:8000/api/users/1
```

For delete a user

```sh
curl -H 'content-type: application/json' -v -X DELETE http://127.0.0.1:8000/api/users/1
```


The log of the app is in:

```sh
$ cat storage/logs/laravel.log 
```

### Testing

Unit Tests are located in `./tests/Unit` directory. Tests can be executed by running

```sh
$ ./vendor/bin/phpunit --filter ApiTest 
```
