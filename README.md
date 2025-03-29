# General Notes

## about the view files

    every file endpoint in views must have its name ending with ".blade.php" to allow it to be founded by the laravel routes

## laravel crud

### important commands

#### start server
    php artisan serve

#### create or refresh the database
    php artisan migrate

#### install all the dependecies
    composer install

#### create new project (it only works on empty dir) (already done)
    composer create-project laravel/laravel .

#### create table, controller, models
    php artisan make:migration create_(table_name - needs to be lowerCase and in plural)_table
    php artisan make:controller PostController //any name you want
    php artisan make:model Post //it will only work if the table name match to the rules right above
