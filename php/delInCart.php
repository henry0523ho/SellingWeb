<?php
require_once "conn.php";
$inputData=$_POST;
$outputData=array();
try{
    $purchaseId=$inputData['purchaseId'];
    session_start();
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        $sql = "SELECT user_id FROM purchase WHERE purchase_id='".$purchaseId."';";
        $result=$conn->query($sql);
        if($row = $result->fetch_assoc()){
            if($row['user_id']==$_SESSION["userId"]){
                $sql="DELETE FROM purchase WHERE purchase_id='".$purchaseId."';";
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