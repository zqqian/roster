<?php
require_once 'get_user_info.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>数据分析</title>
</head>
<script src="js/Echarts/echarts.js"></script>
<script src="js/jquery-3.2.1.js"></script>
<link rel="stylesheet" href="style/button_one.css">
<script type="text/javascript" src="checkbox.js"></script>
<style type="text/css">
    body,html {
        margin: 0;
        padding: 0;
    }
    .up{
        height:130px;width:100%;background-color:#953b39;
    }
    #select{width:100%;height:70px;}
    #select span{color:#fbf9ee;font-size:20px;margin-left:40%;}
    #select_course_name{margin-left:50px;height:23px;position:absolute;margin-top:25px;}
    #select{border-bottom:1px solid #fbf9ee;width:100%;height:70px;line-height:70px;}
    #class{float:left;}
    #spand{float:left;width:15%;position:absolute;}
    #select_class_name{float:left;width:70%;position:absolute;margin-left:15%;text-align:center;line-height:30px;}
    #buttonsure{float:left;width:15%;position:absolute;margin-left:85%;text-align:center;}
    #spand span{display:block;font-size:17px;margin-top:16px;margin-left:30px;color:#fbf9ee;margin-left:30px;}
    ul li{color:#E6F5FF;list-style-type:none;display:inline;margin:4px;}
    #buttonsure input{display:block;margin-top:18px;float:right;margin-right:30px;}
    #verify-bu1{width:57px;height:30px;}
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
    #select span {
        color: #999;
        font-size: 20px;
        margin-left: 40%;
        width: 219px;
        height: 54px;
        text-align: center;
        padding-left: 22px;
        line-height: 54px;
        position: relative;
        left: -33px;
    }
</style>
<script type="text/javascript" src="checkbox.js"></script>
<link rel="stylesheet" type="text/css" href="css/style1.css" />
<script src="js/modernizr.custom.63321.js"></script>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.dropdown.js"></script>
</head>
<body>
<div class="up">
    <!--课程名及班级容器-->
    <div id="select">
        <span>选择课程名</span>
        <select id="select_course_name" onChange = "getclass()">

        </select>
<!--        <select id="cd-dropdown" name="cd-dropdown" class="cd-select" onChange = "getclass()" >-->
<!--            <option value="-1" selected>树莓</option>-->
<!--            <option value="1" >计科</option>-->
<!--            <option value="2">国贸</option>-->
<!--            <option value="3" >体育</option>-->
<!--        </select>-->
    </div>
    <div id="class">
        <div id="spand">
            <span>选择班级</span>
        </div>
        <div id="select_class_name">
<!--                        <ul>-->
<!--                            <li><input type="checkbox" value="hdw">弧度无</li>-->
<!--                            <li><input type="checkbox" value="hdw">觉得</li>-->
<!--                            <li><input type="checkbox" value="hdw">euyyd</li>-->
<!--                        </ul>-->
            <ul>
            <li>计科<input type="checkbox" id="classname_two" />
            <label for="classname_two" class="check-box"></label>
            </li>
            <li>树莓<input type="checkbox" id="classname_one" />
                    <label for="classname_one" class="check-box"></label>
             </li>
            </ul>
        </div>
        <div id="buttonsure">
            <input class="button_one white" type="button" id="verify-bu1"  value="确定"  onclick="show()"/>
        </div>
    </div>
</div>
<div class="down" id="canvasDiv">
    <!--画布-->
    <div id="score_section" style="width:700px;height:400px;"></div>
    <div id="pass_rate"  style="width:700px;height:400px;"></div>
    <div id="attendance_rate"  style="width:700px;height:400px;"></div>
</div>
</body>
<!--<script>-->
<!--</script>-->
<script>
    $( '#cd-dropdown' ).dropdown( {
        gutter : 5
    } );
