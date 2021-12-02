<?php 
//database coonection route
include 'connect.php'; 
//routes 
$tpl    =   'includes/templates/'; //templates directory
$lang   =   'includes/languages/'; //Language Directory
$func   =   'includes/functions/'; //Function Directory
$css    =   'layout/css/'; //CSS Directory
$js     =   'layout/js/'; //Js Directory


//Include important files
include $func . 'functions.php';
include $lang . 'english.php';
include $tpl . 'header.php';

//Include navbar on all pages except the one with noNavbar variable (which is the index.php page ==> we don't need a navbar on it)
if (!isset($noNavbar)) { include $tpl . 'navbar.php';}
?>