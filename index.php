<?php
require('includes/config.php');
require('includes/products.class.php');

$products=[];
$productOjc=new products();
$result=$productOjc->getAllProducts();
$len=count($result);
if($len>0){
    $i=0;
    while($len>0 && $i<3 ){
        $products[$i]=$result[(count($result)-($i+1))];
        $i++;
        $len--;
    }
}



include('templates/index.html');