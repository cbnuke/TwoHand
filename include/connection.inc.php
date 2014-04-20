<?php
$hostname = "localhost";
$username = "root";
$password = "root";
$database = "twohand";
$objConnect = mysqli_connect($hostname, $username, $password, $database);

$str = (mysqli_connect_errno($objConnect)) ? "MySQL Connect Failed" : "";

echo "$str";
?>