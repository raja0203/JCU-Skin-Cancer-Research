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
		$user_id = $_POST['userid'];
		$sql = "select * from observation_details, user_details where observation_details.Obs_id=".$user_id." and observation_details.user_id = user_details.userid";
		$result= $conn -> query($sql);
		$row = $result->fetch_assoc();
		echo "<table>";
		echo "<tr><td>Observation ID: ".$row['Obs_id']."</td></tr>"
	?>
</div>