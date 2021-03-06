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
    <title>成绩查询</title>
    <link rel="stylesheet" type="text/css" href="css/summarycss.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link href='http://cdn.webfont.youziku.com/webfonts/nomal/107666/45803/59b7ff17f629d80cf06cb9e2.css' rel='stylesheet' type='text/css' />
    <script src="js/jquery-3.2.1.js"></script>
    <script src="js/layer/layer.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <style>
        body,th{text-align: center;}
        /* #entryForm{
             display: block;
             width:450px;
             height: 180px;
             text-align: center;
             line-height: 50px;
             border: pink solid 3px;
             margin: 0 auto;
         }*/

        #showBtn{
            margin: 20px auto !important;
        }
        select{
            border-radius:10px;
            position: relative;
            min-width: 200px;
            width: auto;
            height:40px;
            margin: 10px auto;
            padding: 0px;
            background: #fff;
            border-left: 5px solid grey;
            cursor: pointer;
            outline: none;
        }

        input[type='text']{
            width:240px;
        }
        .font{
            font-size: 25px;
            font-family:'LiDeBiao-Xing3d1be5bb441a492';
        }
        .col-md-12{margin-top:50px;}
    </style>
</head>

<body>
<form  id="entryForm" name="entryForm" >
    <label for="showClass" class="font">选择班级</label><select id="showClass" name="showClass" style="width: 200px;">
        <option value="" selected></option>
        <?php
        $userid = $_SESSION['userid'];
        $find_class = "SELECT DISTINCT a.classId,className,enterYear FROM class as a,class_course_user as b where a.classId=b.classId and b.userId=".$userid;
        require "mysql-connect.php";
        $set=mysqli_query($db,$find_class);
        while($row=mysqli_fetch_assoc($set)){
            echo "<option value='".$row['classId']."'>".$row['enterYear'].$row['className']."</option>";
        }
        mysqli_close($db);?>

    </select>
    <br>
    <label for="showCourse" class="font">选择课程</label><select  id="showCourse" name="showCourse" style="width: 200px;">
        <option value="" selected></option>
    </select> <br>

    <label for="check" class="font">查询项目</label><select  id="check" name="check" style="width: 200px;">
        <option value="" selected></option>

    </select> <br>

    <input type="button" id="showBtn" value="查询">
</form>

<div class="container">
    <div class="row clearfix">
        <div class="col-md-12 column">
            <table class="table table-bordered table-hover table-condensed" id="showTable">
            </table>
        </div>
    </div>
</div>
<script>
    $(function(){
        //班级变动后，课程随之改变
        $("#showClass").change(function(){
            var value=$(this).val();

            $("#check").val("");
            $("#showTable").empty();

            if ("" != value){
                $("#showCourse").empty();
                $("#showCourse").append("<option value='' selected></option>");
                var classId=$("#showCourse").val();
                $.post("phpData/return_courses.php",{classId:value,userId:<?php echo $_SESSION['userid'];?>},function(data){
                    /*console.log(data);*/
                    $("#showCourse").append(data);
                });
            }
            else{
                $("#showCourse").empty();
                $("#showCourse").append("<option value='' selected></option>");
            }
        });


        //课程变动后，查询内容随之改变
        $("#showCourse").change(function(){
            var courseId=$(this).val();

            if ("" != courseId){
                $("#check").empty();
                $("#check").append("<option value='' selected></option>");
                $("#check").append("<option value='Fgrade' >期末成绩</option>");
                var classId=$("#showClass").val();
                $.post("phpData/return_check.php",{classId:classId,courseId:courseId,userId:<?php echo $_SESSION['userid'];?>,},function(data){
                    /*console.log(data);*/
                    $("#check").append(data);
                });
            }
            else{
                $("#check").empty();
                $("#check").append("<option value='' selected></option>");
            }
        });

        //点击查询按钮
        $("#showBtn").click(function(){

            var check = $("#check").val();
            var classId = $("#showClass").val();
            var courseId = $("#showCourse").val();
            if("" == showClass || "" == showCourse || "" == check){
                //alert("请先填写完信息再查询！")
                layer.alert('请先填写完信息再查询！', {
                    icon: 5,
                    skin: 'layer-ext-moon' //该皮肤由layer.seaning.com友情扩展。关于皮肤的扩展规则，去这里查阅
                });
            }
            else{//数据都填充完毕时
                console.log(classId+" "+courseId+" "+check);
                $.post("phpData/return_strgrade.php",{classId:classId,courseId:courseId,check:check,userId:<?php echo $_SESSION['userid'];?>},function(data){
                    //处理并显示返回来的学生成绩
                    console.log(data);
                    if(data=="0")
                    {
                        layer.alert('该班未录入期末成绩，请先录入期末成绩再查询！', {
                            icon: 5,
                            skin: 'layer-ext-moon' //该皮肤由layer.seaning.com友情扩展。关于皮肤的扩展规则，去这里查阅
                        });
                    }
                    else  if(data=="1")
                    {
                        layer.alert('未录入该考核项目的成绩，请先录成绩再查询！', {
                            icon: 5,
                            skin: 'layer-ext-moon' //该皮肤由layer.seaning.com友情扩展。关于皮肤的扩展规则，去这里查阅
                        });
                    }
                    else {
                        $("#showTable").empty();
                        $("#showTable").append(data);
                    }

                });

            }
        });
    });//document.onload
</script>
</body>
</html>


