<?php
require_once "conn.php";
$userName=$_POST["userName"];
$userPwd=$_POST["userPwd"];

$sql="SELECT user_name FROM user WHERE user_name='".$userName."';";
$result=$conn->query($sql);
if($result->num_rows>0){
    echo "username has been taken<br>";
}else{
    $pwdHash=password_hash($userPwd, PASSWORD_DEFAULT);
    $sql="INSERT INTO user (user_name, user_pwd_hash) VALUES ('".$userName."', '".$pwdHash."');";
    $result=$conn->query($sql);
    if($result===TRUE){
        echo "register successfully<br>";
    }else{
        echo "register fail<br>";
    }
}
