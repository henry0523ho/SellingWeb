<?php
require_once "conn.php";
$userName = $_POST["userName"];
$userPwd = $_POST["userPwd"];

$sql="SELECT * FROM user WHERE user_name='".$userName."';";
$result=$conn->query($sql);
if($result->num_rows>0){
    while($row= $result->fetch_assoc()){
        if(password_verify($userPwd,$row['user_pwd_hash'])){
            //echo "login successful";
            echo "登入成功!3秒後將自動跳轉頁面<br>";
            echo "<a href=http://".$_SERVER["HTTP_HOST"]."/Workspace/SellingWeb/index.html>未成功跳轉頁面請點擊此</a>";
            header("refresh:3;url=http://".$_SERVER["HTTP_HOST"]."/Workspace/SellingWeb/index.html");
        }else{
            //echo "login failed";
            echo "登入失敗!3秒後將自動跳轉頁面<br>";
            echo "<a href=".$_SERVER["HTTP_REFERER"].">未成功跳轉頁面請點擊此</a>";
            header("refresh:2;url=".$_SERVER["HTTP_REFERER"]);
        }
    }
}else{
    //echo "login failed";
    echo "登入失敗!3秒後將自動跳轉頁面<br>";
    echo "<a href=".$_SERVER["HTTP_REFERER"].">未成功跳轉頁面請點擊此</a>";
    header("refresh:2;url=".$_SERVER["HTTP_REFERER"]);
}

?>