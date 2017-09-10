<?php

session_start();
header("Content-Type:text/html;charset=UTF-8");

$ID=$_GET['ID'];

$userId=$_GET['userId'];

//echo "<script>
//        alert(('".$ID."'));
//    </script>";


//$userId=18;
//$classid_s=55;
//$courseName1='数据库';
//$courseName = iconv("gbk","utf-8",$courseName1);


/*$dir = dirname(__FILE__);//找到当前脚本所在路径
$fileuserid= $dir . "/validation/" . $userId."/".$userId;


if (!file_exists($fileuserid)){//判断文件夹是否存在，不存在的话就表明未扫二维码就直接进入，所以弹出警示框，并跳转至白度。
    echo "<script>
        alert('请通过正规的渠道进入验证码界面！');
        location.href='http://www.baidu.com';
    </script>";
}
else*/
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
    <title>验证码界面</title>
    <script type="text/javascript" src="js/jquery-3.2.1.js"></script>
</head>

<style>
    .body
    {
        text-align:center;
    }

</style>
<body class="body">

    <P>请输入验证码:<input type="text" id="textvalue" value=''/></p>
    <p><input type="button" id="sucess" value="提交" style='padding: 6px 17px;background-color: #3c00ff4d;color: blue;'></p>
</body>
<script>

    $(function(){
    $("#sucess").click(function(){
//        alert("ddd");
        var textvalue=$("#textvalue").val().trim();
        if(textvalue!="") {
            $.post("phpData/formcode.php", {textvalue: textvalue,userId:<?php echo $userId;?>}, function (data) {

                if (data == 1) {
//                    window.location.href = 'autoidname.php? userId='<?php //echo $userId."&ID=".$ID;?>//;
                    window.location.href = 'autoidname.php? userId=<?php echo $userId;?>,ID=<?php echo $ID;?>';
                }
                else if (data == 0) {
                    alert('验证码不正确，请重新输入！');
                }
                else {
                }
            });

        }
        else alert("请输入验证码！");

    });

    });
</script>

</html>