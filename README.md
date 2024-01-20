# steps

- is a PHP project  to learn basics of laravel

## How to start

```sh
composer create -project laravel/laravel name-project
```

```sh
php artisan serve
```

## Breeze to auth

```sh
composer require laravel/breeze --dev
```

```sh
php artisan  breeze:install blade --dark
```

## Create database

- on the file .env change the name of DB_DATABASE
- on DBMS create the database with the same name of before step
- on the explorer choose run migrations

## Lang

```sh
composer require laravel-lang/common --dev
```

- add support to espanish

```sh
php artisan lang:add es
```

- or support  to fr

```sh
php artisan lang:Add fr
```

> note: publish always lang on english for default

```sh
php artisan lang:publish
```

### config app.php to lang

- on 'locale' =>  'en' change to 'locale' => 'es'

### change welcome.blade.php

- in this file add lang on login and register
- for lang use the next sintax:

```php
{{__('name_variable')}}
```

### to add new translation or change translation

- change the file on  lang > language > language.json

## use env variables

- to create env variables add the variable on .env with the next sintax:

```sh
NAME_VARIABLE=VALUE
```

- to use env variables

```php
env('NAME_VARIABLE', 'DEFAULT_VALUE')
```

## best practice

- always add on .env.example when you add  new line on .env

## routing

- structure:

```php
Route::method('/url', function(){
    return //message or view(nameView);
});
```

- endpoint with params

```php
Route::method('/url/{param}', function($variable){
    return 'message'.$variable;
});
```

- optional params

```php
Route::method('/url/{param?}', function($variable = dafaultValue){
    return 'message'.$variable;
});
```

- redirect

```php
Route::method('/url/{param?}', function($variable){
    if($variable == value){
       return redirect('/url');
    }
    return 'message'.$variable;
});
```

- endpoint name

```php
Route::method('/url/{param}', function($variable){
    return 'message'.$variable;
})->name('name.index'); // .index .create .show is a convention
```

- redirect to endpoint name

```php
Route::method('/url/{param?}', function($variable){
    if($variable == value){
       return redirect()->route('name.index');
    }
    return 'message'.$variable;
});
```

or

```php
Route::method('/url/{param?}', function($variable){
    if($variable == value){
       return to_route('name.index');
    }
    return 'message'.$variable;
});
```

- only return a view

```php
Route::view('/url', 'view');
//or with name
Route::view('/url', 'view')->name('welcome');
```

- view all defined routes

```sh
php artisan route:list
```

- only on application

```sh
php artisan route:list --except-vendor
```

## const Home

- is a constant  route o endpoint to home in this case is '/dashboard'. is ubicate on file RouteServiceProvider

## middleware

- execute something after and before the route is executed

- how to use:

```php
Route::get('/url', function (){
    return //function, view o something
})->middleware(['beforeMiddleware', 'afterMiddleware'])->name('endpointName')
```

- inheritance middleware

```php
Route::middleware('nameMiddleware')->group(function(){
    Route::method('/url', action)->name('endpointName')
})
```

## navigation

- on file >resources>views>layouts>navigation.blade.php modify navigation links and responsive navigation menu to include new routes

## make model to db

- create migration and controller:

```sh
php artisan make:model Name -mrc
```

## execute migrations

- function up

```sh
php artisan migrate
```

- function down of the last lote

```sh
php artisan migrate:rollback
```

- function  down of the last #n of migrations

```sh
php artisan migrate:rollback --step=numberOfMigrations
```

## what is eloquent (app>Models)

- is a Laravel ORM

## assignable mass on models

- on app>Models>NameModel.php

```php
class NameModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'fillName1',
        'fillName2'
    ];
}
```

- how to use

```php
use App\Models\NameModel;

NameModel::operation([
    'fillName1'=>$variable,
    'fillName2'=>'value' // or num
]);
```

## styles and js

- on runtime

```sh
npm run dev
```

- compile styles (Note: Only compile the styles what are when exec the comand)

```sh
npm run build
```

## Session flash messages

- on routes

```php
Route::method('/url', function(){
    session()->flash('status','message');
    return to_route('name.index');
});
```

```php
Route::method('/url', function(){
    return to_route('name.index')->with('status','message'); //  __('message')
});
```

- on views

```php
@if(session('status'))
    <div class="">{{ session('status')}}</div>
@endif
```

## controlers

## errors

```sh
2024_01_19_222432_create_tweets_table ........... 30ms FAIL

   Illuminate\Database\QueryException

  SQLSTATE[42000]: Syntax error or access violation: 1064 You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '' at line 1 (Connection: mysql, SQL: alter table `tweets` add constraint `tweets_user_id_foreign` foreign key (`user_id`) references `users` (`id`) on delete )

  at vendor\laravel\framework\src\Illuminate\Database\Connection.php:822
    818▕                     $this->getName(), $query, $this->prepareBindings($bindings), $e
    819▕                 );
    820▕             }
    821▕
  ➜ 822▕             throw new QueryException(
    823▕                 $this->getName(), $query, $this->prepareBindings($bindings), $e
    824▕             );
    825▕         }
    826▕     }

  1   vendor\laravel\framework\src\Illuminate\Database\Connection.php:574
      PDOException::("SQLSTATE[42000]: Syntax error or access violation: 1064 You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '' at line 1")

  2   vendor\laravel\framework\src\Illuminate\Database\Connection.php:574
      PDO::prepare("alter table `tweets` add constraint `tweets_user_id_foreign` foreign key (`user_id`) references `users` (`id`) on delete ")
```

- solution:

````sql
alter table `tweets` add constraint `tweets_user_id_foreign` foreign key (`user_id`) references `users` (`id`) on delete cascade;
```

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
