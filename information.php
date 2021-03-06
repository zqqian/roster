<?php
require_once 'get_user_info.php';
//用于检测是否登录，测试本页面时可暂时屏蔽以下几行php代码
if(!$is_login){
    echo "<script> alert('Please login...');parent.location.href='./index.php'; </script>";
}
$sql="select * from user where userId=$userid";
$result=mysqli_query($db,$sql);
$row = mysqli_fetch_assoc($result);
$email=$row['email'];
$college=$row['college'];
$academy=$row['academy'];
echo "<script>console.log('$email.$college.$academy')</script>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>个人信息</title>
    <script src="js/jquery-3.2.1.js"></script>
    <script src="js/layer/layer.js"></script>
    <link rel="stylesheet" href="style/button_one.css">
    <link href='http://cdn.webfont.youziku.com/webfonts/nomal/107666/45803/59b54708f629d81184f0b96c.css' rel='stylesheet' type='text/css' />
<!--    <script type="text/javascript" src="http://cdn.webfont.youziku.com/wwwroot/js/wf/youziku.api.min.js?"></script>-->
</head>
<style>
    .information{display:block;margin-top:10%;}
    label{
        display: inline-block;
        padding: 0 15px;
        vertical-align: middle;
        margin-top:30px;
        font-size:25px;
    }
    input{
        outline: none;
        transition:all 0.30s ease-in-out;
        -webkit-transition: all 0.30s ease-in-out;
        -moz-transition: all 0.30s ease-in-out;
        border-radius:15px;
        border: 1px solid rgb(216, 216, 216);
        padding: 2px 10px 2px 10px;
        margin-top:30px;
    }
    input[type="text"]{
        height: 50px;
        width:300px;
        line-height: 50px;
        border-radius: 20px;
        padding:10px 10px;
        vertical-align: middle;
        color:#666;
    }
    input:focus{
    box-shadow:0 0 5px rgba(81, 203, 238, 1);
    -webkit-box-shadow:0 0 5px rgba(81, 203, 238, 1);
    -moz-box-shadow:0 0 5px rgba(81, 203, 238, 1);
    }
    #code_fasong{margin-left:45px;}
    #tijiao{margin-right:-5%;width:80px;height:35px;border-radius:10px;}
    #bianji{margin-right:20px;width:80px;height:35px;border-radius:10px;}
    #username,#email,#school,#academy,#code::-ms-input-placeholder{text-align: center; font-size:16px;}
    #username,#email,#school,#academy,#code::-webkit-input-placeholder{text-align: center;font-size:16px;}
    #code,#username::-ms-input-placeholder{text-align: center; font-size:16px;}
    #code,#username::-webkit-input-placeholder{text-align: center;font-size:16px;}
</style>
<!--<script type="text/javascript">-->
<!--    $youziku.load("body", "5c53e5d5d6be4b5496148084e1523f1c", "LiDeBiao-Xing3");-->
<!--    /*$youziku.load("#id1,.class1,h1", "5c53e5d5d6be4b5496148084e1523f1c", "LiDeBiao-Xing3");*/-->
<!--    /*．．．*/-->
<!--    $youziku.draw();-->
<!--</script>-->
<body>
<center>
    <div class="information">
        <label  style="font-family:'LiDeBiao-Xing3d1146c0811a492';" for="username">用户名</label><input type="text" class="myinput" id="username" value="<?php echo $username;?>" disabled><br>
        <label  style="font-family:'LiDeBiao-Xing3d1146c0811a492';"for="email">邮箱&nbsp;&nbsp;</label><input type="text"  class="myinput" id="email" value="<?php echo $email;?>" disabled><br>
        <label style="font-family:'LiDeBiao-Xing3d1146c0811a492';"for="school">学校&nbsp;&nbsp;</label><input type="text" class="myinput"  id="school" value="<?php echo $college;?>" disabled><br>
        <label  style="font-family:'LiDeBiao-Xing3d1146c0811a492';"for="academy">学院&nbsp;&nbsp;</label><input type="text" class="myinput" id="academy" value="<?php echo $academy;?>" disabled><br>
        <label style="font-family:'LiDeBiao-Xing3d1146c0811a492';"id="code_lable" for="academy">验证码</label><input type="text" class="myinput" placeholder="请输入验证码"  autoComplete='off' id="code"><br>
