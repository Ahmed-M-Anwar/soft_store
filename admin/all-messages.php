<?php
session_start();
require('../includes/config.php');
require('../includes/messages.class.php');

$error='';
$mesageObj=new messages();
$messages=$mesageObj->getAllMessages();
if($messages==null){
    $error='no any message to show';
}
include('../templates/admin/all-messages.html');