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
		echo "<style>td,th {padding-right:70px;} #table-2 td,th {text-align:center; padding:10px;}</style>";
		echo "<table>";
		echo "<tr><td>Observation ID: ".$row['Obs_id']."</td><td>School Name: ".$row['school_name']."</td><td>School Ownership: ".$row['school_ownership']."</td></tr>";
		echo "<tr><td>User ID: ".$row['user_id']."</td><td>School Post Code: ".$row['school_postcode']."</td><td>School Setting: ".$row['school_setting']."</td></tr>";
		echo "<tr><td>User Name: ".$row['first_name']."</td><td>Season: ".$row['season']."</td><td>School Type: ".$row['school_type']."</td></tr>";
		echo "<tr><td>Start Time: ".$row['start_time']."</td><td>Rainy Day: ".$row['rain']."</td><td>Time of day: ".$row['time_of_day']."</td></tr>";
		echo "<tr><td>End Time: ".$row['end_time']."</td><td>Cloud Cover: ".$row['cloud_cover']."</td></tr>";
		echo "</table>";
		echo "<br /><br />";
		echo "<table border=1 id='table-2'>";
		echo "<tr><td></td><th>Sun Safe Hat</th><th>No Hat</th><th>Other Hat</th></tr>";
		echo "<tr><th>Students</th><td>".$row['std_withhat']."</td><td>".$row['std_withouthat']."</td><td>".$row['std_withotherhat']."</td></tr>";
		echo "<tr><th>Children</th><td>".$row['children_withhat']."</td><td>".$row['children_withouthat']."</td><td>".$row['children_withotherhat']."</td></tr>";
		echo "<tr><th>Adults</th><td>".$row['adult_withhat']."</td><td>".$row['adult_withouthat']."</td><td>".$row['adult_withotherhat']."</td></tr>";
		echo "</table>";
		echo "<br />";
		echo "<form action='viewFullInfo.php' method='post'><input type='hidden' value=".$row['user_id']." name='view' /><input type='hidden' value=".$row['Obs_id']." name='obsid' /><input type='submit' value='View full Information' /></form>";
		echo "<form action='deleteObservation.php' method='post'><input type='hidden' value=".$row['Obs_id']." name='delete' /><input type='submit' value='Delete Observation' /></form>";
		$conn->close();
	?>
</div>