# Book-app

## Tech
- [Laravel] - https://laravel.com/docs/10.x
- [Sqlite] - https://laravel.com/docs/10.x/database#sqlite-configuration

## Installation

Install the dependencies and start the server.

- add a .env file with the same configs off the .env.example

```sh
composer install
php artisan key:generate
php artisan jwt:secret
php artisan migrate
php artisan serve
```

For production environments

```sh
DB_CONNECTION=sqlite
DB_DATABASE=/database/database.sqlite
DB_HOST=127.0.0.1
DB_PORT=3306
DB_USERNAME=root
DB_PASSWORD=
```

## ROUTES
Prefix: /api

| NAME | METHOD | ROUTE |
| ------ | ------ | ------ |
| Create books | POST | /books 
| Get all books | GET | /books 
| Get book | GET | /books/{id}
| Edit books| PUT | /books/{id}
| Delete books| DELETE | /books /{id}
| Register | POST | /books 
| Login | POST | /books 
| Logout | POST | /books 

## EXAMPLES


Create a book:

```sh
POST api/book
{
    "name": "string",
    "isbn":"number",
    "value":"number"
}
```

Edit a book:

```sh
POST api/book/{id}
{
    "name": "string",
    "isbn":"number",
    "value":"number"
}
```

Register:

```sh
POST api/register
{
    "email": "string",
    "name": "string",
    "password": "string"
}
```

Login:

```sh
POST api/login
{
    "email": "string",
    "password":"string",
}
```



#### Header

Autrhorization: You need to use this authorization in the books request.

```sh
Authorization: Bearer {token jwt}
```


## License

MIT

**Free Software, Hell Yeah!**

