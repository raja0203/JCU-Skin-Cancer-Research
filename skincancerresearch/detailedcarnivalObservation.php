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
<body style="margin-bottom:0px; padding-bottom:0px;">
<?php
include('menu.php');
?>
<div style="margin:10px;padding:10px;" class="content">
	<?php
		$user_id = $_POST['userid'];
		$sql = "select * from carnival_observations, user_details where carnival_observations.carnival_obs_id=".$user_id." and carnival_observations.user_id = user_details.userid";
		$result= $conn -> query($sql);
		$row = $result->fetch_assoc();
		echo "<style>td,th {padding-right:70px;} #table-2 td,th {text-align:center; padding:10px;}</style>";
		echo "<table>";
		echo "<tr><td>Observation ID: ".$row['carnival_obs_id']."</td><td>School Name: ".$row['school_name']."</td><td>School Ownership: ".$row['school_ownership']."</td></tr>";
		echo "<tr><td>User ID: ".$row['user_id']."</td><td>School Post Code: ".$row['school_postcode']."</td><td>School Setting: ".$row['school_setting']."</td></tr>";
		echo "<tr><td>User Name: ".$row['first_name']."</td><td>Season: ".$row['season']."</td><td>School Type: ".$row['school_type']."</td></tr>";
		echo "<tr><td>Start Time: ".$row['start_time']."</td><td>Rainy Day: ".$row['rain']."</td><td>Time of day: ".$row['time_of_day']."</td></tr>";
		echo "<tr><td>End Time: ".$row['end_time']."</td><td>Cloud Cover: ".$row['cloud_cover']."</td></tr>";
		echo "</table>";
		echo "<br /><br />";
		echo "<table border=1 id='table-2'>";
		echo "<tr><td></td><th>Sun Safe Hat</th><th>No Hat</th><th>Other Hat</th><th>Long Sleeves</th><th>Short Sleeves</th><th>No Sleeves</th></tr>";
		echo "<tr><th>Students</th><td>".$row['sssh']."</td><td>".$row['snoh']."</td><td>".$row['soh']."</td><td>".$row['slong']."</td><td>".$row['sshort']."</td><td>".$row['sno']."</td></tr>";
		echo "<tr><th>Children</th><td>".$row['ocssh']."</td><td>".$row['ocnoh']."</td><td>".$row['ocoh']."</td><td>".$row['oclong']."</td><td>".$row['ocshort']."</td><td>".$row['ocno']."</td></tr>";
		echo "<tr><th>Adults</th><td>".$row['assh']."</td><td>".$row['anoh']."</td><td>".$row['aoh']."</td><td>".$row['along']."</td><td>".$row['ashort']."</td><td>".$row['ano']."</td></tr>";
		echo "</table>";
		echo "<br />";
		echo "<form action='viewFullInfoforcarnival.php' method='post'><input type='hidden' value=".$row['user_id']." name='view' /><input type='hidden' value=".$row['carnival_obs_id']." name='carnival_obs_id' /><input type='submit' value='View Full Information' /></form>";
		echo "<form action='deleteObservationforcarnival.php' method='post'><input type='hidden' value=".$row['carnival_obs_id']." name='delete' /><input type='submit' value='Delete Observation' /></form>";
	
		$conn->close();
	?>
</div>
<div style="clear:both;"></div>
<?php
include('footer.php');
?>