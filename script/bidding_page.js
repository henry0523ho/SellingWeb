$(document).ready(function() {
    displayDetail(location.search);
    $("#comfirmBidding").click(function(){
        let productId = location.search.split("?")[1];
        let productPrice = (parseInt(document.getElementById("product_price").textContent.split("$")[1])
                             + parseInt($("#addBid").val()) * parseInt(document.getElementById("low_price").textContent.split("$")[1].split("/刀")[0]))
        $.ajax({
            url: 'php/biddingProduct.php',
            type: "POST",
            data: {
                "productId": productId,
                "productPrice" : productPrice
            },
        })
        .done(function(data) {
            let obj = JSON.parse(data);
            console.log(obj.message);
        })
        setTimeout(() => {location.reload();}, 1000);
    });
});

function displayDetail(search) {
    let id = search.split("?")[1];
    $.ajax({
        url: 'php/showBidProduct.php',
        type: "POST",
        data: { "id": id },

        success: function(result) {
            console.log(result);
            let datas = JSON.parse(result);
            document.getElementById("product_img").setAttribute("src", datas.data.url);
            console.log(document.getElementById("product_img"));

            document.getElementById("product_name").innerHTML = datas.data.name;
            document.getElementById("product_price").innerHTML = '$' + datas.data.price;
            document.getElementById("product_title").innerHTML = datas.data.name;
            document.getElementById("product_info").innerHTML = datas.data.info;

            let state = document.getElementById("product_state");
            state.appendChild(document.createTextNode('old '));
            for (let i = 0; i < 5; i++) {
                let img = document.createElement("img");
                img.style.width = '20px';
                img.style.height = '20px';
                if (i < datas.data.new) {
                    img.setAttribute("src", "images/new.png");
                } else {
                    img.setAttribute("src", "images/old.png");
                }
                state.appendChild(img);
            }
            state.appendChild(document.createTextNode(' new'));

            var endTime = new Date(datas.data.bid_length).getTime();
            var startTime = new Date(datas.data.start_bidding).getTime();
            var date = new Date().getTime();
            const minute = 1000 * 60;
            

            document.getElementById("now_price").innerHTML = '$' + datas.data.price;

            document.getElementById("low_price").innerHTML = '$' + datas.data.raise + '/刀';

            document.getElementById("timeLast").setAttribute("value", Math.round(Math.round((endTime - date)/minute) / Math.round((endTime - startTime) / minute ) * 100))
            

        },
    });
}