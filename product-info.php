<?php
require('includes/config.php');
require('includes/products.class.php');

if(isset($_GET['id'])){
    
  $productOjc=new products();
  $product=$productOjc->getProduct($_GET['id']);

}
include('templates/product-info.html');