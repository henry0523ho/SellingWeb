<?php
require_once "conn.php";
$data=$_POST;
$outputData= array();
try{
    $userName = $data["userName"];
    $userPwd = $data["userPwd"];
    $sql="SELECT * FROM user WHERE user_name='".$userName."';";
    $result=$conn->query($sql);
    
    $outputData['state'] = 406;
    $outputData['message'] = "login failed";
    while($row= $result->fetch_assoc()){
        if(password_verify($userPwd,$row['user_pwd_hash'])){
            if($row['auth']=="OK"){
                session_start();
                $_SESSION["loggedin"]=true;
                $_SESSION["userName"]=$row['user_name'];
                $_SESSION["userId"]=$row['user_id'];
                $outputData['state']=200;
                $outputData['message']="OK";
            }else{
                $outputData["userId"]=$row['user_id'];
                $outputData["state"]=401;
                $outputData['message']="auth mail first";
            }
        }
    }
}catch(Exception $e){
    $outputData['state'] = 500;
    $outputData['message'] = $e->getMessage();
}
$outputJson = json_encode($outputData);
echo $outputJson;
