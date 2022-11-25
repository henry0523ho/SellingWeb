$(document).ready(function() {
    console.log('location.search: '+location.search);
    displayDetail(location.search);
});

function displayDetail(search){
    let id = search.split("?")[1];    
    $.ajax({
        url: 'http://localhost/workSpace/SellingWeb/php/showProductDetail.php',
        type: "POST",
        data: {"id": id},

        success: function(result) {
            //console.log(result);
            let obj = JSON.parse(result);
            console.log(obj.name);
        },
    });
}
