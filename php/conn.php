<?php
$dbServerName = "localhost";
$dbUserName = "root";
$dbPwd = "Cherry900327";
$dbName = "selling_web";
// Create connection
$conn = new mysqli($dbServerName, $dbUserName, $dbPwd,$dbName);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error."<br>");
}
// echo "Connected successfully<br>";
?>