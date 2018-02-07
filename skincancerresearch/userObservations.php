<?php
session_start();
include_once('config.php');

?>

<html>
    <head>
        <title>
            User Status
        </title>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    </head>
<body>
<?php
include('menu.php');
?>
<div style="margin:auto" class="content">

	<div>
		<table>
			<form action="userObservation.php" method="post">
				<tr>
					<td style="padding:5px;">
						<input type="date" name="date" id="date" />
					</td>
					<td style="padding:5px;">
						<input type="submit" value="Go">
					</td>
				</tr>
			</form>
		</table>
		
		
			<?php
				echo "<table border=1 style='padding:5px;'>";
				echo "<tr><th>User ID</th><th>User Name</th><th>Start Time</th><th>End Time</th><th>Sun Safe</th><th>No Safety</th><th>Others</th></tr>";
				date_default_timezone_set("Australia/Brisbane");
				$date = date ("y/m/d");
				$sql = "SELECT * FROM `user_details`,`observation_details` WHERE observation_details.user_id = user_details.userid";
				$result= $conn -> query($sql);
				if ($result->num_rows > 0)
				{
					while ($row = $result->fetch_assoc())
					{
						$user_id = $row["user_id"];
						$start_time = $row["start_time"];
						$end_time = $row["end_time"];
						$sssh = (int)$row["std_withhat"];
						$ocssh = (int)$row["children_withhat"];
						$assh = (int)$row["adult_withhat"];
						$total_withhat = $sssh+$ocssh+$assh;
						$snoh = (int)$row["std_withouthat"];
						$ocnoh = (int)$row["children_withouthat"];
						$anoh = (int)$row["adult_withouthat"];
						$total_withnohat = $snoh+$ocnoh+$anoh;
						$soh = (int)$row["std_withotherhat"];
						$ocoh = (int)$row["children_withotherhat"];
						$aoh = (int)$row["adult_withotherhat"];
						$total_withotherhat = $soh+$ocoh+$aoh;
						$username = $row["first_name"];	
						$observation_id = $row["Obs_id"];
						echo "<tr><td>".$user_id."</td><td>".$username."</td><td>".$start_time."</td><td>".$end_time."</td><td>".$total_withhat."</td><td>".$total_withnohat."</td><td>".$total_withotherhat."</td><td style='padding:5px;'><form action='detailedObservation.php' method='post'><input type='hidden' value='$observation_id' name='userid' /><input type='submit' value='view full information' /></form></td></tr>";
					}
				}
				echo "</table>";
				echo "<form action='excelExport.php' method='post'><input type='submit' value='Export Data to Excel File' /></form>";
					
			?>
		</table>
	</div>
	<div class="clear-both"></div>


</div>
<!--This code is used for changing the active item on the menu-->
<script>
$(document).ready(function(){
	$('#bluecard').addClass("active");
});
</script>
<!-- The above code is used to change the active item on the menu. To be explicitly pasted on each page that is created-->
</body>
</html>
