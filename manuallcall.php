<?php
//为方便本页面测试 暂时屏蔽
require_once 'get_user_info.php';
//echo "<script>console.log('".session_id().$_SESSION['username'].$is_login."'); </script>";
if(!$is_login){
	echo "<script> alert('Please login...');parent.location.href='./index.php'; </script>"; 
}
?>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <title>手动点名</title>
    <script type="text/javascript" src="js/jquery-3.2.1.js"></script>
    <link rel="stylesheet" href="style/button_one.css">
</head>
<style>
    /*.body*/
    /*{*/
        /*text-align: center;*/
        /*font-size:100%;*/
    /*}*/
    /*#selectclass*/
    /*{*/
        /*width:130px;*/
    /*}*/
    /*#tablel*/
    /*{*/
        /*border:0;*/
        /*vertical-align:top;*/
        /*!*background-color:red;*!*/
        /*width:100%;*/
    /*}*/
    /*.trangle*/
    /*{*/

        /*height:300px;*/
        /*width:400px;*/
        /*text-align:center;*/
        /*border-radius: 10px;*/
        /*margin-left: 35%;*/
        /*margin-top: 50px;*/
        /*border: 1px solid #50ffe4;*/
       /*!* background-color: antiquewhite;*!*/
    /*}*/
    /*#numth*/
    /*{*/
       /*!* background-color: aqua;*!*/
        /*border:none;*/
        /*height:100px;*/
    /*}*/
    /*.name-num*/
    /*{*/
        /*float:left;*/
        /*margin-top:10px;*/
        /*margin-left:20%;*/
    /*}*/
    /*#submit3*/
    /*{*/
        /*height:100px;*/
       /*!* background-color: aqua;*!*/
        /*text-align: center;*/
        /*float: left;*/
        /*width: 100%;*/
    /*}*/
    #selectcourse,#selectclass{
        /*Chrome和Firefox里面的边框是不一样的，所以复写了一下*/
        border: solid 2px #40AFFE;
        /*很关键：将默认的select选择框样式清除*/
        appearance:none;
        -moz-appearance:none;
        /*清除箭头*/
        -webkit-appearance:none;
        /*在选择框的最右侧中间显示小箭头图片*/
        background: url("img/arrow.png") no-repeat scroll right center transparent;
        /*为下拉小箭头留出一点位置，避免被文字覆盖*/
        padding-right: 14px;
        position: relative;
        min-width: 250px;
        width:auto;
        background-color:#fffdfc;
        font-size:17px;
        margin: 0 auto;
        padding: 10px 15px;
        padding-left:30px;;
        border-left: 5px solid deepskyblue;
        cursor: pointer;
        outline: none;
        height:50px;
    }
    #selectnum{
        display:block;
        transition:all 0.30s ease-in-out;
        -webkit-transition: all 0.30s ease-in-out;
        -moz-transition: all 0.30s ease-in-out;
        border:#35a5e5 1px solid;
        border-radius:15px;
        outline:none;
        width:150px;
        height:40px;
        margin-top:5px;
    }
    #selectnum:focus{
        box-shadow:0 0 5px rgba(81, 203, 238, 1);
        -webkit-box-shadow:0 0 5px rgba(81, 203, 238, 1);
        -moz-box-shadow:0 0 5px rgba(81, 203, 238, 1);
        width:150px;
        height:43px;
    }
    #manuallselect{margin-top:50px;}
    #manucalcourse{margin-top:30px;}
    #manucalclass{margin-top:30px;}
    #classok{margin-top:30px;}
    #nucall-num{margin-top:30px;}
    #btn1{margin-top:40px;}
</style>
<body class="body">
<center>
<div id="manuallselect" >
                <div id="manucalcourse">
                    <span for="selectcourse" >选择课程</span>
                    <select id="selectcourse" name="course">
                        <option  value="" selected>选择课程</option>
                        <?php
                        $sql = "select distinct(courseId) from class_course_user where userId = '$userid' ";
                        $result=mysqli_query($db,$sql);
                        while($row = mysqli_fetch_assoc($result)){
                            $courseid=$row['courseId'];
                            $sql2 = "select courseName from course where courseId = '$courseid' ";
                            $result2=mysqli_query($db,$sql2);
                            $row2 = mysqli_fetch_assoc($result2);
                            echo "<option value=".$row2['courseName'].">".$row2['courseName']."</option>";
                        }
                        ?>
                    </select>
                </div>
<!--            <th  style="vertical-align:top;">-->
                <div id="manucalclass">
                    <span for="selectclass">选择班级</span>
                    <select id="selectclass" >
                        <option  value="" selected>选择班级</option>
                    </select>
                </div>
<!--    <button id="classok">确定</button>-->
    <input class="button_one white" style="font-size:10px;border-radius:10px;height:35px;width:80px;font-size:18px;"  type="button" id="classok"  value="确定"/>
    <span id="classlab"></span>
