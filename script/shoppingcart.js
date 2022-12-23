$(document).ready(function(){
    getCart();
})

function getCart(){
    $.ajax({
        url: "php/getCart.php",
        type: "GET"
    })
    .done(function(result){
        let data=JSON.parse(result);
        showCart(data);
    })
}

function showCart(result){
    console.log(result.data.length  );
    for(let i=0;i<result.data.length;i++){
        
        //console.log(product);
        $("#cart").append(
            $("<tr></tr>")
            .attr("id","productInCart-"+result.data[i].purchase_id)
            .append(
                $("<td></td>")
                .append(
                    $("<input>")
                    .attr("type","checkbox")
                    .attr("id","purchaseId-"+result.data[i].purchase_id)
                )
            )
            .append(
                $("<td></td>")
                .append(
                    $("<img>")
                    .attr("id","productImg-"+result.data[i].purchase_id)

                )

            )
            .append(
                $("<td></td>")
                .attr("id","productName-"+result.data[i].purchase_id)
            )
            .append(
                $("<td></td>")
                .attr("id","productNum-"+result.data[i].purchase_id)
                .html(result.data[i].purchase_num)
            )
            .append(
                $("<td></td>")
                .attr("id","productPrice-"+result.data[i].purchase_id)
            )
            .append(
                $("<td></td>")
                .append(
                    $("<button></button>")
                    .attr("id","remove-"+result.data[i].purchase_id)
                    .html("移除")
                    .click(function(){
                        removePurchase(result.data[i].purchase_id);
                        location.reload();
                    })
                )
            )
            )
            getProduct(result.data[i].product_id,result.data[i].purchase_id);
    }
    
}
function getProduct(productId,purchaseId){
    $.ajax({
        url: "php/getProduct.php",
        type: "POST",
        data: {"productId": productId}
    })
    .done(function(result){
        let objs=JSON.parse(result);
        console.log(objs);
        $("#productImg-"+purchaseId)
        .attr("src",objs.data[0].product_img)
        $("#productName-"+purchaseId)
        .html(objs.data[0].product_name)
        $("#productPrice-"+purchaseId)
        .html(objs.data[0].product_cost)
    })
}
function removePurchase(purchaseId){
    $.ajax({
        url: "php/delInCart.php",
        type: "POST",
        data: {"purchaseId": purchaseId}
    })
    .done(function(result){
        console.log(JSON.parse(result));
    })
}