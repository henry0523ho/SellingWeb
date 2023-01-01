$(document).ready(function() { //上架商品
    let conBtn = document.getElementById("conBtn");
    conBtn.addEventListener("click", upload, false);
});


async function upload() {
    let date = new Date();
    let todayTime = [];
    let deadline = [];
    let time = [];
    todayTime[0] = date.getFullYear();
    todayTime[1] = date.getMonth() + 1;
    todayTime[2] = date.getDate();
    todayTime[3] = date.getHours();
    todayTime[4] = date.getMinutes();
    todayTime[5] = date.getSeconds();
    let dv = $("#chosenDate").val();
    deadline = dv.split("-");
    deadline[0] = parseInt(deadline[0]);
    deadline[1] = parseInt(deadline[1]);
    deadline[2] = parseInt(deadline[2]);
    deadline[3] = todayTime[3];
    deadline[4] = todayTime[4];
    deadline[5] = todayTime[5];
    time.push(todayTime);
    time.push(deadline);
    if(($("#productPrice").val() > 0 && $("#productBidPrice").val() > 0) || ($("#productPrice").val() > 0 && $("#productBidOnce").val() > 0)){
        alert("不能同時不二價與競標(商品欄位需修改)");
    }
    else if($("#productBidPrice").val() > 0 && $("#productBidOnce").val() > 0){
        let jsonStr = JSON.stringify(time);

        if(deadline[0] < todayTime[0] || (deadline[0] == todayTime[0] && deadline[1] < todayTime[1]) || (deadline[0] == todayTime[0] && deadline[1] == todayTime[1] && deadline[2] < todayTime[2])){
            alert("截止日要在當天時間後");
        }
        else if(dv == ""){
            alert("要選日期");
        }
        else{
            let productId = "";
            let productName = $("#productName").val();
            let productNum = $("#productNumber").val();
            let productImg = await uploadImage($("#productPic"));
            let productText = $("#productIntro").val();
            let productLabel = $("#productCate").val();
            let productNewRate = $("input[name=rating]:checked").val();
            let productInfo = $("#productDescription").val();
            let productCost = $("#productBidPrice").val();
            let productRasie = $("#productBidOnce").val();
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
                    "productCost": productCost,
                    "productRaise" : productRasie,
                    "productDate" : jsonStr,
                    "productMethod" : 1
                },
            })
            .done(function(data) {
                console.log(data);
            })
            location.reload();
        }
        
    }
    else if($("#productPrice").val() > 0){
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
                "productCost": productCost,
                "productMethod" : 0
            },
        })
        .done(function(data) {
            let obj = JSON.parse(data);
            console.log(obj.message);
        })
        location.reload();
    }
    else{
        console.log("error");
    }
}