<!--            <th style="vertical-align:top;">-->
                <div id="nucall-num">
                    <span for="selectnum">点名人数：</span>
                    <input type="text"  style="display:inline-block;width:150px;"id="selectnum" name="callnum" placeholder="输入点名人数">
                </div>
    </div>
</center>

<!--    <button id="btn1">开始点名</button>-->
<center>
<input class="button_one white" style="font-size:20px;border-radius:20px;height:45px;width:150px;font-size:18px;"  type="button" id="btn1" value="开始点名"/>
</center>
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
                <button id="last" >上一个</button>
            </th>
            <th>
                <button id="haveto" >已到</button>
            </th>
            <th>
                <button id="skip" >跳过</button>
            </th>
            <th>
                <button id="absence">缺勤</button>
            </th>
        </tr>
    </table>

</div>

<script>

    function isContains(str,substr){
        return str.indexOf(substr)>=0;
    }


    $(function(){

        var arr;
        var classids=[];

            $("#hidetrangle").hide();


            $("#selectcourse").change(function(){
                var courseName = $(this).val();
                $("#classlab").html("");
                if("" == courseName){
                    $("#selectclass").empty();
                    $("#selectclass").append("<option value='' selected>选择课程</option>");
                }else{

                    $.post("phpData/return_class.php",{courseName:courseName,userId:<?php echo $_SESSION['userid'];?>},function(data){
                        $("#selectclass").empty();
                        $("#selectclass").append("<option value='' selected>选择课程</option>");
                        $("#selectclass").append(data);
                    });

                }
            });//end change

            $("#classok").click(function(){
                var classid=$("#selectclass").val();
                if(classids.indexOf(classid)<0){
                    classids.push(classid);
//                    jQuery("#select1  option:selected").text();
                    var classs=$("#selectclass option:selected").text();
                    $("#classlab").append(classs + "  ");
                };

            });

            $("#btn1").click(function(){
                var classs=$("#classlab").text();
              var course=$("#selectcourse").val();
              var number=$("#selectnum").val();
                if(""==course) alert("请选择课程");
                else  if(""==classs) alert("请选择班级");
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

                $.getJSON("phpData/creat_manuallcall_list.php",{ classids:classids, num:number,userId:<?php echo $_SESSION['userid'];?> },function(data){

                    console.log(data);
                     arr=eval(data);

                    $("#stunum").html(arr[0][0]);
                    $("#stuname").html(arr[0][1]);
                     });
                }

          });

             $("#last").click(function(){
                 $("#last").prop("disabled", false);
                 x = Number($("#tranglenum").text()) - 1;
                 if(x==1)
                     $("#last").prop("disabled", true);
                 $("#tranglenum").html(x);
                 $("#stunum").html(arr[x-1][0]);
                 $("#stuname").html(arr[x-1][1]);
                 });

            $("#haveto").click(function(){
                arr[$("#tranglenum").text()-1][2]=0;
                if($("#tranglenum").text()==$("#selectnum").val()) {
                    var number=$("#selectnum").val();
                    $.post("phpData/manualcall_info.php",{classids:classids, num:number,arr:arr,courseName:$("#selectcourse").val(),userId:<?php echo $_SESSION['userid'];?>},function(data){
                        console.log(data);
                    });

                    alert("点名完成");
                    window.location.reload();

                }
                else {
                    x = Number($("#tranglenum").text()) + 1;
                    $("#stunum").html(arr[x-1][0]);
                    $("#stuname").html(arr[x-1][1]);
                    $("#tranglenum").html(x);
                    $("#last").prop("disabled", false);
                }
            });

            $("#skip").click(function(){
                arr[$("#tranglenum").text()-1][2]=2;
                if($("#tranglenum").text()==$("#selectnum").val()) {
                    var number=$("#selectnum").val();
                    $.post("phpData/manualcall_info.php",{classids:classids, num:number,arr:arr,courseName:$("#selectcourse").val(),userId:<?php echo $_SESSION['userid'];?>},function(data){
                        console.log(data);
                    });

                    alert("点名完成");
                    window.location.reload();
                }
                else {
                    x = Number($("#tranglenum").text()) + 1;
                    $("#stunum").html(arr[x-1][0]);
                    $("#stuname").html(arr[x-1][1]);
                    $("#tranglenum").html(x);
                    $("#last").prop("disabled", false);
                }
            });

            $("#absence").click(function(){
                if($("#tranglenum").text()==$("#selectnum").val()) {
                    var number=$("#selectnum").val();
                    $.post("phpData/manualcall_info.php",{classids:classids, num:number,arr:arr,courseName:$("#selectcourse").val(),userId:<?php echo $_SESSION['userid'];?>},function(data){
                        console.log(data);
                    });

                    alert("点名完成");
                    window.location.reload();
                }
                else {
                    x = Number($("#tranglenum").text()) + 1;
                    $("#stunum").html(arr[x-1][0]);
                    $("#stuname").html(arr[x-1][1]);
                    $("#tranglenum").html(x);
                    $("#last").prop("disabled", false);
                }
            });

        });
    </script>
</body>
</html>