<?php
session_start();
include_once('config.php');
?>
<html>
    <head>
        <title>
            Home
        </title>
    </head>
<body>
<?php
include_once('menu.php');
?>
<div align="center" style="margin:auto" class="content">
	<h1>Contact us</h1>

	<div style="display:inline-block; text-align: left;">
    <p><img src="images/email-phone-simone.png" width="300" /></p>
		<p><img src="images/email-phone-jcu-skincare.png" width="400" /></p>
		<p><h2>Project Director:</h2>Dr Simone Harrison <br>
		JCU Skin Cancer Research Unit <br>
		College of Public Health, Medical and Veterinary Sciences
		</p>
		<p><img src="images/simone.jpg" width="300" /></p>

	</div>
</div>
<!--This code is used for changing the active item on the menu-->
<script>
$(document).ready(function(){
$('#contact').addClass("active");
});
</script>
<!-- The above code is used to change the active item on the menu. To be explicitly pasted on each page that is created-->
</body>
</html>
