<?php
header("Access-Control-Allow-Origin: *");
require_once "conn.php";
session_start();
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    echo $_SESSION["userName"];
}else{
    echo "No Login";
}
?>