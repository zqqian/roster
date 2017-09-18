
<?php
//为方便本页面测试 暂时屏蔽
require_once 'get_user_info.php';
//echo "<script>console.log('".session_id().$_SESSION['username'].$is_login."'); </script>";
if(!$is_login){
    echo "<script> alert('Please login...');parent.location.href='./index.php'; </script>";
}/*
$userId=$_GET['userId'];
$ID=&$_GET['ID'];
$myDate=$_GET['myDate'];*/


$userId=$_GET['userId'];
$ID=$_GET['ID'];
$myDate=$_GET['myDate'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
    <title>验证码界面</title>
    <link rel="stylesheet" href="style/button_one.css">
    <script type="text/javascript" src="js/jquery-3.2.1.js"></script>
    <link href='http://cdn.webfont.youziku.com/webfonts/nomal/107666/45803/59bf5ca9f629d80f586053f3.css' rel='stylesheet' type='text/css' />
</head>

<style>
    .body1
    {
        text-align:center;
    }
    .form1
    {
        float:left;
        margin-left:42%;
    }
    #captcha_img{margin-top:30px;}
    #idcodeh2{margin-top:40px;}
    #finish{margin-top:30px;}
</style>
<body class="body1">
<div class="form1">
         <p><h1 style="font-size:40px;font-family:'LiDeBiao-Xing3d38ab3e831a492';">验证码</h1> <img id="captcha_img" border='1' src='captcha.php?r=echo rand(); ?>' style="width:300px; height:90px" />
             </br>
         <a href="javascript:void(0)" onclick="document.getElementById('captcha_img').src='captcha.php?r='+Math.random()" style="text-decoration: none;"><h3 style="font-family:'LiDeBiao-Xing3d38ab3e831a492';">换一个?</h3></a>
         </p>
         <h2 id="idcodeh2"; style="font-family:'LiDeBiao-Xing3d38ab3e831a492';"> 已有<span id="havecodenum" style="font-family:'LiDeBiao-Xing3d38ab3e831a492';">0</span>人签到</h2>
        <input type="button" value="结束"class="button_one white" id="finish" style='font-family:LiDeBiao-Xing3d38ab3e831a492;border-radius:20px;width:120px;height:40px;font-size:25px;padding: 6px 17px;color:#000000;font-family:'LiDeBiao-Xing3d38ab3e831a492'>
</div>

<script type="text/javascript">


    var int=setInterval("clock()",10000);
    function clock()
    {
        captcha_img.src="captcha.php?id="+Math.random();
        $.post("auto_newfilecode.php",{userId:<?php echo $_SESSION['userid'];?>},function(data) {
            console.log(data);
        });
        $.post("phpData/auto_idnameyesnum.php",{userId:<?php echo $userId;?>,ID:'<?php echo $ID;?>',myDate:'<?php echo $myDate;?>'},function(data){
            console.log(data);
            $("#havecodenum").html(data);
        });
    }
    $(function(){

        $.post("auto_newfilecode.php",{userId:<?php echo $_SESSION['userid'];?>},function(data){
        console.log(data);

    });

        $("#finish").click(function(){

            $.post("phpData/auto_delefilecode.php",{userId:<?php echo $_SESSION['userid'];?>},function(data){
                console.log(data);

                var jshondata = {
                    userId:<?php echo $_SESSION['userid'];?>,
                    ID:'<?php echo $ID;?>',
                    myDate:'<?php echo $myDate;?>'
                };
                window.location.href = 'resign.php?' +$.param(jshondata);
//                window.location.href = "resign.php";//进入补签界面
            });
        });
    });
</script>

</body>
</html>