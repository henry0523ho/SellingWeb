<?php
require_once "conn.php";
$inputData=$_POST;
$outputData=array();
try{
    $purchaseId=$inputData['purchaseId'];
    session_start();
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        $sql="SELECT user_id FROM purchase WHERE purchase_id='".$purchaseId."';";
        $result=$conn->query($sql);
        if($row = $result->fetch_assoc()){
            if ($row["user_id"] == $_SESSION["userId"]){
                $sql = "UPDATE purchase SET purchase_state='Ordering' WHERE purchase_id='".$purchaseId."';";
                $result = $conn->query($sql);
                if($result===TRUE){
                    $outputData["state"] = 200;
                    $outputData["message"] = "ordering";
                }else{
                    throw new Exception("MySQL is broken.");
                }
            }else {
                $outputData["state"] = 401;
                $outputData["message"] = "login first";
            }
        }else{
            $outputData["state"] = 410;
            $outputData["message"] = "no purchase found";
        }
    }else {
        $outputData["state"] = 401;
        $outputData["message"] = "login first";
    }
}catch(Exception $e){
    $outputData["state"]=500;
    $outputData["message"]=$e->getMessage();
}
$outputJson=json_encode($outputData);
echo $outputJson;
$conn->close();
?>