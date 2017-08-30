<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>云点名，找回密码</title>
    <script src="js/jquery-3.2.1.js"></script>
    <script src="js/layer/layer.js"></script>
    <link rel="stylesheet" href="style/placeholder.css">
    <link rel="stylesheet" href="style/button_one.css">
</head>
<style>
    #find_password_two{display:none;margin-top:20%;}
    #find_password_three{display:none;margin-top:15%;}
    /*#pop_up{dispaly:block;text-align:center;width:200px;line-height:160px; margin-top:10%;margin-left:30%;border:1px solid #00CC66;}*/
    #find_password_one{display:block;margin-top:15%;}
    #username,#email,#email_code{display:block;width:450px;height:50px;}
    #verify-bu{display:block;width:180px;height:35px;}
    #verify_one{display:block;}
    #verify,#verify2{display:block;margin-top:-10px;margin-right:260px;color:#2E2D3C;}
    #verify1{display:block;margin-top:-10px;margin-right:80px;color:#2E2D3C;}
    #verify_star,#verify2_star {display:block;color:#6666FF;float:left;margin-left:260px;}
    #verify1_star {display:block;color:#6666FF;float:left;margin-left:90px;}
    a {
        position: relative;
        color: rgba(255,255,255,1);
        /*淡蓝色rgb值：193 210 240*/
        text-decoration: none;
        background-color: rgba(193,210,240,1);
        font-family: 'Yanone Kaffeesatz';
        font-weight: 600;
        font-size: 2em;
        display: block;
        padding: 4px;
        -webkit-border-radius: 8px;
        -moz-border-radius: 8px;
        border-radius: 8px;
        -webkit-box-shadow: 0px 6px 0px rgba(160,210,240,1), 0px 9px 25px rgba(0,0,0,.7);
        -moz-box-shadow: 0px 6px 0px rgba(160,210,240,1), 0px 9px 25px rgba(0,0,0,.7);
        box-shadow: 0px 6px 0px rgba(160,210,240,1), 0px 9px 25px rgba(0,0,0,.7);
        margin: 100px auto;
        width: 160px;
        text-align: center;
        -webkit-transition: all .1s ease;
        -moz-transition: all .1s ease;
        -ms-transition: all .1s ease;
        -o-transition: all .1s ease;
        transition: all .1s ease;
    }
    a:active {
        -webkit-box-shadow: 0px 3px 0px rgba(160,210,240,1), 0px 3px 6px rgba(0,0,0,.9);
        -moz-box-shadow: 0px 3px 0px rgba(160,210,240,1), 0px 3px 6px rgba(0,0,0,.9);
        box-shadow: 0px 3px 0px rgba(160,210,240,1), 0px 3px 6px rgba(0,0,0,.9);
        position: relative;
        top: 6px;
    }
</style>
<body>
<center>
<div id="find_password_one">
<!--    <span>用户名</span>-->
<!--    <input type="text" id="username" placeholder="请输入用户名"><br/>-->
    <input required='' type='text' id="username">
    <label alt='请输入用户名' placeholder='用户名'></label>
<!--    <span>邮箱</span>-->
<!--    <input type="text" id="email" placeholder="请输入注册邮箱">-->
    <input required='' type='text' id="email" >
    <label alt='请输入注册邮箱' placeholder='邮箱'></label>
    <div id="verify_one">
     <span id="verify_star">*</span> <span id="verify"></span><br/>
    </div>
<!--    <input type="button" id="verify-bu" value="验证"><br/>-->
    <input class="button_one white" type="button" id="verify-bu" value="验证" />
<!--    <input type="button" id="find_one" value="下一步"  disabled="disabled">-->
        <a id="find_one">下一步</a>
</div>
</center>
<center>
<div id="find_password_two">
<!--    <span>验证码</span>-->
<!--    <input type="text" id="email_code" placeholder="请输入邮箱验证码">-->
    <input required='' type='text' id="email_code">
    <label alt='请输入邮箱验证码' placeholder='邮箱验证码'></label>
    <div id="verify_two">
        <span id="verify1_star">*</span> <span id="verify1"></span><br/>
    </div>
