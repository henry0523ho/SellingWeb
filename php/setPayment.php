<?php
require_once "conn.php";
$ourputData=array();
try{
    $payment=$_POST['payment'];
    $purchaseId=$_POST['purchaseId'];
    session_start();
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        $sql="SELECT user_id FROM purchase WHERE purchase_id='".$purchaseId."';";
        $result=$conn->query($sql);
        if($row=$result->fetch_assoc()){
            if($row['user_id']==$_SESSION["userId"]){
                $sql = "UPDATE purchase SET payment='".$payment."' WHERE purchase_id='".$purchaseId."';";
                $result=$conn->query($sql);
                if($result===TRUE){
                    $outputData["state"]=200;
                    $outputData["message"]="payment update";
                }else{
                    throw new Exception("MySQL is broken");
                }
            }else{
                $outputData["state"] = 401;
                $outputData["message"] = "login first";
            }
        }else{
            $outputData["state"] = 410;
            $outputData["message"] = "no purchase found";
        }
    }else{
        $outputData["state"]=401;
        $outputData["message"]="login first";
    }
}catch(Exception $e){
    $outputData["state"]=500;
    $outputData["message"]=$e->getMessage();
}
$outputJson=json_encode($outputData);
echo $outputJson;