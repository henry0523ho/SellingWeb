<?php
require_once "conn.php";
$outputData = array();
try{
    if(isset($_POST['userId'])){
        $sql="SELECT * FROM purchase WHERE user_id='". $_SESSION["userId"] ."'AND purchase_state='Ordering';";
        if($row=$result->fetch_assoc()){
            $userEmail = $row['user_email'];
            if($row['purchase_state']!="Finish"){
                
                $sql = "UPDATE purchase SET purchase_state='Finish' WHERE user_id='" . $_POST['userId'] . "';";
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
                                    你有一筆新的訂單
                                </div>
                            </body>
                            </html>';
                    $outputData['state'] = 200;
                    $outputData['message'] = "OK";
                    $outputData['body'] = $body;
                    $outputData['subject']="海大拍賣系統 通知";
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

