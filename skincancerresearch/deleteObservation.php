<?php
session_start();
include('config.php');
$obs_id = $_POST['delete'];
$sql = "delete from observation_details where Obs_id = ".(int)$obs_id;
if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}
?>