$(document).ready(function() {
    grabProductName();
    $("#update").click(function() {
        delProduct();
    })
})
function delProduct(){
    $.ajax({
        url: 'php/delProduct.php',
        type: "POST",
        data: { "productId": $('input[name=cancel]:checked').val() },
    })
    .done(function(data) {

    })
}

function reload() {
    location.reload();
}

function grabProductName() {
    $.ajax({
            url: 'php/findMyUpload.php',
            type: "POST",
        })
        .done(function(data) {
            let objs = JSON.parse(data);
            let table = document.getElementById("takeoff");
            for (i = 0; i < objs.length; i++) {
                let tr = document.createElement("tr");
                let postdate = document.createElement("td");
                postdate.innerHTML = objs[i]["postdate"];
                let name = document.createElement("td");
                name.innerHTML = objs[i]["name"];
                let state = document.createElement("td");
                state.innerHTML = "上架中";
                let price = document.createElement("td");
                price.innerHTML = objs[i]["price"];
                let cancel = document.createElement("td");
                let radio = document.createElement("input");
                radio.setAttribute("type", "radio");
                radio.setAttribute("value", objs[i]["id"]);
                radio.setAttribute("name", "cancel");
                cancel.setAttribute("style", "width: 10%; text-align: center;");
                cancel.appendChild(radio);
                tr.appendChild(postdate);
                tr.appendChild(name);
                tr.appendChild(state);
                tr.appendChild(price);
                tr.appendChild(cancel);
                table.appendChild(tr);
            }
        })
}