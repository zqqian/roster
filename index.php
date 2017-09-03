<?php
// require_once 'get_user_info.php';//主页未登录，无需判断是否登录
?>
<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="keywords" content="云点名系统">
    <meta name="description" content="云点名系统">
    <meta name="author" content="创意武装H5团队">
    <title>云点名系统主页</title>
    <script src="js/jquery-3.2.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/md5.js"></script>
    <script src="https://use.fontawesome.com/2957044126.js"></script>/*add awesome font */
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <style>
        /*为适应低版本的浏览器而设置的*/
        header, section, footer, aside, nav, main, article, figure {display: block;}
    </style>
</head>
<body>
<div class="container" style="margin: 70px auto;">
    <div class="row clearfix">
        <div class="col-md-12 column">
            <nav class="navbar navbar-default navbar-inverse navbar-fixed-top" role="navigation">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button> <a class="navbar-brand" href="index.php">云点名系统</a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a data-toggle="modal" href="#myModal" id="loginA">登录</a>
                            <!-- 模态框（Modal） -->
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times;</button>
                                            <center> <h4 class="modal-title" id="myModalLabel">登录</h4></center>
                                        </div>
                                            <div class="modal-body">
                                                <input type="text" class="form-control" id="userName" name="userName" placeholder="请输入用户名"><br>
                                                <input type="password" class="form-control" id="password" name="password" placeholder="请输入密码"><br>
                                                <span class="help-block" id="loginSpan" style="color:red;"></span><!--这里是帮助文本-->
                                                <center>
                                                    <label><input type="checkbox" id="rememberPwd" name="rememberPwd"> 记住密码</label>
                                                    <a href="find-password.php" name="forgetPwd">忘记密码</a>
                                                </center>
                                            </div>
                                            <div class="modal-footer">
                                                <center>
                                                    <button type="button" id="loginBtn"class="btn btn-primary"style="width:80px;">登录</button>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal"style="width:80px;">关闭</button>
                                                </center>
                                            </div>

                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <a data-toggle="modal" href="#myModal1" id="registerA" style="margin-right: 50px;">注册</a>
                            <!-- 模态框（Modal） -->
                            <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content" id="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <center><h4 class="modal-title" id="myModalLabel1">注册</h4></center>
                                        </div>


                                        <div class="modal-body" id="modal-body">
                                            <center><h1 id="registerShow">显示注册信息</h1></center>
                                            <div class="input-group" id="DuserName">
                                                <input type="text" class="form-control" id="RuserName" maxlength="20"
                                                        name="RuserName" placeholder="请输入用户名">
                                                <span class="input-group-addon" id="checkUsername">*</span>
                                            </div>
                                            <br>
                                            <input type="email" class="form-control" placeholder="请输入邮箱" maxlength="30"
                                                   id="email" name="email" style="margin-bottom:20px;">
                                            <input type="password" class="form-control" id="Rpassword1" maxlength="20"
                                                   name="Rpassword1" placeholder="请输入密码"><br>
                                            <input type="password" class="form-control" id="Rpassword2" maxlength="20"
                                                   name="Rpassword2" placeholder="请重复密码"><br>
                                            <input type="text" class="form-control" id="Rschool" maxlength="30"
                                                    name="Rschool" placeholder="请输入所属学校"><br>
                                            <input type="text" class="form-control" id="Racademy" maxlength="30"
                                                   name="Racademy" placeholder="请输入所属学院">
                                            <div class="modal-auth-code" id="modal-auth-code">
                                            <input type="text"  class="form-control" id="auth-code" maxlength="10" name="auth-code"  placeholder="请输入验证码">
                                            <input type="button" id="auth-code-bu" value="发送邮箱验证码">
                                            </div>
                                            <span class="help-block" id="registerSpan" style="color:red;">*除学校学院，其余都为必填项</span>
                                            <!--这里是帮助文本-->
                                        </div>
                                        <div class="modal-footer" id="modal-footer">
                                            <center>
                                                <button type="button" id="registerBtn"class="btn btn-primary" style="width:80px;">注册</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal"style="width:80px;">关闭
                                                </button>
                                            </center>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div>
                            </div><!-- /.modal -->
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="jumbotron well">
                <h2>云点名 让点名更便捷</h2>
            </div>

            <div class="carousel slide" id="carousel-274985" style="margin:40px auto">
                <ol class="carousel-indicators">
                    <li data-slide-to="0" data-target="#carousel-274985"></li>
                    <li data-slide-to="1" data-target="#carousel-274985"></li>
                    <li data-slide-to="2" data-target="#carousel-274985" class="active"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="item">
                        <img alt="" src="img/1.jpg" />
                    </div>
                    <div class="item">
                        <img alt="" src="img/2.jpg" />

                    </div>
                    <div class="item active">
                        <img alt="" src="img/3.jpg" />
                    </div>
                </div>
                <a class="left carousel-control" href="#carousel-274985" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span></a>
                <a class="right carousel-control" href="#carousel-274985" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span></a>
            </div>

            <div class="row" >
                <div class="col-md-4">
                    <div class="thumbnail">

                        <center><i class="fa fa-qrcode fa-5x" aria-hidden="true"></i></center>
                        <div class="caption">
                            <center>
                                <h3>扫码签到</h3>
                            </center>
                            <p>&nbsp;&nbsp;用户登录网站，选择点名功能，产生签到二维码，
                                签到者只需扫码输入验证码和自己的信息即可签到，让签到更智能，效率更高。
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="thumbnail">

                        <center><i class="fa fa-pencil-square-o fa-5x"></i> 	</center>

                        <div class="caption">
                            <center>
                                <h3>便捷录入</h3>
                            </center>
                            <p>&nbsp;&nbsp;系统提供录入期末成绩和平时成绩的功能，为用户设计了合理舒适的录入界面，让用户录入数据不再眼花缭乱。
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="thumbnail">
                        <center><i class="fa fa-bar-chart fa-5x"></i> </center>
                        <div class="caption">
                            <center>
                                <h3>智能分析</h3>
                            </center>
                            <p>&nbsp;&nbsp;系统可根据用户记录的点名记录及录入的成绩记录，自动计算出各班各科的总评分，
                                生成对应的数据分析图与数据统计图，还可导出execl格式的成绩表，
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row" >
        <div class="center-block" style="width:240px;">
            Copyright © 2017 创意武装H5团队
        </div>
    </div>
