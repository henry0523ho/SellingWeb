<?php
header("Access-Control-Allow-Origin: *");
require_once "conn.php";
session_start();
$outputData = array();
$sql = "SELECT * FROM `user` WHERE `user_name` = '{$_SESSION['userName']}'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$sql = "SELECT * FROM `product` WHERE `seller_id` = '{$row['user_id']}'";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)){
    $obj = [
        "id" => $row["product_id"],
        "name" => $row["product_name"],
        "price" => $row["product_cost"],
        "postdate" => $row["product_postdate"],
    ];
    array_push($outputData, $obj);
}
$outputJSON = json_encode($outputData);
echo $outputJSON;
$conn->close();
?>