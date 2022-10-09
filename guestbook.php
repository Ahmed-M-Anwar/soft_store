<?php
require('includes/config.php');
require('includes/messages.class.php');

$success='';
$error='';

$messageOjc=new messages();
$messages=$messageOjc->getAllMessages();

if($_POST && count($_POST)>0){

    $title=$_POST['title'];
    $content=$_POST['content'];
    $name=$_POST['name'];
    $email=$_POST['email'];
    
    
    $res=$messageOjc->addMessage($title,$content,$name,$email);
    if($res){
        $success='Message added successfully...';
    }else{
        $error='Erorr! Message Not Added.';
    }
       
}

include('templates/guestbook.html');