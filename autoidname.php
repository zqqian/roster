<?php

session_start();
header("Content-Type:text/html;charset=UTF-8");


$ID=$_GET['ID'];
$userId=$_GET['userId'];


/*$dir = dirname(__FILE__);//找到当前脚本所在路径
$fileuserid= $dir . "/validation/" . $userId."/".$userId;


if (!file_exists($fileuserid)){//判断文件夹是否存在，不存在的话就表明未扫二维码就直接进入，所以弹出警示框，并跳转至白度。
echo "<script>
    alert('请通过正规的渠道进入签到界面！');
    location.href='http://www.baidu.com';
</script>";
}
else*/
?>
<html>
<head>
    <meta charset="utf-8">
    <title>签到</title>
    <script type="text/javascript" src="js/jquery-3.2.1.js"></script>
</head>

<style>
    .body
    {
        text-align:center;
    }
</style>

<body class="body">
    <div>
        //<form method="post" action="idnameidentify.php">
             <h2>请输入学号与姓名</h2>
             <P>学号:   <input type="text" id='stuid' value=''/></p>
             <P>姓名:   <input type="text" id='stuname' value=''/></p>
            <p><input type="button" id="yes",value='提交' style='padding: 6px 17px;background-color: #3c00ff4d;color: blue;'/></p>

    </div>
</body>

<script>

    $(function(){

        $("#yes").click(function(){
            var stuCode=$("#stuid").val().trim();
            var stuName=$("#stuname").val().trim();

            $.post("phpData/auto_insertidname.php",{ID:<?php echo $ID;?>,uerId:<?php echo $_SESSION['userid'];?>,stuCode:stuCode,stuName:stuName},function(data){
                console.log(data);




            });


        });

    });

</script>

</html>