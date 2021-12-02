<?php
/*
Manage the memebers page
You can Add | Edit | Delete Memebrs from this page
*/

//start the session
session_start();
//The name of the Page
$pageTitle='Members';

if (isset($_SESSION['username'])){
   
    include 'init.php';

    //the redirection of the page
    $do='';
    if (isset($_GET['do'])) {
        $do = $_GET['do'];
    }else{
        $do='Manage';
    }
    
    //Start the Manage Page
    if($do =='Manage'){
        //the Manage page

    }elseif ($do =='Edit'){ ?>
        <!--the Edit page -->
        

        <h1>helo edit</h1>

    <?php
    }elseif ($do =='Insert'){

        echo 'Welcome you are in the Insert category page';
    }

    include $tpl . 'footer.php';



} else { 
    header('Location: index.php');
    exit();
}

?>
