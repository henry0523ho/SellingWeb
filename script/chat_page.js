let chatList = [];
let currentChat = null;
let chatData = [];
$(document).ready(function() {
    if (location.search != "") {
        currentChat = location.search.split("?")[1];
    } else {
        currentChat = null;
    }
    $("#sendMsgBtn").click(function() {
        if ($("#sendMsgText").val() != "" && currentChat != null) {
            sendMessage($("#sendMsgText").val());
        }
        $("#sendMsgText").val("");
    });
    updateChatList();
    setInterval(updateChatList, 5000);
    updateChatText(0);
    setInterval(updateChatText, 1000, 0);
});

function sendMessage(msgText) {
    $.ajax({
        url: "php/chatTalk.php",
        type: "POST",
        data: {
            userIdTo: currentChat,
            chatText: msgText
        }
    }).done(function(res) {
        res = JSON.parse(res);
        if (res.state == 200) {
            updateChatText(0);
        } else {
            console.log(res);
        }
    });
}

function updateChatList() {
    $.ajax({
        url: 'php/chatList.php',
        type: "GET",
        success: function(result) {
            result = JSON.parse(result);
            if (result.state == 200) {
                chatList = result.chatList;
                showChatList();
            } else {
                console.log(result);
            }
        }
    });
}

function updateChatText(top) {
    if (currentChat == null) { return; }
    let time = "";
    if (chatData[currentChat] != null) {
        if (top == 1) {
            time = chatData[currentChat][0].chatTime;
        } else {
            time = chatData[currentChat][chatData[currentChat].length - 1].chatTime;
        }
    } else {
        chatData[currentChat] = [];
    }
    $.ajax({
        url: "php/chatHistory.php",
        type: "POST",
        data: {
            "userId": currentChat,
            "time": time,
            "top": top
        },
    }).done(function(res) {
        res = JSON.parse(res);
        if (res.state == 200) {
            for (let i = 0; i < res.chatData.length; ++i) {
                if (top) {
                    chatData[currentChat].unshift(res.chatData[i]);
                } else {
                    chatData[currentChat].push(res.chatData[i]);
                }
            }
            showChatText();
        } else {
            console.log(res);
        }
    });

}



function showChatList() {
    $('#chatList').html("");
    for (let i = 0; i < chatList.length; ++i) {
        $('#chatList').append(
            $("<li></li>").append(
                $("<a></a>")
                .addClass("chat")
                .addClass((chatList[i].alreadyRead == 1 ? "already_read" : "no_read"))
                .attr("href", "chat_page.html?" + chatList[i].userId)
                .html(chatList[i].userName)
            )
        );

    }
}

function showChatText() {
    $("#chatWindow").html("");
    if (currentChat == null) return;
    let name = "";
    for (let i = 0; i < chatList.length; ++i) {
        if (currentChat == chatList[i].userId) {
            name = chatList[i].userName;
        }
    }
    for (let i = 0; i < chatData[currentChat].length; ++i) {
        $("#chatWindow").append(
            $("<div></div>").append(
                $("<h4></h4>").html((currentChat == chatData[currentChat][i].userIdFrom ? name : "我") + ":")
            ).append(
                $("<p></p>").html(chatData[currentChat][i].chatText)
            ).append(
                $("<span></span>")
                .addClass((currentChat == chatData[currentChat][i].userIdFrom ? "time-right" : "time-left"))
                .html(chatData[currentChat][i].chatTime)
            ).addClass("message")
            .addClass((currentChat == chatData[currentChat][i].userIdFrom ? "" : "darker"))
        );
    }
}