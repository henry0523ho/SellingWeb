<?php
require_once "conn.php";

$inputData=$_POST;
$outputData=array();

try{
    session_start();
    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
        if($inputData['chatText']!=''){
            $sql= 'INSERT INTO chat (user_id_from, user_id_to, chat_text) VALUES ("'. $_SESSION['userId'].'", "'. $inputData['userIdTo'].'", "'.$inputData['chatText'].'")';
            $result = $conn->query($sql);
            if($result===TRUE){
                $outputData['state']=200;
                $outputData['message']="OK";
            }else{
                $outputData['state'] = 400;
                $outputData['message'] = "mysql is broken. QAQ";
            }
        }else{
            $outputData['state']=204;
            $outputData['message'] = "no chat_text";
        }
        
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