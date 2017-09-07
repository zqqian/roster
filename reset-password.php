<?php
require_once 'get_user_info.php';
//用于检测是否登录，测试本页面时可暂时屏蔽以下几行php代码
if(!$is_login){
    echo "<script> alert('Please login...');parent.location.href='./index.php'; </script>";}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>重置密码</title>
    <script src="js/jquery-3.2.1.js"></script>
    <link rel="stylesheet" href="style/button_one.css">
    <style>
        /*为适应低版本的浏览器而设置*/

        header,section,footer,aside,nav,main,article,figure
        {display:block;}
        .password{border-left-color:#000;margin:30%;
        }
       #newpassword,#renewpassword,#oldpassword::-ms-input-placeholder{text-align: center; font-size:16px;}
       #newpassword,#renewpassword,#oldpassword::-webkit-input-placeholder{text-align: center;font-size:16px;}
    </style>
    <script type="text/javascript" src="http://cdn.webfont.youziku.com/wwwroot/js/wf/youziku.api.min.js?"></script>
</head>
<style>
    #repassword{
        margin-top:20%;
    }
    #newpassword,#oldpassword,#renewpassword{
        display:block;
        transition:all 0.30s ease-in-out;
        -webkit-transition: all 0.30s ease-in-out;
        -moz-transition: all 0.30s ease-in-out;
        border:#35a5e5 1px solid;
        border-radius:15px;
        outline:none;
        width:400px;
        height:50px;
        margin-top:5px;
    }
    #newpassword:focus{
        box-shadow:0 0 5px rgba(81, 203, 238, 1);
        -webkit-box-shadow:0 0 5px rgba(81, 203, 238, 1);
        -moz-box-shadow:0 0 5px rgba(81, 203, 238, 1);
        width:400px;
        height:55px;
    }
    #oldpassword:focus{
        box-shadow:0 0 5px rgba(81, 203, 238, 1);
        -webkit-box-shadow:0 0 5px rgba(81, 203, 238, 1);
        -moz-box-shadow:0 0 5px rgba(81, 203, 238, 1);
        width:400px;
        height:55px;
    }
    #renewpassword:focus{
        box-shadow:0 0 5px rgba(81, 203, 238, 1);
        -webkit-box-shadow:0 0 5px rgba(81, 203, 238, 1);
        -moz-box-shadow:0 0 5px rgba(81, 203, 238, 1);
        width:400px;
        height:55px;
    }
    #tijiao,#chongzhi{
        margin-top:90px;
        margin-left:20px;
    }
    #tijiao{margin-left:-20px;}
</style>
<body>
<center>
    <div id="repassword">
<input type="password" id="oldpassword" placeholder="请输入旧密码"></br>
<input type="password" id="newpassword"  placeholder="请输入新密码"></br>
<input type="password"  id="renewpassword"  placeholder="请重新输入新密码"></br>
<span id="repasswordspan"></span>
<!--<button type="button" id="tijiao" value="提交">提交</button>-->
 <input class="button_one white"  id="tijiao" type="button" value="提交" />
<!--<button type="reset" id="chongzhi" value="重置">重置</button>-->
<input class="button_one white" id="chongzhi" type="button"  value="重置"/>
    </div>
</center>
<script>
    $(function(){
        $("#chongzhi").click(function(){
            $('#oldpassword').val("");
            $('#newpassword').val("");
            $('#renewpassword').val("");
        });
        $("#tijiao").click(function() {
            $("#repasswordspan").html();
            var newpassword=$("#newpassword").val();
            var oldpassword=$("#oldpassword").val();
            var newpassword2=$("#renewpassword").val();
//            alert(oldpassword);
//            alert(newpassword);
//            alert(newpassword2);
            if (newpassword == "") {
                $("#repasswordspan").html();
                $("#repasswordspan").html("*新密码不能为空");
                $("#newpassword").focus();
            }
            else if (newpassword.length < 6) {
                $("#repasswordspan").html();
                $("#repasswordspan").html("*新密码不能低于6位");
                $("newpassword").focus();
            }
            else if (newpassword != newpassword2) {
                $("#repasswordspan").html();
                $("#repasswordspan").html("*两次输入的新密码不一致");
                $("#newpassword").focus();
            }
            else {
                $.post("repassword.php", {oldpassword: oldpassword,newpassword: newpassword,newpassword2:newpassword2}, function (data) {
                    if (data == "1") {
                        $("#repasswordspan").html("");
                        alert("重置成功");
                    }
                    else {
                        if (data == "2") {
                            $("#repasswordspan").html();
                            $("#repasswordspan").html("*原密码输入错误");
                        }
                        else {
                        }
                    }
                })
            }
        })
    })
</script>
</body>
</html>
