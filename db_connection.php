<?php

$servername = "localhost";
$username = "root";
$password = "test123";
$dbname = "tracker";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	/*else {
		echo "you are connected! <br />";
	}*/	

//$conn->close();

?>