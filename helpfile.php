<?php
require_once 'get_user_info.php';
//用于检测是否登录，测试本页面时可暂时屏蔽以下几行php代码
if(!$is_login){
    echo "<script> alert('Please login...');parent.location.href='./index.php'; </script>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <script src="js/jquery-3.2.1.js" ></script>
    <title></title>
    <style>
        *{margin: 0; padding: 0;}
        ul,li{list-style: none;}
        .container{perspective: 1300px;-webkit-perspective:1300px;}
        #boxList{position:absolute;width: 500px;height:500px;left:50%;margin-left:-315px; -webkit-transform-style: preserve-3d;transform-style: preserve-3d;
            /*animation: a1 2s 1;*/transition: all 2s;}
        #odd1 {float: left;width: 150px;height: 150px;margin-left:10px;background:#00bafa;-webkit-transition: all 0.3s;transition: all 0.3s;}
        #odd2 {float: left;width: 150px;height: 150px;margin-left:160px;background:#00bafa;-webkit-transition: all 0.3s;transition: all 0.3s;}
        #odd3 {float: left;width: 150px;height: 150px;margin-left:10px;background:#00bafa;-webkit-transition: all 0.3s;transition: all 0.3s;}
        #odd4 {float: left;width: 150px;height: 150px;margin-left:160px;background:#00bafa;-webkit-transition: all 0.3s;transition: all 0.3s;}
        #even {float: left;width: 150px;height: 150px;margin-left:165px;margin-right:165px;background:#92A1AC;-webkit-transition: all 0.3s;transition: all 0.3s;}
        .on li:hover{-webkit-transform: translate3d(0,0,30px);transform: translate3d(0,0,30px);background:deepskyblue;box-shadow: 30px 30px 10px rgba(0, 0, 0, 0.5);}
        .on{webkit-transform: rotateX(75deg) rotateY(0deg) rotateZ(45deg);transform: rotateX(75deg) rotateY(0deg) rotateZ(45deg);}
    </style>
    <style>
        #boxList a{
            font-size:20px;
            text-align: center;
            line-height:150px;
            text-transform: uppercase;
            line-height:150px;
            padding:50px;
            color: #EEE;
            animation: rotate 2s ease-in-out alternate infinite;
        }
        #odd1 a, #odd3 a{padding:30px;}
        @keyframes rotate {
            from {
                trasform: rotateY(-10deg);
                text-shadow:  1px -1px #CCC,
                2px -1px #BBB,
                3px -2px #AAA,
                4px -2px #999,
                5px -3px #888,
                6px -3px #777;
            }
            to {
                transform: rotateY(10deg);
                text-shadow:  -1px -1px #CCC,
                -2px -1px #BBB,
                -3px -2px #AAA,
                -4px -2px #999,
                -5px -3px #888,
                -6px -3px #777;
            }
        }
    </style>
    <style>
        #help_text{border:2px solid #000000;border-radius:10px;height:200px;width:94%;clear:both;position:absolute;margin-top:500px;margin-left:3%;margin-right:3%;}
        #nav{height:200px;width:100px;margin-left:15px;border-right:2px solid #fffdfc;}
        #text{height:180px;width:auto;margin-left:130px;margin-right:15px;margin-top:-190px;}
        span{display:none;color:#000000;font-size:14px;font-family: "Courier New", Courier, mono;padding-top:20px;
            padding-left:15px;padding-right:10px; }
        #dao,#dianming,#chengji,#shuju,#bangzhu {
            display: block;
            padding-top:50px;
            /*padding-left:-30px;*/
            padding-right:20px;
        }
        #nav{border-right:1px solid #000000;}
        #nav li{
            display:block;
            width:60px;
            height:30px;
            text-align: center;
            background-color:  #92A1AC;
            margin-left:20px;
            /*border:2px dotted #002DFF;*/
            margin-top:10px;
            border-radius:15px;
        }
        #nav a{
            color:#000000;
            text-align: center;
            line-height:30px;
            font-size: 15px;
            font-family: "Courier New", Courier, mono;
            font-kerning: auto;
        }
        #nav li:hover{
            background-color: #92A1AC;
            border:1px solid #000000;
            border-radius:15px;
        }
        .select{
            background-color:#000000;
            border:2px dotted #92A1AC;
        }
        #nav a:hover{
            color:#ffffff;
        }
        #dianming,#chengji,#shuju,#bangzhu{display:none;}
        .container{display:block;margin-left:150px;}
    </style>
</head>
<body>
<div class="container">
    <ul id="boxList">
        <li id="odd1" class="subs"><a data-shadow="导入导出">导入导出</a></li>
        <li id="odd2" class="subs"><a data-shadow="点名">点名</a></li>
        <li id="even" class="subs"><a data-shadow="成绩">成绩</a></li>
        <li id="odd3" class="subs"><a data-shadow="数据分析">数据分析</a></li>
        <li id="odd4" class="subs"><a data-shadow="帮助">帮助</a></li>
    </ul>
