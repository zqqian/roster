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
    <link href='http://cdn.webfont.youziku.com/webfonts/nomal/107666/45803/59ba2a2cf629d815106db5a0.css' rel='stylesheet' type='text/css' />
    <link href='http://cdn.webfont.youziku.com/webfonts/nomal/107666/45803/59ba2acaf629d815106db5a1.css' rel='stylesheet' type='text/css' />
</head>
<style>

    #selectcourse,#selectclass{
        position: relative;
        border-radius: 10px;
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
    #autocourse{
    margin-top:50px;
    }
    #autoclass{margin-top:15px;margin-left:80px;}
    #classlab{display:block;margin-top:30px;margin-left:80px;}
    #classok{dislay:block;}
    #classsure{margin-left:100px;margin-top:35px;}
    #twocode{width:500px;height:350px;border:1px solid #000000;margin-top:-20px;margin-left:100px;}
    #auto-code{display:block;margin-top:-20px;}
    #qrcodeCanvas{margin-top:15px;}
    #twocodestart{margin-left:100px;}
</style>
<body>
<div class="select2">
    <center>
                <div id="autocourse">
                    <label for="selectcourse" style="font-family:'LiDeBiao-Xing3d245e05e61a492';font-size:25px;">选择课程</label>
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
    <center>
                <div id="autoclass">
                    <label for="selectclass" style="font-family:'LiDeBiao-Xing3d245e05e61a492';font-size:25px;">选择班级</label>
                    <select id="selectclass" >
                        <option  value="" selected></option>
                    </select>
                    <input class="button_one white" style="font-family:'LiDeBiao-Xing3d245e05e61a492';font-size:20px;width:80px;height:30px;" type="button" id="classok"  value="选定"/>
                </div>
    <span id="classlab"></span>
    <input class="button_one white" style="font-family:'LiDeBiao-Xing3d245e05e61a492';font-size:20px;height:35px;width:80px;border-radius:10px;"  type="button" id="classsure"  value="确定"/>
    </center>
</div>
</br>
</br>
<center>
<div id="twocode">
    <br>
    <br>
    <center >
         <h2 style="font-family:'LiDeBiao-Xing3d245e05e61a492';font-size:30px;"id="auto-code" >请扫描该二维码</h2>
         <div id="qrcodeCanvas"></div>
    </center>
    <br>

    <span style="font-family:'LiDeBiao-Xing3d246070301a492';font-size:30px;">已有<span style="font-family:'LiDeBiao-Xing3d246070301a492';font-size:25px;"id="havenumtc">0</span>人扫描</span>
<!--    <button id="twocodestart" style='padding: 6px 17px;background-color: #3c00ff4d;color: blue;'>开始</button>-->
</div>
</center>
<center>
<input class="button_one white" style="font-family:'LiDeBiao-Xing3d246070301a492';border-radius:20px;font-size:20px;width:100px;height:40px;" type="button" id="twocodestart"  value="开始"/>
</center>
    <script>
$("#twocodestart").hide();
    var courseName1="";
    var int=setInterval("clock()",10000);
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


    $(function(){

        var classids=new Array();
       var ID="";
        var myDate = new Date();

        function getNowFormatDate() {
            var date = new Date();
            var seperator1 = "-";
            var seperator2 = ":";
            var month = date.getMonth() + 1;
            var strDate = date.getDate();
            if (month >= 1 && month <= 9) {
                month = "0" + month;
            }
            if (strDate >= 0 && strDate <= 9) {
                strDate = "0" + strDate;
            }
            var currentdate = date.getFullYear() + seperator1 + month + seperator1 + strDate
                + " " + date.getHours() + seperator2 + date.getMinutes()
                + seperator2 + date.getSeconds();
            return currentdate;
        }

        $("#twocode").hide();


        $("#selectcourse").change(function(){
            var courseName = $(this).val();

            $("#classlab").html("");
            classids.splice(0,classids.length);
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

        $("#classsure").click(function(){

            //alert("*"+$("#classlab").html()+"*");
            if($("#classlab").html().trim()=="")
                alert("请选择课程与班级，之后按下选定！");
            else {
                $("#twocodestart").show();
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


                    myDate= getNowFormatDate();
                    $.post("phpData/auto_initialclassstu.php",{myDate:myDate,ID:ID},function(data){
                       console.log(data);
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

                var jshondata = {
                    userId:<?php echo $_SESSION['userid'];?>,
                    ID:ID,
                    myDate:myDate
                };
                window.location.href = 'identifycode.php?' +$.param(jshondata);
            });




        });

    });



</script>
</body>
</html>