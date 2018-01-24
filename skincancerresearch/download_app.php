<?php
session_start();
include_once('config.php');



if($_POST){
	if(!$_POST['appDownloadCode'])
		$error.= 'Please enter App download code<br>';

	if(!$error) {
		$appDownloadCode = $_POST['appDownloadCode'];

    $sql = "Select appDownloadCode from user_details where userid = ".intval($_GET[userid]);
    $result = $conn->query($sql);
    echo $conn->error;
    if ($result->num_rows > 0) {
    	$row = $result->fetch_assoc();
      if($appDownloadCode==$row[appDownloadCode]){
        $sql = "update user_details set blue_card_status = 'app_downloaded' where userid = $_SESSION[userid] ";
        $conn -> query($sql);
        if($conn->error) die($conn->error);
        $status_message = "Your app will download now.";
        header("Location: files/HatAppBeta4.apk");
        //die();
      }
      else{
        $status_message = "App download code is not valid. Please try again.";
      }
    }
    else{
      $status_message = "User id is not valid";
    }
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
<?php if($status_message) echo '<div class="alert alert-danger">'.$status_message.'</div>'; ?>
	<div class="col-md-6 col-md-push-3 text-center jumbotron" id="blue-card-form">
    <h2>Download App</h2>
		<form action="" method="post" class=" text-left" style="padding:20px; max-width: 500px;">
              <div>
                <label for="cardholder"> App Download code
                  <br>
                <input name="appDownloadCode" type="text" maxlength="100" style="width: 400px" required>
              </div>
              <div>
                <p>
                  <input type="submit" name="ValidateCardBtn" value="Submit and Download app" class="button">
                </p>
              </div>

		</form>
	</div>
</div>
</body>
</html>