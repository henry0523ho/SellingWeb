<?php
require_once "conn.php";
session_start();
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    $userId=$_SESSION["userId"];
    $sql = "SELECT user_name FROM user WHERE user_id='".$userId."'";
    $result =$conn->query($sql);
    echo $result;
}else{
    echo "No Login";
}
?>