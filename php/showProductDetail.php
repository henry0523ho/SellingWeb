<?php 
require_once 'conn.php'; 
$data=$_POST;
$product_id=$_POST["id"];

$sql="SELECT * FROM product WHERE product_id='".$product_id."';";

$query_run = mysqli_query($conn, $sql); 
foreach($query_run as $row){
    $obj = [
        'id' => $row['product_id'],
        'url' => $row['product_img'],
        'name' => $row['product_name'],
        'price' => $row['product_cost'],
        'new' => $row['product_new_rate'],
        'num' => $row['product_num'],
        'text' => $row['product_text'],
        'info' => $row['product_info'],
    ];
}

$outputJson = json_encode($obj);
echo $outputJson;

?>