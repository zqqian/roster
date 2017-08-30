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
    <style>
        /*为适应低版本的浏览器而设置*/

        header,section,footer,aside,nav,main,article,figure
        {display:block;}
        .password{border-left-color:#000;margin:30%;
        }
    </style>
</head>
<body>

<center>
    <div id="repassword">
<lable>输入原密码</lable><input type="password" id="oldpassword" ></br>
<lable>输入新密码</lable><input type="password" id="newpassword"></br>
<lable>重新输入新密码</lable><input type="password"  id="renewpassword"></br>
<span id="repasswordspan"></span>
<button type="button" id="tijiao" value="提交">提交</button>
<button type="reset" id="chongzhi" value="重置">重置</button>
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
