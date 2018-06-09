<?php
session_start();
include_once('config.php');
	$pcode = $_POST['pcode'];
	$query = "SELECT school_name FROM school_list WHERE school_pcode=$pcode ORDER BY school_name";
	$conn -> query($query);
	$result = $conn->query($query);
	$flag=0;
	$school_names =[];
	if($result->num_rows >0)
	{	
		$flag=1;
		foreach($result as $school_name)
		{
			array_push($school_names,$school_name);
		}
	}
		echo json_encode($school_names);
	

?>