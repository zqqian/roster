<?php require_once 'get_user_info.php';?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>成绩查询</title>
    <script src="js/jquery-3.2.1.js"></script>
    <style>
        #entryForm{
            display: block;
            width:450px;
            height: 150px;
            text-align: center;
            line-height: 50px;
            border: pink solid 3px;
            margin: 0 auto;
        }
    </style>
</head>
<script>

</script>
<body>
<form  id="entryForm" name="entryForm" >
    选择班级：<select id="showClass" name="showClass" style="width: 200px;">
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
    选择课程：<select  id="showCourse" name="showCourse" style="width: 200px;">
        <option value="" selected></option>
        <?php

        //echo "<option value='数据库'>数据库</option>";
        /*
         * 1.从session取出用户信息，根据 用户信息 和 班级信息 提取
        */
        ?>

    </select> <br>
    <input type="button" id="showBtn" value="查询">
</form>
<hr>

<script>
    $(function(){
        $("#showClass").change(function(){
            var value=$(this).val();

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

        $("#showBtn").click(function(){
            var showClass = $("#showClass").val();
            var showCourse = $("#showCourse").val();


            if("" == showClass || "" == showCourse){
                alert("请先填写完信息再查询！")
            }else{
                console.log(showClass+" "+showCourse);
                $.post("phpData/return_strgrade.php",{showClass:showClass,showCourse:showCourse,userId:<?php echo $_SESSION['userid'];?>},function(data){
                    //处理并显示返回来的学生成绩
                        alert(data);

                });

            }
        });







    });//document.onload

</script>
</body>
</html>


