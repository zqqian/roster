<?php
require_once 'get_user_info.php';
//用于检测是否登录，测试本页面时可暂时屏蔽以下几行php代码
/*if(!$is_login){
    echo "<script> alert('Please login...');parent.location.href='./index.php'; </script>";
}*/
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>点名信息查询</title>
    <script src="js/jquery-3.2.1.js"></script>
</head>
<style>
    html,body{margin:0px;padding:0px;}
    #course_name{display:block;width:100%;height:50px;background-color:#000000;text-align:center;line-height:80px;}
    #course_name span{font-size:25px;color:#f9f9f9;margin-right:25%;position:absolute;}
    #select_course{margin:20px;height:25px;text-align:center;margin-top:20px;margin-left:160px;}
    #menuselect{display:block;width:100%;height:60px;margin: 0px;background-color:#000000;
        text-align:center;padding:0px;line-height:85px;}
    #menuselect ul{background-color:#000000;margin:0px;display:block;padding:0px;}
    .showa{font-size: 20px;color: #fffdfc;}
    ul li{list-style-type:none;display:inline;margin:7%;}
    #menusure{display:block;width:100%;height:80px;background-color:#E6F5FF;text-align:center;line-height:80px;}
    #menusure span{font-size:18px;}
    #select-class{margin:10px;}
</style>
<body>
<div id="course_name">
    <span>选择课程</span>
    <select id="select_course" onChange = "getcourse()">
        <option value="请选择" selected></option>
        <?php
        $userid = $_SESSION['userid'];
        $find_course = "SELECT courseId,courseName FROM basic_relation WHERE userId=$userid";

        $set=mysqli_query($db,$find_course);
        while($row=mysqli_fetch_assoc($set)){
            echo "<option value='".$row['courseName']."'>".$row['courseName']."</option>";
        }
        mysqli_close($db);?>
    </select>
</div>
<div id="menuselect">
    <ul>
        <li> <a href="#" class="showa" id="showaone" onclick="searchdate()">按日期查询</a></li>
        <li> <a href="#" class="showa" id="showatwo" onclick="searchclass()">按班级查询</a></li>
    </ul>
</div>
<div id="menusure">
    <span>选择日期</span>
    <select id="select-class" onChange = "attendance_data()">
        <option>国贸</option>
        <option>计科</option>
    </select>
</div>
<div id="showdata">

</div>
</body>
<script>
    var userId=session.getAttribute("userID").toString(); //返回班级名称字符串，以,隔开
    var date_array=new Array();
    var class_array=new Array();
    function getcourse(){
        var obj = document.getElementById("select_course");
        var index = obj.selectedIndex;
        if (obj.options[index].value != "请选择") {
        $.ajax({
            type:"POST",
            url:"attendance.php",
            data:{userId:<?php echo $_SESSION['userid'];?>},selected_course:obj.options[index].value},
            dataType:"json",
            success:function(data) {   //返回一个json数组，数组中分别包含班级和日期两个数组
                date_array=data.search_date;
                class_array=data.search_class;
            }
        })
    }
    }
    function searchdate()
    {
        $("#menusure span").html("");
        $("#menusure span").html("选择日期");
        $("#select-class").html("");
        for(var i=0;i<date_array.length;i++)
        {
            $("#select-class").append("<opotion value='"+date_array[i]+"'>"+date_array[i]+"</opotion>");
        }
        $("#select-class").append("<opotion value=\"请选择\" selected>选择日期</opotion>");
    }
    function searchclass(){
        $("#menusure span").html("");
        $("#menusure span").html("选择班级");
        $("#select-class").html("");
        for(var i=0;i<class_array.length;i++)
        {
            $("#select-class").append("<opotion value='"+class_array[i]+"'>"+class_array[i]+"</opotion>");
        }
        $("#select-class").append("<opotion value=\"请选择\" selected>选择班级</opotion>");
    }
    function attendance_data() {
        var search = $("#menusure span").html();  //获取当前标签值
        var obj = document.getElementById("select_class");
        var index = obj.selectedIndex;
        if (search == "选择日期") {
            if (obj.options[index].value !="请选择") {
                $.ajax({
                    type: "POST",
                    url: "attendance.php",
                    data: {search: search, select_date: obj.options[index].value,userId:<?php echo $_SESSION['userid'];?>},selected_course:obj.options[index].value},
                    dataType: "json",
                    success: function (data) {   //返回数据为班级名、其具体点名时间和缺勤绿
                        var h = "<table id=tb>";
                        for (var i = 0; i < data.length; i++) {
                            h += "<tr>";
                            h += "<td>" + data[i].class_name + "</td>" + "<td>" + data[i].call_time + "</td>" + "<td>" + data[i].attendance_rate_ave + "</td>";
                            h += "</tr>"
                        }
                        h += "</table>";
                        document.getElementById("showdata").innerHTML = h;
                    }
                })

            }
        }
        else if (search == "选择班级") {
            if (obj.options[index].value != -1) {
                $.ajax({
                    type: "POST",
                    url: "attendance.php",
                    data: {search: search, select_class: obj.options[index].value,userId:<?php echo $_SESSION['userid'];?>},selected_course:obj.options[index].value},
                    dataType: "json",
                    success: function (data) {    //返回数据为学号，学生，点名几次，实到几次，总缺勤率
                        var h="";
                        if(data.length>0) {
                            h+= "<table id=tb>";
                            for (var i = 0; i < data.length; i++) {
                                h += "<tr>";
                                h += "<td>" + data[i].student_number + "</td>" + "<td>" + data[i].student_name + "</td>" + "<td>" + data[i].call_number + "</td>" +
                                    "<td>" + data[i].come_number + "</td>" + data[i].attendance_rate_sum + "</td>";
                                h += "</tr>"
                            }
                            h += "</table>";
                        }
                        else{
                            h="<span>+该班该课程未点过名</span>";
                        }
                        document.getElementById("showdata").innerHTML = h;
                    }
                })
            }
        }
        else {
        }
    }

</script>
</html>