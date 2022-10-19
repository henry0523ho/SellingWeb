console.log("hello");
$(document).ready(function() {
    checkLogin(displayUserName);
});

function checkLogin(callback) {
    $.post("http://localhost/workSpace/SellingWeb/php/getSession.php", null, function(data, status) {
        if (status == "success") {
            callback(data);
        }
    });
}

function displayUserName(username) {
    console.log(username);
    if (username != "No Login") {
        // 如果有登入的session，要怎麼顯示使用者資訊&登出按鈕?
    }
}

function logout() {
    $.post("http://localhost/workSpace/SellingWeb/php/logout.php", null, function(data, status) {

    });
}