<?php
$data=$_POST;
require_once "conn.php";
$userName = $data["userName"];
$userPwd = $data["userPwd"];

$sql="SELECT * FROM user WHERE user_name='".$userName."';";
$result=$conn->query($sql);
if($result->num_rows>0){
    while($row= $result->fetch_assoc()){
        if(password_verify($userPwd,$row['user_pwd_hash'])){
            echo "success";
            session_start();
            $_SESSION["loggedin"]=true;
            $_SESSION["userName"]=$row['user_name'];
            $_SESSION["userId"]=$row['user_id'];
        }else{
            echo "failed";
        }
    }
}else{
    echo "failed";
}

?>