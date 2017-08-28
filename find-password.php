<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>云点名，找回密码</title>
    <script src="js/jquery-3.2.1.js"></script>
</head>
<style>
    #find_password_two{display:none;}
    #find_password_three{display:none;}
    #pop_up{dispaly:block;text-align:center;width:200px;line-height:160px; margin-top:10%;margin-left:30%;border:1px solid #00CC66;}

</style>
<body>
<div id="find_password_one">
    <span>用户名</span>
    <input type="text" id="username" placeholder="请输入用户名"><br/>
    <span>邮箱</span>
    <input type="text" id="email" placeholder="请输入注册邮箱">
    <span id="verify"></span><br/>
    <input type="button" id="verify-bu" value="验证"><br/>
    <input type="button" id="find_one" value="下一步"  disabled="disabled">
</div>
<div id="find_password_two">
    <span>验证码</span>
    <input type="text" id="email_code" placeholder="请输入邮箱验证码">
    <span id="verify1"></span>
    <input type="button" id="verify-bu1" value="发送邮箱验证码">
    <input type="button" id="find_two" value="下一步"  disabled="disabled">
</div>
<div id="find_password_three">
    <span>输入新密码</span>
    <input type="password" id="new_password" placeholder="请输入新密码">
    <span>重新输入</span>
    <input type="password" id="renew_password" placeholder="请重新输入新密码">
    <span id="verify2"></span>
    <input type="button" id="find_three" value="确定">
</div>
<div id="pop_up">
</div>
</body>
<script>
    $(function(){
        $("#pop_up").hide();
        $("#verify-bu").click(function(){
            var username=$("#username").val();
            var email=$("#email").val();
            $.post("findpassword.php",{Username:username,Email:email},function(data){
                if(data=="1")
                {
                    $("#verify").html("");
                    document.getElementById('verify-bu').value='验证通过';
                    $("#find_one").removeAttr("disabled");
                }
                else{
                    $("#verify").html("用户名或邮箱错误");
                }
            })
        })
        $("#find_one").click(function(){
            $("#find_password_one").hide();
            $("#find_password_two").show();
        })
        $("#verify-bu1").click(function(){
            var username=$("#username").val();
            var email=$("#email").val();
            $.post("findpassword-one.php",{Username:username,Email:email},function(data){
                if(data=="1")
                {
                    document.getElementById('verify-bu1').value='发送成功';
                    $("#verify1").html("请输入邮箱验证码进行验证，未收到验证码，请检查邮箱是否填写正确");
                    $("#find_two").removeAttr("disabled");
                }
                else{
                    $("#verify").html("发送失败，请重新发送");
                }
            })
        })

        $("#find_two").click(function(){
            var email_code=$("#email_code").val();
            if(email_code=="")
            {
                $("#verify1").html("验证码为空!");
            }
            else {
                $.post("findpassword-two.php", {Email_code:email_code}, function (data) {
                    if(data=="1")
                    {
                        $("#find_password_two").hide();
                        $("#find_password_three").show();
                    }
                    else {
                        $("#verify1").html("验证码错误，请检查验证码或重新发送验证");
                        document.getElementById('verify-bu1').value='重新发送';
                    }
                })
            }
        })

        $("#find_three").click(function(){
            var newpassword=$("#new_password").val();
            var renewpassword=$("#renew_password").val();
            var username=$("#username").val();
            if( newpassword==""||renewpassword=="")
            {
                $("#verify2").html("*密码不能为空!");
            }
            else if(newpassword.length<6)
            {
                $("#verify2").html("*密码长度不能小于6位！");
            }
            else if(newpassword!=renewpassword)
            {
                $("#verify2").html("*密码不一致！");
            }
            else {
                $("#verify2").html("");
                $.post("findpassword-three.php", {Newpassword:newpassword,Renewpassword:renewpassword,Username:username}, function (data) {
                        if(data=="1")
                        {
                            $("#pop_up").html("");
                            $("#pop_up").fadeIn(100);
                            document.getElementById("pop_up").innerHTML="<span >重置成功，可返回"+"<a href='index.php'>登录</a></span>";
                        }
                        else {
//                            alert("重置失败,请尝试重新找回");find-password
                            $("#pop_up").html("");
                            $("#pop_up").fadeIn(100);
                            document.getElementById("pop_up").innerHTML="<span >重置失败，请尝试"+"<a href='find-password.php'>重新找回</a></span>"

                        }

                })
            }
        })
    })
</script>
</html>