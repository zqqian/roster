<?php
require_once 'get_user_info.php';
//用于检测是否登录，测试本页面时可暂时屏蔽以下几行php代码
//if(!$is_login){
//    echo "<script> alert('Please login...');parent.location.href='./index.php'; </script>";
// }
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
<style type="text/css">
    body,html {
        margin: 0;
        padding: 0;
    }
    .up{
        height:130px;width:100%;background-color:#000000;
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
</style>
</head>
<body>
<div class="up">
    <!--课程名及班级容器-->
    <div id="select">
        <span>选择课程名</span>
        <select id="select_course_name" onChange = "getclass()">
<!--            <option>c++</option>-->
<!--            <option>图形学</option>-->
        </select>
    </div>
    <div id="class">
        <div id="spand">
            <span>选择班级</span>
        </div>
        <div id="select_class_name">
            <ul>
                <li><input type="checkbox" value="hdw">弧度无</li>
                <li><input type="checkbox" value="hdw">觉得</li>
                <li><input type="checkbox" value="hdw">euyyd</li>
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
                    alert("请求成功");
                    if (data.status == 1)             //返回课程名，以json数组的形式返回，class_name及对应的班级名
                    {
                        for (var i = 0; i < data.length; i++) {
                            class_name_array[i] = data[i];
                            class_name_array[i] = new Array();
                            for (var j = 0; j < data[i].length; j++) {
                                class_name_array[i][j] = data[i][j].name;
                            }
                        }
                        for (var i = 0; i < class_name_array.length; i++) {
                            $("#select_course_name").append("<opotion value='" + class_name_array[i] + "'>" + class_name_array[i] + "</opotion>");
                        }
                        $("#select_course_name").append("<opotion value=\"-1\">选择课程</opotion>");
                    }
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
            $.ajax({         //返回给后台选中的课程名和班级名返回数据
                type: "POST",
                url: "data-analyse.php",
                data: {selected_course: selected_course, select_class: select_class},
                dataType: "json",
                success: function (data) {
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