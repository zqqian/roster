<?php
//require_once 'get_user_info.php';
//?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>数据分析</title>
</head>
<script src="js/Echarts/echarts.js"></script>
<script src="js/jquery-3.2.1.js"></script>
<script src="js/layer/layer.js"></script>
<link rel="stylesheet" href="style/button_one.css">
<link href='http://cdn.webfont.youziku.com/webfonts/nomal/107666/45803/59b53c8df629d81184f0b959.css' rel='stylesheet' type='text/css' />
<style type="text/css">
    body,html {
        margin: 0;
        padding: 0;
    }
    .up{
        height:190px;width:100%;
    }
    #select span{font-size:30px;}
    #select{border-bottom:1px solid #92A1AC;width:100%;min-height:80px;height:auto;line-height:80px;text-align:center;margin-left:20px;}
    #class{float:left;min-height:80px;height:auto;text-align:center;}
    #spand{position:absolute;font-size:20px;float:left;width:20%;height:80px;margin-left:0px;text-align:center;
        white-space: normal !important;//正常，自动换行
        -webkit-line-clamp: auto;//auto表示自动换行，数字表示指定行数
        line-height:80px;}
    #spand span{font-size:26px;display:block;margin-top:20px;}
    #select_class_name{position:absolute;float:left;height:80px;width:70%;margin-left:10%;text-align:center;line-height:80px;}
    #buttonsure{float:left;position:absolute;height:80px;width:10%;text-align:center;line-height:60px;margin-left:90%;}
    #verify-bu1{width:57px;height:30px;margin-top:25px;margin-left:2px;}
    #select_course_name{
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
    .li-style{list-style-type:none;display:inline;margin:4px;}
    @-moz-keyframes dothabottomcheck {
        0% {
            height: 0;
        }

        100% {
            height: 30px;
        }
    }
    @-webkit-keyframes dothabottomcheck {
        0% {
            height: 0;
        }

        100% {
            height: 30px;
        }
    }
    @keyframes dothabottomcheck {
        0% {
            height: 0;
        }

        100% {
            height:17px;
            /*第一条对勾长度*/
        }
    }
    @keyframes dothatopcheck {
        0% {
            height: 0;
        }

        50% {
            height: 0;
        }

        100% {
            height: 25px;
            /*另一条对勾的长度*/
        }
    }
    @-webkit-keyframes dothatopcheck {
        0% {
            height: 0;
        }

        50% {
            height: 0;
        }

        100% {
            height: 60px;
        }
    }
    @-moz-keyframes dothatopcheck {
        0% {
            height: 0;
        }

        50% {
            height: 0;
        }
        100% {
            height: 60px;
        }
    }
    input[type=checkbox] {
        display: none;
    }
    .check-box {
        height: 20px;
        width: 20px;
        background-color: transparent;
        border: 1px solid black;
        border-radius: 5px;
        position: relative;
        display: inline-block;
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        -moz-transition: border-color ease 0.2s;
        -o-transition: border-color ease 0.2s;
        -webkit-transition: border-color ease 0.2s;
        transition: border-color ease 0.2s;
        cursor: pointer;
    }
    .check-box::before, .check-box::after {
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        position: absolute;
        height: 0;
        width: 2px;
        background-color: #34b93d;
        display: inline-block;
        -moz-transform-origin: left top;
        -ms-transform-origin: left top;
        -o-transform-origin: left top;
        -webkit-transform-origin: left top;
        transform-origin: left top;
        border-radius: 5px;
        content: ' ';
        -webkit-transition: opacity ease .5;
        -moz-transition: opacity ease .5;
        transition: opacity ease .5;
    }
    .check-box::before {
        top: 17px;
        left: 7px;
        /*另一条对勾相对第一条的距离*/
        -moz-transform: rotate(-135deg);
        -ms-transform: rotate(-135deg);
        -o-transform: rotate(-135deg);
        -webkit-transform: rotate(-135deg);
        transform: rotate(-135deg);
    }
    .check-box::after {
        top:5px;
        left: -5px;
        /*第一条对勾相对方框的距离*/
        -moz-transform: rotate(-45deg);
        -ms-transform: rotate(-45deg);
        -o-transform: rotate(-45deg);
        -webkit-transform: rotate(-45deg);
        transform: rotate(-45deg);
    }
    input[type=checkbox]:checked + .check-box,
    .check-box.checked {
        border-color: #34b93d;
    }
    input[type=checkbox]:checked + .check-box::after,
    .check-box.checked::after {
        height: 0px;
        -moz-animation: dothabottomcheck 0.2s ease 0s forwards;
        -o-animation: dothabottomcheck 0.2s ease 0s forwards;
        -webkit-animation: dothabottomcheck 0.2s ease 0s forwards;
        animation: dothabottomcheck 0.2s ease 0s forwards;
    }
    input[type=checkbox]:checked + .check-box::before,
    .check-box.checked::before {
        height: 50px;
        -moz-animation: dothatopcheck 0.4s ease 0s forwards;
        -o-animation: dothatopcheck 0.4s ease 0s forwards;
        -webkit-animation: dothatopcheck 0.4s ease 0s forwards;
        animation: dothatopcheck 0.4s ease 0s forwards;
    }
    #select_course_name option{text-align:center;}
    #score_section{margin-top:70px;text-align:center;}
    #attendance_rate{margin-top:50px;text-align:center;}
