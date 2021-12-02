<?php 
//connect to database
$dsn ='mysql:host=localhost;dbname=shop'; //data source name
$user = 'root';
$pass='';
$option = array(
// for the pdo = php data objects
PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' ,
);

try {
    $con = new PDO($dsn,$user,$pass,$option);
    $con -> setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
    echo "<script >console.log('You have been successfully connected to database');</script>";
}
catch(PDOException $e){
    echo "<script>console.log('Failed to connect to database');</script>" ;

}

?>