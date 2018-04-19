<?php
session_start();
include('config.php');
if(isset($_POST['school-name'],$_POST['school-pcode'],$_POST['season'],$_POST['rain'],$_POST['cloud-cover'],$_POST['school-ownership'],$_POST['school-setting'],$_POST['school-type'],$_POST['time-of-day'],$_POST['sssh'],$_POST['soh'],$_POST['snoh'],$_POST['ocssh'],$_POST['ocoh'],$_POST['ocnoh'],$_POST['assh'],$_POST['aoh'],$_POST['anoh'],$_POST['slong'],$_POST['sshort'],$_POST['sno'],$_POST['oclong'],$_POST['ocshort'],$_POST['ocno'],$_POST['along'],$_POST['ano'],$_POST['ashort'])){
	$school_name = $_POST['school-name'];
	$school_pcode = (int)$_POST['school-pcode'];
	$season = $_POST['season'];
	$rain = $_POST['rain'];
	$cloud_cover = $_POST['cloud-cover'];
	$school_ownership = $_POST['school-ownership'];
	$school_setting = $_POST['school-setting'];
	$school_type = $_POST['school-type'];
	$time_of_day = $_POST['time-of-day'];
	$sssh = (int)$_POST['sssh'];
	$soh = (int)$_POST['soh'];
	$snoh = (int)$_POST['snoh'];
	$ocssh = (int)$_POST['ocssh'];
	$ocoh = (int)$_POST['ocoh'];
	$ocnoh = (int)$_POST['ocnoh'];
	$assh = (int)$_POST['assh'];
	$aoh = (int)$_POST['aoh'];
	$anoh = (int)$_POST['anoh'];
	$slong= (int)$_POST['slong'];
	$sshort= (int)$_POST['sshort'];
	$sno = (int)$_POST['sno'];
	$oclong = (int)$_POST['oclong'];
	$ocshort = (int)$_POST['ocshort'];
	$ocno = (int)$_POST['ocno'];
	$along = (int)$_POST['along'];
	$ashort = (int)$_POST['ashort'];
	$ano = (int)$_POST['ano'];
	$userid = $_SESSION['userid'];
	$start_time = $_POST['start-time'];
	$carnival = $_POST['carnival'];
	date_default_timezone_set("Australia/Brisbane");
	$end_time = date("h:i:sa");
	
	date_default_timezone_set("Australia/Brisbane");
	$date = date ("y/m/d");
	$sql = "insert into carnival_observations (school_name,school_postcode,season,rain,cloud_cover,school_ownership,school_setting,school_type,time_of_day,carnival,sssh,ocssh,assh,snoh,anoh,ocnoh,soh,aoh,ocoh,slong,sshort,sno,oclong,ocshort,ocno,along,ashort,ano,date, start_time,end_time,duration, user_id) values ('$school_name','$school_pcode','$season','$rain','$cloud_cover','$school_ownership','$school_setting','$school_type','$time_of_day','$carnival','$sssh','$ocssh','$assh','$snoh','$anoh','$ocnoh','$soh','$aoh','$ocoh','$slong','$sshort','$sno','$oclong','$ocshort','$ocno','$along','$ashort','$ano','$date','$start_time','$end_time','$end_time','$userid')";
	$result = $conn -> query($sql);
	echo "connect Error: ". mysqli_error($conn);
	if($result){
		echo "observations have been uploaded successfully";
		echo "$start_time";
		echo "$end_time";
		mail ("simone.harrison@jcu.edu.au, lynne.bartlett@jcu.edu.au", "Remainder of New data... BACK UP!!!!!!", "A new Observation has been recorded by ".$useid." at ".$school_name.".",$admin_email);
		echo "connect Error: ". mysqli_error($conn);
		header ('Location: successfulSubmission.php');
	}
	else{
		//echo $userid;
		echo "connect Error: ". mysqli_error($conn);
	}
}
?>