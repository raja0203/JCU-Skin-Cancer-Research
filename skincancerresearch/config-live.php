<?php
//define constants for connection info
define("MYSQLUSER","root");
define("MYSQLPASS","");
define("HOSTNAME","localhost");
define("MYSQLDB","skincancerresearch");

//make connection to database
function db_connect()
{
	try{
	$connString="mysql:host=".HOSTNAME.";dbname=".MYSQLDB;
	$conn = new PDO($connString,MYSQLUSER,MYSQLPASS);
	}
	catch (PDOException $e) {
  		die( $e->getMessage() );
	}

	return $conn;
} 
?>