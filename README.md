# logging-services

Package for logging activities,simple to use!..

## Installation

Install the package by the following command,

```bash
$ composer require dzaki236/logging-services
```

#

## Dump Autoloading

Autoloading the package by the following command,

```bash
$ composer dump-autoload
```

#

## Add Provider

Add the provider to your `config/app.php` into `provider` section if using lower version of laravel,

```php
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

```php
'aliases'=>[
   ...
   'LoggingServices'=>Dzaki236\LoggingServices\LoggingServices::class,
]
```

#

## Publish the Assets

Run the following command to publish config file,

```bash
$ php artisan logging-services:publish
```

#

## Run migration

if you want to use a table on your logs just run :

```bash
$ php artisan migrate
```

Or if you want to reset all of your migrations `(with your data seeder)`, just run :

```bash
$ php artisan migrate:fresh --seed
```

#

## Relationship `(Optional Part)`

If you want to use a relationship to user on table on your logs table just add by the following code on `Log.php`:

### Version 7+-

```php
public function user()
    {
        # code...
        return $this->belongsTo('App\User','user_id');
    }
```

### Version 8.x+

```php
public function user()
    {
        # code...
        return $this->belongsTo(User::class,'user_id');
    }
```

Don't forget to add this stuff (namespacing) at first line `(before class on model)` on relationship:

```php
use App\Models\User;
```

And then if you want to use `(eager-loading)` ,example on code:

```php
LogActivity::with('user')->all();
```

#

# How To Use?

First, add `__construct()` line at first of your controller example : `(UserController or whatever Controller it is)`;

```php
// use App\Services\LogServices\MainLogActivitiesServices; // You can use namespacing like this at first line before class on contoller

   /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function __construct(MainLogActivitiesServices $logs) {
        $this->loging = $logs;
    }

    Or, just write the source like this by following code :

   /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function __construct(\App\Services\LogServices\MainLogActivitiesServices $logs) {
        $this->loging = $logs;
    }
```

Second, example on `(UserController Or Controller You have)`, add code by the following code :

```php
// Example at store function on controller
public function store(Request $request)
    {
        //if
        $data = new Student($request->all());
        $con = $data->save();
        if ($con) {
            # code...
        $this->loging->activitylog(true,'add student data'); // if success set to true
            return redirect()->route('students.index')->with(['success'=>'Success!']);
        } else {
            # code...
        $this->loging->activitylog(false,'add student data'); // if had failure on proccess set to false
            return redirect()->route('students.index')->with(['error'=>'Failure!']);
        }

    }

// Example at update function on controller
    public function update($id,Request $request)
    {
        //if
        $data = Student::find($id)
        $data->update($request->all());
        $con = $data->save();
        if ($con) {
            # code...
        $this->loging->activitylog(true,'success update student data'); // if success set to true
            return redirect()->route('students.index')->with(['success'=>'Success!']);
        } else {
            # code...
        $this->loging->activitylog(false,'failure update student data'); // if had failure on proccess set to false
            return redirect()->route('students.index')->with(['error'=>'Failure!']);
        }

    }
```
#
# Function Parameter
All Function Parameter by the following and fill on this `can't be random fill!!, must be sequential`:
|#| Parameter | Field | default |description|nullable|
|:-:| :-: | :-: |:-:|:-:|:-:|
|1|status| true or false |true|if success parameter set to `true` the result will be `success`,but if `false` then result will be `error`|no|
|2|msglogs|string|string (not nullable) | message logs, write message according to the relevan conditions, but you want to |no|
|3|flush|true or false|true|if the data is more than equal to 10000 it will be deleted automatically|yes|

### License

The MIT License (MIT). Please see [License]() File for more information
