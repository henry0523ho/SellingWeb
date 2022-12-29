let chatList = [];

updateChatList();

function updateChatList() {
    $.ajax({
        url: 'php/chatList.php',
        type: "GET",
        success: function(result) {
            result = JSON.parse(result);
            if (result.state == 200) {
                chatList = result.chatList;
                $(document).ready(function() {
                    showChatList();
                });
            } else {
                console.log(result);
            }
        }
    });
}

function showChatList() {
    $('#chat_box').html("");
    $('#chat_box').append("</th><th>來自</th><th>訊息</th><th>時間</th></tr>");
    for (let i = 0; i < chatList.length; ++i) {
        $('#chat_box').append(
            $('<tr></tr>')
            .addClass('chat')
            .addClass((chatList[i].alreadyRead == 1 ? "already_read" : "no_read"))
            .click(function() {
                window.open("chat_page.html?" + chatList[i].userId);
            })
            .append(
                $('<td></td>').text(chatList[i].userName)
            )
            .append(
                $('<td></td>').text(chatList[i].lastMessage)
            )
            .append(
                $('<td></td>').text(chatList[i].chat_time)
            )
        );
    }
}