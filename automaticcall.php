<?php
//为方便本页面测试 暂时屏蔽
require_once 'get_user_info.php';
//echo "<script>console.log('".session_id().$_SESSION['username'].$is_login."'); </script>";
if(!$is_login){
    echo "<script> alert('Please login...');parent.location.href='./index.php'; </script>";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>二维码扫描</title>
    <script type="text/javascript" src="js/jquery-3.2.1.js"></script>
    <script type="text/javascript" src="js/utf.js"></script>
    <script type="text/javascript" src="js/jquery.qrcode.js"></script>
    <link rel="stylesheet" href="style/button_one.css">
    <link href='http://cdn.webfont.youziku.com/webfonts/nomal/107666/45803/59b5e41ff629d8133c486a1f.css' rel='stylesheet' type='text/css' />
</head>
<style>
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
        min-width: 249px;
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
    #explain_matical{width:100%;height:70px;background-color:#40AFFE;}
    #matical_select_course{margin-top:30px;}
    #matical_select_class{margin-top:20px;}
    #classok{margin-top:30px;margin-left:120px;}
    #classlab{display:block;margin-top:20px;font-size:18px;margin-left:90px;}
    #classsure{margin-top:20px;margin-left:120px;}
    /*#twocode{width:300px;height:300px;background-color:#40AFFE;}*/
</style>
<body>
<center>
    <center>
    <div id="explain_matical">
        <span></span>
    </div>
    </center>
                <div id="matical_select_course">
                    <label for="selectcourse" style="font-family:'LiDeBiao-Xing3d13ac64ab1a492';font-size:30px;">选择课程</label>
                    <select id="selectcourse" name="course">
                        <option  value="选择点名课程" selected>选择课程</option>
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
                <div id="matical_select_class">
                    <label for="selectclass" style="font-family:'LiDeBiao-Xing3d13ac64ab1a492';font-size:30px;">选择班级</label>
                    <select id="selectclass" >
                        <option  value="选择点名班级" selected>选择班级</option>
                    </select>
                </div>
<!--    <center>-->
<!--    <input style="font-family:'LiDeBiao-Xing3d13ac64ab1a492';width:130px;height:45px;font-size:18px;border-radius:20px;" class="button_one white" type="button" id="classok"  value="选定班级"/>-->
<!--    </center>-->
             <span id="classlab">测试中啦啦啦啦啦啦请点击确定开始点名</span>
<!--    <button id="classsure"style='padding: 6px 17px;background-color: #3c00ff4d;color: blue;float: left;margin-left: 94px;'>确定</button>-->
    <center>
    <input style="font-family:'LiDeBiao-Xing3d13ac64ab1a492';width:80px;height:33px;font-size:18px;width:100px;height:40px;font-size:18px;border-radius:20px;" class="button_one white" type="button"  id="classsure"  value="确定"/>
    </center>
    <div id="twocode">
         <span style="font-family:'LiDeBiao-Xing3d13ac64ab1a492';width:80px;height:33px;font-size:18px;">该扫描该二维码</span>
         <div id="qrcodeCanvas"></div>
         <span style="text-align: center;font-family:'LiDeBiao-Xing3d13ac64ab1a492';width:80px;height:33px;font-size:18px;"">已有<span id="havenumtc">0</span>人扫描</h2>
</div>
<!--<button id="twocodestart" style='padding: 6px 17px;background-color: #3c00ff4d;color: blue;'>开始</button>-->
    <input style="font-family:'LiDeBiao-Xing3d13ac64ab1a492';width:80px;height:33px;font-size:18px;width:150px;height:45px;font-size:18px;border-radius:20px;" class="button_one white" type="button" id="twocodestart"   value="开始"/>
</center>
<script>
    var courseName1="";
    var int=setInterval("clock()",500);
    function clock()
    {
        $.post("visit_counter.php",{userId:<?php echo $_SESSION['userid'];?>},function(data){
            console.log(data);
            $("#havenumtc").html(data);
        });
    }
    function isContains(str,substr){
        return str.indexOf(substr)>=0;
    }
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

    $(function(){
        var classids=new Array();
       var ID="";
        $("#twocode").hide();
//        $("#classok").click(function(){
//            var classid=$("#selectclass").val();
//            if(classids.indexOf(classid)<0){
//                classids.push(classid);
//                var classs=$("#selectclass option:selected").text();
//                if(classs=="选择班级")
//                {
//                    $("#classlab").html("");
//                    $("#classlab").append("*请选择班级！");
//                    setTimeout(function(){$("#classlab").hide();},2000);//2秒后执行该方法
//                }
//                else
//                {
//                    $("#classlab").html("");
//                    $("#classlab").append("选定"+classs + "，点击确定开始自动点名！");
//                    setTimeout(function(){$("#classlab").hide();},2000);//2秒后执行该方法
//                }
//            };
//        });
        $("#classsure").click(function(){
            var classid=$("#selectclass").val();
            if(classids.indexOf(classid)<0){
                classids.push(classid);
                var classs=$("#selectclass option:selected").text();
                if(classs=="选择班级")
                {
                    $("#classlab").html("");
                    $("#classlab").append("*请选择班级！");
                    setTimeout(function(){$("#classlab").hide();},2000);//2秒后执行该方法
                }
                else
                {
                    $("#classlab").html("");
                    $("#classlab").append("选定"+classs + "，点击确定开始自动点名！");
                    setTimeout(function(){$("#classlab").hide();},2000);//2秒后执行该方法
                }
            };
            if($("#classlab").html().trim()=="")
                $("#classlab").html("请选择课程与班级，之后按下选定!");
            else {
                $.getJSON("phpData/auto_getId.php",{courseName:$("#selectcourse").val(),classid_s:classids,userId:<?php echo $_SESSION['userid'];?>},function(data){
                    console.log(data);
                    for(var i=0;i<data.length;i++){
                        ID+=data[i]+"_";
                    }
                    $("#qrcodeCanvas").qrcode({
                        render : "canvas",    //设置渲染方式，有table和canvas，使用canvas方式渲染性能相对来说比较好
                        text :'https://www.q-cs.cn/roster/idcophone.php?  ID='+ID+'&userId='+<?php echo $_SESSION['userid'];?>, //扫描了二维码后的内容显示,在这里也可以直接填一个网址，扫描二维码后
                        width : "200",               //二维码的宽度
                        height : "200",              //二维码的高度
                        background : "#ffffff",       //二维码的后景色
                        foreground : "#000000",        //二维码的前景色
                        src: 'img/logo.jpg'             //二维码中间的图片
                    });

                });
                //获得Id

                $("#selectcourse").prop("disabled", true);
                $("#selectclass").prop("disabled", true);
                $("#classok").prop("disabled", true);
                $("#classsure").prop("disabled", true);


                $("#twocode").show();

                var flag = 1;
                var classs = $("#classlab").text();
                var course = $("#selectcourse").val();

                $.post("auto_newfile.php", {flag: flag, userId:<?php echo $_SESSION['userid'];?>}, function (data) {
                    console.log(data);
                });


            }

            /*var twocodedata="twocode_sucessfully";
            $.post("phpData/twocode_database.php",{twocodata:twocodedata,userId:<?php /*echo $_SESSION['userid'];*/?>},function(data){

            });*/

        });

        $("#twocodestart").click(function(){
            var classs=$("#classlab").text();
            var course=$("#selectcourse").val();
             var flag=0;
            $.post("auto_newfile.php",{flag:flag,userId:<?php echo $_SESSION['userid'];?>},function(data){
                console.log(data);
                window.location.href = 'identifycode.php ?userId:'+<?php echo $_SESSION['userid'];?>;//进入生成验证码界面
            });
        });

    });



</script>
</body>
</html>