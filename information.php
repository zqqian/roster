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
</head>
<style>
</style>
<body>
<!--<form action="helpfile.html" method="post" id="reset" onsubmit="return validateForm( );">
    <span>用户名</span><input type="text" id="username" value=""><br>-->
    <label for="email">邮箱</label><input type="text" id="email" value="<?php echo $email;?>"><br>
    <label for="school">学校</label><input type="text" id="school" value="<?php echo $college;?>"><br>
    <label for="academy">学院</label><input type="text" id="academy" value="<?php echo $academy;?>">
    <input type="button" id="tijiao" value="保存">
<!--</form>-->
<script>
    $("#tijiao").click(function(){
        var email = $("#email").val();
        var school = $("#school").val();
        var academy = $("#academy").val();
        alert(email+school+academy);
        $.post("phpData/update_inf.php",{userId:<?php echo $userid;?>,email:email,school:school,academy:academy},function(data){
            if(data == "1") {alert('修改成功');window.location.reload();}
            else alert('修改失败');
        });
    });
  /*  alert("");
$(document).ready(function()
{
    $.post("reset-information.php", {userId:<?php echo $_SESSION['userid'];?>}}, function (data) {
            $("#username").val(data.username);
            $("#email").val(data.email);
            $("#school").val(data.college);
            $("#academy").val(data.academy);
            $("#tijiao").disabled=true;
        })
    })
        var form=document.getElementById('reset');
        for(var i=0;i<form.length;i++)
        {
            var element=form.elements[i];
            if(element.value!=element.defaultValue)
            {
                $("#tijiao").disabled=false;
                break;
            }
        }
        function validateForm()
        {
            var username=$("#username").val();
            var email=$("#email").val();
            if(username==""||email=="")
            {
                alert("用户名或密码不能为空")
                return false;
            }
            else {
                var reg = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/;
               var isok = reg.test(email);
                if (!isok) {
                    alert("邮箱格式不正确，请重新输入");
                    document.getElementById("email").focus();
                    return false;
                }
                $.post("information.php", {username: $("#username").val()}, function (data) {
                    if (data) {
                        alert("修改成功！")
                        return true;
                    }
                    else {
                        alert("用户名重复，请重新设置用户名!")
                        return false;
                    }
                })
            }
        }*/
</script>
</body>
</html>