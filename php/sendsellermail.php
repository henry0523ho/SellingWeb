<?php
require_once "conn.php";
$data=$_POST;
$outputData = array();
try{
    $userId = $data["userId"];    
    $sql="SELECT * FROM user WHERE user_id='".$userId."';";
    $result=$conn->query($sql);
    if($row=$result->fetch_assoc()){
        $userEmail = $row['user_email'];
        $username = $row['user_name'];
        $body = '   <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
        </head>
        <body>
            <div style="width: 100vh;text-align: center;">
                你有一筆新的訂單 '.$username.' 請盡快完成訂單<br>
                
            </div>
        </body>
        </html>';
        $outputData['state'] = 200;
        $outputData['message'] = "OK";
        $outputData['body'] = $body;
        $outputData['subject']="海大拍賣系統";
        $outputData['email']=$userEmail;      
    }else{
        $outputData['state']=404;
        $outputData['message']="no user";
    }
}catch(Exception $e){
$outputData['state'] =500;
$outputData['message'] =$e->getMessage();
}
echo json_encode($outputData);
$conn->close();
?>