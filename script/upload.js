$(document).ready(function() { //上架商品
    let conBtn = document.getElementById("conBtn");
    conBtn.addEventListener("click", upload, false);
});

function upload(){
    let productId = "";
    let productName = $("#productName").val();
    let productNum = $("#productNumber").val();
    let productImg = "暫無圖片";
    let productText = $("#productIntro").val();
    let productLabel = $("#productCate").val();
    let productNewRate = $("input[name=rating]:checked").val();
    let productInfo = $("#productDescription").val();
    let productCost = $("#productPrice").val();

    $.ajax({
        url: 'http://localhost/workSpace/SellingWeb/php/setProduct.php',
        type: "POST",
        data: { "productId": productId, "productName": productName, "productNum" : productNum,
                "productImg" : productImg, "productText" : productText, "productLabel" : productLabel,
                "productNewRate" : productNewRate, "productInfo" : productInfo, "productCost" : productCost},
    })
    .done(function(data){
       
    })
    location.reload();
}