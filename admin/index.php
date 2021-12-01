
<?php 
session_start();
$noNavbar ='';
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

$stmt = $con->prepare("select username , password from users where username  = ? and password = ? and groupID = 1 ");
$stmt->execute(array($username,$hashedPass));
$count = $stmt->rowCount();
// if count > 0 this means the database contains a record about this username 
if ($count > 0 ) {
$_SESSION['username'] =$username; //register session name
header('Location: dashboard.php'); 
exit();
    }
}
?>

<form class="login" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
    <h2 class="text-center">Admin login</h2>
	<input class="form-control input-lg" type="text" name="user" placeholder="Username ... " autocomplete="off" />
	<input class="form-control input-lg" type="password" name="pass" placeholder="Password ... " autocomplete="new-password" />
	<input class="btn btn-primary btn-block btn-lg " type="submit" value="Login"/>
</form>

<?php include $tpl . 'footer.php';?> 