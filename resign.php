<?php
//为方便本页面测试 暂时屏蔽
require_once 'get_user_info.php';

if(!$is_login){
    echo "<script> alert('Please login...');parent.location.href='./index.php'; </script>";
}

$userId=$_GET['userId'];
$ID=&$_GET['ID'];
$myDate=$_GET['myDate'];


//$userId=18;
//$ID="51_";
//$myDate="2017-08-01 00:00:00";

?>
<html>
<head>

    <meta charset="utf-8">
    <title>补签</title>
    <script type="text/javascript" src="js/jquery-3.2.1.js"></script>
    <script src="js/layer/layer.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/summarycss.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link href='http://cdn.webfont.youziku.com/webfonts/nomal/107666/45803/59b7fe72f629d80cf06cb9e1.css' rel='stylesheet' type='text/css' />

    <style>

        body,th{text-align: center;}
        .ziti{
            font-family:'LiDeBiao-Xing3d1be338ee1a492';
            font-size: 25px;
        }


    </style>

</head>

<body style="text-align: center;">
<span class="ziti">补签界面</span>


<div class="container">
    <div class="row clearfix">
        <div class="col-md-12 column">
            <table class="table table-bordered table-hover table-condensed" id="showTable" style="text-align: center;">
                <thead class="ziti"><tr><th >班级</th><th>学号</th><th>姓名</th><th>状态</th></tr></thead><tbody>

            </table>
        </div>

        <button id="save" style="float: right;margin-top: 33px;"> 保存</button>
    </div>
</div>

</body>

<script>

    $(function(){


        $("#showTable  tr:not(:first)").html("");
        var arr="";
        var i=0

        $.getJSON("phpData/auto_returnresign.php",{userId:<?php echo $userId;?>,ID:'<?php echo $ID;?>',myDate:'<?php echo $myDate;?>'},function(data){
            console.log(data);
            if(data==0)
                alert("全员到齐！无缺勤人员！");
            else {
               arr =eval(data);
                var tbody=$('<tbody></tbody>');
                    $(arr).each(function (index) {                           //不用循环，一次就能搞定
                        var val = arr[index];
                        var tr = $('<tr></tr>');
                        tr.append('<td>' + val[0] + '</td>' + '<td>' + val[1] + '</td>' + '<td>' +val[2] + '</td>' + '<td align=center ><button id="btn">缺勤</button></td>');
                        tbody.append(tr);
                    });
                $('#showTable tbody').replaceWith(tbody);
            }
            alert("dd");

        });

       btn.oncick=function(){
           btn.innerHTML='ddd';
       }
    });

</script>
</html>