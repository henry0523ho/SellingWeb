<?php
require_once "conn.php";
$outputData= array();
try{
    if(isset($_POST['userName'],$_POST['userPwd'],$_POST['userEmail'],$_POST['phone'],$_POST['realName'])){
        $sql = "SELECT user_name FROM user WHERE user_name='" . $_POST['userName'] . "';";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $outputData['state'] = 409;
            $outputData['message'] = "nameTaken";
        }else{
            $pwdHash = password_hash($_POST['userPwd'], PASSWORD_DEFAULT);
            $sql = "INSERT INTO user (user_name, user_pwd_hash, user_email,real_name,phone) VALUES ('" . $_POST['userName'] . "', '" . $pwdHash . "','" . $_POST['userEmail'] . "', '" . $_POST['realName'] . "', '" . $_POST['phone'] . "');";
            $result = $conn->query($sql);
            $outputData['userId']=$conn->insert_id;
            $outputData['state'] = 200;
            $outputData['message'] = "OK";
            //寄email驗證(伺服器)
            // $userId = $conn->insert_id;
            // require "sendAuthEmail.php";
            // sendAuthMail($userId);
            
        }
    }else{
        $outputData['state'] = 406;
        $outputData['message'] = "key value missing";
    }
}catch(Exception $e){
    $outputData['state']=500;
    $outputData['message']=$e->getMessage();
}

$outputJson = json_encode($outputData);
echo $outputJson;
$conn->close();