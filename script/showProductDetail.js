$(document).ready(function() {
    displayDetail(location.search);
});

function displayDetail(search) {
    let id = search.split("?")[1];
    $.ajax({
        url: 'php/showProductDetail.php',
        type: "POST",
        data: { "id": id },

        success: function(result) {
            console.log(result);
            let datas = JSON.parse(result);

            let obj = {
                id: id,
                name: datas.data.name,
                price: datas.data.price,
                url: datas.data.url
            };
            //console.log(obj);
            var products = JSON.parse(localStorage.getItem("products"));
            if(products == null){
                let newProudcts = []
                newProudcts.push(obj)
                localStorage.setItem("products", JSON.stringify(newProudcts))
                //console.log(localStorage)
            }else{
                //console.log(products);
                let find = $.map(products, function(item, index) {
                    return item.id;
                  }).indexOf(obj.id);
                if(find == -1){
                    //console.log("加!!!");
                    products.push(obj)
                    localStorage.setItem("products",JSON.stringify(products));
                }
                //else console.log("不加!!!");
            }


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

            document.getElementById("price").innerHTML = '$' + datas.data.price;

            let num = document.getElementById("product_num");
            for (let i = 1; i <= datas.data.num; i++) {
                let option = document.createElement("option");
                option.setAttribute("value",i);
                option.innerHTML = i;
                num.appendChild(option);
            }

        },
    });
}