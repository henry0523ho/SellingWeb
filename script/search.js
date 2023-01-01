$(document).ready(function() {
    $("#searchBtn").click(function() {
        console.log("search");

    })
})

function search() {
    console.log("search");
    let parent = document.getElementById("showProduct");
    let divs = document.getElementsByClassName("col-md-4 text-center animate-box fadeInUp animated-fast");
    let num = divs.length;
    //let name = $("#searchText").val();
    let name = document.getElementById("searchText").value;
    console.log(name);
    $.ajax({
            url: "php/search.php",
            type: "POST",
            data: { "name": name },
        })
        .done(function(result) {
            let objs = JSON.parse(result);
            if (objs.state != 200) {
                console.log("fetch showProduct.php failed");
                console.log(objs.state + ' ' + objs.message);
                return;
            }
            for (i = 0; i < num; i++) {
                parent.removeChild(divs[0]);
            }
            for (let i = 0; i < objs.data.length; i++) {
                if (i % 3 == 0) {
                    let divRow = document.createElement("div");
                    divRow.setAttribute("class", "row");
                    document.getElementById("display").appendChild(divRow);
                }

                let objContext = objs.data[i];

                let div01 = document.createElement("div");
                div01.setAttribute('class', "col-md-4 text-center animate-box fadeInUp animated-fast");

                let div02 = document.createElement("div");
                div02.setAttribute("class", "product");

                let div03 = document.createElement("div");
                div03.setAttribute("class", "product-grid");
                div03.style.backgroundImage = "url(\"" + objContext.url + "\")";

                let div04 = document.createElement("div");
                div04.setAttribute("class", "inner");

                let div05 = document.createElement("div");
                div05.setAttribute("class", "desc");

                let p01 = document.createElement("p");

                let a01 = document.createElement("a");
                a01.href = "fixed_page.html?" + objContext.id;
                //a01.addEventListener("click", function(){displayDetail(objContext.id);})
                a01.setAttribute("class", "icon");

                let i01 = document.createElement("i");
                i01.setAttribute("class", "icon-shopping-cart");

                a01.appendChild(i01);

                let a02 = document.createElement("a");
                a02.href = "fixed_page.html?" + objContext.id;
                a02.setAttribute("class", "icon");
                //a02.addEventListener("click", function(){displayDetail(objContext.id);})
                let i02 = document.createElement("i");
                i02.setAttribute("class", "icon-eye");

                a02.appendChild(i02);

                let h301 = document.createElement("h3");

                let a03 = document.createElement("a");
                a03.href = "fixed_page.html";
                a03.appendChild(document.createTextNode(objContext.name));
                h301.appendChild(a03);


                let s01 = document.createElement("span");
                s01.setAttribute("class", "Price");
                s01.appendChild(document.createTextNode("$" + objContext.price));

                div05.appendChild(h301);
                div05.appendChild(s01);
                p01.appendChild(a01);
                p01.appendChild(a02);
                div04.appendChild(p01);
                div03.appendChild(div04);
                div02.appendChild(div03);
                div02.appendChild(div05);
                div01.appendChild(div02);

                document.getElementById("showProduct").appendChild(div01);

                // document.getElementById("showProduct").append(newDiv);

                // string += '<div class="col-md-4 text-center animate-box"><div class="product"><div class="product-grid" style="background-image:url("';
                // string += 'images/product-1.jpg';
                // string += '");">';
                // string += '<div class="inner"><p><a href="single.html" class="icon"><i class="icon-shopping-cart"></i></a><a href="single.html" class="icon"><i class="icon-eye"></i></a></p></div></div><div class="desc"><h3><a href="single.html">';
                // string += objContext.name;
                // string += '</a></h3><span class="price">$';
                // string += objContext.price;
                // string += '</span></div></div></div>';

                //console.log(string);
            }
            //document.getElementById("showProduct").innerHTML = string;
        })
}