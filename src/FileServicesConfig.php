<?php

namespace Dzaki236\LoggingServices;

use Exception;

class FileServicesConfig extends FilesPatching
{
   protected $file;
   /**
    * Constructor at services config
    * Constructor
    */
   public function __construct($filepath)
   {
      $this->file = "$filepath";
      if (!file_exists(public_path("$this->file"))) {
         # if spelling wrong or file not exsit
         throw new Exception("Error!, File not found '" . public_path("$this->file") . "' check again at spelling file, or check at your path / config path");
      }
   }

   /**
    * Show By Id
    * @int id
    */
   public function showById(int $id)
   {
      $file = file(public_path("$this->file"), FILE_IGNORE_NEW_LINES);
      $iduser = $id;
      $data = [];
      $fields = explode('|', $file[0]);
      foreach ($file as $key => $files) {
         # code...
         $pecah = explode('|', $files);
         @$keys = $pecah[0];
         if ($keys == $iduser) {
            # code...
            $data = (array) $pecah;
         }
      }
      foreach ($data as $i => $datainjectable) {
         # code...
         $data_injectable[$fields[$i]] = $datainjectable;
      }
      $texts[] = $data_injectable;
      return json_encode($texts[0]);
   }

   /**
    * All void
    */
   public function all()
   {
      # code...
      $file = file(public_path("$this->file"), FILE_IGNORE_NEW_LINES);
      $data = [];
      foreach ($file as $key => $files) {
         # code...
         $pecah = explode('|', $files);
         $data[] = $pecah;
      }
      foreach ($data[0] as $field) {
         # code...
         $fields[] = $field;
      }
      foreach ($data as $i => $row) {
         # code...
         if ($i == 0) {
            # code...
            continue;
         }
         foreach ($fields as $k => $v) {
            # code...
            $data_injectable[$v] = $row[$k];
         }
         $texts[] = $data_injectable;
      }
      return json_encode($texts);
   }
}
