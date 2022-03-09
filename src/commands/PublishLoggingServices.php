<?php

namespace Dzaki236\LoggingServices\Commands;

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

      $manifestTemplate = file_get_contents(__DIR__ . '/../stubs/2022_01_01_000000_create_logs_table.stub');
      $this->createFile(database_path('migrations'),DIRECTORY_SEPARATOR,'2022_01_01_000000_create_logs_table.php',$manifestTemplate);
      $this->info('migrations file is published.');

      // $offlineHtmlTemplate = file_get_contents(__DIR__ . '/../stubs/offline.stub');
      // $this->createFile($publicDir . DIRECTORY_SEPARATOR, 'offline.html', $offlineHtmlTemplate);
      // $this->info('offline.html file is published.');

      // $swTemplate = file_get_contents(__DIR__ . '/../stubs/sw.stub');
      // $this->createFile($publicDir . DIRECTORY_SEPARATOR, 'sw.js', $swTemplate);
      // $this->info('sw.js (Service Worker) file is published.');

      $this->info('Generating autoload files');
      $this->composer->dumpOptimized();

      $this->info('Greeting!.. Enjoy Logging...');
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
