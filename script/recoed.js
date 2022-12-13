$(document).ready(function() {
    var products = JSON.parse(localStorage.getItem("products"))
    //console.log(products);
    products.reverse(); //反向排序
    //console.log(products);
    if(products != null){
        for(let i=0; i<products.length; i++){
            let product = products[i];
    
            let div01 = document.createElement("div");
            div01.setAttribute('class', "col-md-4 text-center animate-box fadeInUp animated-fast");
            
            let div02 = document.createElement("div");
            div02.setAttribute("class", "product");
            div02.setAttribute("id", "product");
    
            let div03 = document.createElement("div");
            div03.setAttribute("class", "product-grid-recode");
            div03.style.backgroundImage = "url(\"" + product.url + "\")";
            
            let div05 = document.createElement("div");
            div05.setAttribute("class", "desc");
    
            let h301 = document.createElement("h3");
    
            let a03 = document.createElement("a");
            a03.href = "fixed_page.html?" + product.id;
            a03.appendChild(document.createTextNode(product.name));
            a03.setAttribute("id", "show")
            a03.setAttribute("target", "_blank")
    
            h301.appendChild(a03);
    
            let s01 = document.createElement("span");
            s01.setAttribute("class", "Price");
            s01.appendChild(document.createTextNode("$" + product.price));
    
            div05.appendChild(h301);
            div05.appendChild(s01);
            div02.appendChild(div03);
            div02.appendChild(div05);
            div01.appendChild(div02);
    
            document.getElementById("record_product").appendChild(div01);
        }
    }
    
});