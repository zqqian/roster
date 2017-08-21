<?php require_once 'get_user_info.php';?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>导出学生成绩</title>
    <script src="js/jquery-3.2.1.js"></script>
    <style>
        #exportForm{
            display: block;
            width:450px;
            height: 150px;
            text-align: center;
            line-height: 50px;
            border: pink solid 3px;
            margin: 0 auto;
        }
        .hide{
            display:none;
        }
    </style>
</head>
<script>

</script>
<body>
    <form  id="exportForm" name="exportForm" >
        <label for="gradeType">选择导出信息：</label>
        <select  id="gradeType" name="gradeType" style="width: 200px;">
            <option value="" selected></option>
            <option value="nomal" >平时成绩</option>
            <option value="final" >期末成绩</option>
            <option value="roster" >点名情况</option>
        </select>
        <br>
        <label for="Class">选择班级：</label><select id="Class" name="Class" style="width: 200px;">
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
            /*
             * 1.从session取出用户信息，根据用户信息提取
             * 2.需要用jQuery绑定change事件，然后利用AJAX刷新课程下拉列表的内容 （默认是空值，非空值才判断） 内容 入学年份+班级名
             *
           */
            ?>
        </select>
        <br>
        <label for="course">选择课程：</label><select  id="course" name="course" style="width: 200px;">
            <option value="" selected></option>
            <?php

            //echo "<option value='数据库'>数据库</option>";
            /*
             * 1.从session取出用户信息，根据 用户信息 和 班级信息 提取
            */
            ?>
        </select>
      <!--  <br>
        <input type="radio" name="gradeType" value="nomal" id="nomal"><label for="nomal">平时成绩</label>
        <input type="radio" name="gradeType" value="final" id="final"><label for="final">期末成绩</label>
        <input type="radio" name="gradeType" value="roster" id="roster"><label for="roster">点名情况</label>-->
        <br>

        <hr><!--测试板块-->
        <label for="start" class="hide">开始日期：</label><input id="start"  class="hide" type="date" value="2014-01-13"/>
        <label for="end" class="hide">结束日期：</label><input id="end"  class="hide" type="date" value="2014-01-13"/>
        <hr>
        <input type="button" id="downloadBtn" value="下载">
    </form>


<script>
    $(function(){


        $("#Class").change(function(){
            var value=$(this).val();

            if ("" != value){
                $("#course").empty();
                $("#course").append("<option value='' selected></option>");
                var classId=$("#course").val();
                $.post("phpData/return_courses.php",{classId:value,userId:<?php echo $_SESSION['userid'];?>},function(data){
                    $("#course").append(data);
                });
            }
            else{
                $("#course").empty();
                $("#course").append("<option value='' selected></option>");
            }
        });
//问题代码，待修改
/*        $("#downloadBtn").click(function(){
            var gradeType = $("#gradeType").val();
            var Class = $("#Class").val();
            var course = $("#course").val();

            if("roster" == gradeType){//如果点击了点名情况
                $(".hide").css("display","inline");
                var start =  $("#start").val();
                var end =  $("#end").val();
                if("" == Class || "" == course || "" == gradeType){
                    alert("请填写完信息再下载！")
                }else
                {
                    console.log(Class+" "+course+" "+gradeType);
                    $.post("export_download.php",{Class:Class,course:course,gradeType:gradeType,userId:<?php echo $_SESSION['userid'];?>},function(data){
                        //设计三种表格所对应的数据库视图，根据视图填充Excel表格，访问生成Excel表格的地址
                        window.location.href = "tempExcel/"+Class+course+gradeType+".xls";
                    });
                }

            }else{
                if("" == Class || "" == course || "" == gradeType){
                    alert("请填写完信息再下载！")
                }else
                {
                    console.log(Class+" "+course+" "+gradeType);
                    $.post("export_download.php",{Class:Class,course:course,gradeType:gradeType,userId:<?php echo $_SESSION['userid'];?>},function(data){
                        //设计三种表格所对应的数据库视图，根据视图填充Excel表格，访问生成Excel表格的地址
                        window.location.href = "tempExcel/"+Class+course+gradeType+".xls";
                    });
                }
            }



        });//downloadBtn*/


    });//document.onload

</script>
</body>
</html>


