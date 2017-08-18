<?php
//为方便本页面测试 暂时屏蔽
require_once 'get_user_info.php';
//echo "<script>console.log('".session_id().$_SESSION['username'].$is_login."'); </script>";
if(!$is_login){
	echo "<script> alert('Please login...');parent.location.href='./index.php'; </script>"; 
}
?>

<html xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html"
      xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <title>手动点名</title>
    <script type="text/javascript" src="js/jquery-3.2.1.js"></script>

</head>
<style>
    .body
    {
        text-align: center;
        font-size:100%;
    }
    #selectl
    {
        font-size: 1.0em;
        font-height:30px;
        font-style:normal;
    }
    #tablel
    {
        border:0;
        vertical-align:top;
        /*background-color:red;*/
        width:100%;
    }
    .trangle
    {

        height:300px;
        width:400px;
        text-align:center;
        border-radius: 10px;
        margin-left: 35%;
        margin-top: 50px;
        border: 1px solid #50ffe4;
       /* background-color: antiquewhite;*/
    }
    #numth
    {
       /* background-color: aqua;*/
        border:none;
        height:100px;
    }
    .name-num
    {
        float:left;
        margin-top:10px;
        margin-left:20%;
    }
    #submit3
    {
        height:100px;
       /* background-color: aqua;*/
        text-align: center;
        float: left;
        width: 100%;
    }
</style>
<body class="body">

<table id="tablel" >

        <tr>

            <th>
                <div>
                    <label for="selectl">选择班级：</label>
                    <select id="selectclass" name="classes">
                        <option name="" value="" selected></option><?php
						$sql = "select classId from class_course_user where userId = '$userid' ";
						$result=mysqli_query($db,$sql);
						while($row = mysqli_fetch_assoc($result)){
							$classid=$row['classId'];
							$sql2 = "select className from class where classId = '$classid' ";
						$result2=mysqli_query($db,$sql2);
						$row2 = mysqli_fetch_assoc($result2);
						echo "<option name=".$row2['className']." value=".$row2['className'].">".$row2['className']."</option>";
							
							
						}
						
						?>
                        
                    </select>
                    <button id="classok">确定</button>
                    </br>
                    <label id="classlab"></label>
                </div>

            </th>

            <th  style="vertical-align:top;">

                <div>
                    <label for="selectl" >选择课程：</label>
                    <select id="selectcourse" name="course">
                        <option name="" value="" selected></option>
                        <?php
                        $sql = "select courseId from class_course_user where userId = '$userid' ";
                        $result=mysqli_query($db,$sql);
                        while($row = mysqli_fetch_assoc($result)){
                            $courseid=$row['courseId'];
                            $sql2 = "select courseName from course where courseId = '$courseid' ";
                            $result2=mysqli_query($db,$sql2);
                            $row2 = mysqli_fetch_assoc($result2);
                            echo "<option name=".$row2['courseName']." value=".$row2['courseName'].">".$row2['courseName']."</option>";


                        }

                        ?>

                    </select>
                </div>

            </th>

            <th style="vertical-align:top;">

                <div>
                    <label for="selectl">点名人数：</label>
                    <input type="text"  style="display:inline-block;width:100px;"id="selectnum" name="callnum" placeholder="点名人数">
                </div>

            </th>

        </tr>

    </table>
    </br>
    <button id="btn1">开始点名</button>

<div id="hidetrangle" class="trangle">

    <div id="numth">
        <h2>第<span id="tranglenum"
            style="display:inline-block;width:50px;border:none;text-align:center;font-size: 1.0em; margin: .75em 0;" name="num"  disabled>1</span>个</h2>
    </div>

    <div  class="name-num">
        <label for="selectl">学生学号</label>
        <span id="stunum"></span>
    </div>

    <div  class="name-num">
        <label for="selectl">学生姓名</label>
        <span id="stuname"></span>
    </div>

    <table id="submit3">
        <tr>
            <th>
                <button id="last" onclick="lastloadXMLDoc()">上一个</button>
            </th>
            <th>
                <button id="haveto" onclick="loadXMLDoc()">已到</button>
            </th>
            <th>
                <button id="skip" onclick="loadXMLDoc()">跳过</button>
            </th>
            <th>
                <button id="absence" onclick="loadXMLDoc()">缺勤</button>
            </th>
        </tr>
    </table>

</div>

<script>

        $(function(){

            $("#hidetrangle").hide();

            $("#classok").click(function(){
                var classs=$("#selectclass").val();
                if(""!=classs)
                     $("#classlab").append("+"+classs);
            });

            $("#btn1").click(function(){
                var classs=$("#classlab").text();
              var course=$("#selectcourse").val();
              var number=$("#selectnum").val();
                if(""==classs) alert("请选择班级");
                else  if(""==course) alert("请选择课程");
                else if(""==number)alert("请输入点名数字")
                else if(number<=0 ||isNaN(number)) alert("请输入有效点名数字");
                else {
                    $("#classok").prop("disabled",true);
                    $("#selectclass").prop("disabled", true);
                   $("#selectcourse").prop("disabled", true);
                   $("#selectnum").prop("disabled", true);
                   $("#classlab").prop("disabled",true);
                   $("#btn1").prop("disabled",true);
                   $("#hidetrangle").show();
                    $("#last").prop("disabled",true);

                    $.post("manualcall_info.php",{classlab:classs, courseName:course, num:number },function(data){
                            console.log(data);
                    });
                }

          });



        });

        function loadXMLDoc() {
            if($("#tranglenum").text()==$("#selectnum").val()) {
                alert("点名完成");
                $("#classok").prop("disabled",false);
                $("#classlab").html("");
                $("#selectclass").prop("disabled", false);
                $("#selectcourse").prop("disabled", false);
                $("#selectnum").prop("disabled", false);
                $("#classlab").prop("disabled",false);
                $("#btn1").prop("disabled",false);
                $("#tranglenum").html(1);
                $("#hidetrangle").hide();
            }
            else {
                x = Number($("#tranglenum").text()) + 1;
                $("#tranglenum").html(x);
                $("#last").prop("disabled", false);
            }
        }

        function lastloadXMLDoc() {
                $("#last").prop("disabled", false);
                x = Number($("#tranglenum").text()) - 1;
                if(x==1)
                    $("#last").prop("disabled", true);
                $("#tranglenum").html(x);
        }

       /* function loadXMLDoc() {
            $.get("re.php",{name:"lu"},function(data){

                x=Number($("#tranglenum").text())+Number(data);
                $("#tranglenum").html(x);
            })
        }*/
        /*function loadXMLDoc() {
            var xmlhttp;
            var x;
            if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            }
            else {// code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    x=Number($("#tranglenum").text())+Number(xmlhttp.responseText);

                    alert(x);
                    $("#tranglenum").html(x);
                }
            }
            xmlhttp.open("GET", "re.php", true);
            xmlhttp.send();
        };*/
    </script>
</body>
</html>