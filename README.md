# logging-services

Package for logging,simple to use!..

## Installation

Install the package by the following command,

```
$ composer require dzaki236/logging-services
```
#
## Dump Autoloading

Autoloading the package by the following command,

```
$ composer dump-autoload
```
#
## Add Provider

Add the provider to your `config/app.php` into `provider` section if using lower version of laravel,

```
'providers' => [
   ...
   /*
   * Package Service Providers...
   */

   Dzaki236\LoggingServices\LoggingServicesServiceProvider::class,
   ...
]
```
#
## Add Facade `(this is optional part)`

Add the Facade to your `config/app.php` into `aliases` section on the last part,

```
'aliases'=>[
   ...
   'LoggingServices'=>Dzaki236\LoggingServices\LoggingServices::class,
]
```
#
## Publish the Assets

Run the following command to publish config file,

```
$ php artisan logging-services:publish
```
#
## Run migration

if you want to use a table on your logs just run :

```
$ php artisan migrate
```

or if you want to reset all of your migrations `(with your data seeder)`,  just run :

```
$ php artisan migrate:fresh --seed
```

### License

The MIT License (MIT). Please see [License]() File for more information
