<?php
//start the session
session_start();
//unset the data of the session
session_unset(); 
//destroy the session
session_destroy();
//redirection of the user to the index page
header('Location: index.php');

exit();
?>