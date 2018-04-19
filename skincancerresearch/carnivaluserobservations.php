<?php
session_start();
include('config.php');

?>

<html>
    <head>
        <title>
            User Observation
        </title>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    </head>
<body style="margin-bottom:0px; padding-bottom:0px;">
<?php
include('menu.php');
?>
<div style="margin:auto" class="content">

	<div>
		
			<?php
				echo "<table border=1 style='padding:5px;'>";
				echo "<tr><th>User ID</th><th>User Name</th><th>Start Time</th><th>End Time</th><th>Sun Safe</th><th>No Safety</th><th>Others</th><th>Long Sleeves</th><th>Short Sleeves</th><th>No Sleeves</th></tr>";
				date_default_timezone_set("Australia/Brisbane");
				$date = date ("y/m/d");
				$sql = "SELECT * FROM user_details,carnival_observations WHERE carnival_observations.user_id = user_details.userid";
				$result= $conn->query($sql);
				if ($result->num_rows > 0)
				{
					while ($row = $result->fetch_assoc())
					{
						$user_id = $row["user_id"];
						$start_time = $row["start_time"];
						$end_time = $row["end_time"];
						$sssh = (int)$row["sssh"];
						$ocssh = (int)$row["ocssh"];
						$assh = (int)$row["assh"];
						$total_withhat = $sssh+$ocssh+$assh;
						$snoh = (int)$row["snoh"];
						$ocnoh = (int)$row["ocnoh"];
						$anoh = (int)$row["anoh"];
						$total_withnohat = $snoh+$ocnoh+$anoh;
						$soh = (int)$row["soh"];
						$ocoh = (int)$row["ocoh"];
						$aoh = (int)$row["aoh"];
						$slong = (int)$row["slong"];
						$sshort = (int)$row["sshort"];
						$sno = (int)$row["sno"];
						$oclong = (int)$row["oclong"];
						$ocshort = (int)$row["ocshort"];
						$ocno = (int)$row["ocno"];
						$along = (int)$row["along"];
						$ashort = (int)$row["ashort"];
						$ano = (int)$row["ano"];
						$total_withotherhat = $soh+$ocoh+$aoh;
						$total_withlongsleeves = $slong+$oclong+$along;
						$total_withshortsleeves = $sshort+$ocshort+$ashort;
						$total_withnosleeves = $sno+$ocno+$ano;
						$username = $row["first_name"];	
						$carnival_obs_id = $row["carnival_obs_id"];
						echo "<tr><td>".$user_id."</td><td>".$username."</td><td>".$start_time."</td><td>".$end_time."</td><td>".$total_withhat."</td><td>".$total_withnohat."</td><td>".$total_withotherhat."</td><td>".$total_withlongsleeves."</td><td>".$total_withshortsleeves."</td><td>".$total_withnosleeves."</td><td style='padding:5px;'><form action='detailedcarnivalObservation.php' method='post'><input type='hidden' value='$carnival_obs_id' name='userid' /><input type='submit' value='View Full Information' /></form></td></tr>";
					}
				}
				echo "</table>";
				echo "<a href='excelExportforCarnival.php' target='_blank'>Export Data to Excel File</a>";
			?>
		</table>
	</div>
	<div class="clear-both"></div>


</div>
<?php
include('footer.php');
?>
</body>
</html>
