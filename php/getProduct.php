<?php
require_once "conn.php";
$inputData = $_POST;
$outputData=array();
try{
    $productId=$_POST["productId"];
    session_start();
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
    {
        $sql="SELECT * FROM product WHERE product_id = '" .$productId. "';";
        $result=$conn->query($sql);
        $row=$result->fetch_assoc();
        $outputData['data']=array();
        array_push($outputData['data'],$row);
        $outputData['state']=200;
        $outputData['message']="OK";
    }
    
}catch(Exception $e){
    $outputData['state']=500;
    $outputData['message']=$e->getMessage();
}
$outputJson = json_encode($outputData);
echo $outputJson;
$conn->close();
?>