<script>
function formValidation(){
	var school_name = document.sunsafeapp.school-name;
	alert("school Name: "+int(school_name.length));
	var school_pcode = document.sunsafeapp.school-pcode;
	var season = document.sunsafeapp.season;
	var rain = document.sunsafeapp.rain;
	var cloud_cover = document.sunsafeapp.cloud-cover;
	var school_ownership = document.sunsafeapp.school-ownership;
	var school_seting = document.sunsafeapp.school-setting;
	var school_type = document.sunsafeapp.school-type;
	var time_of_day = document.sunsafeapp.time-of-day;
	if (school_name.length == 'NaN' ){
		alert ("School name should not be empty");
	}
	if (school_pcode.length == 0 || school_pcode.length > 4){
		alert ("School pcode should not be empty or more than digits");
	}
	if (season.value == "select-season" ){
		alert ("season should not be empty");
	}
	if (time_of_day.length == "select time" ){
		alert ("please select the time of the day");
	}
}

function startObservation()
{
	document.getElementByID("sssh").disabled = true;
}
</script>
<style>
table, td {
	
}
</style>
<?php
session_start();
include_once('config.php');

$sql = "Select blue_card_status from user_details where userid = $_SESSION[userid] ";
$conn -> query($sql);
$result = $conn->query($sql);
echo $conn->error;
if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();
	$status = $row[blue_card_status];
