<?php
session_start();
include_once('config.php');
if(!$_SESSION[userid]) die("Please login to access this page.");

if($_FILES){
  $target_dir = "uploads/";
  foreach ($_FILES as $key => $value) {
    $file_name = basename($_FILES[$key]["name"]);
    if($file_name){
      $save_url = $_SESSION[userid].'-'.$key.'-'.preg_replace("/[^a-zA-Z0-9 \.]+/", "", $file_name);
      $save_url = str_replace(" ","_",$save_url);
      $target_file = $target_dir.$save_url;
      if (move_uploaded_file($_FILES[$key]["tmp_name"], $target_file)) {
        $out.=$key." uploaded successfully";
        $sql = "update user_details set ".$key."_file = '$target_file' where userid = $_SESSION[userid] ";
        if($conn->query($sql)){
          $uploaded = true;
          $msg.="http://skincancerresearch.jcubitgroup.com/".$target_file."";
        }
        else{
          $uploaded = false;
          die($conn->error);
        }
    	}
  		else {
  			$error =  "Sorry, there was an error uploading your file.";
  		}
    }
  }
}

if($msg) mail($admin_email,"Completed application forms uploaded by user ".$_SESSION[username],$_SESSION[email]." uploaded ".$msg);


$sql = "Select * from user_details where userid = $_SESSION[userid] ";
$result = $conn->query($sql);
echo $conn->error;
if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();
  $bluecard_application_file = $row[bluecard_application_file];
  $confirmation_of_identity_file = $row[confirmation_of_identity_file];
  $alternative_identification_file = $row[alternative_identification_file];
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
<div style="margin:0 auto" class="col-md-8 col-md-push-2">
  <?php if($out) echo '<div class="alert alert-success">Files uploaded successfully</div>'; ?>

	<div class="jumbotron" id="uploadDocsForm" style="display:none1; padding-top: 0">

		<form action="" method="post" enctype="multipart/form-data" class=" text-left" style="padding:2px 20px; margin-top: 30px;">
			<h2>Upload completed forms</h2>
			<div>
					<div >Completed bluecard application <?php if($bluecard_application_file ) echo '<a href="'.$bluecard_application_file.'">Uploaded file</a>'; ?> </div>
					<div style="padding-left: 10px; padding-bottom: 20px;"><input type="file" name="bluecard_application"></div>
			</div>

			<div>
					<div >Completed confirmation of identity form <?php if($confirmation_of_identity_file ) echo '<a href="'.$confirmation_of_identity_file.'">Uploaded file</a>'; ?> </div>
					<div style="padding-left: 10px; padding-bottom: 20px;"><input type="file" name="confirmation_of_identity"></div>
			</div>

			<div>
					<div >Completed Alternative identification form <?php if($alternative_identification_file ) echo '<a href="'.$alternative_identification_file.'">Uploaded file</a>'; ?></div>
					<div style="padding-left: 10px; padding-bottom: 20px;"><input type="file" name="alternative_identification"></div>
			</div>

			<div style="padding-left: 10px; ">
					<input type="submit" value="Submit" class="" style="">
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
