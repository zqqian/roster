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
    <link href='http://cdn.webfont.youziku.com/webfonts/nomal/107666/45803/59ba1fd8f629d815106db594.css' rel='stylesheet' type='text/css' />
    <style>

        body,th{text-align: center;}
        .ziti{
            font-family:'LiDeBiao-Xing3d2435ae261a492';
            font-size: 25px;
        }


    </style>

</head>

<body style="text-align: center;">
<span class="ziti">补签界面</span>
</br>
</br>


<div class="container">
    <div class="row clearfix">
        <div class="col-md-12 column">
            <table class="table table-bordered table-hover table-condensed" id="showTable" style="text-align: center;">
                <thead class="ziti"><tr><th >班级</th><th>学号</th><th>姓名</th><th>状态</th></tr></thead><tbody>

            </table>
        </div>

<!--        <intput type="button" id="save" style="float: right;margin-top: 33px;" value="保存"> 保存-->
<!--            <input type="button" value="保存" id="save" style="float: right;margin-top: 33px;">-->
    </div>
</div>

</body>

<script>

    $("#showTable  tr:not(:first)").html("");
    var arr="";
    var i=0;


    function change1(obj){
        var temp = $(obj).parent().parent().prevAll().length+1;//DOM元素转化成jQuery对象

//        alert(temp);
        var deleteTr =  $("#showTable tr:eq("+temp+")");
//        alert(deleteTr);

        layer.msg('确定该学生已到？', {
            time: 0 //不自动关闭
            ,icon: 3
            ,skin: 'layer-ext-moon'
            ,btn: ['确定','取消']
            ,yes: function(index){
                alert(arr);
                $.getJSON("phpData/auto_updateresign.php",{temp:temp,arr:arr,rosterDate:'<?php echo $myDate ?>'},function(data){
                        console.log(data);
                        arr =eval(data);

                });

                deleteTr.remove();

                layer.close(index);
            }

        });

      /*  var temp = $(obj).parent().parent().prevAll().length+1;//DOM元素转化成jQuery对象
        alert(temp);
        var deleteTr =  $("#showTable tr:eq("+temp+")");
        alert(deleteTr);

        var reg=/\d+/;//.match(reg);
        var trId = deleteTr.attr("id");


            alert("11");
            trId=trId.match(reg)[0];

            layer.msg('确定该学生已到？', {
                time: 0 //不自动关闭
                ,icon: 3
                ,skin: 'layer-ext-moon'
                ,btn: ['确定','取消']
                ,yes: function(index){


                    deleteTr.remove();

                    layer.close(index);
                }

            });*/

//        var trId = this.attr("btn");
//        alert(this);
//       var btnvalue= btn.val();
 //       alert(btnvalue);
//        alert(btnvalue=="缺勤");
//            if(btnvalue=="缺勤")
//            {
//                btnvalue=="已到";
//                this.("#btn").val(btnvalue);
////                $(obj).(btnvalue);
//
//            }
//            else if(btnvalue=="已到")
//                btnvalue=="缺勤";
//            else{}
    }

    $(function(){





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
                        tr.append('<td>' + val[0] + '</td>' + '<td>' + val[1] + '</td>' + '<td>' +val[2] + '</td>' + "<td align=center ><input type='button' value='缺勤'  onclick='change1(this)' ></td>");
                        tbody.append(tr);
                    });
                $('#showTable tbody').replaceWith(tbody);
            }

        });

    });

</script>
</html>