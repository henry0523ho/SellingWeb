$(document).ready(function(){
    getSeller();
    getBuyer();
})

function getSeller(){
    $.ajax({
        url: "php/shipment_seller.php",
        type: "GET"
    })
    .done(function(result){
        let data=JSON.parse(result);
        console.log(data);
        show("seller-shipment", data);
    })
}
function getBuyer(){
    $.ajax({
        url: "php/shipment_buyer.php",
        type: "GET"
    })
    .done(function(result){
        let data=JSON.parse(result);
        console.log(data);
        show("buyer-shipment", data);
    })    
}
function changeState(state, id){
    console.log(state + " " + id);
    $.ajax({
        url: "php/changePurchaseState.php",
        type: "POST",
        data: {
            state: state,
            id: id
        }
    }).done(function(res) {
        location.reload();
    });
}
function setClick(nowState, state, id){
    if(state == 'ship'){
        if(nowState == "Ordering"){
            changeState(state, id);
        } 
    } 
    else if(state == 'take'){
        if(nowState == "ship"){
            changeState(state, id);
        }
    } 
}
function show(who, result){
    for(let i=0; i<result.data.length; i++){
        $("#"+who).append(
            $("<tr></tr>")
            .append(
                $('<td></td>')
                .html(result.data[i].purchase_id)
            )
            .append(
                $('<td></td>')
                .html(result.data[i].delivery)
            )
            .append(
                $('<td></td>')
                .html(result.data[i].payment)
            )
            
            .append( //金額
                $('<td></td>')
                .html(result.data[i].product_cost*result.data[i].purchase_num)
            )
            .append(
                $('<td></td>')
                .append(
                    $("<input>")
                    .attr("class", "state")
                    .attr("type", "text")
                    .attr("disabled", true)
                    .val(result.data[i].purchase_state)
                )
            )
            .append(
                $('<td></td>')
                .append(
                    $("<button></button>")
                    .attr("class","btn")
                    .html((who=="seller-shipment"?"已出貨":"已取貨"))
                    .attr("id", result.data[i].purchase_id)
                    
                    .click((who=="seller-shipment"?(
                        function(){
                            setClick(result.data[i].purchase_state, "ship", result.data[i].purchase_id)
                        }
                    ):(
                        function(){
                            setClick(result.data[i].purchase_state, "take", result.data[i].purchase_id)

                        }
                    ))
                    )
                )
            )
        );
    }
}
