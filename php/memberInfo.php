<?php
require_once 'conn.php';
session_start();
$data = $_POST;
$sql = "SELECT `user_id` FROM `user` WHERE `user_id` = '{$_SESSION['userId']}'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
if($data['name'] == "" && $data['email'] == "" && $data["password"] == ""){
    echo "請輸入要修改資料";
}
else if($data['name'] == "" && $data['email'] == "" && $data['password'] != ""){
    $password = password_hash($data['password'], PASSWORD_DEFAULT);
    $sql = "UPDATE `user` SET `user_pwd_hash` = '{$password}' WHERE `user_id` = '{$_SESSION['userId']}'";
    $result = mysqli_query($conn, $sql);
}
else if($data['name'] == "" && $data['email'] != "" && $data['password'] == ""){
    $sql = "UPDATE `user` SET `user_email` = '{$data['email']}', `auth` = '0' WHERE `user_id` = '{$_SESSION['userId']}'";
    $result = mysqli_query($conn, $sql);
    echo $_SESSION['userId'];
}
else if($data['name'] != "" && $data['email'] == "" && $data['password'] == ""){
    $sql = "UPDATE `user` SET `real_name` = '{$data['name']}' WHERE `user_id` = '{$_SESSION['userId']}'";
    $result = mysqli_query($conn, $sql);
}
else if($data['name'] != "" && $data['email'] != "" && $data['password'] == ""){
    $sql = "UPDATE `user` SET `real_name` = '{$data['name']}', `user_email` = '{$data['email']}', `auth` = '0' WHERE `user_id` = '{$_SESSION['userId']}'";
    $result = mysqli_query($conn, $sql);
    echo $_SESSION['userId'];
}
else if($data['name'] != "" && $data['email'] == "" && $data['password'] != ""){
    $password = password_hash($data['password'], PASSWORD_DEFAULT);
    $sql = "UPDATE `user` SET `real_name` = '{$data['name']}', `user_pwd_hash` = '{$password}' WHERE `user_id` = '{$_SESSION['userId']}'";
    $result = mysqli_query($conn, $sql);
}
else if($data['name'] == "" && $data['email'] != "" && $data['password'] != ""){
    $password = password_hash($data['password'], PASSWORD_DEFAULT);
    $sql = "UPDATE `user` SET `user_email` = '{$data['email']}', `user_pwd_hash` = '{$password}', `auth` = '0' WHERE `user_id` = '{$_SESSION['userId']}'";
    $result = mysqli_query($conn, $sql);
    echo $_SESSION['userId'];
}
else{
    $password = password_hash($data['password'], PASSWORD_DEFAULT);
    $sql = "UPDATE `user` SET `real_name` = '{$data['name']}', `user_email` = '{$data['email']}', `user_pwd_hash` = '{$password}', `auth` = '0' WHERE `user_id` = '{$_SESSION['userId']}'";
    $result = mysqli_query($conn, $sql);
    echo $_SESSION['userId'];
}
?>