//	die($status);
	if($status=='pending' or $status=='dont_have' or $status=='submitted' or $status=='approved' or $status=='test_failed' or $status == ''){
		header ('Location: user-status.php');
	}
	elseif($status=='rejected'){
		$status_message = 'We were not able to validate your blue card. Please submit your blue card details again.';
		header('Location: user-status.php');
	}
	else{
		//header("Location: user-status.php");
?>

<html>
    <head>
        <title>
            Swimming Carnival Application
        </title>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    </head>
<body style="margin-bottom:0px; padding-bottom:0px;clear:both;">
<?php
include_once('menu.php');
date_default_timezone_set("Australia/Brisbane");
$start_time = date("h:i:sa");

?>
<div style="margin:25px;" class="content">
	<form action="submit_carnival_observations.php" method="post">
	<div class="col-md-5" style="float:left; text-align: left;">
			<input type="hidden" name="start-time" value="<?php echo "$start_time";?>">
			<h1>SunSafe Hat Application</h1>
			<h2>About Location</h2>
			<table border="0px">
				<tr><th>School Name</th><td><input type="text" name="school-name" id="school-name"></td></tr>
				<tr><th>School Post Code</th><td><input type="text" name="school-pcode" id="school-pcode"></td></tr>
			</table>
			<h2>About the Conditions</h2>
			<table border="0px">
				<tr>
					<th>Season</th>
					<td>
						<select name="season" id="season">
							<option value="select-season">Select Season</option>
							<option value="1">Summer</option>
							<option value="2">Autumn</option>
							<option value="3">Winter</option>
							<option value="4">Spring</option>
						</select>
					</td>
				</tr>
				<tr>
					<th>Rainy day?</th>
					<td>
						<select name="rain" id="rain">
							<option value="0">No Rain</option>
							<option value="1">Rain</option>
						</select>
					</td>
				</tr>
				<tr>
					<th>Cloud Cover</th>
					<td>
						<select name="cloud-cover" id="cloud-cover">
							<option value="0">0 okta</option>
							<option value="1">1 okta</option>
							<option value="2">2 okta</option>
							<option value="3">3 okta</option>
							<option value="4">4 okta</option>
							<option value="5">5 okta</option>
							<option value="6">6 okta</option>
							<option value="7">7 okta</option>
							<option value="8">8 okta (overcast)</option>
						</select> 	
					</td>
				</tr>
			</table>
			<h2>About the School</h2>
			<table border="0px">
				<tr>
					<th>School Ownership</th>
					<td>
						<select name="school-ownership">
							<option value="0">Private</option>
							<option value="1">Public</option>
						</select>
					</td>
				</tr>
				<tr>
					<th>School Setting</th>
					<td>
						<select name="school-setting">
							<option value="0">Urban</option>
							<option value="1">Rural</option>
						</select>
					</td>
				</tr>
				<tr>
					<th>School Type</th>
					<td>
						<select name="school-type">
							<option value="0">Primary school</option>
							<option value="1">Combined P-12</option>
							<option value="2">Secondary Only</option>
						</select> 	
					</td>
				</tr>
				<tr>
					<th>Time of the Day</th>
					<td>
						<select name="time-of-day">
							<option value="select time">Select Time</option>
							<option value="1">Before School</option>
							<option value="2">After School</option>
							<option value="3">Recess/Lunch</option>
							<option value="4">Outdoor Lesson</option>
						</select> 	
					</td>
				</tr>
				<tr>
					<th>Carnival</th>
					<td>
						<select name="time-of-day">
							<option value="0">No Carnival</option>
							<option value="1">Swimming</option>
							<option value="2">Athletics</option>
							<option value="3">Cross Country</option>
						</select> 	
					</td>
				</tr>
			</table>
			<input type="button" value="Start Observation" onclick="startObservatio()" />
	</div>
	<div class="col-md-6" style="float:left; text-align: left;">
		<h3>This section needs to be in landscape</h3>
			<table border="0px">
				<tr><td></td><td style="padding:5px;">Sun Safe Hat</td><td style="padding:5px;">Other Hats</td><td style="padding:5px;">No Hats</td><td style="padding:5px;">Long Sleeve</td><td style="padding:5px;">Short Sleeve</td><td style="padding:5px;">No Sleeve</td></tr>
				<tr>
					<td style="padding:5px;">Students</td>
					<td style="padding:5px;">
						<input type="number" name="sssh" id="sssh" min="0" max="100"/>
					</td>
					<td style="padding:5px;">
						<input type="number" name="soh" id="soh" min="0" max="100"/>
					</td>
					<td style="padding:5px;">
						<input type="number" name="snoh" id="snoh" min="0" max="100"/>
					</td>
					<td style="padding:5px;">
						<input type="number" name="slong" id="slong" min="0" max="100"/>
					</td>
					<td style="padding:5px;">
						<input type="number" name="sshort" id="sshort" min="0" max="100"/>
					</td>
					<td style="padding:5px;">
						<input type="number" name="sno" id="sno" min="0" max="100"/>
					</td>
				</tr>
				<tr>
					<td style="padding:5px;">Other Children</td>
					<td style="padding:5px;">
						<input type="number" name="ocssh" id="ocssh" min="0" max="100"/>
					</td>
					<td style="padding:5px;">
						<input type="number" name="ocoh" id="ocoh" min="0" max="100"/>
					</td>
					<td style="padding:5px;">
						<input type="number" name="ocnoh" id="ocnoh" min="0" max="100"/>
					</td>
					<td style="padding:5px;">
						<input type="number" name="oclong" id="oclong" min="0" max="100"/>
					</td>
					<td style="padding:5px;">
						<input type="number" name="ocshort" id="ocshort" min="0" max="100"/>
					</td>
					<td style="padding:5px;">
						<input type="number" name="ocno" id="ocno" min="0" max="100"/>
					</td>
				</tr>
				<tr>
					<td style="padding:5px;">Adults</td>
					<td style="padding:5px;">
						<input type="number" name="assh" id="assh" min="0" max="100"/>
					</td>
					<td style="padding:5px;">
						<input type="number" name="aoh" id="aoh" min="0" max="100"/>
					</td>
					<td style="padding:5px;">
						<input type="number" name="anoh" id="anoh" min="0" max="100"/>
					</td>
					<td style="padding:5px;">
						<input type="number" name="along" id="along" min="0" max="100"/>
					</td>
					<td style="padding:5px;">
						<input type="number" name="ashort" id="ashort" min="0" max="100"/>
					</td>
					<td style="padding:5px;">
						<input type="number" name="ano" id="ano" min="0" max="100"/>
					</td>
				</tr>
				<tr>
					<td style="padding:5px;">
						<input type="submit" value="Submit Observation" name="submit" id="submit" style="background-color:blue;color:white;"/>
					</td>
				</tr>
			</table>
	</div> 
	</form>
</div>
<!--This code is used for changing the active item on the menu-->
<script>
$(document).ready(function(){
	$('#bluecard').addClass("active");
});

$("#yes-card").click(function() {
	$("#have-card").slideUp();
	$("#blue-card-form").slideDown();
});
$("#no-card").click(function() {
	$("#have-card").slideUp();
	$("#show-bluecard-docs").slideDown();
});

</script>
<!-- The above code is used to change the active item on the menu. To be explicitly pasted on each page that is created-->
<?php
	}
}
?>
<div style="clear:both;">
</div>
<?php
include('footer.php');
?>
</body>
</html>
