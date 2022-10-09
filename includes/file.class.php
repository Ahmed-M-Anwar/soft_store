<?php

class file
{
    public $newName;

    
    public function __construct($name){
        $this->newName=md5(rand(1000,10000).date('u')).'_'.$name;
    }

    public function checkFile($size,$error,$type){
        $errors='';

         if($error == 4)
           $errors='No File Selected';
         
         if($type != 'image/png' && $type != 'image/jpeg' )
           $errors='Invalid File Uploade';

         

         if($size >(500*1024))
           $errors='Max File Size Is 500KB';

        return $errors;
    }

    public function moveFile($newName,$tmp){
        if(move_uploaded_file($tmp,'../upload/'.$newName)){
          return true;
        }else{
          return false;
        }
            
    }

}