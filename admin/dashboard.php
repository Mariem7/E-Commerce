<?php 

//the solution of the error of :Header already sent
ob_start(); //Output Buffering Start (buffreing all the output in the memory (except the header))

//start the session
session_start();
if (isset($_SESSION['username'])){
    
    //the title of the page
    $pageTitle='Dashboard';
    include 'init.php'; 

     /*Start the Dashboard Page*/?>

    <div class="container-lg home-stats">
        <h4>Dashboard</h4>
        <div class="row text-center">

            <div class="col-md-3">
                <a href ="members.php" class="link">
                    <div class="stat shadow-sm">
                        Total Members
                        <span><?php echo countItems('userId','users')?></span>
                    </div>
                </a>
            </div>

            <div class="col-md-3">
                <div class="stat shadow-sm">
                <a href ="members.php?do=Manage&page=Pending" class="link">
                    Pending Members
                    <span><?php echo checkItem("regStatus", "users", 0) ?></span>
                </a>
                </div>
            </div>

            <div class="col-md-3">
                <div class="stat shadow-sm">
                <a href ="items.php" class="link">
                    Total Items
                    <span><?php echo countItems('item_ID','items')?></span>
                </a>
                </div>
            </div>

            <div class="col-md-3">
                <div class="stat shadow-sm">
                    Total Categories
                    <span>400</span>
                </div>
            </div>
   

                <div class="card col-md-5" style="width: 40rem; margin-right:30px;">
                <?php $latestusers =5; ?> 
                    <div class="card-header">
                        <i class="fas fa-users"></i> Latest <?php echo $latestusers?> Registered Users
                    </div>
                    <ul class="list-group list-group-flush">
                        <?php 
                          $theLatest = getLatest("*","users","userID",$latestusers);
                          foreach($theLatest as $user){
                              echo '<li class="list-group-item">' .  $user['username'] . '</li>';
                          }
                        ?>
                    </ul>
                </div>

                <div class="card col-md-5" style="width: 40rem;">
                    <div class="card-header">
                        <i class="fas fa-tag"></i> Latest Items
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Test</li>
                    </ul>
                </div>
            </div>

     </div>




<?php
    /*End the Dashboard Page*/ 
    include $tpl . 'footer.php';
} else { 
    header('Location: index.php');
    exit();
}

ob_end_flush(); //send the output of the page
?>