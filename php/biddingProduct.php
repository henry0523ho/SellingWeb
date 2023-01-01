<?php
require_once "conn.php";
$data=$_POST;
$outputData = array();
try{
    $productId=$_POST["productId"];
    $productPrice=$_POST["productPrice"];
    session_start();
    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
        $sql = "UPDATE bidding
                SET price = '" . $productPrice . "',
                user_ID = '" .  $_SESSION["userId"] . "'
                WHERE product_id = '" .  $productId ."'
                AND state = '1';";
        $result = $conn->query($sql);
        if ($result === TRUE) {
            $outputData["state"] = 200;
            $outputData["message"] = "create success";
        } else {
            throw new Exception("MySQL is broken.");
        }
    } else {
        $outputData["state"] = 401;
        $outputData["message"] = "login first to bidding.";
    }
}catch(Exception $e){
    $outputData["state"]=500;
    $outputData["message"] = $e->getMessage();
}
$outputJson = json_encode($outputData);
echo $outputJson;
$conn->close();
?>