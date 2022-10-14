<?php
require_once "conn.php";
$userName = $_POST["userName"];
$userPwd = $_POST["userPwd"];

$sql="SELECT * FROM user WHERE user_name='".$userName."';";
$result=$conn->query($sql);
if($result->num_rows>0){
    while($row= $result->fetch_assoc()){
        if(password_verify($userPwd,$row['user_pwd_hash'])){
            echo "login successful";
        }else{
            echo "login failed";
        }
    }
}else{
    echo "login failed";
}

?>