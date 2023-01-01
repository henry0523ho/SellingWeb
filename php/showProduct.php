<?php 
require_once 'conn.php'; 
$data=$_POST;
$outputData = array();
try{
    $order = $data["order"];
    $fiter = $data["filter"];

    $order_arr = explode("-", $order);
    if($fiter == "undefined") $sql = "SELECT * FROM product ORDER BY $order_arr[0] $order_arr[1];";
    else $sql = "SELECT * FROM product WHERE product_label = '$fiter' ORDER BY $order_arr[0] $order_arr[1];";
    
    $result = $conn->query($sql);
    $outputData['data']=array();
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
$conn->close();
?>