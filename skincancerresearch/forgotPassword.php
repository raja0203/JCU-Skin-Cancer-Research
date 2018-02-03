<?php
session_start();
include_once('config.php');
if ($_SESSION['userid']){
  header("Location:bluecard.php");
}
?>
<html>
    <head>
        <title>
            Login
        </title>
    </head>
<body>
<?php
include_once('menu.php');
?>


<div align="" style="margin:auto" class="content">
  <?php
  if(isset($_SESSION['error'])){
    echo '<div class="alert alert-danger text-center">'.$_SESSION['error'].'</div>';
    unset($_SESSION['error']);
  }
  if(isset($_SESSION['success'])){
    echo '<div class="alert alert-success text-center">'.$_SESSION['success'].'</div>';
    unset($_SESSION['error']);
  }
  ?>
<form action="sendPassword.php" method="post" class="col-md-6 col-md-push-3 jumbotron">

	<h2 class="text-center">Login</h2>
	<div class="col-md-5 text-right  ">Email ID</div>
	<div class="col-md-7 margin-bottom-10"><input type="text" name="email"></div>

	<div class="col-md-5 text-right  ">Re-type Email ID </div>
	<div class="col-md-7 margin-bottom-10"><input type="text" name="retypeemail"></div>

	<div class="col-md-5 text-right  "></div>
	<div class="col-md-7"><input type="submit" value="Submit"></div>


</form>
</div>
<script>
$(document).ready(function(){

$('#login').addClass("active");
});
</script>
</body>
</html>
