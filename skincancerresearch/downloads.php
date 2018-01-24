<?php
session_start();
include_once('config.php');
?>
<html>
    <head>
        <title>
            Downloads
        </title>
    </head>
<body>
<?php
include_once('menu.php');
?>
<div align="center" style="margin:auto" class="content">
	<h1>Downloads</h1>

	<div style="display:inline-block; text-align: left;">
    <div class="col-sm-12">
	<ol>
		<li><a href="files/Bluecard 2018.pdf" target="_blank">Blue card application, partially completed</a>
			(Right click and save to save this pdf to your system)
		</li>
    <li><a href="files/DJAG039-Confirmation-of-identity.pdf" target="_blank">Confirmation of identity form</a>
			(Right click and save to save this pdf to your system)
		</li>
    <li><a href="files/DJAG015-Request-to-consider-alternative-identification.pdf" target="_blank">A Request To Consider Alternative Identification form</a>
			(Right click and save to save this pdf to your system)
		</li>

    <?php if($_SESSION[userid]){ ?>
      <li>
        <a href="http://skincancerresearch.jcubitgroup.com/download_app.php?userid=<?php echo $_SESSION[userid]; ?>">Download app</a>
      </li>
    <?php } ?>

	</ol>
</div>
	</div>

<div class="row">
  <div class="col-sm-3 col-md-4">
    <img class="img-responsive" src="images/Sid sunsafe toddler.jpg">
  </div>
  <div class="col-sm-3 col-md-4">
    <img class="img-responsive" src="images/shari.png" >
  </div>
  <div class="col-sm-3 col-md-4">
    <img  class="img-responsive" src="images/townsville beach.jpg">
  </div>
</div>
</div>
<!--This code is used for changing the active item on the menu-->
<script>
$(document).ready(function(){
$('#download').addClass("active");
});
</script>
<!-- The above code is used to change the active item on the menu. To be explicitly pasted on each page that is created-->
</body>
</html>
