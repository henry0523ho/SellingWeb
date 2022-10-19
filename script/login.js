$(document).ready(function() {
    $("#loginSubmit").click(function() {
        login($('#loginName').val(), $("#loginPwd").val());
    });
    $("#regSubmit").click(function() {
        register($('#regName').val(), $('#regEmail').val(), $('#regPwd').val(), $('#checkPwd').val());
    });
});

function login(userName, userPwd) {
    $.ajax({
        url: 'http://localhost/workSpace/SellingWeb/php/login.php',
        type: "POST",
        data: { "userName": userName, "userPwd": userPwd },
        success: function(result) {
            console.log(result);
            if (result == "success") {
                alert("登入成功");
                document.location.href = "http://localhost/workSpace/SellingWeb/index.html";
            } else {
                alert("登入失敗，請檢查帳號密碼");
            }
        },
        error: function(result) {
            console.log(result);
            alert("登入失敗，請檢查帳號密碼");
        }
    });
}

function register(userName, userEmail, userPwd, checkPassword) {
    if (userPwd == checkPassword) {
        $.ajax({
            url: 'http://localhost/workSpace/SellingWeb/php/register.php',
            type: 'POST',
            data: { "userName": userName, "userEmail": userEmail, "userPwd": userPwd },
            success: function(result) {
                if (result == "success") {
                    alert("註冊成功");
                    document.location.href = "http://localhost/workSpace/SellingWeb/login.html"
                } else if (result == "nameTaken") {
                    alert("使用者名稱已存在")
                } else {
                    alert("註冊失敗");
                }
            },
            error: function(result) {
                console.log(result);
                alert("註冊失敗");
            }

        });
    } else {
        alert("密碼與確認密碼不同");
    }
}