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
    <script type="text/javascript" src="js/jquery-1.8.0.js"></script>
    <script type="text/javascript" src="js/utf.js"></script>
    <script type="text/javascript" src="js/jquery.qrcode.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#qrcodeCanvas").qrcode({
                render : "canvas",    //设置渲染方式，有table和canvas，使用canvas方式渲染性能相对来说比较好
                text : "http://www.baidu.com",   //扫描了二维码后的内容显示,在这里也可以直接填一个网址，扫描二维码后
                width : "200",               //二维码的宽度
                height : "200",              //二维码的高度
                background : "#ffffff",       //二维码的后景色
                foreground : "#000000",        //二维码的前景色
                src: 'img/logo.jpg'             //二维码中间的图片
            });
        });
    </script>

</head>

<style>
    #twocode
    {
        text-align:center;
    }
    .select2
    {
        float:left;
        margin-left:42%;
    }
    #tablel
    {
        border: 0;
        vertical-align: top;
       /* background-color: red;*/
        width: 195%;
        float: left;
        margin-left: -240px;
    }
    #selectclass{
        width:130px;
    }
</style>

<body>

<div class="select2">

                <div>
                    <label for="selectcourse" >选择课程：</label>
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

                <div>
                    <label for="selectclass">选择班级：</label>
                    <select id="selectclass" >
                        <option  value="" selected></option>
                    </select>

                    <button id="classok">选定</button>
                    <br>
                    <label id="classlab"></label>
                    </br>
                    <button id="classsure"style='padding: 6px 17px;background-color: #3c00ff4d;color: blue;float: left;margin-left: 94px;'>确定</button>
                </div>

</div>
</br>
</br>
<div id="twocode">
    <br>
    <br>
    <center >
         <h2>该请扫描该二维码</h2>
         <div id="qrcodeCanvas"></div>
    </center>
    <br>

    <h2 style="text-align: center;">已有<span id="havenumtc"></span>人扫描</h2>
    <button id="twocodestart" style='padding: 6px 17px;background-color: #3c00ff4d;color: blue;'>开始</button>
</div>

<script>

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

        $("#twocode").hide();

        $("#classok").click(function(){
            var classs=$("#selectclass").val();
            var labelclass=$("#classlab").text();
            if(""!=classs && !isContains(labelclass,classs))
                $("#classlab").append("+"+classs);
        });

        $("#classsure").click(function(){
            $("#selectcourse").prop("disabled",true);
            $("#selectclass").prop("disabled",true);
            $("#classok").prop("disabled",true);
            $("#classsure").prop("disabled",true);
            $("#twocode").show();
        });

        $("#twocodestart").click(function(){
            window.location.href = "identifycode.php";//进入生成验证码界面

        });

    });
</script>
</body>
</html>