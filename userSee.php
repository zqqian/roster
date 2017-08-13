<?php?>
<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="keywords" content="云点名系统">
    <meta name="description" content="云点名系统">
    <meta name="author" content="创意武装H5团队">
    <!--每30秒中刷新当前页面:<meta http-equiv="refresh" content="30">-->

    <title>云点名用户界面</title>
    <script src="js/jquery-3.2.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/npm.js"></script>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <style>
        /*为适应低版本的浏览器而设置的*/
        header, section, footer, aside, nav, main, article, figure {display: block;}
        html,body{margin:0;}
        .container{
            width: 100%;
            margin: 60px 0 0 0;
            height:500px;
            }

        #left {
            width: 12%;
            min-width: 180px;
            min-height: 420px;
            position: absolute;
            left: 0;
        }

        #right {
            width: -moz-available;
            height: 100%;
            padding: 0;
            min-width: 350px;
            min-height: 420px;
            position: absolute;
            left: 180px;
        }
    </style>
</head>
<body>
<div class="container" id="container">
    <div class="row clearfix">
        <div class="col-md-12 column">
            <!--导航栏开始-->
            <nav class="navbar navbar-default navbar-fixed-top navbar-inverse" role="navigation">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="userSee.php">云点名系统</a>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">


                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="#" ><?php session_start(); echo $_SESSION['username']; ?></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="margin-right: 50px;">用户设置<strong class="caret"></strong></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="#">修改用户信息</a>
                                </li>
                                <li>
                                    <a href="repassword.html" target="rightShow">修改用户密码</a>
                                </li>

                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
            <!--导航栏结束-->



             <!-- <div class="row clearfix" id="mainContainer"></div>-->
                    <div class="col-md-6 column" id="left">
                        <!--手风琴切换开始-->
                        <div class="panel-group" id="menu" style="margin-top:20px;">

                            <!-- 导入/导出 -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <a class="panel-title" data-toggle="collapse"
                                       data-parent="#menu" href="#panel1">导入/导出</a>
                                </div>
                                <div id="panel1" class="panel-collapse collapse collapse"><!--panel-collapse collapse in 表示默认面板打开-->
                                    <div class="panel-body">
                                        <a href="import.php" target="rightShow" id="import">导入学生名单</a>
                                    </div>
                                    <div class="panel-body">
                                        <a href="#" target="" id="export">导出学生成绩</a>
                                    </div>
                                </div>
                            </div>
                            <!-- 导入/导出 -->

                            <!-- 点名 -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <a class="panel-title" data-toggle="collapse"
                                       data-parent="#menu" href="#panel2">点名</a>
                                </div>
                                <div id="panel2" class="panel-collapse collapse collapse">
                                    <div class="panel-body">
                                        <a href="#" target="" id="import">自动点名</a>
                                    </div>
                                    <div class="panel-body">
                                        <a href="manuallcall.php" target="rightShow" id="import">手动点名</a>
                                    </div>
                                    <div class="panel-body">
                                        <a href="#" target="" id="export">点名信息查询</a>
                                    </div>
                                </div>
                            </div>
                            <!-- 点名 -->


                            <!-- 成绩 -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <a class="panel-title" data-toggle="collapse"
                                       data-parent="#menu" href="#panel3">成绩</a>
                                </div>
                                <div id="panel3" class="panel-collapse collapse collapse">
                                    <div class="panel-body">
                                        <a href="#" target="" id="import">成绩录入</a>
                                    </div>
                                    <div class="panel-body">
                                        <a href="#" target="" id="import">成绩查询</a>
                                    </div>

                                </div>
                            </div>
                            <!-- 成绩 -->

                            <!-- 数据分析 -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <a class="panel-title" data-toggle="collapse"
                                       data-parent="#menu">数据分析</a>
                                </div>
                            </div>
                            <!-- 数据分析 -->

                            <!-- 帮助 -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <a class="panel-title" data-toggle="collapse"
                                       data-parent="#menu">帮助</a>
                                </div>

                            </div>
                            <!-- 帮助 -->

                        </div>
                        <!--手风琴切换结束-->




                    </div>
                     <div class="col-md-6 column" id="right">
                         <iframe src="https://www.baidu.com/" name="rightShow" style="width:99.9%;height:99%;float:right;display:inline-block;margin:0 auto;"
                                   frameborder="no" align="center" seamless>
                             <p>您的浏览器不支持iframe 标签。</p>
                         </iframe>


                     </div>
        </div>
    </div>
</div>
<script>
    function auto(){
        //container的自适应
        var bodyHeight=document.documentElement.clientHeight;
        $("#container").height(bodyHeight-60);

        //left和right的自适应
        var temp=$("#container").height();

        if(temp>420){
            $("#left").height(temp);
            $("#right").height(temp);
        }
        else
        {   $("#left").height(420);
            $("#right").height(420);}
    }

    $(window).resize(function(){
       auto();
    });

    $(function(){
      auto();
    });
</script>
</body>
</html>