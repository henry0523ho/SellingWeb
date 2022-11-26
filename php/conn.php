<?php
header("Access-Control-Allow-Origin: *");
$dbServerName = "localhost";
$dbUserName = "root";

$dbPwd = "";
$dbName = "selling_web";
// Create connection
$conn = new mysqli($dbServerName, $dbUserName, $dbPwd,$dbName);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error."<br>");
}
// echo "Connected successfully<br>";
?>