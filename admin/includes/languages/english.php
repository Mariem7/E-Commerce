<?php 
function lang($phrase) {
    static $lang = array(
        
       // Dashboard phrases
       'HOME_ADMIN'     => 'Home',
       'CATEGORIES'     => 'Categories',
       'ITEMES'         => 'Items',
       'MEMBERS'        => 'Members',
       'STATICTICS'     => 'Statistics',
       'LOGS'           => 'Logs'
    );
    return $lang[$phrase]; 
} 
?>