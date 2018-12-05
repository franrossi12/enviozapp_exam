
#Start Project
 
    in mysql -> CREATE DATABASE enviozapp_exam;
 ***
    php artisan key:generate
***
    php artisan migrate
***
    php artisan jwt:secret
***
    php artisan db:seed --class UsersTableSeeder
***
    php artisan db:seed --class DatabaseSeeder
***
    php artisan serve

# Test Credentials
*email*: admin@test.com

*password*: secret