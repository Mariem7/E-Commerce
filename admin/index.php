
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
<div class="index">
	<div class="container shadow p-3 mb-5 bg-white rounded" id="container">
		<div class="form-container sign-up-container">
			<!--Form for creating new account-->
			<form class="form1" action="#">
				<h2>Create Account</h2>

				<div class="input-group flex-nowrap">
				<span class="input-group-text" id="addon-wrapping"><i class="fas fa-user"></i></span>
				<input type="text" name="user" class="form-control" placeholder="Name" aria-label="Username" aria-describedby="addon-wrapping">
				</div>

				<div class="input-group flex-nowrap">
				<span class="input-group-text" id="addon-wrapping"><i class="fas fa-envelope"></i></span>
				<input type="email" name="email" class="form-control" placeholder="Email" aria-label="Password" aria-describedby="addon-wrapping">
				</div>

				<div class="input-group flex-nowrap">
				<span class="input-group-text" id="addon-wrapping"><i class="fas fa-lock"></i></span>
				<input name="password" type="password" value="" class="input form-control" id="password1" placeholder="password" required="true" aria-label="password" aria-describedby="addon-wrapping" />
					<span class="input-group-text" onclick="password_show_hide2();">
						<i class="fas fa-eye" id="show_eye1"></i>
						<i class="fas fa-eye-slash d-none" id="hide_eye1"></i>	
					</span>
			    </div>
				
				<br>
				<button class="buttont1">Sign Up</button>

			</form>
		</div>
		<!--form to sign in -->
		<div class="form-container sign-in-container">
			<form class="form1" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" >
				<h2>Sign in</h2>

				<div class="input-group flex-nowrap">
				<span class="input-group-text" id="addon-wrapping"><i class="fas fa-user"></i></span>
				<input type="text" name="user" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="addon-wrapping">
				</div>

				<div class="input-group flex-nowrap">
				<span class="input-group-text" id="addon-wrapping"><i class="fas fa-lock"></i></span>
				<input name="pass" type="password" value="" class="input form-control" id="password" placeholder="password" required="true" aria-label="password" aria-describedby="addon-wrapping" />
					<span class="input-group-text" onclick="password_show_hide();">
						<i class="fas fa-eye" id="show_eye"></i>
						<i class="fas fa-eye-slash d-none" id="hide_eye"></i>	
					</span>
			    </div>

				<a class="link" href="#">Forgot your password?</a>
				<button class="buttont1" type="submit" value="Login">Sign In</button>
			</form>
		</div>

		<!--form to sign up -->
		<div class="overlay-container">
			<div class="overlay">
				<div class="overlay-panel overlay-left">
					<h1>Welcome Back!</h1>
					<p>To keep connected with us please login with your personal info</p>
					<button class="ghost" id="signIn">Sign In</button>
				</div>
				<div class="overlay-panel overlay-right">
					<h1>Welcome to</h1>
					<img class="logo-sign-up" src='images/LOGO-Sing-UP.png' alt='not found'/>
					<button class="ghost" id="signUp">Sign Up</button>
				</div>
			</div>
		</div>
	</div>
</div>


<script>
	const signUpButton = document.getElementById('signUp');
	const signInButton = document.getElementById('signIn');
	const container = document.getElementById('container');

	signUpButton.addEventListener('click', () => {
		container.classList.add("right-panel-active");
	});

	signInButton.addEventListener('click', () => {
		container.classList.remove("right-panel-active");
	});
	function password_show_hide() {
	var x = document.getElementById("password");
	var show_eye = document.getElementById("show_eye");
	var hide_eye = document.getElementById("hide_eye");
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

	function password_show_hide2() {
	var x = document.getElementById("password1");
	var show_eye = document.getElementById("show_eye1");
	var hide_eye = document.getElementById("hide_eye1");
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


<?php include $tpl . 'footer.php';?> 