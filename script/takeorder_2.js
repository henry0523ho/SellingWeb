$(document).ready(function(){
    check();
    getSeller();
    $("#back").click(function(){
        $(location).attr("href","takeorder_1.html")
    })
    $("#next").click(function(){
        $(location).attr("href","takeorder_3.html")
    })
})
function getSeller(){
    $.ajax({
        url: "php/getDistinctSeller.php",
        type: "GET"
    })
    .done(function(reslut){
        let objs=JSON.parse(reslut);
        drawTable(objs);
    })
}
function drawTable(reslut){
    for(let i=0;i<reslut.data.length;i++){
        $("#takeorder_2table")
        .append(
            $("<tr></tr>")
            .append(
                $("<td></td>")
                .attr("id","sellerId-"+reslut.data[i].seller_id)
            )
            .append(
                $("<td></td>")
                .attr("id","productName-"+reslut.data[i].seller_id)
            )
            .append(
                $("<td></td>")
                .attr("id","delivery-"+reslut.data[i].seller_id)
                .append(
                    $("<div></div>")
                    .attr("style","padding-top: 30px;")
                    .append(
                        $("<div></div>")
                        .attr("id","ChooseMethod-"+reslut.data[i].seller_id)
                        .attr("class","formlist")
                        .append(
                            $("<div></div>")
                            .append(
                                $("<input>")
                                .attr("id","facetoface")
                                .attr("type","radio")
                                .attr("name","method")
                            )
                            .append(
                                $("<label></label>")
                                .attr("for","facetoface")
                                .html("面交")
                            )
                        )
                        
                        .append($("<br>"))
                        .append($("<br>"))
                        .append(
                            $("<div></div>")
                            .append(
                                $("<input>")
                                .attr("id","711")
                                .attr("type","radio")
                                .attr("name","method")
                            )
                            .append(
                                $("<label></label>")
                                .attr("for","711")
                                .html("711(請先匯款)")
                            )
                        )                        
                        .append($("<br>"))
                        .append($("<br>"))
                        .append(
                            $("<div></div>")
                            .append(
                                $("<input>")
                                .attr("id","fami")
                                .attr("type","radio")
                                .attr("name","method")
                            )
                            .append(
                                $("<label></label>")
                                .attr("for","fami")
                                .html("全家(請先匯款)")
                            )
                        )
                        .append($("<br>"))
                        .append($("<br>"))
                        .append(
                            $("<p></p>")
                            .append(
                                $("<input>")
                                .attr("id","ps-"+reslut.data[i].seller_id)
                                .attr("type","text")
                                .attr("placeholder","備註說明")
                            )
                        )
                    )
                )
            )
            .append(
                $("<td></td>")
                .append(
                    $("<div></div>")
                    .attr("style","padding-top: 30px;")
                    .append(
                        $("<div></div>")
                        .attr("class","formlist")
                        .append(
                            $("<p></p>")
                            .attr("name","buyerName")
                            .html("買家姓名: ")
                        )
                        .append(
                            $("<p></p>")
                            .attr("name","buyerPhone")
                            .html("電話號碼: ")
                        )
                        .append(
                            $("<p></p>")
                            .append(
                                $("<input>")
                                .attr("id","pickupAddress-"+reslut.data[i].seller_id)
                                .attr("type","text")
                                .attr("placeholder","取貨地址")
                            )
                        )
                    )
                )
            )
        )
        getInfo(reslut.data[i].seller_id);
        getSellerName(reslut.data[i].seller_id);
    }

}

function getInfo(sellerId){
    $.ajax({
        url: "php/getInfoToOrdering.php",
        type: "POST",
        data: {"sellerId": sellerId}
    })
    .done(function(reslut){
        let obj=JSON.parse(reslut);
        innerTable(obj);
    })
}
function innerTable(reslut){
    for(let i=0;i<reslut.data.length;i++){
        $("#productName-"+reslut.data[i].seller_id)
        .append(
            $("<p></p>")
            .html(reslut.data[i].product_name)
        )
        console.log(reslut.data[i].product_name);
        // .html(reslut.data[i].product_name);
    }
    $("p[name='buyerName']")
    .html("買家姓名: "+reslut.data[0].real_name)
    console.log(reslut.data[0].real_name)
    $("p[name='buyerPhone']")
    .html("電話號碼: "+reslut.data[0].phone)
    console.log(reslut.data[0].phone)
}
function getSellerName(sellerId){
    $.ajax({
        url: "php/getSellerName.php",
        type: "POST",
        data:{"userId": sellerId}
    })
    .done(function(reslut){
        let obj=JSON.parse(reslut);
        innerSellerName(obj,sellerId);
    })
}
function innerSellerName(reslut,sellerId){
    $("#sellerId-"+sellerId)
    .append(
        $("<p></p>")
        .html(reslut.data[0].real_name)
    )
}