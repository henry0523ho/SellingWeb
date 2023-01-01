$(document).ready(function(){
    check();
    $("#finish").click(function(){
        if(window.confirm("確認?")== true)
        {
            getSeller();
            $(location).attr("href","index.html");
            alert("已下單");
        }       
    })  
})

function getSeller(){
    $.ajax({
        url: "php/getpurchase.php",
        type: "GET"
    })
    .done(function(reslut){
        let objs=JSON.parse(reslut);
        sendInfoMail(objs)
    })
}

function sendInfoMail(reslut){   
    for(let i=0;i<reslut.data.length;i++){       
        sendinformMail(reslut.data[i].seller_id, func)    
    }
}

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


function sendinformMail(userId, func) {
    $.ajax({
        url: "php/sendmail.php",
        type: "POST",
        data: { userId: userId },
        success: function(res) {
            data = JSON.parse(res);
            if (data.state == 200) {
                sendMail(data.Email, data.subject, data.body, func);
            }
        }
    })
}