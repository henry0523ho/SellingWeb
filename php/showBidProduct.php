<?php 
require_once 'conn.php'; 
$data=$_POST;
$outputData = array();
try{
    $productId = $_POST["id"];
    $sql = "SELECT * FROM bidding WHERE product_id = '" . $productId . "';";
    $result = $conn->query($sql);
    if($row = $result->fetch_assoc()){
        $outputData['data']= [
            'url' => $row['product_img'],
            'name' => $row['product_name'],
            'new' => $row['product_new_rate'],
            'num' => $row['product_num'],
            'text' => $row['product_text'],
            'info' => $row['product_info'],
            'raise' => $row['raise'],
            'price' => $row['price'],
            'bid_length' => $row['bid_length'],
            'start_bidding' => $row['start_bidding'],
        ];
        $outputData['state']=200;
        $outputData['message']="OK";
    }
    else{
        $outputData['state'] = 404;
        $outputData['message'] = "product not found";
    }
}catch(Exception $e){
    $outputData['state']=500;
    $outputData['message']=$e->getMessage();
}

$outputJson = json_encode($outputData);
echo $outputJson;
$conn->close();
?>