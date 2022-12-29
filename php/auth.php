<?php
require_once "conn.php";
try{
    parse_str($_SERVER['QUERY_STRING'],$query);
    $sql="SELECT user_id,auth FROM user WHERE user_id='".$query['userId']."' AND auth='".$query['auth']."';";
    $result=$conn->query($sql);
    if($result->num_rows>0){
        $sql="UPDATE user SET auth='OK' WHERE user_id='".$query['userId']."' AND auth='".$query['auth']."';";
        $result=$conn->query($sql);
        echo "驗證完成";
    }else{
        echo "驗證連結已失效，驗證失敗";
    }
}catch(Exception $e){
    echo "發生錯誤";
}