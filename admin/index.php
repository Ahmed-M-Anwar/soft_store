<?php
session_start();
require('../includes/functions.php');

if(!checkLogin())
   exit(' you must Login first to login <a href="login.php">click here</a>!!');

include('../templates/admin/index.html');