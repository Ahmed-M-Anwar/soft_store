<?php
session_start();
require('../includes/config.php');
require('../includes/functions.php');
require('../includes/file.class.php');
require('../includes/products.class.php');
$error='';
$success='';
if($_POST && count($_POST)>0){

    $title=$_POST['title'];
    $desc=$_POST['desc'];
    $price=$_POST['price'];
    $available=$_POST['product-availability'];
    if($available=='available'){
        $available=1;
    }else{
        $available=0;
    }
    /**
     * image insert 
     */
    $image=$_FILES['image']['name'];
    $file_err=$_FILES['image']['error'];
    $file_size=$_FILES['image']['size'];
    $file_type=$_FILES['image']['type'];
    $tmp=$_FILES['image']['tmp_name'];

    $f = new file($image);
    $err=$f->checkFile($file_size,$file_err,$file_type);
    if(strlen($err) == 0){
        if($f->moveFile($f->newName,$tmp) == false){
            $error='error in move file';
        }
        $image=$f->newName;
    }else{
            $error=$err;
    }
     /**
      * end image insert
     */  
    $userId=$_SESSION['user']['id'];
    
    if(!(strlen($error)>0)){
        $productObj=new products();
        $res=$productObj->addProduct($title,$desc,$image,$price,$available,$userId);
        if($res){
            $success='Product added successfully...';
        }else{
            $error='Error! Product Not Added.';
        }
    }
}
include('../templates/admin/add-product.html');