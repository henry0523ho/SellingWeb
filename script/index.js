$(document).ready(function() {
    console.log("check login");
    checkLogin(displayUserName);
    checkCartNum();
    $("#in_out").click(function() {
        //console.log("要不要登出");

        $.post("php/getSession.php", null, function(data, status) {
            let res = JSON.parse(data);
            if (res.state == 200) {
                let yes = confirm('已登入，是否要登出');
                if (yes) {
                    console.log("登出!!");
                    logout();
                } else {
                    console.log("不登出!!");
                    // document.location.href = "index.html";
                }
            }
        });
    });
    $("#check_in_out_1").click(check);
    $("#check_in_out_2").click(check);
    $("#check_in_out_3").click(check);
    $("#check_in_out_4").click(check);
    $("#check_in_out_5").click(check);
});

function checkCartNum() {
    $.ajax({
            url: "php/getCart.php",
            type: "GET"
        })
        .done(function(result) {
            console.log(JSON.parse(result));
            if (JSON.parse(result) != "") $("#cart_product_num").html(JSON.parse(result).data.length);
            else $("#cart_product_num").html('0');
        })
}

function check() {
    $.post("php/getSession.php", null, function(data, status) {
        let res = JSON.parse(data);
        if (res.state == 204) {
            let yes = confirm('請先登入才可下一步');
            if (yes) {
                console.log("登入!!");
                document.location.href = "login.html";
            } else {
                console.log("不登入!!");
                document.location.href = "index.html";
            }
        }
    });
}

function checkLogin(callback) {
    $.post("php/getSession.php", null, function(data, status) {
        let res = JSON.parse(data);
        console.log(data + " " + status);
        if (status == "success") {
            callback(res);
        } else return;
    });
}

function displayUserName(sessionData) {
    //console.log(username);
    if (sessionData.state == 200) {
        console.log(document.getElementById("logoName"));
        document.getElementById("logoName").innerHTML = ("Hello-" + sessionData.userName);
    } else document.getElementById("logoName").innerHTML = ("Member");
}

function logout() {
    $.post("php/logout.php", null, function(data, status) {
        document.getElementById("logoName").innerHTML = ("Member");
        alert("以登出，請重新登入");
        document.location.href = "login.html";
    });
}