</div>



<script>

     $("#modal-auth-code").hide();
    /*测试用户名是否重复的函数*/
    function checkUserid(){
        var span = $("#checkUsername");
        var useridValue = $("#RuserName").val().trim();

        var xmlhttp=null;
        if (window.XMLHttpRequest)
        {
            //  IE7+, Firefox, Chrome, Opera, Safari 浏览器执行代码
            xmlhttp=new XMLHttpRequest();
        }
        else
        {
            // IE6, IE5 浏览器执行代码
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }


        //这里是异步运行了，当js执行到这一句话后不会等待他的返回值，而是直接往下进行，我测试出来的效果是当你js代码执行完了这里的值才返回来。  

        xmlhttp.onreadystatechange = function(){

            if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
                var byphp100 = xmlhttp.responseText;//接受PHP的返回值 
                if(byphp100=="1")//设置span里的内容    
                $("#checkUsername").text("该用户名可用").css("color","green");  
                else $("#checkUsername").text("该用户名已经存在").css("color","red");
            }
            else { $("#checkUsername").text("正在检查");}

        };//接受返回值  
        xmlhttp.open("GET","check_username.php?id="+useridValue,true);//这个页面便是你要进行选择查询的PHP页面 
        xmlhttp.send(null);
    }
    $("#loginBtn").click(function(){
            var username=$("#userName").val().trim();
            var pwd=$("#password").val().trim();
            if(""==username && ""==pwd) {$("#loginSpan").html("*请输入用户名和密码");}
            else {
                if ("" == username) {
                    $("#loginSpan").html("*请输入用户名");
                }
                else if ("" == pwd) {
                    $("#loginSpan").html("*请输入密码");
                }
                else {
                    $.ajax({
                        async: false,//取消异步
                    });
                    $.post("login.php", {userName: username, password: hex_md5(pwd)}, function (data) {
                        console.log(data);
                        if (data == "0") {
                            window.location.href = "userSee.php";//登录成功
                        } else if (data == "1") {
                            $("#loginSpan").html("*密码错误");
                        } else if (data == "2") {
                            $("#loginSpan").html("*该用户不存在");
                        } else if (data == "3") {
                            $("#loginSpan").html("*用户名和密码不能为空（后端）");
                        } else {
                            //console.log(data);
                        }
                    });
                }
            }
    });

    /*点击超链接时清空对应模态框的提示信息*/
    $("#loginA").click(function(){$("#loginSpan").html("");});
    $("#registerA").click(function(){
        $("#DuserName").show();
        $("#modal-body").find(":input").show();
        $("#modal-body").find("span").show();
        $("#registerShow").hide();
        $("#modal-footer").show();
        $("#registerSpan").html("*除学院，其余都为必填项");
        $("#checkUsername").html("*");

    });

    $("#registerBtn").click(function(event){
        var flag=false;
        var nameCheck= $("#checkUsername").text();
        var username=$("#RuserName").val().trim();//删除前后空格，防止用户只输入一个空格的bug
        var email=$("#email").val().trim();
        var pwd1=$("#Rpassword1").val().trim();
        var pwd2=$("#Rpassword2").val().trim();
        var school=$("#Rschool").val().trim();
        var academy=$("#Racademy").val().trim();
        var auth_code=$("#auth-code").val().trim();
        //event.preventDefault();alert(username+"*"+email+pwd1+"*"+pwd2+"*"+school+"*"+academy+"*");
//        alert(auth_code);
        var reg1 = /^[A-Za-z0-9\u4e00-\u9fa5]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/;//通用邮箱验证
        //var reg2=/^\d{5,12}@[qQ][qQ]\.(com|cn)$/;//只用于qq邮箱的验证
        //alert(reg1.test(email)+"*"+reg2.test(email));//邮箱的正则表达式的测试代码
        if ("" == username) {event.preventDefault();$("#registerSpan").html("*请输入用户名");$("#RuserName").focus();}
        else if ("" == email && reg1.test(email)) {event.preventDefault();$("#registerSpan").html("*请输入正确的邮箱");$("#email").focus();}
        else if ("" == pwd1) {event.preventDefault();$("#registerSpan").html("*请输入密码");$("#Rpassword1").focus();}
        else if (pwd1.length < 6) {event.preventDefault();$("#registerSpan").html("*密码不能低于6位");$("#Rpassword1").focus();}
        else if ("" == pwd2) {event.preventDefault();$("#registerSpan").html("*请重复密码");$("#Rpassword2").focus();}
        else if (pwd2.length < 6) {event.preventDefault();$("#registerSpan").html("*密码不能低于6位");$("#Rpassword2").focus();}
        else if (pwd1 != pwd2) {event.preventDefault();$("#registerSpan").html("*两次输入的密码不一致");$("#Rpassword1").focus();}
        else if ("该用户名可用" != nameCheck) {event.preventDefault();$("#registerSpan").html("*用户名重复，请更换用户名");$("#RuserName").focus();}
        else if ("" == school) {event.preventDefault();$("#registerSpan").html("*请输入学校");$("#Rschool").focus();}
        else { flag=true;}
        if(flag){
            $("#modal-auth-code").show();
           if(""==auth_code){event.preventDefault();$("#registerSpan").html("*请输入验证码");$("#auth-code").focus();}
           else {
                $.post("register.php",{RuserName:username,email:email,Rpassword1:hex_md5(pwd1),Rpassword2:hex_md5(pwd2),Rschool:school,Racademy:academy,Auth_code:auth_code},function(data){
                   if(data=="5")
                   {
                       document.getElementById('auth-code-bu').value='重新发送';
                       $("#registerSpan").html("");
                       $("#registerSpan").html("*验证码错误，请检查输入验证码或重新发送");
                   }
                    else {
                       $("#modal-body").find(":input").hide();
                       $("#modal-body").find("span").hide();
                       $("#registerShow").show();
                       $("#modal-footer").hide();
                       if(data=="1")
                       //注册成功
                           $("#registerShow").html(username+" 已注册成功!<br>请返回登录");
                       else
                           $("#registerShow").html("注册失败<br>请重新注册,错误代码 "+data);
                   }

                });
           }
        }

    })

    $("#RuserName").blur(function(){checkUserid();});
//  发送验证码
          $("#auth-code-bu").click(function(){
              $.post("send-email.php",{RuserName:$("#RuserName").val().trim(),email:$("#email").val().trim()},function(data){
                   if(data=="1")
                   {
                       $("#registerSpan").html("");
                       $("#registerSpan").html("*发送成功，请输入邮箱中的验证码");
                   }
                  else {
                       document.getElementById('auth-code-bu').value='重新发送';
                       $("#registerSpan").html("");
                       $("#registerSpan").html("*请检查邮箱是否填写正确，重新发送");
                   }
              })
              })
</script>
</body>
</html>