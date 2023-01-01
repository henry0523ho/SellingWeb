<?php
header("Access-Control-Allow-Origin: *");

$dbServerName = "localhost";
$dbUserName = "root";
$dbPwd = "";
$dbName = "selling_web";
$rootUrl= "http://localhost/workSpace/SellingWeb/";

// 伺服器設定
// $dbServerName = "localhost";
// $dbUserName= "id19917486_root";
// $dbPwd= "21gnaY5oH3nehC!";
// $dbName= "id19917486_selling_web";
// $rootUrl="https://sellingwebchen3ho5yang12.000webhostapp.com/";

$conn = new mysqli($dbServerName, $dbUserName, $dbPwd,$dbName);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error."<br>");
}
// echo "Connected successfully<br>";
?>