$(document).ready(function() { //上架商品
    let conBtn = document.getElementById("conBtn");
    conBtn.addEventListener("click", upload, false);
});


async function upload() {
    let productId = "";
    let productName = $("#productName").val();
    let productNum = $("#productNumber").val();
    let productImg = await uploadImage($("#productPic"));
    let productText = $("#productIntro").val();
    let productLabel = $("#productCate").val();
    let productNewRate = $("input[name=rating]:checked").val();
    let productInfo = $("#productDescription").val();
    let productCost = $("#productPrice").val();

    $.ajax({
            url: 'php/setProduct.php',
            type: "POST",
            data: {
                "productId": productId,
                "productName": productName,
                "productNum": productNum,
                "productImg": productImg,
                "productText": productText,
                "productLabel": productLabel,
                "productNewRate": productNewRate,
                "productInfo": productInfo,
                "productCost": productCost
            },
        })
        .done(function(data) {
            let obj = JSON.parse(data);
            console.log(obj.message);
        })
        location.reload();
}