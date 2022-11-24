console.log("hello");
$(document).ready(function() {
    checkLogin(displayUserName);
    $("#in_out").click(function(){
        //console.log("要不要登出");

        $.post("http://localhost/workSpace/SellingWeb/php/getSession.php", null, function(data, status) {
            if (data != "No Login") {
                let yes = confirm('以登入，是否要登出');
                if (yes) {
                    console.log("登出!!")
                    alert("以登出，請重新登入")
                    logout();
                    document.location.href = "http://localhost/workSpace/SellingWeb/login.html";
                } else {
                    console.log("不登出!!")
                    document.location.href = "http://localhost/workSpace/SellingWeb/index.html";
                }
            }
        });
    });
});
// $(window).unload(function(){
//     console.log("關閉");
//     logout();
    
//     alert("頁面要關閉了");
// });
// window.onunload = function() {
//     window.event.returnValue  = "Goodbye Jason !";
//     if (window.event.reason == false) {
//        window.event.cancelBubble = true;
//     }
// }

function checkLogin(callback) {
    $.post("http://localhost/workSpace/SellingWeb/php/getSession.php", null, function(data, status) {
        console.log(data + " " + status);
        if (status == "success") {
            callback(data);
        }
        else return;
    });
}

function displayUserName(username) {
    console.log(username);
    if (username != "No Login") {
        console.log(document.getElementById("logoName"));
        document.getElementById("logoName").innerHTML = ("Hello-" + username);
    }
    else document.getElementById("logoName").innerHTML = ("Member");

}

function logout() {
    $.post("http://localhost/workSpace/SellingWeb/php/logout.php", null, function(data, status) {
        document.getElementById("logoName").innerHTML = ("Member");
        alert("以登出，請重新登入");
    }); 
}