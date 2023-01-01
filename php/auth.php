<?php
require_once "conn.php";
try{
    parse_str($_SERVER['QUERY_STRING'],$query);
    $sql="UPDATE user SET auth='OK' WHERE user_id='".$query['userId']."' AND auth='".$query['auth']."';";
    $result=$conn->query($sql);
    if($conn->affected_rows==1){
        echo "驗證完成";
    }else{
        echo "驗證連結已失效，驗證失敗";
    }
}catch(Exception $e){
    echo "發生錯誤";
}
$conn->close();