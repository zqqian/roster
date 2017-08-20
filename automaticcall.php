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
    .body
    {
        text-align:center;
    }
    .select2
    {
        float:left;
        margin-left:42%;
    }
</style>

<body class="body">

<div class="select2">
    <label for="selectl">选择班级：</label>
    <select id="selectclass" name="classes">
        <option name="" value="" selected></option>
        <option name="计科一班" value="计科一班">计科一班</option>
        <option name="saab"value="saab">Saab</option>
        <option name="opel"value="opel">Opel</option>
        <option name="audi"value="audi">Audi</option>
    </select>
    <button id="classok">选定</button>
    </br>
    <label id="classlab"></label>
    </br>
    <button id="classsure">确定</button>
</div>
</br>
</br>
<div id="twocode">
    </br>
    <center>
         <h2>该请扫描该二维码</h2>
         <div id="qrcodeCanvas"></div>
    </center>
    </br>
    <h2>已有<span id="havenumtc"></span>人扫描</h2>
    <button id="twocodestart" style='padding: 6px 17px;background-color: #3c00ff4d;color: blue;'>开始</button>
</div>

<script>

    $(function(){

        $("#twocode").hide();

        $("#classok").click(function(){
            var classs=$("#selectclass").val();
            if(""!=classs)
                $("#classlab").append("+"+classs);
        });

        $("#classsure").click(function(){
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