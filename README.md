# Blog Example

This is a basic example of a blog created with Laravel 7 using Bootstrap 4.

## Getting Started

### Installing

* Clone or download this repository on your local machine.
* Run composer install to get all the necessary dependencies.
```
composer install
```
* You must also configure your database. After that, set up your .ENV file by adding the connection details from your database.
* Then run this command to migrate the database and seed it with fake and default data for testing purposes.
```
php artisan migrate --seed
```
* If you do not want to seed fake data for testing, it is recommended to create a default Administrator user with ID 1 and a default category, same as ID 1.
* You can do this by running the following commands.
```
php artisan migrate
```
```
php artisan db:seed --class=AdminUserSeeder
```
```
php artisan db:seed --class=CategoryTableSeeder
```

### Executing program

* You can log in with the default administrator details:
```
User: admin@blog-example.com
Password: password
```
* From there, you can import posts from any API endpoint in JSON format using only the URL from the Data Importer menu in the Admin Panel
