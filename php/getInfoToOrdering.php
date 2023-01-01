<?php
require_once "conn.php";
$outputData=array();
try{
    session_start();
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        $sql="SELECT * FROM product NATURAL JOIN purchase NATURAL JOIN user WHERE user_id='". $_SESSION["userId"] ."' AND purchase_state='Ordering' AND seller_id='". $_POST["sellerId"] ."';";
        $result=$conn->query($sql);
        $outputData['data']=array();
        while($row=$result->fetch_assoc())
        {
            array_push($outputData['data'],$row);
        }
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