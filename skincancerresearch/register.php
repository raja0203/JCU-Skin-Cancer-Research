<?php
session_start();
include_once('config.php');

if($_POST){
	if(!$_POST['fname'])
		$error.= 'Please enter first name<br>';
	if(!$_POST['lname'])
		$error.= 'Please enter last name<br>';
	if(!$_POST['uname'])
		$error.= 'Please enter UserName<br>';
	if(!$_POST['pw'])
		$error.= 'Please enter password<br>';
	if(!$_POST['gender'])
		$error.= 'Please select gender<br>';
	if(!$_POST['email'])
		$error.= 'Please enter email<br>';
	if(!$_POST['birthdate'])
		$error.= 'Please enter Birth Date<br>';
	if (time() < strtotime('+18 years', strtotime($_POST['birthdate']))) {
		$error.='You must be at least 18 years old to apply.<br>';
	}

	$sql = "select * from user_details where username='".$conn->real_escape_string($_POST[uname])."' or email='".$conn->real_escape_string($_POST[email])."'";
	$result = $conn->query($sql);
	echo $conn->error;
	//print_r($result->num_rows);
	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		if($row[username]==$_POST[uname]){
			$error.='This Username already exists.<br>';
		}
		if($row['email']==$_POST['email']){
			$error.='This email already exists.<br>';
		}
	}

	if(!$error) {
		$fname = $conn->real_escape_string($_POST['fname']);
		$lname = $conn->real_escape_string($_POST['lname']);
		$uname = $conn->real_escape_string($_POST['uname']);
		$password = md5($_POST['pw']);
		$gender= $conn->real_escape_string($_POST['gender']);
		$email=$conn->real_escape_string($_POST['email']);
		if($gender=='Male')
			$gender='M';
		else
			$gender='F';
		$state = $conn->real_escape_string($_POST['state']);
		$birthdate = $conn->real_escape_string($_POST['birthdate']);
		//make the database connection
		//create an insert query
		$sql = "insert into user_details (first_name,last_name,email,username,password,gender,birthdate) VALUES ('$fname', '$lname','$email','$uname', '$password','$gender','$birthdate')";
		//execute the query
		if($conn -> query($sql)){
			$_SESSION['success']="Registration successful.<br> You can login now";
			header("Location:login.php");
			die();
		}
		else{
			echo $conn->error;
			echo 'Issue in data entry';
		}
	}
}
//die();
?>


<html>
    <head>
        <title>
            Register
        </title>
    </head>
<body>
<?php
include_once('menu.php');
?>
<div style="margin:auto" class="content">


<form action="" method="post" class="col-md-6 col-md-push-3 jumbotron">
<?php
if($error){
	echo '<div class="alert alert-danger text-center">'.$error.'</div>';
}
?>
	<h2 class="text-center margin-bottom-10">Register</h2>
	<div class="col-md-5 text-right  ">First Name: </div>
	<div class="col-md-7 margin-bottom-10"><input type="text" name="fname" required value="<?php echo $_POST[fname]; ?>"></div>


	<div class="col-md-5 text-right  ">Last Name: </div>
	<div class="col-md-7 margin-bottom-10"><input type="text" name="lname" required  value="<?php echo $_POST[lname]; ?>"></div>

	<div class="col-md-5 text-right  ">Email: </div>
	<div class="col-md-7 margin-bottom-10"><input type="email" name="email" style="length:200px" required  value="<?php echo $_POST[email]; ?>"></div>

	<div class="col-md-5 text-right  ">UserName: </div>
	<div class="col-md-7 margin-bottom-10"><input type="text" name="uname" required  value="<?php echo $_POST[uname]; ?>"></div>

	<div class="col-md-5 text-right  ">Password: </div>
	<div class="col-md-7 margin-bottom-10"><input type="password" name="pw" required  value="<?php echo $_POST[pw]; ?>"></div>

	<div class="col-md-5 text-right  ">Gender: </div>
	<div class="col-md-7 margin-bottom-10"><input type="radio" value="F" name="gender">  Female
                <input type="radio" value="M" name="gender">  Male</div>

	<div class="col-md-5 text-right  ">Birth Date: </div>
	<div class="col-md-7 margin-bottom-10"><input type="date" name="birthdate" required  value="<?php echo $_POST[birthdate]; ?>"></div>

	<div class="col-md-5 text-right  "></div>
	<div class="col-md-7"><input type="submit" value="Register"></div>

</form>
</div>
<script>
$(document).ready(function(){
$('#register').addClass("active");
});
</script>
</body>
</html>
