<?php
require_once "conn.php";
$outputData= array();
try{
    session_start();
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        $userList= array();
        $sql='SELECT user_id_to FROM chat WHERE user_id_from="'.$_SESSION['userId'].'" GROUP BY user_id_to';
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()){
            array_push($userList,$row['user_id_to']);
        }
        $sql = 'SELECT user_id_from FROM chat WHERE user_id_to="' . $_SESSION['userId'] . '" GROUP BY user_id_from';
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            array_push($userList, $row['user_id_from']);
        }
        $userList = array_unique($userList);
        $outputData['chatList']=array();
        for($i=0;$i<count($userList);$i++){
            $tmp=array();
            $tmp['userId']=$userList[$i];
            $sql='SELECT user_name FROM user WHERE user_id="'.$tmp['userId'].'";';
            $tmp['userName']=($conn->query($sql)->fetch_assoc())['user_name'];
            $sql='SELECT user_id_from,chat_text,chat_time,already_read FROM chat WHERE (user_id_from="'.$tmp['userId'].'" AND user_id_to="'.$_SESSION['userId'] . '") OR (user_id_from="'.$_SESSION['userId'].'" AND user_id_to="'.$tmp['userId'].'") ORDER BY chat_time DESC LIMIT 1;';
            $ret=$conn->query($sql)->fetch_assoc();
            $tmp['lastMessage']=$ret['chat_text'];
            if($ret['already_read']==0&&$ret['user_id_from']==$tmp['userId']){
                $tmp['already_read']=0;
            }else{
                $tmp['alreadyRead']=1;
            }
            array_push($outputData['chatList'],$tmp);
        }
        $outputData['state']=200;
        $outputData['message']="OK";
    }else{
        $outputData['state']=401;
        $outputData['message']="login first";
    }
}catch(Exception $e){
    $outputData['state']=500;
    $outputData['message']=$e->getMessage();
}
$outputJson = json_encode($outputData);
echo $outputJson;

