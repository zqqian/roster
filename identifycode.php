
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
    <script type="text/javascript" src="js/jquery-3.2.1.js"></script>
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
</style>
<body class="body1">
<div class="form1">

         <p><h1>验证码:</h1> <img id="captcha_img" border='1' src='captcha.php?r=echo rand(); ?>' style="width:300px; height:90px" />
             </br>
         <a href="javascript:void(0)" onclick="document.getElementById('captcha_img').src='captcha.php?r='+Math.random()" style="text-decoration: none;"><h3>换一个?</h3></a>
         </p>
         <h2> 已有<span id="havecodenum">0</span>人签到</h2>
        <button id="finish" style='padding: 6px 17px;background-color: #3c00ff4d;color: blue;'>结束</button>


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