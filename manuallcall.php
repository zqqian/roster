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
    <script src="js/layer/layer.js"></script>
    <link rel="stylesheet" href="style/placeholder.css">
    <!--//加文本框的样式-->
    <link href='http://cdn.webfont.youziku.com/webfonts/nomal/107666/45803/59b7f8fdf629d80cf06cb9df.css' rel='stylesheet' type='text/css' />

    <link rel="stylesheet" type="text/css" href="css/summarycss.css">
    <!--按钮的样式-->

</head>
<style>
    .body
    {
        text-align: center;
        font-size:100%;
    }
    #selectclass
    {
        width:130px;
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
        border: 1px solid #92A1AC;
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
    #classlab{
        display: block;
        margin: 10px auto;
    }
    #classok{
        width:70px;
        display: inline;
    }
    th label{
        font-size: 25px;
    }
    #btn1{
        margin: 0 auto;
    }
    #submit3 th input[type='button']{
        width: 70px;
        margin: 10px;
    }

    input[type='text'][disabled]{color: gray;
        background: rgba(128, 128, 128, 0.32);
    }

    button[disabled][required]:focus {
        border-color: rgba(128, 128, 128, 0.32);
    }
    input[type='button'][disabled]{color:rgba(128, 128, 128, 0.32);}

    button[disabled][required]:focus + label[placeholder]:before {
        color: rgba(128, 128, 128, 0.32);
    }
    input[type='button'][disabled]{color:rgba(128, 128, 128, 0.32);}


    button[type='button'][disabled]:active {
        -webkit-transition: none;
        -moz-transition: none;
        -ms-transition: none;
        -o-transition: none;
        transition: none;
        position:static;

    }
    input[type='button'][disabled]:active {
        -webkit-transition: none;
        -moz-transition: none;
        -ms-transition: none;
        -o-transition: none;
        transition: none;
        position:static;
    }
    #manucourse{margin-top:50px;margin-left:-70px;}
    #manuclass{margin-top:30px;}
    #manunum{margin-top:30px;margin-left:-50px;}
    #hidetrangle{margin-top:40px;margin-left:200px;}
</style>
<body class="body">

<table id="tablel" >
               <!-- <div>-->
                <center>
                    <div id="manucourse">
                    <label class="cssd1bcde6dd1a492" for="selectcourse" style="font-size:25px;">选择课程</label>
                    <select id="selectcourse" name="course">
                        <option  value="" selected></option>
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
                </center>
               <!-- </div>-->

               <!-- <div>-->
    <div id="manuclass">
                    <label  class="cssd1bcde6dd1a492" for="selectclass" style="font-size:25px;">选择班级</label>
                    <select id="selectclass" >
                        <option  value="" selected></option>
                    </select>

                    <input type="button" value="确定" id="classok"/>
    </div>
               <!-- </div>-->
       <div id="manunum">
                    <label class="cssd1bcde6dd1a492" for="selectnum"style="font-size:20px;">点名人数：</label>
                    <input type="text"  style="display:inline-block;width:100px;"id="selectnum" name="callnum" placeholder="点名人数">
       </div>
    </table>
<label id="classlab"></label>
    <br>
    <input type="button" value="开始点名" id="btn1" style="height:35px;width:150px;"/>

<div id="hidetrangle" class="trangle">

    <div id="numth">
        <h2>第<span id="tranglenum"
            style="display:inline-block;width:50px;border:none;text-align:center;font-size: 1.0em; margin: .75em 0;" name="num"  disabled>1</span>个</h2>
    </div>

    <div  class="name-num">
        <label  for="selectl">学生学号</label>
        <span id="stunum"></span>
    </div>

    <div  class="name-num">
        <label  for="selectl">学生姓名</label>
        <span id="stuname"></span>
    </div>

    <table id="submit3">
        <tr>
            <th>
                <input type="button" value="上一个" id="last" />
            </th>
            <th>
                <input type="button" value="已到" id="haveto" >
            </th>
            <th>
                <input type="button" value="跳过" id="skip" >
            </th>
            <th>
                <input type="button" value="缺勤" id="absence">
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
                    $("#selectclass").append("<option value='' selected></option>");
                }else{

                    $.post("phpData/return_class.php",{courseName:courseName,userId:<?php echo $_SESSION['userid'];?>},function(data){
                        $("#selectclass").empty();
                        $("#selectclass").append("<option value='' selected></option>");
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
                if(""==course)
                    layer.alert('请选择课程', {
                        icon: 5,
                        skin: 'layer-ext-moon' //该皮肤由layer.seaning.com友情扩展。关于皮肤的扩展规则，去这里查阅
                    })
                else  if(""==classs)
//                    alert("请选择班级");
                    layer.alert('请选择班级', {
                        icon: 5,
                        skin: 'layer-ext-moon' //该皮肤由layer.seaning.com友情扩展。关于皮肤的扩展规则，去这里查阅
                    })
                else if(""==number)
//                    alert("请输入点名数字")
                    layer.alert('请输入点名数字', {
                        icon: 5,
                        skin: 'layer-ext-moon' //该皮肤由layer.seaning.com友情扩展。关于皮肤的扩展规则，去这里查阅
                    })
                else if(number<=0 ||isNaN(number))
//                    alert("请输入有效点名数字");
                    layer.alert('请输入有效点名数字', {
                        icon: 5,
                        skin: 'layer-ext-moon' //该皮肤由layer.seaning.com友情扩展。关于皮肤的扩展规则，去这里查阅
                    })
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

//                    alert("点名完成");
                    layer.alert('点名完成', {
                        icon: 6,
                        skin: 'layer-ext-moon' //该皮肤由layer.seaning.com友情扩展。关于皮肤的扩展规则，去这里查阅
                    })
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

                    layer.alert('点名完成', {
                        icon: 6,
                        skin: 'layer-ext-moon' //该皮肤由layer.seaning.com友情扩展。关于皮肤的扩展规则，去这里查阅
                    })
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

                    layer.alert('点名完成', {
                        icon: 6,
                        skin: 'layer-ext-moon' //该皮肤由layer.seaning.com友情扩展。关于皮肤的扩展规则，去这里查阅
                    })
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