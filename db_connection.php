<?php

$servername = "localhost";
$username = "root";
$password = "test123";
$database = "tracker";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	// else {
	// 	echo "you are connected! <br />";
	// }

//$conn->close();

?>