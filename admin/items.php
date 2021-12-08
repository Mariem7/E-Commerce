<?php
/*
**Manage the Items page
**You can Add | Edit | Delete items from this page
*/

//start the session
session_start();
//The name of the Page
$pageTitle='Items';

if (isset($_SESSION['username'])){
   
        include 'init.php';

        //the redirection of the page
        $do='';
        if (isset($_GET['do'])) {
            $do = $_GET['do'];
        }else{
            $do='Manage';
        }
        
    //------------------------------------------------------The manage section---------------------------------------------------------------------

    
    if($do =='Manage'){
     //Start the Manage Page   
       
        //select
        $stmt = $con->prepare("SELECT * FROM items");
        $stmt->execute();
        $items = $stmt-> fetchAll();

        
        ?>
        <!--The manage page -->

        <div class="container2 shadow-sm bg-white rounded">
            <div>
                <h3>Manage Items</h3>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered text-center shadow-sm bg-white rounded">
                    <thead>
                     <tr>
                        <td>#ID</td>
                        <td>Name</td>
                        <td>Description</td>
                        <td>Price</td>
                        <td>Adding date</td>
                        <td>Control</td>
                    </tr>   
                    </thead>
                    
                    <?php
                        foreach($items as $item){
                            echo "<tr>";
                            echo "<td>". $item['item_ID'] ."</td>";
                            echo "<td>". $item['name'] ."</td>";
                            if($item['description'] == ''){
                                echo "<td>This category has no description</td>";
                            }else{
                                echo "<td>". $item['description'] ."</td>";
                            }
                            
                            echo "<td>". $item['price'] ."</td>";
                            echo "<td>". $item['add_date'] ."</td>";
                            echo "<td><a href ='items.php?do=Edit&itemid=" . $item["item_ID"] . "' class='btn btn-success'><i class='fas fa-pen'></i></a>
                            <a href ='items.php?do=Delete&itemid=" . $item["item_ID"] . "' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#exampleModal'><i class='fas fa-trash'></i></a>";
                            echo"</td>";
                            echo "</tr>";
                        }
                    ?>
                </table>
            </div>

            <a href="items.php?do=Add" class="btn btn-secondary"><i class="fas fa-plus"></i> Add New Item</a>     

            
            <!-- Modal for the confirm of the user's delete-->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Do you want to confirm the delete of the item?
                </div>
                <div class="modal-footer">
                    <?php echo  "<button type='button' class='btn btn-success'> <a href ='categories.php?do=Delete&catid=" . $cat['categoryID'] . "' style= 'text-decoration:none; color:#fff;'>Yes</a></button> "?> 
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                </div>
                </div>
            </div>
            </div>
        </div>


<!-----------------------------------------------------------------------the Add section--------------------------------------------------------------->
    
<?php } elseif ($do == 'Add'){ ?>
        <!--the Add category page-->
        <div class="container-sm shadow-sm bg-white rounded">
         <h3>Add New Item</h3>
         <hr>
            <form class="form2" action="?do=Insert" method="POST">

                <!--name field-->
                <div class="input-group flex-nowrap">
				<span class="input-group-text" id="addon-wrapping"><i class="fas fa-user"></i></span>
				<input type="text" name="name" class="form-control" placeholder="Name of the Item" aria-label="name" aria-describedby="addon-wrapping" required ="required">
				</div>

                 <!--description field-->
                 <div class="input-group flex-nowrap">
				<span class="input-group-text" id="addon-wrapping"><i class="fas fa-user"></i></span>
				<input type="text" name="description" class="form-control" placeholder="Describe the item" aria-label="description" aria-describedby="addon-wrapping">
				</div>

                <!--price field-->
				<div class="input-group flex-nowrap">
				<span class="input-group-text" id="addon-wrapping"><i class="fas fa-envelope"></i></span>
				<input type="text" name="price" class="form-control" placeholder="Price" aria-label="ordering" aria-describedby="addon-wrapping">
				</div>

                <!--country_made field-->
				<div class="input-group flex-nowrap">
				<span class="input-group-text" id="addon-wrapping"><i class="fas fa-envelope"></i></span>
				<input type="text" name="country" class="form-control" placeholder="Country of Made" aria-label="ordering" aria-describedby="addon-wrapping">
				</div>

                <!--Status field-->
				<div class="input-group flex-nowrap">
				<span class="input-group-text" id="addon-wrapping"><i class="fas fa-envelope"></i></span>
                    <select class="from-control" name="status">
                        <option value ="0">...</option>
                        <option value ="1">New</option>
                        <option value ="2">Like New</option>
                        <option value ="3">Used</option>
                        <option value ="4">Old</option>
                    </select>
				</div>

                <!--member field-->
				<div class="input-group flex-nowrap">
				<span class="input-group-text" id="addon-wrapping"><i class="fas fa-envelope"></i></span>
                    <select class="from-control" name="member">
                        <option value ="0">...</option>
                            <?php 
                            $stmt = $con-> prepare("SELECT * FROM users");
                            $stmt->execute();
                            $users = $stmt->fetchAll();
                            foreach($users as $user){
                                echo "<option value ='" . $user['userID'] . "'>" . $user['username'] . "</option>";
                            } 
                            ?>
                    </select>
				</div>

                <!--category field-->
				<div class="input-group flex-nowrap">
				<span class="input-group-text" id="addon-wrapping"><i class="fas fa-envelope"></i></span>
                    <select class="from-control" name="category">
                        <option value ="0">...</option>
                            <?php 
                            $stmt2 = $con-> prepare("SELECT * FROM categories");
                            $stmt2 ->execute();
                            $cats = $stmt2->fetchAll();
                            foreach($cats as $cat){
                                echo "<option value ='" . $cat['categoryID'] . "'>" . $cat['name'] . "</option>";
                            } 
                            ?>
                    </select>
				</div>

                    <input type="submit" value="Add Item" class="btn btn-primary" />
            </form>
        </div>
    

    <?php
    }
//------------------------------------------------------The insert section---------------------------------------------------------------------

    elseif($do == 'Insert'){

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            //The Insert page
            echo"<div class='container2 shadow-sm bg-white rounded'>";
            echo "<h2>Insert Item</h2>";

            // variables from the form
            $name       =   $_POST['name'];
            $desc       =   $_POST['description'];
            $price      =   $_POST['price'];
            $country    =   $_POST['country'];
            $status     =   $_POST['status'];
            $member     =   $_POST['member'];
            $cat        =   $_POST['category'];

                //Validate the Form
                $fromErrors = array();
                if (empty($name)){
                    $fromErrors[] = 'The name cannot be <strong>empty</strong>';
                }

                if (empty($desc)){
                    $fromErrors[] = 'The description cannot be <strong>empty</strong>';
                }

                if (empty($price)){
                    $fromErrors[] = 'The price cannot be <strong>empty</strong>';
                }

                if (empty($country)){
                    $fromErrors[] = 'The country cannot be <strong>empty</strong>';
                }

                if ($status == 0){
                    $fromErrors[] = 'You must choose the<strong>Status</strong>';
                }

                if ($member == 0){
                    $fromErrors[] = 'You must choose the<strong>Member</strong>';
                }

                if ($cat == 0){
                    $fromErrors[] = 'You must choose the<strong>Category</strong>';
                }

                //loop for the errors
                foreach($fromErrors as $error){
                    echo '<div class="alert alert-danger">' . $error . '</div>';
                }

                //If there is no error so you can add this member to the database            
                if(empty($fromErrors)){

                    //Insert the form fields into the database
                    $stmt = $con ->prepare("INSERT INTO items(name, description, price, country_made,status, add_date, cat_id, member_id)
                     VALUES(:zname, :zdesc, :zprice, :zcountry, :zstatus, now(), :zcat, :zmember)");
                    $stmt->execute(array(
                        'zname'     => $name,
                        'zdesc'     => $desc,
                        'zprice'    => $price,
                        'zcountry'  => $country,
                        'zstatus'   => $status,
                        'zcat'      => $cat,
                        'zmember'   => $member                    
                    ));

                    $theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Inserted </div>';
                    redirectHome($theMsg, 'back');
                }
        }

    }else{
        echo "<div class='container2'>";
        $theMsg ="<div class='alert alert-danger'>You cannot browser this page directly</div>";
        redirectHome($theMsg);
        echo "</div>";  
    }
        echo"</>";
    

               

//------------------------------------------------------The edit section---------------------------------------------------------------------

   }elseif ($do =='Edit'){ 
        
        //for the security (we need to verify that the id in the url is a number not a string)
        $catid = isset($_GET['catid']) && is_numeric($_GET['catid']) ? intval($_GET['catid']) : 0;
        $stmt = $con->prepare("select * from categories where categoryID  = ? LIMIT 1");
        //execute the select request
        $stmt->execute(array($catid));
        //bring the data from the select request and save it in the row variable
        $cat= $stmt->fetch();
        //count the number of the row in the select request
        $count = $stmt->rowCount();
        // if count > 0 this means the database contains a record about this username 

        if ($count > 0 ) { ?>
        <!--the Edit page -->
       
        <!--the Add category page-->
        <div class="container-sm shadow-sm bg-white rounded">
         <h3>Edit Category</h3>
         <hr>
            <form class="form2" action="?do=Update" method="POST">
                <input type="hidden" name="catid" value="<?php echo $catid?>">
                <!--name field-->
                <div class="input-group flex-nowrap">
				<span class="input-group-text" id="addon-wrapping"><i class="fas fa-user"></i></span>
				<input type="text" name="name" class="form-control" placeholder="Name of the Category" aria-label="name" aria-describedby="addon-wrapping" required ="required" value="<?php echo $cat['name'] ?>">
				</div>

                 <!--description field-->
                 <div class="input-group flex-nowrap">
				<span class="input-group-text" id="addon-wrapping"><i class="fas fa-user"></i></span>
				<input type="text" name="description" class="form-control" placeholder="Describe the category" aria-label="description" aria-describedby="addon-wrapping" value="<?php echo $cat['description'] ?>">
				</div>

                <!--ordering field-->
				<div class="input-group flex-nowrap">
				<span class="input-group-text" id="addon-wrapping"><i class="fas fa-envelope"></i></span>
				<input type="text" name="ordering" class="form-control" placeholder="Ordering" aria-label="ordering" aria-describedby="addon-wrapping" value="<?php echo $cat['ordering'] ?>">
				</div>

                <!--visibility field-->
				<div class="input-group flex-nowrap">
				<span>Visible</span>
                    <div>
                        <input id="vis-yes" type="radio" name="visibility" value ="0" <?php if ($cat['visibility'] == 0) {echo 'checked';} ?> />
                        <label for ="vis-yes">Yes</label>
                    </div>
                    <div>
                        <input id="vis-no" type="radio" name="visibility" value ="1" <?php if ($cat['visibility']== 1) {echo 'checked';} ?> />
                        <label for ="vis-no"">No</label>
                    </div>
				</div>

                  <!--allow_comments field-->
				<div class="input-group flex-nowrap">
				<span>Allow Commenting</span>
                    <div>
                        <input id="com-yes" type="radio" name="commenting" value ="0" <?php if ($cat['allow_comments'] == 0) {echo 'checked';} ?> />
                        <label for ="com-yes">Yes</label>
                    </div>
                    <div>
                        <input id="com-no" type="radio" name="commenting" value ="1" <?php if ($cat['allow_comments'] == 1) {echo 'checked';} ?>/>
                        <label for ="com-no"">No</label>
                    </div>
				</div>

                  <!--allow_ads field-->
				<div class="input-group flex-nowrap">
				<span class="input-group-text" id="addon-wrapping">Allow Ads</span>
                    <div>
                        <input id="ads-yes" type="radio" name="ads" value ="0" <?php if ($cat['allow_ads'] == 0) {echo 'checked';} ?>/>
                        <label for ="ads-yes">Yes</label>
                    </div>
                    <div>
                        <input id="ads-no" type="radio" name="ads" value ="1" <?php if ($cat['allow_ads'] == 1) {echo 'checked';} ?> />
                        <label for ="ads-no"">No</label>
                    </div>
				</div>

                    <input type="submit" value="Save Category" class="btn btn-primary" />
            </form>
        </div>
    

    <?php
        }else{
            //If there is no such ID then show this error message
            echo "<div class='container2'>";
            $theMsg= '<div class="alert alert-danger">There is no such id</div>';
            redirectHome($theMsg);
            echo "</div>";
        }

//------------------------------------------------------The update section---------------------------------------------------------------------

    }elseif ($do =='Update'){

        //The update page
        echo"<div class='container2 shadow-sm bg-white rounded'>";
        echo "<h2>Update Member</h2>";

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

             // variables from the form
             $id         =   $_POST['catid'];
             $name       =   $_POST['name'];
             $desc       =   $_POST['description'];
             $order      =   $_POST['ordering'];
             $visible    =   $_POST['visibility'];
             $comment    =   $_POST['commenting'];
             $ads        =   $_POST['ads'];

    

                $stmt = $con->prepare("UPDATE categories SET name =?, description =?, ordering =? , visibility = ? , allow_comments =?, allow_ads=?  where categoryID  = ?");
                //execute the update request
                $stmt->execute(array($name, $desc, $order, $visible, $comment, $ads, $id));
                //Success update
                $theMsg= "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record updated </div>';

                redirectHome($theMsg, 'back');

        }else{
            $theMsg= '<div class="alert alert-danger">You cannot browser this page directly</div>';
            redirectHome($theMsg);
        }

        echo"</div>";

