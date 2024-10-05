$(function(){
    $("#regSubmit").click(function(){
        var name = $("#name").val();
        var username = $("#username").val();
        var email = $("#email").val();
        var password = $("#password").val();

        var dataString = "name="+name+"&username="+username+"&email="+email+"&password="+password;
        $.ajax({
            type:"POST",
            url:"getRegister.php",
            data:dataString,
            success:function(message){
                $("#status").html(message);
            }
        })
        return false;
    });

    $("#userLogin").click(function(){
        var email = $("#email").val();
        var password = $("#password").val();
        var dataString = "email="+email+"&password="+password;
        $.ajax({
            type:"POST",
            url:"getLogin.php",
            data:dataString,
            success:function(message){
                if ($.trim(message)=="empty"){
                    $(".empty").show();
                    setTimeout(function(){
                        $(".empty").fadeOut();
                    }, 3000);
                }else if ($.trim(message)=="invalid"){
                    $(".invalid").show();
                    setTimeout(function(){
                        $(".invalid").fadeOut();
                    }, 3000);
                }else if($.trim(message)=="disable"){
                    $(".disable").show();
                    setTimeout(function(){
                        $(".disable").hide();
                    }, 3000);
                }else if($.trim(message)=="error"){
                    $(".error").show();
                    setTimeout(function(){
                        $(".error").fadeOut();
                    }, 3000);
                }else{
                    window.location = "exam.php";
                }
            }
        })
        return false;
    })
});