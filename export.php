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
    </style>
</head>
<script>

</script>
<body>
    <form  id="exportForm" name="exportForm"  method="post">
        选择班级：<select id="Class" name="Class">
            <option value="" selected></option>
            <option value="15计科一">15计科一</option>
            <?php
            echo "<option value='15计科二'>15计科二</option>";
             /*
              * 1.从session取出用户信息，根据用户信息提取
              * 2.需要用jQuery绑定change事件，然后利用AJAX刷新课程下拉列表的内容 （默认是空值，非空值才判断） 内容 入学年份+班级名
              *


            */
            ?>
        </select>
        <br>
        选择课程：<select  id="course" name="course">
            <option value="" selected></option>
            <option value="大学英语">大学英语</option>
            <?php
            echo "<option value='数据库'>数据库</option>";
            /*
             * 1.从session取出用户信息，根据 用户信息 和 班级信息 提取


           */
            ?>
        </select>
        <br>
        <input type="radio" name="gradeType" value="nomal">平时成绩
        <input type="radio" name="gradeType" value="final">期末成绩
        <input type="radio" name="gradeType" value="roster">点名情况
        <br>
        <button id="downloadBtn">下载</button>
    </form>


<script>
    $(function(){
        $("#Class").change(function(){
            var value=$(this).val();
            alert(value);
            if ("" == value){
                /*$.get("#",{},function(){


                });*/
            }
        });

        $("#downloadBtn").click(function(){
            var Class = $("#Class").val();
            var course = $("#course").val();
            var gradeType = $(":radio:checked").val();

            alert(Class+" "+course+" "+gradeType);

            if("" == Class || "" == course || undefined == gradeType){
                alert("请填写完信息再下载！")
            }else{

                //$.get("",{Class:Class,course:course,gradeType:gradeType},function(data){});
                //设计三种表格所对应的数据库视图，根据视图填充Excel表格，访问生成Excel表格的地址
            }



        });







    });//document.onload

</script>
</body>
</html>


