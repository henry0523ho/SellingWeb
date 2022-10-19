<?php
require_once "conn.php";
$userName = $_POST["userName"];
$userPwd = $_POST["userPwd"];

$sql="SELECT user_name FROM user WHERE user_name='".$userName."';";
$result=$conn->query($sql);
if($result->num_rows>0){
    //echo "username has been taken<br>";
    echo "使用者姓名已被使用!3秒後將自動跳轉頁面<br>";
    echo "<a href=".$_SERVER["HTTP_REFERER"].">未成功跳轉頁面請點擊此</a>";
    header("refresh:3;url=".$_SERVER["HTTP_REFERER"]);
}else{
    $pwdHash=password_hash($userPwd, PASSWORD_DEFAULT);
    $sql="INSERT INTO user (user_name, user_pwd_hash) VALUES ('".$userName."', '".$pwdHash."');";
    $result=$conn->query($sql);
    if($result===TRUE){
        //echo "register successfully<br>";
        echo "註冊成功!3秒後將自動跳轉頁面<br>";
        echo "<a href=".$_SERVER["HTTP_REFERER"].">未成功跳轉頁面請點擊此</a>";
        header("refresh:3;url=".$_SERVER["HTTP_REFERER"]);
    }else{
        //echo "register fail<br>";
        echo "註冊失敗!3秒後將自動跳轉頁面<br>";
        echo "<a href=".$_SERVER["HTTP_REFERER"].">未成功跳轉頁面請點擊此</a>";
        header("refresh:3;url=".$_SERVER["HTTP_REFERER"]);
    }
}