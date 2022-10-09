<?php
session_start();
require('../includes/config.php');
require('../includes/functions.php');
require('../includes/users.class.php');

if(checkLogin()){
    exit('you are already logged in !');
}
$error='';
$success='';
if(count($_POST)>0){

    $username=$_POST['username'];
    $password=$_POST['password'];

    $userObj=new users();
    $userData=$userObj->login($username,$password);
    if($userData && count($userData)>0 ){
        $_SESSION['user']=$userData;
        $success='logged in successfull to go to admin <a href="index.php">click here</a>';
    }else{
        $error= 'Please Enter Valied Data';
    }

}

include('../templates/admin/login.html');
?>
