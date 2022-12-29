$(document).ready(function() {
    $("#loginSubmit").click(function() {
        login($('#loginName').val(), $("#loginPwd").val());
    });
    $("#regSubmit").click(function() {
        register($('#regName').val(), $('#regEmail').val(), $('#regPwd').val(), $('#checkPwd').val(), $('#regTrueName').val(), $('#regPhone').val());
    });
});

function login(userName, userPwd) {
    $.ajax({
        url: 'php/login.php',
        type: "POST",
        data: { "userName": userName, "userPwd": userPwd },
        success: function(result) {
            let res = JSON.parse(result);
            if (res.state == 200) {
                alert("登入成功");
                document.location.href = "index.html";
            } else {
                alert("登入失敗，請檢查帳號密碼");
            }
        },
        error: function(result) {
            let res = JSON.parse(result);
            console.log(res.state + ' ' + res.message);
            alert("登入失敗，請檢查帳號密碼");
        }
    });
}

function register(userName, userEmail, userPwd, checkPassword, realName, phone) {
    if (userPwd == checkPassword) {
        $.ajax({
            url: 'php/register.php',
            type: 'POST',
            data: { "userName": userName, "userEmail": userEmail, "userPwd": userPwd, "realName": realName, "phone": phone },
            success: function(result) {
                let res = JSON.parse(result);
                if (res.state == 200) {
                    sendAuthMail(res.userId, function() {
                        alert("註冊成功，請到信箱驗證帳號");
                        document.location.href = "login.html";
                    });
                } else if (res.state == 409) {
                    alert("使用者名稱已存在")
                } else {
                    alert("註冊失敗");
                    console.log(result);
                }
            },
            error: function(result) {
                let res = JSON.parse(result);
                console.log(res.state + ' ' + res.message);
                alert("註冊失敗");
            }

        });
    } else {
        alert("密碼與確認密碼不同");
    }
}