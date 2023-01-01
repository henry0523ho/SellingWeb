<?php 
require_once 'conn.php'; 
$data = $_POST;
$sql = "SELECT `product_postdate` FROM `product` ";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)){
    echo $row["product_postdate"] . "\n";
}

$row = json_decode($data["productDate"]);
$date = $row[0][0];
if($row[0][1]<10){
    $date = $date."-"."0".$row[0][1];
}
else{
    $date = $date."-".$row[0][1];
}
if($row[0][2] < 10){
    $date = $date."-"."0".$row[0][2];
}
else{
    $date = $date."-".$row[0][2];
}
if($row[0][3] < 10){
    $date = $date." "."0".$row[0][3];
}
else{
    $date = $date." ".$row[0][3];
}
if($row[0][4] < 10){
    $date = $date.":"."0".$row[0][4];
}
else{
    $date = $date.":".$row[0][4];
}
if($row[0][5] < 10){
    $date = $date.":"."0".$row[0][5];
}
else{
    $date = $date.":".$row[0][5];
}

echo $date."\n";
print_r($row);
//echo $row[0][0];
?>