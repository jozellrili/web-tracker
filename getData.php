<?php
include('db_connection.php');

$query="SELECT * FROM tracker_list ";
$result = $conn->query($query);

$arr = array();
if($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		$arr[] = $row;	
	}
}
# JSON-encode the response
$json_response = json_encode($arr);

// # Return the response
echo $json_response;


?>
