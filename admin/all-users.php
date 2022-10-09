<?php
session_start();
require('../includes/config.php');
require('../includes/users.class.php');

$error='';
$userObj=new users();
$users=$userObj->getAllUsers();
if($users==null){
    $error='no any user to show';
}
include('../templates/admin/all-users.html');