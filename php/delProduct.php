<?php
require_once "conn.php";
$inputData=$_POST;
$outputData=array();
try{
    $productId=$inputData['productId'];
    session_start();
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        $sql = "SELECT seller_id FROM product WHERE product_id='".$productId."';";
        $result=$conn->query($sql);
        if($row = $result->fetch_assoc()){
            if($row['seller_id']==$_SESSION["userId"]){
                $sql="DELETE FROM product WHERE product_id='".$productId."';";
                $result=$conn->query($sql);
                if($result===TRUE){
                    $outputData["state"] = 200;
                    $outputData["message"] = "delete success";
                }else{
                    throw new Exception("MySQL is broken.".$result);
                }
            }else{
                $outputData["state"] = 401;
                $outputData["message"] = "login first to delProduct.";
            }
        }else{
            $outputData["state"]=410;
            $outputData["message"]="no product found";
        }
    }else{
        $outputData["state"] = 401;
        $outputData["message"] = "login first to delProduct.";
    }

}catch(Exception $e){
    $outputData["state"]=500;
    $outputData["message"]=$e->getMessage();
}
$outputJson=json_encode($outputData);
echo $outputJson;
?>