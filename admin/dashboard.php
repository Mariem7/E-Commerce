<?php 
session_start();
if (isset($_SESSION['username'])){
    
    include 'init.php';
    include $tpl . 'footer.php';
} else { 
    header('Location: index.php');
    exit();
}

?>