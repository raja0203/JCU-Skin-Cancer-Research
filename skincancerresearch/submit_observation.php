<?php
session_start();
include_once('config.php');
if(isset($_POST['school-name'],$_POST['school-pcode'],$_POST['season'],$_POST['rain'],$_POST['cloud-cover'],$_POST['school-ownership'],$_POST['school-setting'],$_POST['school-type'],$_POST['time-of-day'],$_POST['sssh'],$_POST['soh'],$_POST['snoh'],$_POST['ocssh'],$_POST['ocoh'],$_POST['ocnoh'],$_POST['assh'],$_POST['aoh'],$_POST['anoh'])){
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
	$userid = $_SESSION['userid'];
	$sql = "insert into observation_details (school_name,school_postcode,season,rain,cloud_cover,school_ownership,school_setting,school_type,time_of_day,std_withhat,children_withhat,adult_withhat,std_withouthat,children_withouthat,adult_withouthat,std_withotherhat,children_withotherhat,adult_withotherhat,user_id)values ('$school_name','$school_pcode','$season','$rain','$cloud_cover','$school_ownership','$school_setting','$school_type','$time_of_day','$sssh','$ocssh','$assh','$snoh','$ocnoh','$anoh','$soh','$ocoh','$aoh','$userid')";
	if($conn -> query($sql)){
		echo "observations have been uploaded successfully";
	}
	else{
		echo "connect Error: ". mysqli_error($conn);
	}
	$conn->close();
	
}
?>