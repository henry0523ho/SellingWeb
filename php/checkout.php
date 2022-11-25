<?php

use function PHPSTORM_META\type;

header("Access-Control-Allow-Origin: *");
require_once "conn.php";
$datas = $_POST; //預設 checkbox 傳進來，key = select = checkbox 的 name = id
$outputData = array();
foreach($datas as $row){
    $sql = "SELECT * FROM `product` WHERE `product_id` = '{$row}'";
    $result = mysqli_query($conn, $sql);
    $product = mysqli_fetch_assoc($result);
    $sql2 = "SELECT * FROM `purchase` WHERE `product_id` = '{$product['product_id']}'";
    $result2 = mysqli_query($conn, $sql2);
    $purchase = mysqli_fetch_assoc($result);
    $obj = [
       "id" => $product['product_id'],
       "name" =>  $product['product_name'],
       "price" => $product['product_price'],
       "num" => $purchase['purchase_num'],
    ];
    array_push($outputData, json_encode($obj));
}
$outputData = json_encode($outputData);
echo $outputData;
?>