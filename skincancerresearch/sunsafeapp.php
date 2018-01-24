<script>
function startObservation(){
	school_name = document.getElementByID("school-name");
	school_post_code = document.getElementByID("school-pcode");
	season = document.getElementByID("season").option.value;
	rain = document.getElementByID("rain").option.value;
	if (school_name == null)
	{
		document.getElementByID("school-name").placeholder.style.color="red";
		document.getElementByID("school-name").placeholder="Enter school name";
	}
	document.getElementByID("sssh").disabled=false;
	document.getElementByID("soh").disabled=false;
	document.getElementByID("snoh").disabled=false;
	document.getElementByID("ocssh").disabled=false;
	document.getElementByID("ocoh").disabled=false;
	document.getElementByID("ocnoh").disabled=false;
	document.getElementByID("assh").disabled=false;
	document.getElementByID("aoh").disabled=false;
	document.getElementByID("anoh").disabled=false;
	
}
</script>
<style>
table, td {
	
}
</style>
<?php
session_start();
include_once('config.php');


if($_POST){
	if(!$_POST['blue_card_name'])
		$error.= 'Please enter Name<br>';
	if(!$_POST['card_number'])
		$error.= 'Please enter card number<br>';
	if(!$_POST['issue_number'])
		$error.= 'Please enter issue number<br>';
	if(!$_POST['expiry_date'])
		$error.= 'Please enter expiry date<br>';

	if(!$error) {
		$blue_card_name = $conn->real_escape_string($_POST['blue_card_name']);

		$card_number = $conn->real_escape_string($_POST['card_number']);
		$issue_number = $conn->real_escape_string($_POST['issue_number']);
		$expiry_date = $conn->real_escape_string($_POST['expiry_date']);

		$sql = "update user_details set blue_card_name='$blue_card_name', card_number='$card_number', issue_number='$issue_number', 
expiry_date='$expiry_date', blue_card_status='submitted' where userid = '$_SESSION[userid]'";
		//execute the query
		if($conn -> query($sql)){
			mail($_SESSION['email'],"We have received your bluecard details","Hi $_SESSION[username]
        We have received your bluecard details. They are pending validation. You will receive an email from project co-ordinator once it is successfully 
completed.");
			mail($admin_email,"bluecard updated by user ".$_SESSION[username],'Dear Admin, '.$_SESSION[email]." has uploaded bluecard details. Please login 
to validate bluecard.");
			header("Location:user-status.php");
			die('a');
		}
		else{
			echo $conn->error;
			echo 'Issue in data entry';
		}
	}


}

$sql = "Select blue_card_status from user_details where userid = $_SESSION[userid] ";
$conn -> query($sql);
$result = $conn->query($sql);
echo $conn->error;
if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();
	$status = $row[blue_card_status];
//	die($status);
	if($status=='pending' or $status=='dont_have'){
		// then do nothing and show this page.
	}
	elseif($status=='rejected'){
		$status_message = 'We were not able to validate your blue card. Please submit your blue card details again.';
	}
	else{
		//header("Location: user-status.php");
	}
}


?>

<html>
    <head>
        <title>
            BlueCard
        </title>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    </head>
<body>
<?php
include_once('menu.php');
?>
<div style="margin:auto;" class="content">
	<form action="submit_observation.php" method="post">
	<div class="col-md-6" style="float:left; text-align: left;">
		
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
							<option value="summer">Summer</option>
							<option value="autumn">Autumn</option>
							<option value="winter">Winter</option>
							<option value="spring">Spring</option>
						</select>
					</td>
				</tr>
				<tr>
					<th>Rainy day?</th>
					<td>
						<select name="rain" id="rain">
							<option value="no-rain">No Rain</option>
							<option value="rain">Rain</option>
						</select>
					</td>
				</tr>
				<tr>
					<th>Cloud cover</th>
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
					<th>School ownership</th>
					<td>
						<select name="school-ownership">
							<option value="private">Private</option>
							<option value="public">Public</option>
						</select>
					</td>
				</tr>
				<tr>
					<th>School setting</th>
					<td>
						<select name="school-setting">
							<option value="urban">Urban</option>
							<option value="rural">Rural</option>
						</select>
					</td>
				</tr>
				<tr>
					<th>School Type</th>
					<td>
						<select name="school-type">
							<option value="primary-school">Primary school</option>
							<option value="combinedp-12">Combined P-12</option>
							<option value="secondaryonly">Secondary Only</option>
						</select> 	
					</td>
				</tr>
				<tr>
					<th>Time of the Day</th>
					<td>
						<select name="time-of-day">
							<option value="select time">Select Time</option>
							<option value="before school">Before School</option>
							<option value="after school">After School</option>
							<option value="recess/lunch">Recess/Lunch</option>
							<option value="outdoor lesson">Outdoor Lesson</option>
						</select> 	
					</td>
				</tr>
			</table>
	</div>
	<div class="col-md-6" style="max-width:700px">
		<h3>This section needs to be in landscape</h3>
			<table border="0px">
				<tr><td></td><td style="padding:15px;">Sun Safe Hat</td><td style="padding:15px;">Other Hats</td><td style="padding:15px;">No Hats</td></tr>
				<tr>
					<td style="padding:15px;">Students</td>
					<td style="padding:15px;">
						<input type="number" name="sssh" id="sssh" min="0" max="100" />
					</td>
					<td style="padding:15px;">
						<input type="number" name="soh" id="soh" min="0" max="100" />
					</td>
					<td style="padding:15px;">
						<input type="number" name="snoh" id="snoh" min="0" max="100" />
					</td>
				</tr>
				<tr>
					<td style="padding:15px;">Other Children</td>
					<td style="padding:15px;">
						<input type="number" name="ocssh" id="ocssh" min="0" max="100" />
					</td>
					<td style="padding:15px;">
						<input type="number" name="ocoh" id="ocoh" min="0" max="100" />
					</td>
					<td style="padding:15px;">
						<input type="number" name="ocnoh" id="ocnoh" min="0" max="100" />
					</td>
				</tr>
				<tr>
					<td style="padding:15px;">Adults</td>
					<td style="padding:15px;">
						<input type="number" name="assh" id="assh" min="0" max="100" />
					</td>
					<td style="padding:15px;">
						<input type="number" name="aoh" id="aoh" min="0" max="100" />
					</td>
					<td style="padding:15px;">
						<input type="number" name="anoh" id="anoh" min="0" max="100" />
					</td>
				</tr>
				<tr>
					<td style="padding:15px;">
						<input type="submit" value="submit observation" name="submit" id="submit" style="background-color:blue;color:white;" />
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
</body>
</html>
