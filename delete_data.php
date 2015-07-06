<?php
include('db_connection.php');

$id = $_GET['id'];

$conn->query("DELETE FROM tracker_list WHERE id = '".$id."' ");
if($conn) {
	echo "Record Deleted";
} else {
	echo "Record not Deleted";
}
?>