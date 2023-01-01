<?php
require_once "conn.php";
$outputData = array();
$url= $rootUrl;
try{
    if(isset($_POST['userId'])){
        $sql="SELECT user_email,auth FROM user WHERE user_id='".$_POST['userId']."';";
        $result=$conn->query($sql);
        if($row=$result->fetch_assoc()){
            $userEmail = $row['user_email'];
            if($row['auth']!="OK"){
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $auth = '';
                for ($i = 0; $i < 32; $i++) {
                    $auth = $auth . $characters[rand(0, strlen($characters) - 1)];
                }
                $sql = "UPDATE user SET auth='" . $auth . "' WHERE user_id='" . $_POST['userId'] . "';";
                $result = $conn->query($sql);
                if ($result) {
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
                                    <a style="display:inline-block;margin: auto; padding: 10px;font-size: 20px;background-color: rgb(74, 128, 255);color:white;border-radius: 5px;text-decoration: none;" href="' . $url . 'php/auth.php?userId=' . $_POST['userId'] . '&auth=' . $auth . '">點此驗證信箱</a>
                                </div>
                            </body>
                            </html>';
                    $outputData['state'] = 200;
                    $outputData['message'] = "OK";
                    $outputData['body'] = $body;
                    $outputData['subject']="海大拍賣系統 信箱驗證";
                    $outputData['email']=$userEmail;
                } else {
                    $outputData['state'] = 500;
                    $outputData['message'] = "sql error";
                }
            }else{
                $outputData['state']=302;
                $outputData['message'] = "already auth";
            }
        }else{
            $outputData['state']=404;
            $outputData['message']="no user";
        }


        
    }else{
        $outputData['state'] = 406;
        $outputData['message'] = "key value not set";
    }
}catch(Exception $e){
    $outputData['state'] =500;
    $outputData['message'] =$e->getMessage();
}
echo json_encode($outputData);

