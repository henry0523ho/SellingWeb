$(document).ready(function(){
    check();
    getOrdering();
})

function getOrdering(){
    $.ajax({
        url: "php/getOrdering.php",
        type: "GET"
    })
    .done(function(result){
        let objs=JSON.parse(result);
        //console.log(objs);
        showOrdering(objs);
    })
}

function showOrdering(result){
    for(let i=0;i<result.data.length;i++){
        $("#CartProduct")
        .append(
            $("<tr></tr>")
            .append(
                $("<td></td>")
                .attr("id","productName-"+result.data[i].product_id)
            )
            .append(
                $("<td></td>")
                .attr("id","productIntro-"+result.data[i].product_id)
            )
            .append(
                $("<td></td>")
                .html(result.data[i].purchase_num)
            )
            .append(
                $("<td></td>")
                .attr("id","productPrice-"+result.data[i].product_id)
            )
            .append(
                $("<td></td>")
                .attr("id","purchasePrice-"+result.data[i].product_id)
            )
        )

        getProduct(result.data[i].product_id,result.data[i].purchase_num);
    }
}

function getProduct(productId,num){
    $.ajax({
        url: "php/getProduct.php",
        type: "POST",
        data: {"productId": productId}
    })
    .done(function(result){
        let objs=JSON.parse(result);
        console.log(objs);
        $("#productName-"+productId)
        .html(objs.data[0].product_name)
        $("#productIntro-"+productId)
        .html(objs.data[0].product_text)
        $("#productPrice-"+productId)
        .html(objs.data[0].product_cost)
        $("#purchasePrice-"+productId)
        .html(num*objs.data[0].product_cost)

    })
}