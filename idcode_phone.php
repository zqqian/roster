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


$dir = dirname(__FILE__);//找到当前脚本所在路径
$fileuserid= $dir . "/validation/" . $userId."/".$userId;


if (!file_exists($fileuserid)){//判断文件夹是否存在，不存在的话就表明未扫二维码就直接进入，所以弹出警示框，并跳转至白度。
    echo "<script>
        alert('请通过正规的渠道进入验证码界面！');
        location.href='http://www.baidu.com';
    </script>";
}
else
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
    <title>验证码界面</title>
    <script type="text/javascript" src="js/jquery-3.2.1.js"></script>
    <link rel="stylesheet" type="text/css" href="css/summarycss.css">
    <link rel="stylesheet" href="style/placeholder.css">
    <link href='http://cdn.webfont.youziku.com/webfonts/nomal/107666/45803/59bfa73bf629d80f5860547b.css' rel='stylesheet' type='text/css' />
</head>

<style>
    .body
    {
        text-align:center;
    }
#sucess{
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
    #textvalue{margin-top:50px;width:500px;height:50px;}
</style>
<body class="body">

<!--<P  style="font-family:'LiDeBiao-Xing3d39ce88661a492';">请输入验证码:<input type="text" id="textvalue" value=''/></p>-->
<input required='' type='text' id="textvalue" value=''/>
<label alt='请输入验证码' placeholder='验证码'></label>
<p><input type="button" id="sucess"  style="font-family:'LiDeBiao-Xing3d39ce88661a492';"value="提交" style='padding: 6px 17px;color: blue;'></p>
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
                        window.location.href = 'autoidname.php?userId=<?php echo $userId;?>&ID=<?php echo $ID;?>';
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