</style>
</head>
<body>
<div class="up">
    <!--课程名及班级容器-->
    <div id="select">
        <span style="font-family:'LiDeBiao-Xing3d111dd2a91a492';" >选择课程名</span>
        <select  id="select_course_name" onchange="getclass()">

        </select>
    </div>
    <div id="class">
        <div id="spand">
            <span style="font-family:'LiDeBiao-Xing3d111dd2a91a492';" >选择班级</span>
        </div>
        <div id="select_class_name">
            <ul>

            </ul>
        </div>
        <div id="buttonsure">
            <input class="button_one white" style="font-family:'LiDeBiao-Xing3d111dd2a91a492';height:35px;width:80px;font-size:18px;"  type="button" id="verify-bu1"  value="确定"  onclick="show()"/>
        </div>
    </div>
</div>
<div class="down" id="canvasDiv">
    <!--画布-->
    <div id="score_section" style="width:700px;height:400px;"></div>
<!--    <div id="pass_rate"  style="width:700px;height:400px;"></div>-->
    <div id="attendance_rate"  style="width:700px;height:400px;"></div>
</div>
<script type="text/javascript">
</script>
</body>
<script>
        var option_score_section = {
            title: {
                text: '班级成绩段占百分比',
                subtext: '本学期成绩',
                x: 'center'
            },
            tooltip: {
                trigger: 'axis'
            },
            legend: {
                data: []
            },
            toolbox: {
                show: true,
                feature: {
                    mark: {show: true},
                    dataView: {show: true, readOnly: false},
                    magicType: {show: true, type: ['line', 'bar']},
                    restore: {show: true},
                    saveAsImage: {show: true}
                }
            },
            calculable: true,
            xAxis: [
                {
                    type: 'category',
                    data: ['0-60分', '60-69分', '70-79分', '80-89分', '90-100分']
                }
            ],
            yAxis: [
                {
                    type: 'value'
                }
            ],
            series: []
        };
        var Chart_score_section = echarts.init(document.getElementById('score_section'));
        Chart_score_section.setOption(option_score_section);
        Chart_score_section.showLoading();
        //出勤率
        var option_attendance_rate = {
            title: {
                text: '点名平均出勤率',
                subtext: '本学期',
                x: 'center'
            },
            tooltip: {
                trigger: 'axis'
            },
            legend: {},
            toolbox: {
                show: true,
                feature: {
                    mark: {show: true},
                    dataView: {show: true, readOnly: false},
                    magicType: {show: true, type: ['line', 'bar']},
                    restore: {show: true},
                    saveAsImage: {show: true}
                }
            },
            calculable: true,
            xAxis: [
                {
                    type: 'category',
                    boundaryGap: false,
                }
            ],
            yAxis: [
                {
                    type: 'value',
                    axisLabel: {
                        formatter: '{value}'
                    }
                }
            ],
            series: []
        };
        var Chart_attendance_rate = echarts.init(document.getElementById('attendance_rate'));
        //使用制定的配置项和数据显示图表
        Chart_attendance_rate.setOption(option_attendance_rate);
        Chart_attendance_rate.showLoading();    //数据加载完之前先显示一段简单的loading动画
        var score_percent = new Array;
        var score_pass_rate = new Array;
        var attendance_rate = new Array;
