<?php 
require_once "conn.php";
$inputData = $_POST;
$outputData = array();
try{
    $purchaseNum=$_POST["purchaseNum"];
    $productId=$_POST["productId"];
    session_start();
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        $sql = "SELECT purchase_state 
                FROM purchase 
                WHERE user_id='". $_SESSION["userId"] ."'
                AND product_id= '". $productId ."';";
        $result = $conn->query($sql);
        if($row = $result->fetch_assoc())
        {
            if($row["purchase_state"] == "InCart")
            {
                $sql = "UPDATE purchase 
                        SET purchase_Num='". $purchaseNum ."',purchase_State='InCart',product_id='". $productId ."'
                        WHERE product_id='" . $productId . "'
                        AND user_id='". $_SESSION["userId"] ."';";
                $result = $conn->query($sql);
                if($result === TRUE)
                {
                    $outputData["state"]=200;
                    $outputData["message"]="update success";
                }
                else
                {
                    throw new Exception("MySQL is broken.");
                }
            }
        }
        else
        {
            $sql = "INSERT INTO purchase(purchase_Num, purchase_State, product_Id,user_id) VALUES('". $purchaseNum ."','InCart','". $productId ."','". $_SESSION["userId"] ."');";
            $result = $conn->query($sql);
            if($result === TRUE){
                $outputData["state"] = 200;
                $outputData["message"] = "put in cart success";
            }
            else{
                throw new Exception("MySQL is broken.");
            }
        }
    }
}catch(Exception $e){
    $outputData["state"]=500;
    $outputData["message"] = $e->getMessage();
}
$outputJson = json_encode($outputData);
echo $outputJson;
?>
