<?php
require_once "conn.php";
$name = $_POST;
$outputData = array();
$outputData['data']=array();
$sql = "SELECT * FROM `product` WHERE `product_name` LIKE '%{$name['name']}%'";
$result = mysqli_query($conn, $sql);
try{
    $outputData['data'] = array();
    while($row = $result->fetch_assoc()){
        $obj = [
            'id' => $row['product_id'],
            'url' => $row['product_img'],
            'name' => $row['product_name'],
            'price' => $row['product_cost'],
        ];
        array_push($outputData['data'], $obj);
    }
    $outputData['state']=200;
    $outputData['message']="OK";
}catch(Exception $e){
    $outputData['state']=500;
    $outputData['message']=$e->getMessage();
}
$outputJson = json_encode($outputData);
echo $outputJson;
?>