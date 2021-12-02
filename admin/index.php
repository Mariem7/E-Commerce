
<?php 
    session_start();
    //varibale that allow us to not display the navbar on the login page
    $noNavbar ='';
    //the title of the page
    $pageTitle = 'Login';
    if (isset($_SESSION['username'])){
        header('Location: dashboard.php');  //redirect to dashboard page
    }

    include 'init.php';


    //check if user is coming from HTTP post request
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $username = $_POST['user'];
        $password = $_POST['pass'];
        $hashedPass = sha1($password);
        //to protect the password in database , we save the hashed password 
        //check if the user exist in database

        $stmt = $con->prepare("select userID, username , password from users where username  = ? and password = ? and groupID = 1 LIMIT 1");
        //execute the select request
        $stmt->execute(array($username,$hashedPass));
        //bring the data from the select request and save it in the row variable
        $row= $stmt->fetch();
        //count the number of the row in the select request
        $count = $stmt->rowCount();
        // if count > 0 this means the database contains a record about this username 

        if ($count > 0 ) {
            //register session name
            $_SESSION['username'] =$username; 
            //register session ID
            $_SESSION['ID'] =$row['userID']; 
            //redirection to the dashboard
            header('Location: dashboard.php'); 
            exit();
        }
    }
?>

<section class="ftco-section">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12 col-lg-10">
				<div class="wrap d-md-flex">
					<div class="text-wrap p-4 p-lg-5 text-center d-flex align-items-center order-md-last">
						<div class="text w-100">
							<h2>Welcome to</h2>
                            <img class="logo-sign-up" src='images/LOGO-Sing-UP.png' alt='not found'/>
							<p>Don't have an account?</p>
							<a href="#" class="mb-4 btn btn-white btn-outline-white">Sign Up</a>
						</div>
			      </div>
						<div class="login-wrap p-4 p-lg-5">
			      	<div class="d-flex">
			      		<div class="w-100">
			      			<h3 class="mb-4">Sign In</h3>
			      		</div>
			      	</div>
						<form class="signin-form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" >
			      	<div class="form-group mb-3">
			      		<label class="label" for="name">Username</label>
			      		<input type="text" class="form-control" placeholder="Username" name="user" required>
			      	</div>
		            <div class="form-group mb-3">
		            	<label class="label" for="password">Password</label>
		              <input type="password" class="form-control" placeholder="Password" name="pass" required>
		            </div>
		            <div class="form-group">
		            	<button type="submit" value="Login" class="form-control btn btn-primary submit px-3">Sign In</button>
		            </div>
		            <div class="form-group d-md-flex">
		            	<div class="w-50 text-left">
			            	<label class="checkbox-wrap checkbox-primary mb-0">Remember Me
								<input type="checkbox" checked>
								    <span class="checkmark"></span>
							</label>
						</div>
						<div class="w-50 text-md-right">
							<a href="#">Forgot Password</a>
						</div>
		            </div>
		          </form>
		        </div>
		      </div>
			</div>
		</div>
	</div>
</section>


<?php include $tpl . 'footer.php';?> 