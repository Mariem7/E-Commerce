<?php

//Redirection of pages
//http://localhost/eCommerce/admin/page.php?do=Manage

$do='';
if (isset($_GET['do'])) {
    $do = $_GET['do'];
}else{
    $do='Manage';
}

//If the page is the main page
if($do =='Manage'){
    echo 'Welcome you are in the Manage category page';
}elseif ($do =='Add'){
    echo 'Welcome you are in the Add category page';
}elseif ($do =='Insert'){
    echo 'Welcome you are in the Insert category page';
}else{
    echo 'Error there\'s No page with this Name';
}

?>