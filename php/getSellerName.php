<?php
require_once "conn.php";
$outputData=array();
try{
    session_start();
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        $sql="SELECT real_name FROM user WHERE user_id='". $_POST["userId"] ."';";
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