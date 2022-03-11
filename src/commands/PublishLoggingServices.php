<?php

namespace Dzaki236\LoggingServices\commands;

use Illuminate\Support\Facades\File;
use Illuminate\Console\Command;

class PublishLoggingServices extends Command
{
   /**
    * The name and signature of the console command.
    *
    * @var string
    */
   protected $signature = 'logging-services:publish';

   /**
    * The console command description.
    *
    * @var string
    */
   protected $description = 'Publishing a logging services';

   public $composer;

   /**
    * Create a new command instance.
    */
   public function __construct()
   {
      parent::__construct();

      $this->composer = app()['composer'];
   }

   public function handle()
   {
      // Create new Migrations
      $migrations = file_get_contents(__DIR__ . '/../stubs/2022_01_01_000000_create_log_activities_table.stub');
      $this->createFile(database_path('migrations'),DIRECTORY_SEPARATOR.'2022_01_01_000000_create_log_activities_table.php',$migrations);
      $this->info('migrations file is published.');

      // Create new Model
      if (app()->version() > 8) {
         # code for version 8+...
         $models = file_get_contents(__DIR__ . '/../stubs/ModelsLogActivity.stub');
         $this->createFile(base_path().'/app/Models',DIRECTORY_SEPARATOR.'LogActivity.php',$models);
         $this->info('model file is published, check at "app/Models/LogActivity.php".');
      }

      if (app()->version() < 8) {
         # code for version 7+-...
         $models = file_get_contents(__DIR__ . '/../stubs/LogActivity.stub');
         $this->createFile(base_path().'/app',DIRECTORY_SEPARATOR.'LogActivity.php',$models);
         $this->info('model file is published, check at "app/LogActivity.php".');
      }

      // Create new Services
      $services = file_get_contents(__DIR__ . '/../stubs/MainLogActivitiesServices.stub');
      $this->createFile(base_path().'/app/Services/LogServices',DIRECTORY_SEPARATOR.'MainLogActivitiesServices.php', $services);
      $this->info('services file is published.');

      $this->info('Generating autoload files');
      $this->composer->dumpOptimized();
      $this->composer->dumpAutoloads();

      $this->info('Greeting!.. Enjoy...');
      $this->info('Success!, please run "php artisan migrate" or "php artisan migrate:fresh --seed" to create new logs table.');
   }

   public static function createFile($path, $fileName, $contents,bool $extends = true)
   {
      if (!file_exists($path)) {
         mkdir($path, 0755, true);
      }

      $path = $path . $fileName;

      file_put_contents($path, $contents);
   }
}
