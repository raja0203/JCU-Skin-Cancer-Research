<?php 
session_start();
include('config.php');
?>
<html>
    <head>
        <title>
            Detailed Observation View
        </title>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    </head>
<body>
<?php
include('menu.php');
?>
<div style="margin:10px;padding:10px;" class="content">
	<?php
		$user_id = $_POST['view'];
		$observation_id = $_POST['obsid'];
		$sql = "select * from user_details where userid = ".$user_id;
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$first_name = $row['first_name'];
		$last_name = $row['last_name'];
		$email = $row['email'];
		$dob = $row['birthdate'];
		$blue_card_num = $row['card_number'];
		$expiry_date = $row['expiry_date'];
		echo "<table>";
		echo "<tr><th>User ID: </th><td> ".$user_id."</td></tr>";
		echo "<tr><th>Name: </th><td> ".$first_name." ".$last_name."</td></tr>";
		echo "<tr><th>Email</th><td> ".$email."</td></tr>";
		echo "<tr><th>Date of Birth: </th><td> ".$dob."<td></tr>";
		echo "<tr><th>Blue Card: </th><td> ".$blue_card_num."</td></tr>";
		echo "<tr><th>Expiry Date: </th><td> ".$expiry_date."</td></tr>";
		echo "</table>";
		echo "<form action='detailedObservation.php' method='post'><input type='hidden' value='$observation_id' name='userid' /><input type='submit' value='Go back to observation'></form>";
	?>
</div>