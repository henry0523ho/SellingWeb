$(document).ready(function(){
    $("#addToCart").click(function(){
        addToCart();
    })
})
function addToCart(){
    $.ajax({
        url: "php/putInCart.php",
        type: "POST",
        data: {
            "purchaseNum": $("#product_num option:selected").val(),
            "productId": location.search.split("?")[1]
        }
    })
    .done(function(reslut){
        let obj=JSON.parse(reslut);
        console.log(obj);
    })
}
