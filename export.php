<?php

include('db_connection.php');
// $host="localhost";
// $uname="root";
// $pass="test123";
// $database = "tracker"; 

 $connection=mysql_connect($servername,$username,$password); 

echo mysql_error();

//or die("Database Connection Failed");
$selectdb=mysql_select_db($database) or 
die("Database could not be selected"); 
$result=mysql_select_db($database)
or die("database cannot be selected <br>");

$output = "";
$table = "tracker_list"; // Enter Your Table Name 
$sql = mysql_query("select * from $table");
$columns_total = mysql_num_fields($sql);

// Get The Field Name

for ($i = 0; $i < $columns_total; $i++) {
$heading = mysql_field_name($sql, $i);
$output .= '"'.$heading.'",';
}
$output .="\n";

// Get Records from the table

while ($row = mysql_fetch_array($sql)) {
for ($i = 0; $i < $columns_total; $i++) {
$output .='"'.$row["$i"].'",';
}
$output .="\n";
}

// Download the file

$filename = "Tracker_List.csv";
header('Content-type: application/csv');
header('Content-Disposition: attachment; filename='.$filename);

echo $output;
exit;

?>