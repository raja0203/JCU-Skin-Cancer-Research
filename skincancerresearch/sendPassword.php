<?php
session_start();
include_once('config.php');
if (isset($_POST['email'],$_POST['retypeemail']))
{
	$email = $_POST['email'];
	$retypeemail = $_POST['retypeemail'];
	if ($email == $retypeemail)
	{
		$sql = "select password from user_details where email='".$email."';";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$pass = md5($row["password"]);
			}
				$txt = "make sure that you keep your password safe. the password is ".$pass;
				$header = "From: kaustubh2807@gmail.com";
				mail($email,"Password for your skin cancer research",$txt,$header);
				$url = 'sentPassword.php';
				echo "password sent";
			
		}
	else
	{
		echo "Error: ".$conn->error;
	}
	}
}
?>