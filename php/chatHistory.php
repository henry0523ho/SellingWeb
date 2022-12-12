<?php
require_once "conn.php";
$inputData=$_POST;
$outputData=array();

try{
    session_start();
    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
        $timeFrom=$inputData["timeFrom"];
        if($timeFrom==""){
            $timeFrom= '1000-01-01 00:00:00';
        }
        $timeTo=$inputData["timeTo"];
        if($timeTo==""){
            $timeTo= '9999-12-31 23:59:59';
        }
        $sql='SELECT * FROM chat WHERE ((user_id_from="'.$_SESSION['userId'].'" AND user_id_to="'.$inputData['userId']. '") OR (user_id_from="' . $inputData['userId'] . '" AND user_id_to="' . $_SESSION['userId'] . '")) AND ( chat_time BETWEEN "'.$timeFrom.'" AND "'.$timeTo.'") ORDER BY chat_time DESC LIMIT 20;';
        $result =$conn->query($sql);
        $outputData['chatData']=array();
        while ($row = $result->fetch_assoc()){
            $tmp=array();
            $tmp['userIdFrom']=$row['user_id_from'];
            $tmp['userIdTo']=$row['user_id_to'];
            $tmp['chatText']=$row['chat_text'];
            $tmp['chatTime']=$row['chat_time'];
            $tmp['chatId']=$row['chat_id'];
            array_push($outputData['chatData'],$tmp);
        }
        $outputData['state']=200;
        $outputData['message']="OK";
    } else {
        $outputData['state'] = 204;
        $outputData['message'] = "no login";
    }
}catch(Exception $e){
    $outputData['state']=500;
    $outputData['message']=$e->getMessage();
}

$outputJson=json_encode($outputData);
echo $outputJson;

