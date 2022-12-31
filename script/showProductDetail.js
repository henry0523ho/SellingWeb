let productDetail = null;
let productId;
let query = location.search.slice(1);
if (query != "") {
    productId = query;
    getProductDetail(productId).then(function() {
        initPage();
    });
}

function initPage() {
    $(document).ready(function() {
        displayDetail();
        $("#addToCart").click(function() {
            addToCart();
        });
        $("#sendMsgBtn").click(function(event) {
            event.preventDefault();
            checkLogin(sendMsg);
        });

    });
}

function sendMsg(sessionData) {
    if (sessionData.state == 200) {
        $.ajax({
            url: "php/chatTalk.php",
            type: "POST",
            data: {
                userIdTo: productDetail.sellerId,
                chatText: ("我對" + productDetail.name + "有興趣")
            },
            success: function(data) {
                location.href = "chatroom.html";
            }
        })
    } else {
        alert("請先登入");
    }
}

function getProductDetail(productId) {
    return new Promise(function(resolve, reject) {
        $.ajax({
            url: "php/showProductDetail.php",
            type: "POST",
            data: {
                id: productId
            },
            success: function(res) {
                res = JSON.parse(res);
                if (res.state == 200) {
                    productDetail = res.data;
                    resolve();
                }
            }
        });
    });
}


function addToCart() {
    $.ajax({
            url: "php/putInCart.php",
            type: "POST",
            data: {
                "purchaseNum": $("#product_num option:selected").val(),
                "productId": location.search.split("?")[1]
            }
        })
        .done(function(reslut) {
            alert("加入成功!!!")
            let obj = JSON.parse(reslut);
            console.log(obj);
            location.reload();
        })
}

function displayDetail() {
    // console.log(result);
    let datas = productDetail;

    let obj = {
        id: productId,
        name: datas.name,
        price: datas.price,
        url: datas.url
    };
    //console.log(obj);
    var products = JSON.parse(localStorage.getItem("products"));
    if (products == null) {
        let newProudcts = []
        newProudcts.push(obj)
        localStorage.setItem("products", JSON.stringify(newProudcts))
            //console.log(localStorage)
    } else {
        //console.log(products);
        let find = $.map(products, function(item, index) {
            return item.id;
        }).indexOf(obj.id);
        if (find == -1) {
            //console.log("加!!!");
            products.push(obj)
            localStorage.setItem("products", JSON.stringify(products));
        }
        //else console.log("不加!!!");
    }


    document.getElementById("product_img").setAttribute("src", datas.url);
    console.log(document.getElementById("product_img"));

    document.getElementById("product_name").innerHTML = datas.name;
    document.getElementById("product_price").innerHTML = '$' + datas.price;
    document.getElementById("product_title").innerHTML = datas.name;
    document.getElementById("product_info").innerHTML = datas.info;


    let state = document.getElementById("product_state");
    state.appendChild(document.createTextNode('old '));
    for (let i = 0; i < 5; i++) {
        let img = document.createElement("img");
        img.style.width = '20px';
        img.style.height = '20px';
        if (i < datas.new) {
            img.setAttribute("src", "images/new.png");
        } else {
            img.setAttribute("src", "images/old.png");
        }
        state.appendChild(img);
    }
    state.appendChild(document.createTextNode(' new'));

    document.getElementById("price").innerHTML = '$' + datas.price;

    let num = document.getElementById("product_num");
    for (let i = 1; i <= datas.num; i++) {
        let option = document.createElement("option");
        option.setAttribute("value", i);
        option.innerHTML = i;
        num.appendChild(option);
    }
}