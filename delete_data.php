<?php
include('db_connection.php');

$id = $_GET['id'];

$conn->query("DELETE FROM tracker_list WHERE id = '".$id."' ");
if($conn) {
	
	echo "
	<script language='javascript'>
	alert('Record Deleted')
	window.location.href = 'tracker.php'; 
	</script>
	";
} else {
	echo "Record not Deleted";
}
?>