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


?>