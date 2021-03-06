<?php
require_once 'get_user_info.php';
//用于检测是否登录，测试本页面时可暂时屏蔽以下几行php代码
if(!$is_login){
    echo "<script> alert('Please login...');parent.location.href='./index.php'; </script>";
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>导出学生成绩</title>
    <link rel="stylesheet" type="text/css" href="css/summarycss.css">
    <link rel="stylesheet" href="style/placeholder.css">
    <script src="js/jquery-3.2.1.js"></script>
    <script src="js/layer/layer.js"></script>
    <link href='http://cdn.webfont.youziku.com/webfonts/nomal/107666/45803/59b66f6ff629db133c19ab7b.css' rel='stylesheet' type='text/css' />
    <link href='http://cdn.webfont.youziku.com/webfonts/nomal/107666/45803/59b7f3e3f629d80cf06cb9de.css' rel='stylesheet' type='text/css' />
    <style>
        #exportForm{
            display: block;
            width:450px;
            height: 450px;
            text-align: center;
            line-height: 50px;
            margin: 0 auto;
        }
        .hide{
            display: none;
        }
        select{
            border-radius:10px;
            position: relative;
            min-width: 200px;
            width:auto;
            height:40px;
            margin: 0 auto;
            padding: 0px;
            background: #fff;
            border-left: 5px solid grey;
            cursor: pointer;
            outline: none;
        }
        #exportForm{margin-top:50px;}
        #downloadBtn{margin-top:40px;height:35px;font-size:20px;}
        select{margin-top:20px;}

        label{margin-right: 10px;}
        label span{font-size: 25px;}

        input[type="date"] {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            width: 100%;
            height: -webkit-calc(3em + 2px);
            height: calc(3em + 2px);
            margin: 0 0 1em;
            padding: 1em;
            border: 1px solid #cccccc;
            border-radius: 1.5em;
            background: #fff;
            resize: none;
            outline: none;
            display: inline;
            width: 200px;
            margin: 15px;
        }
        input[type="date"][required]:focus {
            border-color: #00bafa;
        }
        input[type="date"][required]:focus + label[placeholder]:before {
            color: #00bafa;
        }
        input[type="date"][required]:focus + label[placeholder]:before,
        input[type="date"][required]:valid + label[placeholder]:before {
            -webkit-transition-duration: .2s;
            transition-duration: .2s;
            -webkit-transform: translate(0, -1.5em) scale(0.9, 0.9);
            -ms-transform: translate(0, -1.5em) scale(0.9, 0.9);
            transform: translate(0, -1.5em) scale(0.9, 0.9);
        }
        input[type="date"][required]:invalid + label[placeholder][alt]:before {
            content: attr(alt);
        }
        input[type="date"][required] + label[placeholder] {
            display: inline;
            pointer-events: none;
            line-height: 2.3em;
            margin-bottom: -webkit-calc((3em - 1em) + 2px);
            margin-bottom: calc((3em - 1em) + 2px);
        }
        input[type="date"][required] + label[placeholder]:before {
            content: attr(placeholder);
            display: inline;
            margin: 0 -webkit-calc(1em + 2px);
            margin: 0 calc(1em + 2px);
            padding: 0 2px;
            color: #898989;
            white-space: nowrap;
            -webkit-transition: 0.3s ease-in-out;
            transition: 0.3s ease-in-out;
            background-image: -webkit-gradient(linear, left top, left bottom, from(#ffffff), to(#ffffff));
            background-image: -webkit-linear-gradient(top, #ffffff, #ffffff);
            background-image: linear-gradient(to bottom, #ffffff, #ffffff);
            -webkit-background-size: 100% 5px;
            background-size: 100% 5px;
            background-repeat: no-repeat;
            background-position: center;
        }
    </style>
</head>
<script>

</script>
<body>
    <form  id="exportForm" name="exportForm" >

        <label  style="font-family:'LiDeBiao-Xing3d15cc927c1a492';font-size:25px;" for="Class">选择班级</label><select id="Class" name="Class" style="width: 200px;">
            <option value="" selected></option>
            <?php
            $userid = $_SESSION['userid'];
            $find_class = "SELECT DISTINCT a.classId,className,enterYear FROM class as a,class_course_user as b where a.classId=b.classId and b.userId=".$userid;
            require "mysql-connect.php";
            $set=mysqli_query($db,$find_class);
            while($row=mysqli_fetch_assoc($set)){
                echo "<option value='".$row['classId']."'>".$row['enterYear'].$row['className']."</option>";
            }
            mysqli_close($db);
            ?>
        </select>
        <br>
        <label  style="font-family:'LiDeBiao-Xing3d15cc927c1a492';font-size:25px" for="course">选择课程</label>
        <select  id="course" name="course" style="width: 200px;">
            <option value="" selected></option>
        </select>

        <br>
        <label  style="font-family:'LiDeBiao-Xing3d15cc927c1a492';font-size:25px;" for="gradeType">导出类型</label>
        <select  id="gradeType" name="gradeType" style="width: 200px;">
            <option value="" selected></option>
            <option value="normal" >平时成绩</option>
            <option value="final" >期末成绩</option>
            <option value="roster" >点名情况</option>
        </select>
        <br>
        <div class="hide">
        <label for="start" ><span class="cssd1bb9f6eb1a492">开始日期</span></label><input  id="start" type="date" value="2017-09-01"/><br>
        <label for="end"><span class="cssd1bb9f6eb1a492">结束日期</span></label><input  id="end"  type="date" value="2017-09-01"/>
        </div>

        <input  style="margin-left:180px;"  type="button" id="downloadBtn" value="下载" style="margin: 20px auto;">
    </form>

<script>
    $(function(){
        $("#Class").change(function(){//选择班级
            var value=$(this).val();

            $("#course").empty();
            $("#course").append("<option value='' selected></option>");
            $("#gradeType").val("");
            $("#start").val("");
            $("#end").val("");
            $(".hide").css("display","none");

            if ("" != value){
                $.post("phpData/return_courses.php",{classId:value,userId:<?php echo $_SESSION['userid'];?>},function(data){
                    $("#course").append(data);
                });
            }

        });
        $("#course").change(function(){//选择课程
            $("#gradeType").val("");
            $("#start").val("");
            $("#end").val("");
            $(".hide").css("display","none");
        });

        $("#gradeType").change(function(){//选择导出类型
            var value=$(this).val();
            if("" == $("#Class").val() || "" == $("#course").val()){
                //alert("请先填写班级和课程信息");
                layer.alert('请先填写班级和课程信息!', {
                    icon: 5,
                    skin: 'layer-ext-moon' //该皮肤由layer.seaning.com友情扩展。关于皮肤的扩展规则，去这里查阅
                });
                $(this).val("");
            }
            else{
                if ("roster" == value){
                    //如果是点名情况
                    $.getJSON("phpData/getDate.php",{class:$("#Class").val(),course:$("#course").val(),userId:<?php echo $_SESSION['userid'];?>},function(data){
                       var arr;
                        arr=eval(data);
                        if(arr[0] == false && arr[1] == false){
                            layer.alert('无点名信息！', {
                                icon: 5,
                                skin: 'layer-ext-moon', //该皮肤由layer.seaning.com友情扩展。关于皮肤的扩展规则，去这里查阅
                                yes: function(index){
                                    layer.close(index);
                                    $("#gradeType").val("");
                                    $("#start").val("");
                                    $("#end").val("");
                                    $(".hide").css("display","none");
                                }

                            });
                        }else {
                            $("#start").val(arr[0]);
                            $("#end").val(arr[1]);
                            $(".hide").css("display","block");
                        }
                    });
                }else
                    $(".hide").css("display","none");

            }
        });

        $("#downloadBtn").click(function(){
            var gradeType = $("#gradeType").val();
            var Class = $("#Class").val().trim();
            var course = $("#course").val().trim();


            if("roster" == gradeType){//如果点击了点名情况
                //$(".hide").css("display","inline");
                var start =  $("#start").val();
                var end =  $("#end").val();
                if("" == Class || "" == course || "" == gradeType){
                    //alert("请填写完信息再下载！")
                    layer.alert('请填写完信息再下载！', {
                        icon: 5,
                        skin: 'layer-ext-moon' //该皮肤由layer.seaning.com友情扩展。关于皮肤的扩展规则，去这里查阅
                    });
                }else//信息都为非空时
                {
                    console.log(Class+" "+course+" "+gradeType);
                    $.post("export_download.php",{Class:Class,course:course,gradeType:"roster",
                        userId:<?php echo $_SESSION['userid'];?>,start:start,end:end},function(data){
                        window.location.href = "tempExcel/"+Class+course+gradeType+".xls";
                    });
                }

            }

            else{
                if("" == Class || "" == course || "" == gradeType){
                    //alert("请填写完信息再下载！")
                    layer.alert('请填写完信息再下载！', {
                        icon: 5,
                        skin: 'layer-ext-moon' //该皮肤由layer.seaning.com友情扩展。关于皮肤的扩展规则，去这里查阅
                    });
                }else
                {
                    console.log(Class+" "+course+" "+gradeType);
                    $.post("export_download.php",{Class:Class,course:course,gradeType:gradeType,userId:<?php echo $_SESSION['userid'];?>},function(data){
                        //设计三种表格所对应的数据库视图，根据视图填充Excel表格，访问生成Excel表格的地址
                        if(data=="0")
                        {
                            layer.alert('没有平时成绩！', {//没有自定义字段！
                                icon: 5,
                                skin: 'layer-ext-moon' //该皮肤由layer.seaning.com友情扩展。关于皮肤的扩展规则，去这里查阅
                            });
                        }
                        else  if(data=="1")
                        {
                            layer.alert('没有平时成绩！', {//没有录入自定义字段成绩！
                                icon: 5,
                                skin: 'layer-ext-moon' //该皮肤由layer.seaning.com友情扩展。关于皮肤的扩展规则，去这里查阅
                            });
                        }
                        else  if(data=="2")
                        {
                            layer.alert('录入的数据不足，无法导出Excel！', {
                                icon: 5,
                                skin: 'layer-ext-moon' //该皮肤由layer.seaning.com友情扩展。关于皮肤的扩展规则，去这里查阅
                            });
                        }else  if(data=="error")
                        {
                            layer.alert('出错啦！请重试！', {
                                icon: 5,
                                skin: 'layer-ext-moon' //该皮肤由layer.seaning.com友情扩展。关于皮肤的扩展规则，去这里查阅
                            });
                        }else
                        window.location.href = "tempExcel/"+Class+course+gradeType+".xls";
                    });
                }
            }

        });//downloadBt
    });//document.onload
</script>
</body>
</html>