//        用户数据
//        var userId = session.getAttribute("userID").toString(); //取出后台存入session的值用户Idvar
        var id_number = 1;
        var course_name = "course-name";
        var course_name_array = new Array();
        var class_name_array = new Array();
//        alert("请求前");
        $(document).ready(function() {
//            alert("请求后");
            $.ajax({
                type: "POST",
                url: "data-analyse.php",
                data: {select:""},
                dataType: "json",
                success: function (data) {
                      for (var i = 0; i < data.length; i++) {
                            course_name_array[i] = data[i].coursename;
                            class_name_array[i]=new Array();
                            for (var j = 0; j < data[i].classname.length; j++) {
                                class_name_array[i][j] = data[i].classname[j];
                            }
                        }
                    var appendstr="";
                       $("#select_course_name").append("<option value='选择课程'>选择课程</option>");
                        for (var i = 0; i < course_name_array.length; i++) {
                         appendstr +="<option value='"+course_name_array[i] +"'>"+course_name_array[i]+"</option>";
                        }
//                        alert(appendstr);
                        $("#select_course_name").append(appendstr);
                }
            })
        })
    function getclass(){
        var obj = document.getElementById("select_course_name");
        var index = obj.selectedIndex;
        if (obj.options[index].value != -1) {
            if ($("#select_class_name") != "") {
                $("#select_class_name").html("");
            }
            index=index-1;
            var classed_name="";
            var indexright="index";
            for (var i = 0; i < class_name_array[index].length; i++) {
                indexright+=i;
                 classed_name +=" <li>" +
                     class_name_array[index][i]+
                     "<input type='checkbox' name='box' value='"+class_name_array[index][i]+"' id='"+indexright+"'/> <label for='"+indexright+"'class='check-box'></label> </li>";
            }
            $("#select_class_name").append(classed_name);
            $("li").addClass("li-style");
        }
    }
    var select_class = new Array();
    function show(){
        var selected_course =$('#select_course_name option:selected') .val();//选中的值
        var j = 0;
        var select_checkbox = document.getElementsByName("box");
        for (var i = 0; i < select_checkbox.length; i++) {
            if (select_checkbox[i].checked == true) {
                select_class[j] = select_checkbox[i].value;
                j++;
            }
        }
        if(selected_course=="选择课程")
        {
//            alert("请选择课程！");
            layer.alert('请选择课程！', {
                icon: 5,
                skin: 'layer-ext-moon' //该皮肤由layer.seaning.com友情扩展。关于皮肤的扩展规则，去这里查阅
            })
        }
        else if(select_class.length==0) {
//            alert("请选择班级！");
            layer.alert('请选择班级！', {
                icon: 5,
                skin: 'layer-ext-moon' //该皮肤由layer.seaning.com友情扩展。关于皮肤的扩展规则，去这里查阅
            })
        }
        else {
//            alert("请求数据");
//            alert(selected_course);
            var select_xinxi='{"' ;
            for(var i=0;i<select_class.length;i++)
            {
                var classnum="class"+i;
                select_xinxi+=
                    classnum +
                    '":"' +
                    select_class[i] +
                    '","';
            }
            select_xinxi+='course":"' +
                selected_course +
                '"}';
            var bToObj=JSON.parse(select_xinxi);
            $.post("data-analyse.php",{select:bToObj},function (data){
                    data=JSON.parse(data);
                    var series_score_section = [];
                    var series_pass_rate = [];
                    for (var i = 0; i < data.length; i++) {
                        series_score_section.push({
                            name: select_class[i],
                            data: data[i].score_percent,
                            type: 'bar',
                            markPoint: {
                                data: [
                                    {type: 'max', name: '最大值'},
                                    {type: 'min', name: '最小值'}
                                ]
                            },
                            markLine: {
                                data: [
                                    {type: 'average', name: '平均值'}
                                ]
                            }
                        });
//                        series_pass_rate.push({
//                            name: select_class[i],
//                            data: data[i].score_pass_rate,
//                            type: 'bar',
//                            markPoint: {
//                                data: [
//                                    {type: 'max', name: '最大值'},
//                                    {type: 'min', name: '最小值'}
//                                ]
//                            },
//                            markLine: {
//                                data: [
//                                    {type: 'average', name: '平均值'}
//                                ]
//                            }
//                        })
//                        series_pass_rate.push({
//                            type: 'pie',
//                            radius: radius,
//                            itemStyle: labelFromatter,
//                            center: [centerx, centery],
//                            x: x, // for funnel
//                            y: positiony,
//                            data: [
//                                {name: 'other', value:(100-Number(data[i].score_pass_rate)).toString(), itemStyle: labelBottom},
//                                {name: select_class[i], value:data[i].score_pass_rate, itemStyle: labelTop}
//                            ]
//                        })
                    }
                    Chart_score_section.hideLoading();
                    Chart_score_section.setOption({
                        series: series_score_section
                    });
//                    出勤率是折线图
                    var series_attendance_rate = [];
                    var xAxis_attendance_rate = [];
                    for (var i = 0; i < data.length; i++) {
                        series_attendance_rate.push({
                            name: select_class[i],
                            data: data[i].attendance_rate ,
                            type: 'bar',
                            markPoint: {
                                data: [
                                    {type: 'max', name: '最大值'},
                                    {type: 'min', name: '最小值'}
                                ]
                            },
                            markLine: {
                                data: [
                                    {type: 'average', name: '平均值'}
                                ]
                            }
                        })
//                        series_pass_rate.push({
//                            name: select_class[i],
//                            data: data[i].score_pass_rate ,
//                            type: 'bar',
//                            markPoint: {
//                                data: [
//                                    {type: 'max', name: '最大值'},
//                                    {type: 'min', name: '最小值'}
//                                ]
//                            },
//                            markLine: {
//                                data: [
//                                    {type: 'average', name: '平均值'}
//                                ]
//                            }
//                        })
                    }
                    xAxis_attendance_rate.push({
                        data: data[0].attendance_date,
                    })
                    Chart_attendance_rate.hideLoading();
                    Chart_attendance_rate.setOption({
                        series: series_attendance_rate,
                        xAxis: xAxis_attendance_rate
                    })
//                Chart_pass_rate.hideLoading();
//                Chart_pass_rate.setOption({series: series_pass_rate,  xAxis:select_class});
                })
        }
    }
   //    图表随容器自适应
//    var worldMapContainer1 = document.getElementById('score_section');
//    var worldMapContainer2 = document.getElementById('pass_rate');
//    var worldMapContainer3 = document.getElementById('attendance_rate');
//    var Chart_score_section = echarts.init(worldMapContainer1);
//    var Chart_pass_rate = echarts.init(worldMapContainer2);
//    var Chart_attendance_rate = echarts.init(worldMapContainer3);
//    window.onresize = function () {
//        Chart_attendance_rate.resize();
//        Chart_pass_rate.resize();
//        Chart_score_section.resize();
//    }
</script>
</html>