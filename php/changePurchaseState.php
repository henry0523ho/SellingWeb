<?php
    require_once "conn.php";

    $data=$_POST;
    $outputData= array();
    try{
        $state = $data["state"];
        $id = $data["id"];
        
        $sql="UPDATE purchase set purchase_state = '".$state."' where purchase_id = '".$id."';";
        $result=$conn->query($sql);
        
        $outputData['data']=$state;
        $outputData['state']=200;
        $outputData['message']="OK";
    }catch(Exception $e){
        $outputData['state'] = 500;
        $outputData['message'] = $e->getMessage();
    }
    $outputJson = json_encode($outputData);
    echo $outputJson;

?>