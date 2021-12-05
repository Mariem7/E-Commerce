<?php 
//start the session
session_start();
if (isset($_SESSION['username'])){
    
    //the title of the page
    $pageTitle='Dashboard';
    include 'init.php'; 
     /*Start the Dashboard Page*/?>

    <div class="container3 home-stats">
        <h4>Dashboard</h4>
        <div class="row text-center">

            <div class="col-md-3">
                <div class="stat shadow-sm">
                    Total Members
                    <span>200</span>
                </div>
            </div>

            <div class="col-md-3">
                <div class="stat shadow-sm">
                    Pending Members
                    <span>400</span>
                </div>
            </div>

            <div class="col-md-3">
                <div class="stat shadow-sm">
                    Total Items
                    <span>210</span>
                </div>
            </div>

            <div class="col-md-3">
                <div class="stat shadow-sm">
                    Total Categories
                    <span>400</span>
                </div>
            </div>
   

                <div class="card col-md-6">
                    <div class="card-header">
                        <i class="fas fa-users"></i> Latest Registered Users
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Test</li>
                    </ul>
                </div>

                <div class="card col-md-6">
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
?>