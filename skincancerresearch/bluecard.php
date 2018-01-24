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

		$sql = "update user_details set blue_card_name='$blue_card_name', card_number='$card_number', issue_number='$issue_number', expiry_date='$expiry_date', blue_card_status='submitted' where userid = '$_SESSION[userid]'";
		//execute the query
		if($conn -> query($sql)){
			mail($_SESSION['email'],"We have received your bluecard details","Hi $_SESSION[username]
        We have received your bluecard details. They are pending validation. You will receive an email from project co-ordinator once it is successfully completed.");
			mail($admin_email,"bluecard updated by user ".$_SESSION[username],'Dear Admin, '.$_SESSION[email]." has uploaded bluecard details. Please login to validate bluecard.");
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
		header("Location: user-status.php");
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
	<div class="col-md-6" style="float:left; text-align: right;">
		<img src="images/Working-with-Children-Check-Blue-Card-QLD.jpg" width="450" />
	</div>
	<div class="blue-box col-md-6" style="text-align:left; float:left; width: 327px; word-wrap: break-word; min-height: 379px; width: 400px;">
		<h2>Blue Card Eligibility</h2>
		<ul>
			<li>18 years or older</li>
			<li>Queensland resident</li>
			<li>No criminal convictions</li>
			<li>Not a disqualified person <small>(As defined in page 4 of "Working with children check application")</small></li>
		</ul>
		For more information see <a style="color: white;  text-decoration: underline;" href="https://www.bluecard.qld.gov.au/pdf/forms/DJAG001-BC-Blue-card-application.pdf">https://www.bluecard.qld.gov.au/pdf/forms/DJAG001-BC-Blue-card-application.pdf</a>
	</div>
	<div class="" style="clear:both;"></div>

	<div class="col-md-6 col-md-push-3 text-center" id="have-card">
		<?php if($status_message) echo '<div class="alert alert-danger" style="margin-top:10px;">'.$status_message.'</div>'; ?>
		<h2>Do you have a Blue card?</h2>
		<span id="yes-card" class="btn btn-primary btn-lg white-space-normal" style="margin-right:20px">Yes</span>
		<a href="no-bluecard.php" id="no-card" class="btn btn-primary btn-lg white-space-normal">No</a>
	</div>

	<div class="clear-both"></div>
	<div class="col-md-6 col-md-push-3 text-center jumbotron" id="blue-card-form" style="display:none;">
		<h2>Blue Card details</h2>
		<form action="" method="post" class=" text-left" style="padding:20px; max-width: 500px;">
              <div>
                <label for="cardholder"> Blue card holder's name
                  (as appears on  card)</label>
                  <br>
                <input name="blue_card_name" type="text" maxlength="100" id="FullName" style="width: 164px" required>

              </div>
              <div>
              <br>
                <label for="registration_number"> Card number</label><br>
                <input name="card_number" type="number" maxlength="7" style="width: 100px" required>
                &nbsp;/&nbsp;
                <input name="issue_number" type="number" maxlength="2" style="width: 60px" required>
              </div>
              <div>
              <br>
                <label for="expiry_date"> Card expiry date</label> <br>
                <input type="date" name="expiry_date" required  value="" required>
              </div>
              <div align="">
              <br>
                <p>
                  <input type="submit" name="ValidateCardBtn" value="Submit" class="button">
                </p>
              </div>

		</form>
	</div>


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
