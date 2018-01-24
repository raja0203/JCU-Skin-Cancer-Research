<?php
//must appear BEFORE the <html> tag
session_start();
include_once('config.php');

if( isset($_POST["username"])&& isset($_POST["password"])){
	$username = $_POST["username"];
	$password = md5($_POST["password"]);

	$sql = "select * from user_details where username='".$conn->real_escape_string($username)."' and password='$password'";
//	die($sql);
	$result = $conn->query($sql);
	echo $conn->error;
	if ($result->num_rows > 0) {
	  $row = $result->fetch_assoc();
		$_SESSION['userid'] = $row['userid'];
		$_SESSION['email'] = $row['email'];
		$_SESSION['username'] = $username;
		if($row[isadmin]=='Y')
			$_SESSION['isadmin'] = 1;
	}
}
if (isset($_SESSION['userid'])){
  header("Location:bluecard.php");
}
else{
  if (isset($username)){
		$_SESSION['error']='Invalid username or password';
    header("Location:login.php");
  }
  else{
    // user has not tried to log in yet or has logged out
    echo "<b>You are not logged in</b><br>";
  }
}

?>
