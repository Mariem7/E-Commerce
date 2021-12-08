<?php
/*
**Manage the categories page
**You can Add | Edit | Delete categories from this page
*/

//start the session
session_start();
//The name of the Page
$pageTitle='Categories';

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
        //variable for the sort of the category
        $sort = 'DESC';
        $sort_array = array('ASC', 'DESC');
        if (isset($_GET['sort']) && in_array($_GET['sort'], $sort_array)){
            $sort = $_GET['sort'] ;
        }
        $stmt2 = $con->prepare("SELECT * FROM categories ORDER BY ordering $sort");
        $stmt2->execute();
        $cats = $stmt2 -> fetchAll();

        
        ?>
        <!--The manage page -->

        <div class="container-lg shadow-sm bg-white rounded">
                <h3>Manage Categories</h3>
                <div class="ordering">
                    Ordering: 
                    <a href="?sort=ASC" class="<?php if($sort == 'ASC'){echo 'active';}?>">ASC</a>
                    <a href="?sort=DESC" class="<?php if($sort == 'DESC') {echo 'active';}?>">DESC</a>
                </div>
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                        <?php
                        $i=0;
                        foreach($cats as $cat){
                            $i++;
                            echo "<button class='accordion-button' type='button' data-bs-toggle='collapse' data-bs-target='#" . $i ."' aria-expanded='true' aria-controls='" . $i . "'>". $cat['name'] ."</button>";
                            echo"</h2>";
                            
                            echo"<div id='" . $cat['categoryID'] . "' class='accordion-collapse collapse show' aria-labelledby='" . $i . "' data-bs-parent='#accordionExample'>";
                                echo"<div class='accordion-body'>";

                                    if($cat['description'] == ''){
                                        echo "<h5>This category has no description</h5>";
                                    }else{
                                        echo "<h5>". $cat['description'] ."</h5>";
                                    }
                            
                            echo "<h5>". $cat['ordering'] ."</h5>";
                            echo "<h5>". $cat['visibility'] ."</>";
                            echo "<h5>". $cat['allow_comments'] ."</h5>";
                            echo "<h5>". $cat['allow_ads'] ."</h5>";
                            echo "<span><a href ='categories.php?do=Edit&catid=" . $cat["categoryID"] . "' class='btn btn-success'><i class='fas fa-pen'></i></a>
                            <a href ='categories.php?do=Delete&catid=" . $cat["categoryID"] . "' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#exampleModal'><i class='fas fa-trash'></i></a>";
                            echo"</div>";
                            echo"</div>";
                        }
                    ?>
                    </div>
                </div>

            <a href="categories.php?do=Add" class="btn btn-secondary"><i class="fas fa-plus"></i> Add New Category</a>     
        </div>
    </div>

            
            <!-- Modal for the confirm of the user's delete-->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Do you want to confirm the delete of the category?
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
    
<?php }elseif ($do == 'Add'){ ?>
        <!--the Add category page-->
        <div class="container-sm shadow-sm bg-white rounded">
         <h3>Add New Category</h3>
         <hr>
            <form class="form2" action="?do=Insert" method="POST">

                <!--name field-->
                <div class="input-group flex-nowrap">
				<span class="input-group-text" id="addon-wrapping"><i class="fas fa-user"></i></span>
				<input type="text" name="name" class="form-control" placeholder="Name of the Category" aria-label="name" aria-describedby="addon-wrapping" required ="required">
				</div>

                 <!--description field-->
                 <div class="input-group flex-nowrap">
				<span class="input-group-text" id="addon-wrapping"><i class="fas fa-user"></i></span>
				<input type="text" name="description" class="form-control" placeholder="Describe the category" aria-label="description" aria-describedby="addon-wrapping">
				</div>

                <!--ordering field-->
				<div class="input-group flex-nowrap">
				<span class="input-group-text" id="addon-wrapping"><i class="fas fa-envelope"></i></span>
				<input type="text" name="ordering" class="form-control" placeholder="Ordering" aria-label="ordering" aria-describedby="addon-wrapping">
				</div>

                <!--visibility field-->
				<div class="input-group flex-nowrap">
				<span>Visible</span>
                    <div>
                        <input id="vis-yes" type="radio" name="visibility" value ="0" checked />
                        <label for ="vis-yes">Yes</label>
                    </div>
                    <div>
                        <input id="vis-no" type="radio" name="visibility" value ="1"/>
                        <label for ="vis-no"">No</label>
                    </div>
				</div>

                  <!--allow_comments field-->
				<div class="input-group flex-nowrap">
				<span>Allow Commenting</span>
                    <div>
                        <input id="com-yes" type="radio" name="commenting" value ="0" checked />
                        <label for ="com-yes">Yes</label>
                    </div>
                    <div>
                        <input id="com-no" type="radio" name="commenting" value ="1"/>
                        <label for ="com-no"">No</label>
                    </div>
				</div>

                  <!--allow_ads field-->
				<div class="input-group flex-nowrap">
				<span class="input-group-text" id="addon-wrapping">Allow Ads</span>
                    <div>
                        <input id="ads-yes" type="radio" name="ads" value ="0" checked />
                        <label for ="ads-yes">Yes</label>
                    </div>
                    <div>
                        <input id="ads-no" type="radio" name="ads" value ="1"/>
                        <label for ="ads-no"">No</label>
                    </div>
				</div>

                    <input type="submit" value="Add Category" class="btn btn-primary" />
            </form>
        </div>
    

    <?php
    }
//------------------------------------------------------The insert section---------------------------------------------------------------------

    elseif($do == 'Insert'){

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

        //The Insert page
        echo"<div class='container2 shadow-sm bg-white rounded'>";
        echo "<h2>Insert Category</h2>";

            // variables from the form
            $name       =   $_POST['name'];
            $desc       =   $_POST['description'];
            $order      =   $_POST['ordering'];
            $visible    =   $_POST['visibility'];
            $comment    =   $_POST['commenting'];
            $ads        =   $_POST['ads'];

             

                //check if the category exist in the database with our function checkItem
                $check = checkItem("name","categories",$name);
                if ($check == 1){
                    $theMsg = "<div class='alert alert-danger'>Sorry name already exists</div>";
                    redirectHome($theMsg,'Back');
                }else{

                //Insert Category fields into the database
                $stmt = $con ->prepare("INSERT INTO categories(name, description, ordering, visibility,allow_comments, allow_ads)
                 VALUES(:zname, :zdesc, :zorder, :zvisible, :zcomment, :zads)");
                $stmt->execute(array(
                    'zname' => $name, 'zdesc' => $desc, 'zorder' => $order,'zvisible' => $visible, 'zcomment' => $comment, 'zads' => $ads
                ));
                $theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Inserted </div>';
                redirectHome($theMsg, 'back');
            }

        }else{

            echo "<div class='container2'>";

            $theMsg ="<div class='alert alert-danger'>You cannot browser this page directly</div>";
            
            redirectHome($theMsg);
            
            echo "</div>";
            
        }

        echo"</>";
    }

//------------------------------------------------------The edit section---------------------------------------------------------------------

    elseif ($do =='Edit'){ 
        
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
        } else {
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
    }

    include $tpl . 'footer.php';

} else { 
    header('Location: index.php');
    exit();
}
?>
