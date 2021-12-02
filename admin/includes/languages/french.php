<?php 
function lang($phrase) {
    static $lang = array(
       'message' => 'bienvenue',
       'admin' => 'administrateur'  
    );
    return $lang[$phrase]; 
} 
?>