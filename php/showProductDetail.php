<?php
require_once 'conn.php'; 
$data=$_POST;
$outputData= array();
try{
    $product_id = $_POST["id"];
    $sql = "SELECT * FROM product WHERE product_id='" . $product_id . "';";
    $result = $conn->query($sql);
    if($row = $result->fetch_assoc()){
        $outputData['data']= [
            'id' => $row['product_id'],
            'url' => $row['product_img'],
            'name' => $row['product_name'],
            'price' => $row['product_cost'],
            'new' => $row['product_new_rate'],
            'num' => $row['product_num'],
            'text' => $row['product_text'],
            'info' => $row['product_info'],
            'sellerId'=>$row['seller_id'],
        ];
        $outputData['state']=200;
        $outputData['message']="OK";
    }else{
        $outputData['state'] = 404;
        $outputData['message'] = "product not found";
    }
}catch(Exception $e){
    $outputData['state']=500;
    $outputData['message']=$e->getMessage();
}
$outputJson = json_encode($outputData);
echo $outputJson;
?>