<?php
session_start();
include_once('config.php');

if($_SESSION[userid]){
	$sql = "update user_details set blue_card_status='dont_have' where userid = '$_SESSION[userid]'";
	$conn -> query($sql);
}
else {
	header("location: login.php");
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
<div style="margin:0 auto; font-size:17px;" class="col-md-8 col-md-push-2">

	<p>MOST PEOPLE NEED TO COMPLETE FORMS 1 AND 2 BELOW BECAUSE MOST VOLUNTEERS WILL NOT BE KNOWN TO THE STUDY COORDINATOR:</p>
	<ol>
		<li>Please complete this <a href="files/Bluecard 2018.pdf" target="_blank">partially completed Blue card application</a><br>
				(Right click and save this pdf to your computer)
		</li>
		<li>
			Please complete this <a href="files/DJAG039-Confirmation-of-identity.pdf" target="_blank">confirmation of identity form</a><br>
			(Right click and save this pdf to your computer)
		</li>
	</ol>

	<p>Once these forms are complete please take the required identification to be witnessed by one of the following:</p>
	<ul>
		<li>Justice of the Peace</li>
		<li>Commisssioner for Declarations</li>
		<li>Lawyer</li>
		<li>Police Officer</li>
	</ul>



	<p>PEOPLE WHO NEED TO USE FORMS OF IDENTIFICATION OTHER THAN THOSE LISTED IN THE APPLICATION SHOULD DOWNLOAD AND COMPLETE
	<a href="files/DJAG015-Request-to-consider-alternative-identification.pdf" target="_blank">A Request To Consider Alternative Identification</a></p>

	<div class="blue-box col-md-6" style="display:inline-block; margin-top: 20px; margin-bottom: 30px; text-align:left; width:auto;">
		<ul>
			<li>Blue Card services normally take 1 month to Process Applications.</li>
			<li>Your Blue Card will be sent to your postal address.</li>
			<li>Please complete the <a style="color:white; text-decoration:underline;" href="training.php">online Training</a> while your blue card is being processed.</li>
		</ul>
	</div>




	<a href="upload_files.php" class="btn btn-primary" id="uploadDocs" onclick="$('#uploadDocsForm').show();">
		Please upload scanned ID &amp; completed application forms here.
	</a>



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