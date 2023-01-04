$(document).ready(function(){
    check();
    $("#finish").click(function(){
        if(window.confirm("確認?")== true)
        {
            getBuying();
            getSeller();
            alert("已下單");
        }       
    })  
})

function getSeller(){
    $.ajax({
        url: "php/getpurchase.php",
        type: "GET"
    })
    .done(function(reslut){
        let objs=JSON.parse(reslut);
        console.log(objs)
        sendInfoMail(objs)
    })
}

function sendInfoMail(reslut){   
    console.log(reslut.data)
    for(let i=0;i<reslut.data.length;i++){       
        console.log(reslut.data[i].seller_id)
        sendinformMail(reslut.data[i].seller_id,function(){})    
    }
    $(location).attr("href","shipment.html");
}
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