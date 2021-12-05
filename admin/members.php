<?php
/*
**Manage the memebers page
**You can Add | Edit | Delete Memebrs from this page
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
    
//------------------------------------------------------The manage section---------------------------------------------------------------------

    
    if($do =='Manage'){
     //Start the Manage Page   
       
        //select only users (not admins)
        $stmt = $con->prepare("SELECT * FROM USERS WHERE groupID !=1");
        $stmt->execute();
        $rows = $stmt -> fetchAll();

        
        ?>
        <!--The manage page -->

        <div class="container2 shadow-sm bg-white rounded">
            <h3>Manage Members</h3>
            <div class="table-responsive">
                <table class="table table-bordered text-center shadow-sm bg-white rounded">
                    <thead>
                     <tr>
                        <td>#ID</td>
                        <td>Username</td>
                        <td>Email</td>
                        <td>Full Name</td>
                        <td>Registred Date</td>
                        <td>Control</td>
                    </tr>   
                    </thead>
                    
                    <?php
                        foreach($rows as $row){
                            echo "<tr>";
                            echo "<td>". $row['userID'] ."</td>";
                            echo "<td>". $row['username'] ."</td>";
                            echo "<td>". $row['email'] ."</td>";
                            echo "<td>". $row['fullname'] ."</td>";
                            echo "<td>". $row['date'] ."</td>";
                            echo "<td><a href ='members.php?do=Edit&userid=" . $row["userID"] . "' class='btn btn-success'><i class='fas fa-pen'></i></a>
                            <a href ='members.php?do=Delete&userid=" . $row["userID"] . "' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#exampleModal'><i class='fas fa-trash'></i></a></td>";
                            echo "</tr>";
                        }
                    ?>
                </table>
            </div>

            <a href="members.php?do=Add" class="btn btn-secondary"><i class="fas fa-plus"></i> Add New Member</a>     

            
            <!-- Modal for the confirm of the user's delete-->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Do you want to confirm the delete of the user?
                </div>
                <div class="modal-footer">
                    <?php echo  "<button type='button' class='btn btn-success'> <a href ='members.php?do=Delete&userid=" . $row['userID'] . "' style= 'text-decoration:none; color:#fff;'>Yes</a></button> "?> 
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                </div>
                </div>
            </div>
            </div>
        </div>


    <?php }elseif ($do == 'Add'){ ?>
        <!--the Add member page-->
        <div class="container-sm shadow-sm bg-white rounded">
         <h3>Add New Member</h3>
         <hr>
            <form class="form2" action="?do=Insert" method="POST">

                <!--Username field-->
                <div class="input-group flex-nowrap">
				<span class="input-group-text" id="addon-wrapping"><i class="fas fa-user"></i></span>
				<input type="text" name="username" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="addon-wrapping" required ="required">
				</div>

                 <!--Full Name field-->
                 <div class="input-group flex-nowrap">
				<span class="input-group-text" id="addon-wrapping"><i class="fas fa-user"></i></span>
				<input type="text" name="full" class="form-control" placeholder="Full Name" aria-label="Username" aria-describedby="addon-wrapping" required ="required">
				</div>

                <!--Email field-->
				<div class="input-group flex-nowrap">
				<span class="input-group-text" id="addon-wrapping"><i class="fas fa-envelope"></i></span>
				<input type="email" name="email" class="form-control" placeholder="Email" aria-label="Password" aria-describedby="addon-wrapping" required ="required">
				</div>

                <!--Password field-->
				<div class="input-group flex-nowrap">
				<span class="input-group-text" id="addon-wrapping"><i class="fas fa-lock"></i></span>
				<input name="password" type="password" value="" class="input form-control" id="password3" placeholder="Password" required="true" aria-label="password" aria-describedby="addon-wrapping" autocomplete="new-password" required ="required" />
					<span class="input-group-text" onclick="password_show_hide3();">
						<i class="fas fa-eye" id="show_eye3"></i>
						<i class="fas fa-eye-slash d-none" id="hide_eye3"></i>	
					</span>
			    </div>

                    <input type="submit" value="Add Member" class="btn btn-primary" />
            </form>
        </div>
    

    <?php
    }
//------------------------------------------------------The insert section---------------------------------------------------------------------

    elseif($do == 'Insert'){

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

        //The Insert page
        echo"<div class='container2 shadow-sm bg-white rounded'>";
        echo "<h2>Update Member</h2>";

            // variables from the form
            $user       =   $_POST['username'];
            $pass       =   $_POST['password'];
            $email      =   $_POST['email'];
            $name       =   $_POST['full'];

            $hashPass = sha1($_POST['password']);

            //Validate the Form
            $fromErrors = array();
            if (strlen($user) < 4){
                $fromErrors[] = 'Username cannot be less than <strong>4 characters</strong>';
            }

            if (strlen($user) > 20){
                $fromErrors[] = 'Username cannot be more than <strong>20 characters</strong>';
            }

            if (empty($user)){
                $fromErrors[] = 'Username cannot be <strong>empty</strong>';
            }

            if (empty($pass)){
                $fromErrors[] = 'Password cannot be <strong>empty</strong>';
            }

            if (empty($name)){
                $fromErrors[] = 'Full name cannot be <strong>empty</strong>';
            }

            if (empty($email)){
                $fromErrors[] = 'Email cannot be <strong>empty</strong>';
            }

            //loop for the errors
            foreach($fromErrors as $error){
                echo '<div class="alert alert-danger">' . $error . '</div>';
            }

            //If there is no error so you can add this member to the database            
            if(empty($fromErrors)){

                //check if the username exist in the database with our function checkItem
                $check = checkItem("username","users",$user);
                if ($check == 1){

                    $theMsg = "<div class='alert alert-danger'>Sorry Username already exists</div>";
                    redirectHome($theMsg,'Back');
                }else{

                //Insert the form fields into the database
                $stmt = $con ->prepare("INSERT INTO users(username, password, email, fullname, date) VALUES(:zuser, :zpass, :zmail, :zname, now())");
                $stmt->execute(array('zuser' => $user, 'zpass' => $hashPass, 'zmail' => $email,'zname' => $name, ));

                $theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Inserted </div>';
                redirectHome($theMsg, 'back');
            }
        }

        }else{

            echo "<div class='container2'>";

            $theMsg ="<div class='alert alert-danger'>You cannot browser this page directly</div>";
            
            redirectHome($theMsg, 'back');
            
            echo "</div>";
            
        }

        echo"</>";
    }

//------------------------------------------------------The edit section---------------------------------------------------------------------

    elseif ($do =='Edit'){ 
        
        //for the security (we need to verify that the id in the url is a number not a string)
        $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
        $stmt = $con->prepare("select * from users where userID  = ? LIMIT 1");
        //execute the select request
        $stmt->execute(array($userid));
        //bring the data from the select request and save it in the row variable
        $row= $stmt->fetch();
        //count the number of the row in the select request
        $count = $stmt->rowCount();
        // if count > 0 this means the database contains a record about this username 

        if ($count > 0 ) { ?>
        <!--the Edit page -->
       
        <div class="container-sm shadow-sm bg-white rounded">
         <h3>Edit Member</h3>
         <hr>

         <form class="form2" action="?do=Update" method="POST">

            <!-- We need to send the id in the form that is why we need to added to the form as a hidden input-->
            <input type="hidden" name ="userid" value ="<?php echo $userid?>" />

            <!--Username field-->
            <div class="input-group flex-nowrap">
            <span class="input-group-text" id="addon-wrapping"><i class="fas fa-user"></i></span>
            <input type="text" name="username" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="addon-wrapping" value ="<?php echo $row['username'] ?>"autocomplete="off" required ="required">
            </div>

            <!--Full Name field-->
            <div class="input-group flex-nowrap">
            <span class="input-group-text" id="addon-wrapping"><i class="fas fa-user"></i></span>
            <input type="text" name="full" value ="<?php echo $row['fullname'] ?>"  class="form-control" placeholder="Full Name" aria-label="Username" aria-describedby="addon-wrapping" required ="required">
            </div>

            <!--Email field-->
            <div class="input-group flex-nowrap">
            <span class="input-group-text" id="addon-wrapping"><i class="fas fa-envelope"></i></span>
            <input type="email" name="email" value ="<?php echo $row['email'] ?>" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="addon-wrapping" required ="required">
            </div>

            <!--Password field-->
            <div class="input-group flex-nowrap">
            <span class="input-group-text" id="addon-wrapping"><i class="fas fa-lock"></i></span>
            <!--the old password that we need for the update-->
            <input hidden="true" name="oldpassword" value=<?php echo $row['password']?> />
            <input name="newpassword" type="password" value="" class="input form-control" id="password3" placeholder="Password" aria-label="password" aria-describedby="addon-wrapping" autocomplete="new-password"/>
                <span class="input-group-text" onclick="password_show_hide3();">
                    <i class="fas fa-eye" id="show_eye3"></i>
                    <i class="fas fa-eye-slash d-none" id="hide_eye3"></i>	
                </span>
            </div>
                <input type="submit" value="Save" class="btn btn-primary" />
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

            $id     =   $_POST['userid'];
            $user   =   $_POST['username'];
            $email  =   $_POST['email'];
            $name   =   $_POST['full'];

            //How to update the password
            // condition ? True : False;
            $pass ='';
            if(empty($_POST['newpassword'])){
                $pass = $_POST['oldpassword'];
            }else{
                $pass = sha1($_POST['newpassword']);
            }

            //Validate the Form
            $fromErrors = array();
            if (strlen($user) < 4){
                $fromErrors[] = 'Username cannot be less than <strong>4 characters</strong>';
            }

            if (strlen($user) > 20){
                $fromErrors[] = 'Username cannot be more than <strong>20 characters</strong>';
            }

            if (empty($user)){
                $fromErrors[] = 'Username cannot be <strong>empty</strong>';
            }

            if (empty($name)){
                $fromErrors[] = 'Full name cannot be <strong>empty</strong>';
            }

            if (empty($email)){
                $fromErrors[] = 'Email cannot be <strong>empty</strong>';
            }

            //loop for the errors
            foreach($fromErrors as $error){
                echo '<div class="alert alert-danger">' . $error . '</div>';
            }

            //If there is no error so you can update the form
            if(empty($fromErrors)){

                $stmt = $con->prepare("UPDATE users SET username =?, email =?, fullname =? , password = ? where userID  = ?");
                //execute the update request
                $stmt->execute(array($user, $email, $name, $pass, $id));
                //Success update
                $theMsg= "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record updated </div>';

                redirectHome($theMsg, 'back');
            }

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
            echo "<h2>Delete Member</h2>";
            //for the security (we need to verify that the id in the url is a number not a string)
            $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;

            //check if this user exists in database
            $check = checkItem('userId','users', $userid);

            if ($check > 0){
            $stmt = $con->prepare("DELETE FROM users WHERE userID = :zuser");
            $stmt->bindParam(":zuser", $userid);
            $stmt->execute();
            $theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Deleted </div>';
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


<!---------------------------------------function of javascript for the password's visibilty---------------------------------------------->
<script>
    function password_show_hide3() {
	var x = document.getElementById("password3");
	var show_eye = document.getElementById("show_eye3");
	var hide_eye = document.getElementById("hide_eye3");
	hide_eye.classList.remove("d-none");
	if (x.type === "password") {
		x.type = "text";
		show_eye.style.display = "none";
		hide_eye.style.display = "block";
	} else {
		x.type = "password";
		show_eye.style.display = "block";
		hide_eye.style.display = "none";
	}
	}

</script>
