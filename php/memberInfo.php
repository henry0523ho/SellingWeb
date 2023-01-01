<?php
require_once 'conn.php';
session_start();
$data = $_POST;
$sql = "SELECT `user_id` FROM `user` WHERE `user_id` = '{$_SESSION['userId']}'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$password = password_hash($data['password'], PASSWORD_DEFAULT);
$sql = "UPDATE `user` SET `real_name` = '{$data['name']}', `user_email` = '{$data['email']}', `user_pwd_hash` = '{$password}' WHERE `user_id` = '{$_SESSION['userId']}'";
$result = mysqli_query($conn, $sql);
?>