//------------------------------------------------------The delete section---------------------------------------------------------------------

    }elseif( $do == 'Delete'){ 
        //Delete member page
        //The update page
            echo"<div class='container2 shadow-sm bg-white rounded'>";
            echo "<h2>Delete Category</h2>";
            //for the security (we need to verify that the id in the url is a number not a string)
            $catid = isset($_GET['catid']) && is_numeric($_GET['catid']) ? intval($_GET['catid']) : 0;

            //check if this category exists in database
            $check = checkItem('categoryID','categories', $catid);

            if ($check > 0){
            $stmt = $con->prepare("DELETE FROM categories WHERE categoryID = :zuser");
            $stmt->bindParam(":zuser", $catid);
            $stmt->execute();
            $theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Deleted </div>';
            redirectHome($theMsg);
            }else{
                $theMsg = "<div class='alert alert-danger'>This ID doesn't exist</div>";
                redirectHome($theMsg);
            }
        echo "</div>";


    }elseif ($do == 'Activate'){

        echo"<div class='container2 shadow-sm bg-white rounded'>";
            echo "<h2>Ativate Member</h2>";
            //for the security (we need to verify that the id in the url is a number not a string)
            $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;

            //check if this user exists in database
            $check = checkItem('userId','users', $userid);

            if ($check > 0){
            $stmt = $con->prepare("UPDATE users SET regStatus = 1 WHERE userID =  ?");
            $stmt->execute(array($userid));
            $theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Activated </div>';
            redirectHome($theMsg);
            }else{
                $theMsg = "<div class='alert alert-danger'>This ID doesn't exist</div>";
                redirectHome($theMsg);
            }
    
        echo "</div>";
    
    }elseif($do =='Approve'){

    

    include $tpl . 'footer.php';

    }else{ 
        header('Location: index.php');
        exit();
    }


?>
