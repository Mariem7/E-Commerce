<?php 
//start the session
session_start();
if (isset($_SESSION['username'])){
    
    //the title of the page
    $pageTitle='Dashboard';
    include 'init.php';
    print_r($_SESSION);

    include $tpl . 'footer.php';
} else { 
    header('Location: index.php');
    exit();
}
?>