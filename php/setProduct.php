<?php
header("Access-Control-Allow-Origin: *");
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
    $productMethod = $_POST["productMethod"];
    session_start();
    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
        if($productId==""){
            if($productMethod == 0){ //不二價
                $sql = "INSERT INTO product (product_name, product_num, product_img, product_text, product_label, product_new_rate, product_info, product_cost,seller_id) VALUES('" . $productName . "','" . $productNum . "','" . $productImg . "','" . $productText . "','" . $productLabel . "','" . $productNewRate . "','" . $productInfo . "','" . $productCost . "','" . $_SESSION["userId"] . "');";
                $result = $conn->query($sql);
            }
            else{ //競標
                $productRaise = $_POST["productRaise"];
                $productDateArr = $_POST["productDate"];
                $productDate = json_decode($productDateArr);
                $bidLength = $productDate[1][0];
                if($productDate[1][1] < 10){
                    $bidLength = $bidLength."-"."0".$productDate[1][1];
                }
                else{
                    $bidLength = $bidLength."-".$productDate[1][1];
                }
                if($productDate[1][2] < 10){
                    $bidLength = $bidLength."-"."0".$productDate[1][2];
                }
                else{
                    $bidLength = $bidLength."-".$productDate[1][2];
                }
                if($productDate[1][3] < 10){
                    $bidLength = $bidLength." "."0".$productDate[1][3];
                }
                else{
                    $bidLength = $bidLength." ".$productDate[1][3];
                }
                if($productDate[1][4] < 10){
                    $bidLength = $bidLength.":"."0".$productDate[1][4];
                }
                else{
                    $bidLength = $bidLength.":".$productDate[1][4];
                }
                if($productDate[1][5] < 10){
                    $bidLength = $bidLength.":"."0".$productDate[1][5];
                }
                else{
                    $bidLength = $bidLength.":".$productDate[1][5];
                }
                echo $bidLength;
                $sql = "INSERT INTO bidding (product_name, product_num, product_img, product_text, product_label, product_new_rate, product_info, seller_id, raise, price, product_state, bid_length) VALUES('" . $productName . "','" . $productNum . "','" . $productImg . "','" . $productText . "','" . $productLabel . "','" . $productNewRate . "','" . $productInfo . "','" . $_SESSION["userId"] . "','" . $productRaise . "','"  . $productCost . "','" . 0 . "','"  . $bidLength ."');";
                $result = $conn->query($sql);
            }
            if ($result === TRUE) {
                $outputData["state"] = 200;
                $outputData["message"] = "create success";
            } else {
                throw new Exception("MySQL is broken.");
            }
        }else{
            $sql="SELECT seller_id FROM product WHERE product_id='".$productId."';";
            $result=$conn->query($sql);
            if($row = $result->fetch_assoc()){
                if ($row["seller_id"] == $_SESSION["userId"]) {
                    $sql =   "UPDATE product
                        SET product_name='" . $productName . "',
                        product_num='" . $productNum . "',
                        product_img='" . $productImg . "',
                        product_text='" . $productText . "',
                        product_Label='" . $productLabel . "',
                        product_new_rate='" . $productNewRate . "',
                        product_info='" . $productInfo . "',
                        product_cost='" . $productCost . "' 
                        WHERE product_id='" . $productId . "';";
                    $result = $conn->query($sql);
                    if ($result === TRUE) {
                        $outputData["state"] = 200;
                        $outputData["message"] = "update success";
                    } else {
                        throw new Exception("MySQL is broken.");
                    }
                } else {
                    $outputData["state"] = 401;
                    $outputData["message"] = "login first to setProduct.";
                }
            }else{
                $outputData["state"] = 410;
                $outputData["message"] = "no product found";
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