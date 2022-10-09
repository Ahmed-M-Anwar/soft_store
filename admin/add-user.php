<?php
session_start();
require('../includes/config.php');
require('../includes/users.class.php');
$error='';
$success='';
if($_POST && count($_POST)>0){

    $username=$_POST['username'];
    $password=$_POST['password'];
    $email=$_POST['email'];
    
    
    $userObj=new users();
    $res=$userObj->addUser($username,$password,$email);
    if($res){
        $success='User added successfully...';
    }else{
        $error='Erorr! User Not Added.';
    }
       
}
include('../templates/admin/add-user.html');