# logging-services

Package for logging activities, Simple to use!..

## Installation Step

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

## Add Provider `(some case it's step is optional)`

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

If you want to use a relationship to user on table on your logs table just add by the following code on models `LogActivity.php`:

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

# Change Limit of flush?

Some times you want to custom a value of limit on flushing log,
On folder `config` in laravel project at `logservices.php`,change by following code `(config/logservices.php)`:

```php
return [
    ....
   'flush' => TRUE,  // change this for activate / disactivated flush (default = true)
   'limit' => 1000, // change this for limit you want to flush
];
```

#

# How To Use?

First, add `__construct()` line at first of your controller example : `(UserController or whatever Controller it is)`;

```php
// use App\Services\LogActivitiesServices\MainLogActivitiesServices; // You can use namespacing like this at first line before class on contoller

   /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function __construct(MainLogActivitiesServices $logs) {
        ...
        $this->loging = $logs; // variable name (optional)
    
    }

    /*
    Or, just write the source like this by following code (without namespacing) :
    */

   /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function __construct(\App\Services\LogActivitiesServices\MainLogActivitiesServices $logs) {
        ...
        $this->loging = $logs; // variable name (optional)
    
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
|#| Parameter | Field | default |description|nullable|must added on parameters|
|:-:| :-: | :-: |:-:|:-:|:-:|:-:|
|1|status| true or false |true|if success parameter set to `true` the result will be `success`,but if `false` then result will be `failed`|no|yes|
|2|msglogs|string|string (not nullable) | message logs, write message according to the relevan conditions, but you want to |no|yes|
|3|flush|true or false|true|if true it will be activated flush|yes|no, but some case yes|
|4|limit flush|int (1-n)|1000|if true it will be activated flush|yes|no, but some case yes|
|5|dump|true or false|true|if true it will be stored to logactivities file |yes|no, but some case maybe you need|
### License

The MIT License (MIT). Please see [License]() File for more information, version of 2.0.2

##### `If had a problem or issue on older version,Please use of the latest version`
#
## More Feature's here!
# Custom File Config (Logging)
New update on 2.0.2 the author add new txt reader,you can use this for your custom log on your controller ^>,
First Step you must make config / log config txt file if do not,you will got error :).
## Example following by this bellow code : 
```php
public function store(Request $request)
    {
        //if
        $data = new Student($request->all());
        $con = $data->save();
        if ($con) {
            # code...
        $this->loging->activitylog(true,'add student data'); 
        // loging services this is optional, if you want to record a some log activities on your project but somehow you need it or not.

        /* try this */
        $config = new \Dzaki236\LoggingServices\FileServicesConfig('config.txt'); 
        // the models allowed a constructor to open a new config file (by default : at public path),jsust following the code.

        $config->fieldInsert($field,$fill);
        /*$field = Field To Scaffolding at txt file!*/
        /*$fill = fill this with value (default: request value)*/

        // For example anyway field id you can use at some case!..
        $config->fieldInsert(array('id','name','class','email'),array($data->id,$request->name,$request->class,$request->email));

            return redirect()->route('students.index')->with(['success'=>'Success!']);
        } else {
            # code...
        $this->loging->activitylog(false,'add student data'); // if had failure on proccess set to false
            return redirect()->route('students.index')->with(['error'=>'Failure!']);
        }

    }
```
By default at the version under 2.0.2 you cannot save a txt file of loging, but today you can!,by default at 2.0.2 you allowed to do a save some txt files,like example author had a input txt file on `logactivities.txt` at public file on laravel project!,but you can custom file or make a new path custom config, by use a boilerplate class construct,
All Function / Parameter at boilerplate Class,just by the following and see on this `can't be random fill!!, must be sequential`:
# On model ``FileServicesConfig`` `constructor` = `YES` !
|#| Function | Explanation | path of file on models constructor|Aliases|nullable|namespacing free|
|:-:| :-: | :-: |:-:|:-:|:-:|:-:|
|1|fieldInsert| This function to fill a txt or some config file on your public folder |public of `laravel_project/public` |`txt` and no more like than `txt`,just `txt` |True,if you want to make alias of object for sure! |yes,but somecase `no`|
#
### On `config.txt` file (example)
By default maybe you allowed to randomly fields but not recomended, at first you must fix, what field you want to fill,by default of your version.
```txt
name|class|email
jhondoe|12Ab|jhondoe@gmail.com
```

# Mistake's warning
Library has own stable test,if got error its maybe must check the code in twice, and now this is example code wrong and true
```php
# Wrong code

/*
* Do not use return something else before library loaded!.
* just see some an example's here
*/

# wrong example
... action ...
$data = Model::create($request->all());
return $data;
$this->logvariables->activitilog(true,'message logs here');
$files = new \Dzaki236\LoggingServices\FileServicesConfig('vendorlogs.txt');
$files->fieldInsert(['field1','field2','field3'],[$request->field1,$request->field2,$request->field3]);
}

# right example
... action ...
$data = Model::create($request->all());
$this->logvariables->activitilog(true,'message logs here');
$files = new \Dzaki236\LoggingServices\FileServicesConfig('vendorlogs.txt');
$files->fieldInsert(['field1','field2','field3'],[$request->field1,$request->field2,$request->field3]);
return $data;
}
```
Closure : ``You must done a some proses and you can return a result of you want``.

### License

The MIT License (MIT). Please see [License]() File for more information, version of 2.0.2