//        图表，for循环中重新设置
//        成绩段
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
        //及格率
        var labelTop = {
            normal: {
                label: {
                    show: true,
                    position: 'center',
                    formatter: '{b}',
                    textStyle: {
                        baseline: 'bottom'
                    }
                },
                labelLine: {
                    show: true
                }
            }
        };
        var labelFromatter = {
            normal: {
                label: {

                    formatter: function (params) {
                        return 100 - params.value + '%'
                    },
                    textStyle: {
                        baseline: 'top'
                    }
                }
            },
        }
        var labelBottom = {
            normal: {
                color: '#ccc',
                label: {
                    show: true,
                    position: 'center'
                },
                labelLine: {
                    show: true
                }
            },
            emphasis: {
                color: 'rgba(0,0,0,0)'
            }
        };
        var radius = [40, 55];
        var option_pass_rate = {
            title: {
                text: '班级及格率',
                subtext: '本学期',
                x: 'center'
            },
            toolbox: {
                show: true,
                feature: {
                    dataView: {show: true, readOnly: false},
                    magicType: {
                        show: true,
                        type: ['pie', 'funnel'],
                        option: {
                            funnel: {
                                width: '20%',
                                height: '30%',
                                itemStyle: {
                                    normal: {
                                        label: {
                                            formatter: function (params) {
                                                return 'other\n' + params.value + '%\n'
                                            },
                                            textStyle: {
                                                baseline: 'middle'
                                            }
                                        }
                                    },
                                }
                            }
                        }
                    },
                    restore: {show: true},
                    saveAsImage: {show: true}
                }
            },
            series: []
        };
        var Chart_pass_rate = echarts.init(document.getElementById('pass_rate'));
        Chart_pass_rate.setOption(option_pass_rate);
        Chart_pass_rate.showLoading();    //数据加载完之前先显示一段简单的loading动画
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
                        formatter: '{value} °C'
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
        var class_name_array = new Array();
        alert("请求前");
        $(document).ready(function() {
            alert("请求后");
            $.ajax({
                type: "POST",
                url: "data-analyse.php",
                data: {},
                dataType: "json",
                success: function (data) {
                      for (var i = 0; i < data.length; i++) {
                            class_name_array[i] = data[i].course_name;
                            class_name_array[i] = new Array();
                            for (var j = 0; j < data[i].class-name.length; j++) {
                                class_name_array[i][j] = data[i].class_name[j];
                            }
                        }
                    alert("显示数据");
                    alert(class_name_array.length);
                    alert(class_name_array[0].length);
                        for (var i = 0; i < class_name_array.length; i++) {
                        var appendstr="<option value='"+class_name_array[i] +"'>"+class_name_array[i]+"</option>";}

                        $("#select_course_name").append(appendstr);
                        $("#select_course_name").append("<opotion value=\"-1\">选择课程</opotion>");
        }
            })
        })
        alert("末尾");
    function getclass(){
        var obj = document.getElementById("select_course_name");
        var index = obj.selectedIndex;
        if (obj.options[index].value != -1) {
            if ($("#select_class_name") != "") {
                $("#select_class_name").html("");
            }
            for (var i = 0; i < class_name_array[index].length; i++) {
                $("#select_class_name").append("class_name_array[index][i]+<input type='checkbox' name='box' value='" + class_name_array[index][i] + "'>");
            }
        }
    }
    var select_class = new Array();
    alert("显示数据前");
    function show(){
        alert("显示数据");
        var selected_course = $('#select_course_name option:selected').value;
        alert(sxelected_course);
        var j = 0;
        var select_checkbox = document.getElementsByName("box");
        for (var i = 0; i < select_checkbox.length; i++) {
            if (select_checkbox.checked == true) {
                select_class[j] = select_checkbox.value;
                j++;
            }
        }
        if(selected_course=="选择课程")
        {
            alert("请选择课程！");
        }
        else if(select_class.length< 0) {
            alert("请选择班级！");
        }
        else {
            alert("请求数据");
            $.ajax({         //返回给后台选中的课程名和班级名返回数据
                type: "POST",
                url: "data-analyse.php",
                data: {selected_course: selected_course, select_class: select_class},
                dataType: "json",
//                async: false,
                success: function (data) {
                    alert("数据请求成功");
                    var numi = 0;
                    var x = 0;
                    var centerx = 0.1;
                    var centery = 0.3;
                    var positiony = 0;
                    var series_score_section = [];
                    var series_pass_rate = [];
                    for (var i = 0; i < data.length; i++) {
                        numi++;
                        centerx += 0.2;
                        x += 0.2;
                        if (numi % 6 == 0) {
                            centery += 0.4;
                            positiony = 0.55;
                            x = 0;
                            centerx = 0.1;
                        }
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

                        series_pass_rate.push({
                            type: 'pie',
                            radius: radius,
                            itemStyle: labelFromatter,
                            center: [centerx, centery],
                            x: x, // for funnel
                            y: positiony,
                            data: [
                                {name: 'other', value: 100 - data[i].score_pass_rate, itemStyle: labelBottom},
                                {name: select_class[i], value: data[i].score_pass_rate, itemStyle: labelTop}
                            ]
                        })
                    }
                    Chart_score_section.setOption({
                        series: series_score_section
                    });
                    Chart_pass_rate.setOption({series: series_pass_rate});
                    Chart_pass_rate.showLoading();
                    //出勤率是折线图
                    var series_attendance_rate = [];
                    var xAxis_attendance_rate = [];
                    for (var i = 0; i < data.length; i++) {
                        series_attendance_rate.push({
                            name: select_class[i],
                            data: data[i].attendance_rate,
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
                    }
                    xAxis_attendance_rate.push({
                        data: data[0].attendance_date,
                    })
                    Chart_attendance_rate.setOption({
                        series: series_attendance_rate,
                        xAxis: xAxis_attendance_rate
                    })
                    Chart_attendance_rate.showLoading();
                }
            })
        }
    }
   //    图表随容器自适应
    var worldMapContainer1 = document.getElementById('score_section');
    var worldMapContainer2 = document.getElementById('pass_rate');
    var worldMapContainer3 = document.getElementById('attendance_rate');
    var Chart_score_section = echarts.init(worldMapContainer1);
    var Chart_pass_rate = echarts.init(worldMapContainer2);
    var Chart_attendance_rate = echarts.init(worldMapContainer3);
    window.onresize = function () {
        Chart_attendance_rate.resize();
        Chart_pass_rate.resize();
        Chart_score_section.resize();
    }
</script>
</html>