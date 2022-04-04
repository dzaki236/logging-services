<?php
namespace Dzaki236\LoggingServices;

use Illuminate\Support\Facades\Storage;

class FilesPatching
{
   /**
    * return @void
    */
   public function fieldInsert(array $fields, array $fill):void
   {
      # for insert by field!
      $file_ = file(public_path("$this->file"), FILE_IGNORE_NEW_LINES);
      if (!isset($file_[0])) {
         $field_ = '';
         foreach ($fields as $key => $field) {
            $field_ .= '|' . $field;
         }
         $field_ = substr($field_, 1);
         $files = fopen(public_path("$this->file"), 'a');
         fwrite($files, $field_);
         fclose($files);
         $format_ = '';
         foreach ($fill as $key => $fills) {
            $format_ .= '|' . $fills;
         }
         $formats_ = "\n" . substr($format_, 1);
         $files = fopen(public_path("$this->file"), 'a');
         fwrite($files, $formats_);
         fclose($files);
      } else {
         $format_ = '';
         foreach ($fill as $key => $fills) {
            # code...
            $format_ .= '|' . $fills;
         }
         $formats_ = "\n" . substr($format_, 1);
         $files = fopen(public_path("$this->file"), 'a');
         fwrite($files, $formats_);
         fclose($files);
      }
   }

   /**
    * insert data to file
    * 
    * return @void
    * 
    */
   public function insert(array $arr):void
   {
      $formats = '';
      foreach ($arr as $key => $value) {
         $formats .= '|' . $value;
      }
      $format = "\n" . substr($formats, 1);
      $files = fopen(public_path("$this->file"), 'a');
      fwrite($files, $format);
      fclose($files);
   }


   /**
    * return @void
    */
   public function secureFieldInsert(array $fields, array $fill):void
   {
      # for insert by field (Secured) Maybe will release later)!
      if (!Storage::exists($this->file)) {
         # code...
         throw new \Exception("File not found!,please run 'php artisan storage:link' to link your file, and create custom logging file on 'storage' folder on your laravel project");
      }
      $file_ = file(Storage::url("$this->file"), FILE_IGNORE_NEW_LINES);
      if (!isset($file_[0])) {
         $field_ = '';
         foreach ($fields as $key => $field) {
            $field_ .= '|' . $field;
         }
         $field_ = substr($field_, 1);
         $files = fopen(Storage::url("$this->file"), 'a');
         fwrite($files, $field_);
         fclose($files);
         $format_ = '';
         foreach ($fill as $key => $fills) {
            $format_ .= '|' . $fills;
         }
         $formats_ = "\n" . substr($format_, 1);
         $files = fopen(Storage::url("$this->file"), 'a');
         fwrite($files, $formats_);
         fclose($files);
      } else {
         $format_ = '';
         foreach ($fill as $key => $fills) {
            # code...
            $format_ .= '|' . $fills;
         }
         $formats_ = "\n" . substr($format_, 1);
         $files = fopen(Storage::url("$this->file"), 'a');
         fwrite($files, $formats_);
         fclose($files);
      }
   }
}
