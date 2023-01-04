$(document).ready(function(){
    check();
    $("#finish").click(function(){
        if(window.confirm("確認?")== true)
        {
            buyingToShipment();
            getBuying();
            getSeller();
            alert("已下單");
        }       
    })  
})
function buyingToShipment(){
    $.ajax({
        url: "php/getBuying.php",
        type: "GET"
    })
    .done(function(res){
        let obj=JSON.parse(res);
        for(let i=0;i<obj.data.length;i++){
            $.ajax({
                url: "php/buyingToShipment.php",
                type: "POST",
                data: {"purchaseId": obj.data[i].purchase_id}
            })
            .done(function(reslut){
                console.log(JSON.parse(reslut));
            })
        }
        
    })
}
function getSeller(){
    $.ajax({
        url: "php/getBuying.php",
        type: "GET"
    })
    .done(function(reslut){
        let objs=JSON.parse(reslut);
        console.log(objs)
        for(let i=0;i<objs.data.length;i++){
            $.ajax({
                url: "php/getProduct.php",
                type: "POST",
                data: {"productId": objs.data[i].product_id}
            })
            .done(function(res){
                let obj=JSON.parse(res);
                sendinformMail(obj.data[i].seller_id,function(){})  
            })
        }
        
        
    })
}
// function sendInfoMail(reslut){   
//     console.log(reslut.data)
//     for(let i=0;i<reslut.data.length;i++){       
//         console.log(reslut.data[i].seller_id)
          
//     }
//     // $(location).attr("href","shipment.html");
// }
function getBuying(){
    $.ajax({
        url: "php/getBuying.php",
        type: "GET"
    })
    .done(function(reslut){
        let objs=JSON.parse(reslut);
        setPayment(objs);
    })
}
function setPayment(reslut){
    for(let i=0;i<reslut.data.length;i++){
        $.ajax({
            url: "php/setPayment.php",
            type: "POSt",
            data: {
                "payment": $("#payment").val(),
                "purchaseId": reslut.data[i].purchase_id
            }
        })
        .done(function(res){
            console.log(JSON.parse(res));
        })
    }
}