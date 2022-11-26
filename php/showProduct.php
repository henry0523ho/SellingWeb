<?php 
header("Access-Control-Allow-Origin: *");
require_once 'conn.php'; 

$query = "SELECT * FROM product";
$query_run = mysqli_query($conn,$query); 

$outputData = array();

if(mysqli_num_rows($query_run) > 0){
    foreach($query_run as $row){
        $obj = [
            'id' => $row['product_id'],
            'url' => $row['product_img'],
            'name' => $row['product_name'],
            'price' => $row['product_cost'],
        ];
        //echo Json_encode($obj);
        array_push($outputData, Json_encode($obj));        
    }
}

$outputJson = json_encode($outputData);
echo $outputJson;

?>