<!--    <input type="button" id="verify-bu1" value="发送邮箱验证码">-->
    <input class="button_one white" type="button" id="verify-bu1" value="发送邮箱验证码" />
<!--    <input type="button" id="find_two" value="下一步"  disabled="disabled">-->
     <a id="find_two">下一步</a>
</div>
</center>
<center>
<div id="find_password_three">
    <span>输入新密码</span>
    <input type="password" id="new_password" placeholder="请输入新密码">
    <span>重新输入</span>
    <input type="password" id="renew_password" placeholder="请重新输入新密码">
    <div id="verify_three">
        <span id="verify2_star">*</span> <span id="verify2"></span><br/>
    </div>
    <input type="button" id="find_three" value="确定">
</div>
</center>
<!--<div id="pop_up">-->
<!--</div>-->
</body>
<script>
    $(function(){
        $("#verify_one").hide();
        $("#verify_two").hide();
        $("#verify_three").hide();
//        $("#pop_up").hide();
        var email_verify=0;
        $("#verify-bu").click(function(){
            var username=$("#username").val();
            var email=$("#email").val();
            if(username==""||email=="")
            {
               $("#verify_one").show();
               $("#verify").html("");
               $("#verify").html("用户名或邮箱为空");
            }
            else {
                $.post("findpassword.php", {Username: username, Email: email}, function (data) {
                    if (data == "1") {
                        $("#verify_one").hide();
                        document.getElementById('verify-bu').value = '验证通过';
//                        $("#find_one").removeAttr("disabled");
                        email_verify=1;
                    }
                    else {
                        $("#verify_one").show();
                        $("#verify").html("");
                        $("#verify").html("用户名或邮箱错误");
                    }
                })
            }
        })
        $("#find_one").click(function(){
            if(email_verify==1)
            {
                $("#find_password_one").hide();
                $("#find_password_two").show();
            }
            else {
                $("#verify_one").show();
                $("#verify").html("");
                $("#verify").html("请先验证邮箱");
            }
        })
        $("#verify-bu1").click(function(){
            var username=$("#username").val();
            var email=$("#email").val();
            $.post("findpassword-one.php",{Username:username,Email:email},function(data){
                if(data=="1")
                {
                    document.getElementById('verify-bu1').value='发送成功';
                    $("#verify_two").show();
                    $("#verify1").html("");
                    $("#verify1").html("请输入邮箱验证码进行验证，未收到验证码，请检查邮箱是否填写正确");
                    $("#find_two").removeAttr("disabled");
                }
                else{
                    $("#verify_two").show();
                    $("#verify1").html("");
                    $("#verify1").html("发送失败，请重新发送");
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
                        if(data=="1") {
//                            $("#pop_up").html("");
//                            $("#pop_up").fadeIn(100);
//                            document.getElementById("pop_up").innerHTML="<span >重置成功，可返回"+"<a href='index.php'>登录</a></span>";
                            //页面层
                            layer.open({
                                type: 1,
                                skin: 'layui-layer-rim', //加上边框
                                area: ['420px', '240px'], //宽高
                                content: '<span >重置成功，可返回<a href="index.php">登录</a></span>'
                            });
                        }
                        else {
//                            alert("重置失败,请尝试重新找回");find-password
//                            $("#pop_up").html("");
//                            $("#pop_up").fadeIn(100);
//                            document.getElementById("pop_up").innerHTML="<span >重置失败，请尝试"+"<a href='find-password.php'>重新找回</a></span>"
                            layer.open({
                                type: 1,
                                skin: 'layui-layer-rim', //加上边框
                                area: ['420px', '240px'], //宽高
                                content: '<span >重置失败，请尝试<a href="find-password.php">重新找回</a></span>'
                        });
                        }

                })
            }
        })
    })
</script>
</html>