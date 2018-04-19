<?php
session_start();
include('config.php');
$carnival_obs_id = $_POST['delete'];
$sql = "delete from carnival_observations where carnival_obs_id = ".(int)$carnival_obs_id;
if ($conn->query($sql) === TRUE) {
	header('Location: observationDeleted.php');
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}
?>