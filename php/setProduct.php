<?php
require_once "conn.php";
$inputData=$_POST;
$outputData = array();
try{
    $productId=$_POST["productId"];
    $productName=$_POST["productName"];
    $productNum=$_POST["productNum"];
    $productImg=$_POST["productImg"];
    $productText=$_POST["productText"];
    $productLabel=$_POST["productLabel"];
    $productNewRate=$_POST["productNewRate"];
    $productInfo=$_POST["productInfo"];
    $productCost=$_POST["productCost"];
    session_start();
    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
        if($productId==""){
            $sql = "INSERT INTO product (product_name, product_num, product_img, product_text, product_label, product_new_rate, product_info, product_cost,seller_id) VALUES('" . $productName . "','" . $productNum . "','" . $productImg . "','" . $productText . "','" . $productLabel . "','" . $productNewRate . "','" . $productInfo . "','" . $productCost . "','" . $_SESSION["userId"] . "');";
            $result = $conn->query($sql);
            if ($result === TRUE) {
                $outputData["state"] = 200;
                $outputData["message"] = "create success";
            } else {
                throw new Exception("MySQL is broken.");
            }
        }else{
            $sql="SELECT seller_id FROM product WHERE product_id='".$productId."';";
            $result=$conn->query($sql);
            $row = $result->fetch_assoc();
            
            if($row["seller_id"]==$_SESSION["userId"]){
                $sql=   "UPDATE product
                        SET product_name='".$productName."',
                        product_num='".$productNum. "',
                        product_img='" . $productImg . "',
                        product_text='" . $productText . "',
                        product_Label='" . $productLabel . "',
                        product_new_rate='" . $productNewRate . "',
                        product_info='" . $productInfo . "',
                        product_cost='" . $productCost . "' 
                        WHERE product_id='".$productId."';";
                $result= $conn->query($sql);
                if ($result === TRUE) {
                    $outputData["state"] = 200;
                    $outputData["message"] = "update success";
                } else {
                    throw new Exception("MySQL is broken.");
                }
            }else{
                $outputData["state"] = 401;
                $outputData["message"] = "login first to setProduct.";
            }
        }
    } else {
        $outputData["state"] = 401;
        $outputData["message"] = "login first to setProduct.";
    }
}catch(Exception $e){
    $outputData["state"]=500;
    $outputData["message"] = $e->getMessage();
}
$outputJson = json_encode($outputData);
echo $outputJson;
?>