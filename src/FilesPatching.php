<?php
namespace Dzaki236\LoggingServices;

class FilesPatching
{
   public function fieldInsert(array $fields, array $fill)
   {
      # code...
      $file_ = file(public_path("$this->file"), FILE_IGNORE_NEW_LINES);
      if (!isset($file_[0])) {
         # code...
         $field_ = '';
         foreach ($fields as $key => $field) {
            # code...
            $field_ .= '|' . $field;
         }
         $field_ = substr($field_, 1);
         $files = fopen(public_path("$this->file"), 'a');
         fwrite($files, $field_);
         fclose($files);
         $format_ = '';
         foreach ($fill as $key => $fills) {
            # code...
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
   public function insert(array $arr)
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
}
