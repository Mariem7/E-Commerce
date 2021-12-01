<?php 
function lang($phrase) {
    static $lang = array(
       'message' => 'welcome',
       'admin' => 'administrator'  
       // homepage - settings 
    );
    return $lang[$phrase]; 
} 
?>