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

/*Redirect function [this funtion accept parameters] v2.0
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
** Check items Function v1.0
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



/*
**Count Number of Items Function v1.0
**Function To Count of Items Rows
**$item = The Item To Count
**$table = The table To choose From
*/

function countItems($item, $table){
    global $con;
    $stmt2 = $con->prepare("SELECT COUNT($item) from $table");
    $stmt2->execute();
    return $stmt2->fetchColumn();
}


/*
**Get Lastest Records Function v1.0
**Function To Get the Latest Items From Database [Users, Items, Comments]
**$select =  Field To Select
**$table = The table To choose From
**$limit = Number Of the Records To Get
**$order = the id that wil will order the record from
*/

function getLatest($select, $table,$order, $limit=5){
    global $con;
    $getstmt = $con->prepare("SELECT $select from $table ORDER BY $order DESC LIMIT $limit");
    $getstmt->execute();
    return $getstmt->fetchAll();
}











?>