</div>
<div id="help_text">
    <div id="nav">
        <ul id="dao">
            <li id='odd11' class="select"><a>导入</a></li>
            <li id='odd12'  class="select"><a>导出</a></li>
        </ul>
        <ul id="dianming">
            <li id='odd21'  class="select"><a>自动点名</a></li>
            <li id='odd22'  class="select"><a>手动点名</a></li>
        </ul>
        <ul id="chengji">
            <li id='even1'  class="select"><a>成绩录入</a></li>
            <li id='even2'  class="select"><a>成绩查询</a></li>
        </ul>
        <ul id="shuju">
            <li id='odd31'  class="select"><a>数据分析</a></li>
        </ul>
        <ul id="bangzhu">
            <li id='odd41'  class="select"><a>帮助</a></li>
        </ul>
    </div>
    <div id="text">
        <span id="text1">&nbsp;&nbsp;在使用该网站前选择一张班级名单以excel表的形式导入，班级名单中包括学生学号和姓名信息。</span>
        <span id="text2">&nbsp;&nbsp;选择导出成绩名单还是点名信息名单，在每种形式中选择导出的班级及要导出的信息，以excel表的形式导出该班级所对应的成绩信息或点名信息。</span>
<span id="text3">&nbsp;&nbsp;选择自动点名功能，选择要点名的班级，在产生二维码页面，选择产生二维码，学生扫描二维码进入另一点名页面，老师判断大部分同学扫描完二维码后，
选择确定，进入验证码页面，选择生成验证码后，屏幕上产生验证码，每5秒钟更新一次，每个验证码有效时间为10秒，学生在学生的点名页面输入
验证码点击提交，提交后不限时间输入个人姓名和学号再次提交，老师结束点名后，在网页上显示该次点名信息，老师可根据学生是否点名成功手动编辑该点名信息，
    点击保存即为点名成功。</span>
        <span id="text4" >&nbsp;&nbsp;选择手动点名功能，选择要点名的班级，在页面中的班级信息名单中手动编辑学生的出勤情况，在到的学生后面打钩即为点名成功，点名完毕，点击保存即可。</span>
<span id="text5">&nbsp;&nbsp;选择成绩录入功能，在成绩录入选择对应课程名及班级名，设置平时成绩及期末成绩所占比重，然后选择录入平时成绩还是期末成绩。选择录入平时成绩时设置要录入
    的该项成绩名称及出勤率在平时成绩中所占比重，开始录入，在录入学生平时成绩页面录入每个同学的成绩，录入完毕保存成绩信息；选择录入期末成绩，在录入成绩页
    面输入学生期末成绩，点击下一个，录入完所有学生的期末成绩，点击保存。</span>
<span  id="text6">&nbsp;&nbsp;选择成绩查询功能，查询班级的详细成绩信息。在成绩查询页面选择要查询的班级，点击确定即显示该班所有同学的详细成绩信息，点击排序即可对该班级同学成绩按期
    末成绩升序或降序排列。</span>
<span  id="text7">&nbsp;&nbsp;选择数据分析功能分析分析每个班级及各个班级之间的成绩及点名情况。在数据分析界面选择要进行数据分析的单个或多个班级
    ，点击确定，即在当前界面显示该班级或多个班级的数据分析信息(每个成绩段各个班级所占人数、各班的最高分和最低分、各班期末成绩及格率、各班出勤率）。
</span>
        <span  id="text8">&nbsp;&nbsp;选择帮助功能，查阅该网站的功能使用说明。</span>
    </div>
</div>
</body>
<!--三D文字加旋转特效-->
<script>
    $("#text1").show();
    var list=document.querySelector('#boxList');
    window.onload=function(){
        setInterval(transition,500);
    }
    function transition() {
        list.className = 'on boxList';
    }
    $("#odd11").click(function(){
        $("#text span").hide();
        $("#text1").fadeIn(500);
    })
    $("#odd12").click(function(){
        $("#text span").hide();
        $("#text2").fadeIn(500);
    })
    $("#odd21").click(function(){
        $("#text span").hide();
        $("#text3").fadeIn(500);
    })
    $("#odd22").click(function(){
        $("#text span").hide();
        $("#text4").fadeIn(500);
    })
    $("#even1").click(function(){
        $("#text span").hide();
        $("#text5").fadeIn(500);
    })
    $("#even2").click(function(){
        $("#text span").hide();
        $("#text6").fadeIn(500);
    })
    $("#odd31").click(function(){
        $("#text span").hide();
        $("#text7").fadeIn(500);
    })
    $("#odd41").click(function(){
        $("#text span").hide();
        $("#text8").fadeIn(500);
    })
    $(".subs").click(function(){
        var ss=$(this).attr("id");
        $("#dao").hide();
        $("#dianming").hide();
        $("#chengji").hide();
        $("#shuju").hide();
        $("#bangzhu").hide();
        $("#text span").fadeOut(1000);
        if(ss=="odd1")
        {
            $("#dao").show();
        }
        else if(ss=="odd2")
        {
            $("#dianming").show();
        }
        else if(ss=="even")
        {
            $("#chengji").show();
        }
        else if(ss=="odd3")
        {
            $("#shuju").show();
        }
        else if(ss=="odd4") {
            $("#bangzhu").show();
        }
        else{}
    })
</script>
</html>
