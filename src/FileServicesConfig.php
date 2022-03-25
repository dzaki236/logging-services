<?php 
namespace Dzaki236\LoggingServices;

use Exception;

class FileServicesConfig extends FilesPatching{
   protected $file;
   /**
    * Constructor at services config
    * Constructor
    */
   public function __construct($filepath) {
      $this->file = "$filepath";
      if (!file_exists(public_path("$this->file"))) {
         # if spelling wrong or file not exsit
         throw new Exception("Error!, File not found".public_path("$this->file")." check again at spelling file,or check at your path / config path");
      }
   }
   
}