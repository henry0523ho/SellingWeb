<?php
require_once "conn.php";
$userName = $_POST["userName"];
$userPwd = $_POST["userPwd"];
$userEmail=$_POST["userEmail"];

$sql="SELECT user_name FROM user WHERE user_name='".$userName."';";
$result=$conn->query($sql);
if($result->num_rows>0){
    echo "nameTaken";
}else{
    $pwdHash=password_hash($userPwd, PASSWORD_DEFAULT);
    $sql="INSERT INTO user (user_name, user_pwd_hash, user_email) VALUES ('".$userName."', '".$pwdHash."','".$userEmail."');";
    $result=$conn->query($sql);
    if($result===TRUE){
        echo "success";
    }else{
        echo "failed";
    }
}