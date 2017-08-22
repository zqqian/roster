<?php
/*require_once "get_user_info.php";
require_once 'mysql-connect.php';

$sql = "SELECT DISTINCT `student`.`stuId` \n"
. "FROM sturoster, student\n"
. "WHERE (\n"
. "(\n"
. "`student`.`Id` =8\n"
. ")and `student`.`stuId` NOT IN(\n"
. "SELECT DISTINCT `sturoster`.`stuId`\n"
. "FROM sturoster, student\n"
. "WHERE ((`student`.`Id` =8) AND (`sturoster`.`rosterDate` =CURDATE( )))))\n"
. "ORDER BY `sturoster`.`stuId` ASC\n";
$result=mysqli_query($db,$sql);
$i=0;
while($row[$i++] = mysqli_fetch_assoc($result));
$randnum=rand(0,$i-1);

$randstuid=$row[$randnum]['stuId'];
var_dump($randstuid);*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <script src="js/jquery-3.2.1.js"></script>
    <style>
        td{width: 150px;border: red solid 1px;}
    </style>
</head>
<body>
<button id="btn0">使用$.ajax()/$.post()得到321用户2017-08-01年数据库的点名信息</button><br>
<button id="btn1">使用$.post()得到321用户2015 计算机科学与技术1数据库的点名信息</button><br>
<button id="btn2">使用$.post()/$.getJSON()得到用户321数据库课程所授班级和点过名的日期</button>
<div id="d" style="width: 700px;height: 500px;border:red solid 1px;"></div>
<script>
    $("#btn0").click(function(){
        $("#d").empty();
        $.ajax({
            type:"POST",//声明发送post请求
            url:"phpData/return_rosterDate.php",
            data:{search:"选择日期",selected_course:"数据库",selected_date:"2017-08-01",userId:18},
            dataType:"json",
            success:function(temp) {   //返回一个json数组，数组中分别包含班级和日期两个数组

                $("#d").append("<table>");
                for(var i=0;i<temp.length;i++)

                    $("#d").append("<tr><td>"+temp[i].class_name+'</td><td>'+temp[i].call_time+'</td><td>'+temp[i].attendance_rate_ave+
                        '</td><td>'+temp[i].realStu+'</td><td>'+temp[i].shouldStu+'</td><td>'+temp[i].classSize+"</tr>");
                $("#d").append("<table>");
            }
        });
        //使用post函数
        /*$.post("phpData/return_rosterDate.php",{search:"选择日期",selected_course:"数据库",selected_date:"2017-08-01",userId:18},function (json){
            console.log(json);
            var temp=JSON.parse(json);
            $("#d").append("<table>");
            for(var i=0;i<temp.length;i++)

                $("#d").append("<tr><td>"+temp[i].class_name+'</td><td>'+temp[i].call_time+'</td><td>'+temp[i].attendance_rate_ave+
                    '</td><td>'+temp[i].realStu+'</td><td>'+temp[i].shouldStu+'</td><td>'+temp[i].classSize+"</tr>");
            $("#d").append("<table>");
        });*/
    });
    $("#btn1").click(function(){
        $("#d").empty();

        $.post("phpData/return_rosterDate.php",{search:"选择班级",selected_course:"数据库",select_class:"2015 计算机科学与技术1",userId:18},function (json){
            console.log(json);
            var temp=JSON.parse(json);
            $("#d").append("<table>");
            for(var i=0;i<temp.length;i++)

            $("#d").append("<tr><td>"+temp[i].student_number+'</td><td>'+temp[i].student_name+'</td><td>'+temp[i].call_number+
                            '</td><td>'+temp[i].come_number+'</td><td>'+temp[i].attendance_rate_sum+"</tr>");
            $("#d").append("<table>");
        });


    });
    $("#btn2").click(function(){
        $("#d").empty();

        //$.getJSON发送的是get请求，所以php接收变量的形式应为$_GET才可正常使用
        /*$.getJSON("phpData/return_class_date.php",{selected_course:"数据库",userId:18},function (temp){

            var arr1=temp.search_class;
            var arr2=temp.search_date;

            for( i=0;i<arr1.length;i++)

                $("#d").append("<p>"+arr1[i]+"</p>");
            for( i=0;i<arr2.length;i++)

                $("#d").append("<p>"+arr2[i]+"</p>");
        });*/
        $.post("phpData/return_class_date.php",{selected_course:"数据库",userId:18},function (json){
            console.log(json);
            var temp=JSON.parse(json);
            var arr1=temp.search_class;
            var arr2=temp.search_date;

            for( i=0;i<arr1.length;i++)

                $("#d").append("<p>"+arr1[i]+"</p>");
            for( i=0;i<arr2.length;i++)

                $("#d").append("<p>"+arr2[i]+"</p>");

        });

    });
</script>
</body>
</html>