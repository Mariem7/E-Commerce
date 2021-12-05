<?php

//Title function that echo the page title 
function getTitle(){
    //global variable
    global $pageTitle;
    if (isset($pageTitle)){
        echo $pageTitle;
    }else{
        echo 'Default';
    }
}

/*Redirect function [this funtion accept parameters]
**$theMsg = echo the message [Error | Success | Warning]
**$url = the link you want to redirect to
**$seconds = seconds before redirecting
*/

function redirectHome($theMsg, $url = null, $seconds=3){

    if ($url == null){
        $url = 'index.php';
        $link ='Home Page';
    }else{
        if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== ''){
            //redirection to the previous page that you had visited before
            $url = $_SERVER['HTTP_REFERER'];
            
        }else{
            $url ='index.php';
        }
        $link ='Previous Page';
    }
    echo $theMsg;
    echo "<div class='alert alert-info'>You will be redirected to the $link page after $seconds.</div>";
    header("refresh:$seconds;url=$url");
    exit();
}

/*
** Check items Function
** Function to check item in database [function accept parameters]
**$select = the item to select [Example: user, item, category]
**$from = the table to select from [Example: users, items, categories]
**$value= the value of select [Example: Maryem, box, electronics]
*/

function checkItem($select, $from, $value){
    global $con;
    $statement = $con->prepare("SELECT $select FROM $from WHERE $select = ?");
    $statement->execute(array($value));
    $count = $statement->rowCount();
    return $count;
}


?>