<!--        <input  style="font-family:'LiDeBiao-Xing3d1146c0811a492';" type="button" id="code_fasong" value="发送邮箱验证码">-->
        <input class="button_one white" id="code_fasong" style="font-family:'LiDeBiao-Xing3d1146c0811a492';height:30px; font-size:18px;"type="button" value="发送邮箱验证码" />
        <div  style="font-family:'LiDeBiao-Xing3d1146c0811a492';"id="information_span"></div><br/>
        <input class="button_one white"  style="font-family:'LiDeBiao-Xing3d1146c0811a492';font-size:18px;"type="button" id="bianji"  value="编辑" />
        <input  class="button_one white" style="font-family:'LiDeBiao-Xing3d1146c0811a492';font-size:18px;"type="button" id="tijiao"  value="保存" disabled="disabled"/>
    </div>
</center>
<script>
    $("#code").attr("disabled", true);// 让控件不可用 属性
    $("#code_fasong").hide();
    $("#code").hide();
    $("#code_lable").hide();
    $("#bianji").click(function(){
    $("#email").removeAttr("disabled");
    $("#academy").removeAttr("disabled");
    $("#code").removeAttr("disabled");
    })
    var sign=1;
    $(function(){
        $('#email').bind('input propertychange', function() {
//             alert("");
            $("#code_fasong").show();
            $("#code").show();
            $("#code_lable").show();
            $("#tijiao").attr("disabled",true);//让控件不可用属性
            $("#information_span").html("");
            $("#information_span").html("您更改了邮箱，需要进行邮箱验证提交保存更改！");
        });
    })
    $("#tijiao").click(function() {
        var username = $("#username").val();
        var email = $("#email").val();
        var school = $("#school").val();
        var academy = $("#academy").val();
        var reg = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/;
        var codeone = $("#code").val();
        if (sign == 1) {
            if (codeone == "") {
                $("#information_span").html("");
                $("#information_span").html("验证码不能为空");
            }
            else if (!reg.test(email)) {
                alert("邮箱格式不正确，请重新输入");
                document.getElementById("email").focus();
            }
            else {
                $.post("information-two.php", {Email_code_reset: codeone}, function (data) {
                    if (data == "1") {
                        $("#information_span").html("");
                        $("#information_span").html("验证码填写正确");
                        $.post("information-three.php", {
                            userId:<?php echo $_SESSION['userid'];?>,
                            email: email,
                            school: school,
                            academy: academy
                        }, function (data) {
                            if (data == "1") {
                                layer.msg('个人信息修改成功', {
                                    time: 0 //不自动关闭
                                    , icon: 5
                                    , skin: 'layer-ext-moon'
                                    , btn: ['确定']
                                    , yes: function () {
                                        window.location.href = "information.php";
                                    }
                                });
                            }
                            else {
                                layer.msg('个人信息修改失败，尝试重新修改', {
                                    time: 0 //不自动关闭
                                    , icon: 5
                                    , skin: 'layer-ext-moon'
                                    , btn: ['确定']
                                    , yes: function () {
                                        window.location.href = "information.php";
                                    }
                                });
                            }
                        })
                    }
                    else {
                        $("#information_span").html("");
                        $("#information_span").html("验证码填写错误，请检查邮箱收到的验证码重新填写");
                    }
                })
            }
        }
        else {
            $.post("update_inf.php", {
                userId:<?php echo $_SESSION['userid'];?>,
                email: email,
                school: school,
                academy: academy
            }, function (data) {
                if (data == "1") {
                    layer.msg('个人信息修改成功', {
                        time: 0 //不自动关闭
                        , icon: 5
                        , skin: 'layer-ext-moon'
                        , btn: ['确定']
                        , yes: function () {
                            window.location.href = "information.php";
                        }
                    });
                }
                else {
                    layer.msg('个人信息修改失败，尝试重新修改', {
                        time: 0 //不自动关闭
                        , icon: 5
                        , skin: 'layer-ext-moon'
                        , btn: ['确定']
                        , yes: function () {
                            window.location.href = "information.php";
                        }
                    });
                }
            })
        }
    })
    $("#code_fasong").click(function(){
        var username=$("#username").val();
        var email = $("#email").val();
        $.post("information-one.php", {Information_Username:username,Information_Email:email}, function (data) {
            if (data == "1") {
                $("#code_fasong").value("发送成功");
                $("#information_span").html("");
                $("#information_span").html("请在上方验证码输入框输入验证码进行邮箱验证");
                var is = document.getElementById("#tijiao");
                is.disabled=false;
            }
            else {
                $("#information_span").html("");
                $("#information_span").html("未接收到验证码？请检查邮箱填写是否正确");
            }
        })
    })
</script>
</body>
</html>