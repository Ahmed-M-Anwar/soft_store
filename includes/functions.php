<?php

/**
 * check login user 
 */
function checkLogin(){
    return isset($_SESSION['user'])? true : false;
}