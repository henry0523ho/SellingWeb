<?php
require_once "conn.php";
$input=$_POST;
$outputData= array();
try{
    $userName = $input["userName"];
    $userPwd = $input["userPwd"];
    $userEmail = $input["userEmail"];
    $sql = "SELECT user_name FROM user WHERE user_name='" . $userName . "';";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $outputData['state']=409;
        $outputData['message']="nameTaken";
    } else {
        $pwdHash = password_hash($userPwd, PASSWORD_DEFAULT);
        $sql = "INSERT INTO user (user_name, user_pwd_hash, user_email) VALUES ('" . $userName . "', '" . $pwdHash . "','" . $userEmail . "');";
        $result = $conn->query($sql);
        if ($result === TRUE) {
            $outputData['state'] = 200;
            $outputData['message'] = "OK";
        } else {
            $outputData['state'] = 500;
            $outputData['message'] ="failed";
        }
    }
}catch(Exception $e){
    $outputData['state']=500;
    $outputData['message']=$e->getMessage();
}

$outputJson = json_encode($outputData);
echo $outputJson;
