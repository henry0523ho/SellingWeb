$(document).ready(function() {
    $(".chat").click(function(){
        //console.log(this.id); //判斷按下哪一個記錄條
        window.open("chat_page.html?"+this.id);
    });
});