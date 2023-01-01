<?php
require_once "conn.php";
$outputData=array();
try{
    session_start();
    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
        $outputData['state']=200;
        $outputData['userName']=$_SESSION["userName"];
        $outputData['userId']=$_SESSION["userId"];
        $outputData['message']= "OK";
    } else {
        $outputData['state'] = 204;
        $outputData['message'] = "no login";
    }
}catch(Exception $e){
    $outputData['state']=500;
    $outputData['message']=$e->getMessage();
}
$outputJson = json_encode($outputData);
echo $outputJson;
$conn->close();
?>