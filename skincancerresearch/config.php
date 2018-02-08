<?php
//define constants for connection info
define("MYSQLUSER","jcubitgr_ict");
define("MYSQLPASS","123zxc");
define("HOSTNAME","localhost");
define("MYSQLDB","jcubitgr_scrtest");

// make connection to database
// function db_connect()
// {
// 	try{
// 	$connString="mysql:host=".HOSTNAME.";dbname=".MYSQLDB;
// 	$conn = new PDO($connString,MYSQLUSER,MYSQLPASS);
// 	}
// 	catch (PDOException $e) {
//   		die( $e->getMessage() );
// 	}
//
// 	return $conn;
// }
// $conn  = db_connect();

$conn = new mysqli(HOSTNAME, MYSQLUSER, MYSQLPASS, MYSQLDB);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

error_reporting(E_ERROR | E_WARNING | E_PARSE);

$admin_email = 'simone.harrison@jcu.edu.au';

?>