<?php 
namespace Dzaki236\LoggingServices;

use Exception;

class FileServicesConfig extends FilesPatching{
   protected $file;
   public function __construct($filepath) {
      $this->file = "$filepath";
      if (!file_exists(public_path("$this->file"))) {
         # code...
         throw new Exception("File not found".public_path("$this->file")." check again at spelling file,or check at your path / config path");
      }
   }
   
}