<?php
session_start();
include_once('config.php');
?>
<html>
    <head>
        <title>
            Help
        </title>
        <style>
        ul.checklist {
  list-style: none;
}

ul.checklist li:before {
  content: '✓ ';
}
ul.checklist li {
  margin-bottom: 10px;
}
        </style>
    </head>
<body>
<?php
include_once('menu.php');
?>
<div align="center" style="margin:auto" class="content">
	<h1>Training</h1>
  <div class="text-center">
    <h3>TO LEARN HOW TO CONDUCT RELIABLE HAT-WEARING OBSERVATIONS <br>
      <small>PLEASE CLICK ON THE LINK BELOW TO WATCH A QUICK SLIDE-SHOW</small><br>
      <div style="margin-top:10px;"><a href="files/Presentation hatcounting final for team Aug17.pdf" target="_blank" >HAT-COUNTING PRESENTATION</a></div>
      <br>
      <small>DOWNLOAD OUR MANUAL BY CLICKING ON:</small>
      <div style="margin-top:10px;">
        <a href="files/Observations of hat wearing manual 18april17.pdf" target="_blank">OBSERVATIONS OF HAT WEARING MANUAL</a>
      </div>
      <br><br>
      <span>ONCE YOU HAVE COMPLETED THE TRAINING ABOVE</span>
    </h3>



	<div style="display:inline-block; text-align: left;">
  	<ul>
  		<li>
        IF YOU HAVE ALREADY PROVIDED US WITH YOUR BLUE CARD NUMBER, CLICK ON THE BUTTON TO DO THE QUIZ<br>
        <a class="btn btn-primary btn-lg white-space-normal" href="take_test.php">Click here to take the Quiz</a>
      </li>
  		<li>
        <span class="color-red">NEW BLUE-CARD APPLICANTS:</span> (Please allow 1 month for processing)
        <ul class="checklist-ul">
          <li>When your blue card arrives in the post, please remember to log-in</li>
          <li>Select YES to respond to the question "DO YOU HAVE A BLUE CARD"</li>
          <li>Enter your Blue Card number</li>
          <li>We will email you indicating your Blue-card details are pending</li>
          <li>Once we have verified your Blue Card details, we will email you to let you know (please allow 1-2 days)</li>
          <li>After successful completion of training and quiz a unique code will be sent to you, so you can dowmload the study APP</li>
          <li>Please log-in to the website again and visit this page (Training)</li>
          <li>Click on the button to take the <a href="take_test.php">QUIZ</a></li>
        </ul>
        
        </li>

  	</ul>
    <div class="text-center h4">
      If you have any difficulties, please do not hesitate to <a href="contact.php">CONTACT US</a>
    </div>
	</div>


</div>
</div>
<div style="display:inline-block; text-align: left; margin-left: 150px;">
  <h2>RELATED RESOURCES</h2>
<ol>
  <li><a href="http://www.sunsmart.com.au/skin-cancer" target="_blank">Skin cancer info</a> (External link)</li>
  <li><a href="http://www.arpansa.gov.au/uvindex/realtime/tow_rt.htm" target="_blank">Townsville Real-time UV levels</a> (External link)</li>
  <li><a href="http://uveducation.usq.edu.au/uv-education- activities/about-uv/"target="_blank">About UV (including activities for students)</a> (External link)</li>
</ol>
</div>


<!--This code is used for changing the active item on the menu-->
<script>
$(document).ready(function(){
$('#training').addClass("active");
});
</script>
<!-- The above code is used to change the active item on the menu. To be explicitly pasted on each page that is created-->
</body>
</html>