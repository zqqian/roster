<?php
//为方便本页面测试 暂时屏蔽
require_once 'get_user_info.php';
//echo "<script>console.log('".session_id().$_SESSION['username'].$is_login."'); </script>";
if(!$is_login){
    echo "<script> alert('Please login...');parent.location.href='./index.php'; </script>";
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
    <title>验证码界面</title>
    <script type="text/javascript" src="js/jquery-3.2.1.js"></script>
    <link rel="stylesheet" href="style/button_one.css">
    <link href='http://cdn.webfont.youziku.com/webfonts/nomal/107666/45803/59b57f37f629d81184f0b98e.css' rel='stylesheet' type='text/css' />
</head>

<style>
    #verification{width:100%;height:200px;background-color:#40AFFE;}
    #verification_span{display:block;margin-top:200px;}
    #verification_code{width:500px;height:200px;margin-top:15px;border:1px solid #000000;text-align:center;line-height:500px;}
    #captcha_img{margin-top:55px;}
    #sign_in_span{margin-top:20px;}
    #finish{margin-top:40px;}
</style>
<body>
<div id="verification">
    <div id="explain"><span>该页面的使用介绍说明</span></div>
    <center>
       <span id="verification_span" style="font-family:'LiDeBiao-Xing3d12223a7b1a492';font-size:50px;">验证码</span>
    </center>
    <center>
    <div id="verification_code">
        <img id="captcha_img" border='1' src='captcha.php?r=echo rand(); ?>' style="width:300px; height:90px" />
         <a href="javascript:void(0)" onclick="document.getElementById('captcha_img').src='captcha.php?r='+Math.random()" style="text-decoration: none;"></a>
    </div>
    <div id="sign_in_span"><span style="font-family:'LiDeBiao-Xing3d12223a7b1a492';font-size:35px;"> 已有<span id="havecodenum">0</span>人签到</span></div>
    <input class="button_one white" type="button" style="color:#40AFFE;font-size:26px;border-radius:20px;width:200px;height:60px;" id="finish" value="结束" />
    </center>
</div>
<script type="text/javascript">
    $(function(){
        setInterval("location.reload()",10000);
        $.post("auto_newfilecode.php",{userId:<?php echo $_SESSION['userid'];?>},function(data){
        console.log(data);

    });

        $("#finish").click(function(){

            $.post("phpData/auto_delefilecode.php",{userId:<?php echo $_SESSION['userid'];?>},function(data){
                console.log(data);
                window.location.href = "resign.php";//进入补签界面
            });



        });
    });
</script>

</body>
</html>