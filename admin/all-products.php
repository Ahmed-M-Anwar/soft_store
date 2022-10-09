<?php
session_start();
require('../includes/config.php');
require('../includes/functions.php');
require('../includes/products.class.php');

$error='';
$productOjc=new products();
$products=$productOjc->getAllProducts();
if($products==null){
    $error='no any products to show';
}



include('../templates/admin/all-products.html');