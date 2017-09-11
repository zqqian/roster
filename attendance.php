<?php
require_once 'get_user_info.php';
//用于检测是否登录，测试本页面时可暂时屏蔽以下几行php代码
if(!$is_login){
    echo "<script> alert('Please login...');parent.location.href='./index.php'; </script>";
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>点名信息查询</title>
    <script src="js/jquery-3.2.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet"  type="text/css" href="http://">
    <link href='http://cdn.webfont.youziku.com/webfonts/nomal/107666/45803/59b53de8f629d81184f0b95c.css' rel='stylesheet' type='text/css' />
</head>
<style>
    html,body{margin:0px;padding:0px;}
    #course_name span{color:#000000;font-size:35px;}
    #course_name{background-color:#4cbeff;border:1px solid #fffdfc;width:100%;min-height:100px;height:auto;line-height:100px;text-align:center;}
    /*#select_course{height:25px;text-align:center;margin-top:20px;margin-left:160px;margin-bottom: 20px;}*/
    #menuselect{border-bottom:1px solid #fffdfc;width:100%;height:60px;margin: 0px;background-color:#000000;
        text-align:center;padding:0px;line-height:85px;}
    #menuselect ul{border-bottom:1px solid #fffdfc;background-color:#4cbeff;margin:0px;display:block;padding:0px;}
    .showa{font-size: 20px;color: white;}
    ul li{list-style-type:none;display:inline;margin:7%;}
    #menuselect a{color:#000000;}
    #menusure{display:block;width:100%;height:80px;border-top:1px solid #fffdfc;background-color:#4cbeff;text-align:center;line-height:80px;}
    #menusure span{font-size:25px;font-family:'LiDeBiao-Xing3d11231b241a492';}
    /*#select-class{margin:10px;}*/
    th,tr{text-align: center;}
    /*select{width:auto;min-width: 100px;text-align: center;}*/
    /*清掉默认设置的样式*/
    a:hover  {color: white;}
    a:active {color: white;}
    a:visited{color: white;}
    a:link{color: white;}
    #select_course{
        margin-top:30px;
    }
    #select-class,#select_course{
        border-radius:20px;
        /*Chrome和Firefox里面的边框是不一样的，所以复写了一下*/
        border: solid 2px #40AFFE;
        /*很关键：将默认的select选择框样式清除*/
        /*appearance:none;*/
        /*-moz-appearance:none;*/
        /*清除箭头*/
        /*-webkit-appearance:none;*/
        /*在选择框的最右侧中间显示小箭头图片*/
        /*background: url("http://ourjs.github.io/static/2015/arrow.png") no-repeat scroll right center transparent;*/
        /*为下拉小箭头留出一点位置，避免被文字覆盖*/
        padding-right: 14px;
        position: relative;
        min-width: 200px;
        width:auto;
        background-color:#fffdfc;
        font-size:15px;
        margin: 0 auto;
        padding: 10px 15px;
        padding-left:30px;
        border-left: 5px solid deepskyblue;
        cursor: pointer;
        outline: none;
        height:50px;
        font-size:17px;
    }
</style>
<body>
<div id="course_name">
    <span style="font-family:'LiDeBiao-Xing3d11231b241a492';" >选择课程</span>
    <select id="select_course" onChange = "getcourse()">
        <option value="请选择" selected>选择课程</option>
        <?php
        $userid = $_SESSION['userid'];
        $find_course = "SELECT distinct courseId,courseName FROM basic_relation WHERE userId=$userid";
        $set=mysqli_query($db,$find_course);
        while($row=mysqli_fetch_assoc($set)){
            echo "<option value='".$row['courseName']."'>".$row['courseName']."</option>";
        }
        mysqli_close($db);?>
    </select>
</div>
<div id="menuselect">
    <ul>
        <li> <a style="font-family:'LiDeBiao-Xing3d11231b241a492';" href="#" class="showa" id="showaone" onclick="searchdate()">按日期查询</a></li>
        <li> <a style="font-family:'LiDeBiao-Xing3d11231b241a492';"  href="#" class="showa" id="showatwo" onclick="searchclass()">按班级查询</a></li>
    </ul>
</div>
<div id="menusure">
    <span style="font-family:'LiDeBiao-Xing3d11231b241a492';" >选择查询方式</span>
    <select id="select-class" onChange = "attendance_data()">
        <!--        <option>国贸</option>-->
        <!--        <option>计科</option>-->
    </select>
</div>
<div id="showdata">
    <table class="table table-bordered table-hover table-condensed" id="showTable">
    </table>
</div>
</body>
<script>
    var date_array=new Array();
    var class_array=new Array();
    $( '#select_course' ).dropdown( {
        gutter : 2,
        stack : false,
        slidingIn : 100
    } );
    $( '#select-class' ).dropdown( {
        gutter : 2,
        stack : false,
        slidingIn : 100
    } );
    function getcourse(){
        $("#menusure span").html("选择查询方式");
        $("#select-class").html("");
        var obj = $("#select_course");
        var index = obj.selectedIndex;
        $("#showTable").empty();
        if ("请选择" != obj.val()) {
            $.ajax({
                type:"POST",
                url:"phpData/return_class_date.php",
                data:{userId:<?php echo $_SESSION['userid'];?>,selected_course:obj.val()},
                dataType:"json",
                success:function(data) {   //返回一个json数组，数组中分别包含班级和日期两个数组
                    date_array=data.search_date;
                    class_array=data.search_class;
                }
            });
        }else{
            window.location.reload();
        }
    }
    function searchdate()
    {
        $("#showTable").empty();
        $("#menusure span").html("");
        $("#menusure span").html("选择日期");
        $("#select-class").html("");
        $("#select-class").append("<option value='请选择' selected>选择日期</option>");
        var str="";
        for(var i=0;i<date_array.length;i++)
        {
            str += "<option value='"+date_array[i]+"'>"+date_array[i]+"</option>";
        }
        $("#select-class").append(str);
    }
    function searchclass(){
        $("#showTable").empty();
        $("#menusure span").html("");
        $("#menusure span").html("选择班级");
        $("#select-class").html("");
        $("#select-class").append("<option value='请选择' selected>选择班级</option>");
        var str="";
        for(var i=0;i<class_array.length;i++)
        {
            str += "<option value='"+class_array[i]+"'>"+class_array[i]+"</option>";
        }
        $("#select-class").append(str);
    }
    function attendance_data() {
        var search = $("#menusure span").html();  //获取当前标签值
        var obj = document.getElementById("select-class");
        var index = obj.selectedIndex;
        if (search == "选择日期") {
            if (obj.options[index].value!="请选择") {
                $.post("phpData/return_rosterDate.php",{search: search, selected_date: obj.options[index].value,userId:<?php echo $_SESSION['userid'];?>,selected_course:obj.options[index].value},function(data){
                    $("#showTable").empty();
                    $("#showTable").append(data);
                });
            }
            else{$("#showTable").empty();}
        }
        else if (search == "选择班级") {
            if (obj.options[index].value != "请选择") {
                $.post("phpData/return_rosterDate.php",{search: search, selected_course:$("#select_course").val(),userId:<?php echo $_SESSION['userid'];?>,select_class:obj.options[index].value},function(data){
                    //处理并显示返回来的学生成绩
                    $("#showTable").empty();
                    $("#showTable").append(data);
                });
            }
            else{$("#showTable").empty();}
        }
        else {
        }
    }

</script>
</html>