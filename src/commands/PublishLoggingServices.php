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
      // $publicDir = public_path();

      $migrations = file_get_contents(__DIR__ . '/../stubs/2022_01_01_000000_create_logs_table.stub');
      $this->createFile(database_path('migrations'),DIRECTORY_SEPARATOR.'2022_01_01_000000_create_logs_table.php',$migrations);
      $this->info('migrations file is published.');

      if (app()->version() > 8) {
         # code...
         $models = file_get_contents(__DIR__ . '/../stubs/ModelsLog.stub');
         $this->createFile(base_path().'/app/Models',DIRECTORY_SEPARATOR.'Log.php',$models);
         $this->info('model file is published.');
      }
      if (app()->version() < 8) {
         # code...
         $models = file_get_contents(__DIR__ . '/../stubs/Log.stub');
         $this->createFile(base_path().'/app',DIRECTORY_SEPARATOR.'Log.php',$models);
         $this->info('model file is published.');
      }
      $services = file_get_contents(__DIR__ . '/../stubs/MainLogServices.stub');
      $this->createFile(base_path().'/app/Services/LogServices',DIRECTORY_SEPARATOR.'MainLogServices.php', $services);
      $this->info('services file is published.');

      // $swTemplate = file_get_contents(__DIR__ . '/../stubs/sw.stub');
      // $this->createFile($publicDir . DIRECTORY_SEPARATOR, 'sw.js', $swTemplate);
      // $this->info('sw.js (Service Worker) file is published.');

      $this->info('Generating autoload files');
      $this->composer->dumpOptimized();
      $this->composer->dumpAutoloads();

      $this->info('Greeting!.. Enjoy...');
      $this->info('Success!, please run "php artisan migrate" to create table.');
   }

   public static function createFile($path, $fileName, $contents)
   {
      if (!file_exists($path)) {
         mkdir($path, 0755, true);
      }

      $path = $path . $fileName;

      file_put_contents($path, $contents);
   }
}
