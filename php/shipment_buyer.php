<?php
require_once "conn.php";
$data=$_POST;
$outputData=array();
try{
    //$user_id=$_POST["userid"]
    session_start();
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
    {
        $sql="SELECT * FROM purchase join product using(product_id) WHERE user_id='". $_SESSION["userId"] ."'AND purchase_state<>'InCart'AND purchase_state<>'Ordering';";
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
?>