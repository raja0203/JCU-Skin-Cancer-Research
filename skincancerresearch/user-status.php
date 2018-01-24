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
}


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
include_once('menu.php');
?>
<div style="margin:auto" class="content">

	<div class="col-md-6 col-md-push-3 text-center" id="have-card">
		<h2>Your blue card status</h2>
		<p style="font-size:17px;">
			<?php
			if($status=='submitted'){
				echo 'We have received your blue card details. These are pending validation';
			}
			elseif($status=='approved'){
				echo "Your bluecard has been validated. Please <a href='take_test.php'>Take test</a>";
			}
			elseif($status=='test_passed'){
				echo "Congratulations!! You have passed the test!! Please check your email to download app.";
				echo "<a href=\"sunsafeapp.php\">Sun Safe Hat App</a>";
				exit;
			}
			elseif($status=='test_failed'){
				echo "You didn't pass the test!! Please <a href='take_test.php'>retake test</a>";
			}
			elseif($status=='app_downloaded'){
				echo "You have passed the test and downloaded app!! Please check your email to download app.";
			}

			?>
		</p>
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
