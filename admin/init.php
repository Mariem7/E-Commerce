<?php 
//database coonection route
include 'connect.php'; 
//routes 
$tpl='includes/templates/'; //templates directory
$css = 'layout/css/'; //CSS Directory
$js = 'layout/js/'; //Js Directory
$lang= 'includes/languages/'; //Language Directory

//Include important files

include $lang . 'english.php';
include $tpl . 'header.php';

//Include navbar on all pages except the one with noNavbar variable
if (!isset($noNavbar)) { include $tpl . 'navbar.php';}

?>