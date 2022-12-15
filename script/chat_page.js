$(document).ready(function() {
    let search = location.search.split("?")[1];
    $("#"+search).css("text-decoration", "underline");
    if($("#"+search).attr("class").split(" ")[0] == "no_read"){ //有沒有已讀過可能要重資料庫判斷QQ
        $("#"+search).removeClass("no_read");
        $("#"+search).addClass("ready_read");
    }
});