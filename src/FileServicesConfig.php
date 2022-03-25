<?php 
namespace Dzaki236\LoggingServices;
class FileServicesConfig extends FilesPatching{
   protected $file;
   public function __construct($filepath) {
      // $this->var = $var;
      $this->file = "$filepath";
   }
   
}