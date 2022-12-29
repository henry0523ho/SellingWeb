var Email = {
    send: function(a) {
        return new Promise(function(n, e) {
            a.nocache = Math.floor(1e6 * Math.random() + 1), a.Action = "Send";
            var t = JSON.stringify(a);
            Email.ajaxPost("https://smtpjs.com/v3/smtpjs.aspx?", t, function(e) { n(e) })
        })
    },
    ajaxPost: function(e, n, t) {
        var a = Email.createCORSRequest("POST", e);
        a.setRequestHeader("Content-type", "application/x-www-form-urlencoded"), a.onload = function() {
            var e = a.responseText;
            null != t && t(e)
        }, a.send(n)
    },
    ajax: function(e, n) {
        var t = Email.createCORSRequest("GET", e);
        t.onload = function() {
            var e = t.responseText;
            null != n && n(e)
        }, t.send()
    },
    createCORSRequest: function(e, n) { var t = new XMLHttpRequest; return "withCredentials" in t ? t.open(e, n, !0) : "undefined" != typeof XDomainRequest ? (t = new XDomainRequest).open(e, n) : t = null, t }
};


function sendMail(to, subject, body, func) {
    Email.send({
        SecureToken: "d24dc5d9-4bad-488c-b636-bc372c91e63a",
        To: to,
        From: "chen3ho5yang12@gmail.com",
        Subject: subject,
        Body: body
    }).then(
        function(message) {
            console.log(message);
            func();
        }
    );
}
//伺服器版
// function sendMailPhp(to, subject, body) {
//     $.ajax({
//         url: "php/sendMail.php",
//         type: "POST",
//         data: {
//             emailTo: to,
//             subject: subject,
//             body: body
//         }
//     }).done(function(res) {
//         res = JSON.parse(res);
//         if (res.state == 200) {
//             console.log(res);
//         } else {
//             console.log(res);
//         }
//     });
// }

function sendAuthMail(userId, func) {
    $.ajax({
        url: "php/authMailBody.php",
        type: "POST",
        data: { userId: userId },
        success: function(res) {
            data = JSON.parse(res);
            if (data.state == 200) {
                sendMail(data.email, data.subject, data.body, func);
            }
        }
    })
}