$(document).ready(function(){
    $("#changeInfo").click(function(){
        let name = $("#cName").val();
        let email = $("#cEmail").val();
        let password = $("#cPassword").val();
        
        $.ajax({
            url : 'php/memberInfo.php',
            type : "POST",
            data : {"name" : name, "email" : email, "password" : password},
        })
        .done(function(data){
            location.reload();
        })
    })
});