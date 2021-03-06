<?php
require_once 'get_user_info.php';
//用于检测是否登录，测试本页面时可暂时屏蔽以下几行php代码
if(!$is_login){
    echo "<script> alert('Please login...');parent.location.href='./index.php'; </script>";
}
?>
<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>成绩录入</title>
    <link rel="stylesheet" type="text/css" href="css/summarycss.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link href='http://cdn.webfont.youziku.com/webfonts/nomal/107666/45803/59b7fbf5f629d80cf06cb9e0.css' rel='stylesheet' type='text/css' />
    <link href='http://cdn.webfont.youziku.com/webfonts/nomal/107666/45803/59b9fbf4f629d815106db569.css' rel='stylesheet' type='text/css' />
    <link href='http://cdn.webfont.youziku.com/webfonts/nomal/107666/45803/59ba13d3f629d815106db579.css' rel='stylesheet' type='text/css' />
    <script src="js/jquery-3.2.1.js"></script>
    <script src="js/layer/layer.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/layer/layer.js"></script><link rel="stylesheet" href="style/placeholder.css">
    <link href='http://cdn.webfont.youziku.com/webfonts/nomal/107666/45803/59bf9768f629d80f58605471.css' rel='stylesheet' type='text/css' />
    <style>
        body{text-align: center;}
        select{
            border-radius: 10px;
            position: relative;
            min-width: 200px;
            height:40px;
            width: auto;
            margin: 10px auto;
            padding: 0px;
            background: #fff;
            border-left: 5px solid grey;
            cursor: pointer;
            outline: none;
        }

        #show{
            width: 100%;
            height:auto;
            /*background: rgba(255, 192, 203, 0.48);*/
        }
        #normal{
            width: 600px;
            height:auto;
            border:pink solid 1px;
            margin: 10px auto;
            display:none;
            border-radius: 10px;
        }
        .xiang{
            width:400px;
            height: 50px;
            /*border:red solid 1px;*/

        }
        #normalAdd{
            float: right;font-size: 18px;display: block;border-radius: 5px;width:30px !important;
            -webkit-box-shadow: none;
            -moz-box-shadow: none;
            box-shadow: none;
            margin: 5px;
        }

        #normalAdd:active {
            -webkit-box-shadow:none;
            -moz-box-shadow: none;
            box-shadow: none;
        }


        .deleteBtn{
            width: 40px;
            -webkit-box-shadow: none;
            -moz-box-shadow: none;
            box-shadow: none;
            margin:0 auto;
        }

        .deleteBtn:active {
            -webkit-box-shadow:none;
            -moz-box-shadow: none;
            box-shadow: none;
        }

        #table{
            margin: 25px auto;
            clear: both;
        }

        #Grade{
            border: grey solid 3px;
            border-radius: 35px;
            width: 400px;
            height: 300px;
            left: 500px;
            text-align: center;
            margin: 10px auto;
            display: none;
            margin-top: 25px;
        }

        #Grade p{
            margin:25px;
            font-size: 20px;
        }

        #percent{
            width:100%;
            min-width: 555px;
            height:80px;
            /*border:red solid 1px;*/
            margin:10px auto;
            line-height: 80px;
            display: none;
        }
        #percent span{
            display: inline;
        }

        #anniu{
            width:100%;
            min-width: 555px;
            height:50px;
            /*border:red solid 1px;*/
            margin:10px auto;
            line-height: 50px;
            display: none;
        }
        #anniu input[type="button"]{
            display: inline;
            width: 170px;
        }

        #inputFen{
            width:100%;
            height:auto;
            /*border: 1px solid red;*/
            margin: 10px auto;
            line-height: 40px;
        }

        #yes{
            margin: 20px auto !important;
        }

        #prev, #next {
            display: inline;
            width: 80px;
            margin: 20px;
        }

        input[type='text']{
            width:150px;
            height:20px;
            text-align: center;
            padding: 0px;
            margin: 0px;
        }

        th{text-align: center;}

        #table td{
            height: 29px;
            padding: 0px;
            vertical-align: middle;
            margin: 0px;
        }

        #entryNormal,#entryFinal{
            width: 200px;
            height: 30px;
            line-height: 30px;
        }

        #range{
            display: inline;
            width:200px;
        }

        #attendance{
            margin:0px;
        }
        #entrycourse{margin-top:50px;}
        #entryclass{margin-top:-5px;}
        #normal{margin-top:80px;}


    /*    button[disabled][required]:focus {
            border-color: rgba(128, 128, 128, 0.32);
        }
        input[type='button'][disabled]{color:rgba(128, 128, 128, 0.32);}

        button[disabled][required]:focus + label[placeholder]:before {
            color: rgba(128, 128, 128, 0.32);
        }
        input[type='button'][disabled]{color:rgba(128, 128, 128, 0.32);}*/

        .ziti{
            font-family:'LiDeBiao-Xing3d1bd97d5c1a492';
            font-size: 25px;
        }

    </style>

</head>

<body>
<div id="entrycourse">
        <label  for="selectcourse"  style="font-family:'LiDeBiao-Xing3d3990b88b1a492';font-size:30px;">选择课程</label>
        <select id="selectcourse" name="course">
            <option  value="" selected></option>
            <?php
            $sql = "SELECT distinct courseName FROM `basic_relation` WHERE userId=$userid";
            $result=mysqli_query($db,$sql);
            while($row = mysqli_fetch_assoc($result)){
                echo "<option value=".$row['courseName'].">".$row['courseName']."</option>";
            }
            ?>
        </select>
</div>
<div id="entryclass">
        <br>
        <label  for="selectclass" style="font-family:'LiDeBiao-Xing3d3990b88b1a492';font-size:30px;">选择班级</label>
        <select id="selectclass" >
            <option  value="" selected></option>
        </select>
</div>

        <div id="show">

            <div id="percent">
        <span class="cssd2406ba6f1a492" style="font-size: 25px;">平时成绩<span id="norPer">(30%)</span></span>
        <input type="range" step="5" value="30" min="0" max="100" name="range" id="range"/>
        <span class="cssd2406ba6f1a492" style="font-size: 25px;">期末成绩<span id="finPer">(70%)</span></span>
        </div>

        <div id="anniu">
        <input type="button" value="录入平时成绩" id="entryNormal" name="entryNormal" style="margin-right: 30px;"/>
        <input type="button" value="录入期末成绩" id="entryFinal" name="entryFinal"/>
        </div>
            <div  id="normal" class="container">
                <div class="row clearfix">
                    <div class="col-md-12 column">

                        <button id="normalAdd" title="添加考核项目">+</button>

                        <table class="table table-bordered table-hover table-condensed" id="table">
                            <thead>
                            <tr>
                                <th>是否勾选</th>
                                <th>考核项目名称</th>
                                <th colspan="2">平时成绩占比（%）</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><input type="checkbox" name="check" disabled/></td>
                                <td><input type="text" name="field" value="出勤率" disabled/></td>
                                <td><input type="text" name="percent" id="attendance" value=""/></td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                        <input type="button" id="yes" value="保存并开始录入"/>
                    </div>
                </div>
            </div>


        <div id="Grade">
            <p id="stuCode">学号</p>
            <p id="stuName">姓名</p>
            <div id="inputFen">
                <label for="grade">期末成绩：</label><input type="text" id="grade" name="grade">
            </div>
            <input type="button" value="上一个" id="prev" name="prev" style="margin-right: 20px;">
            <input type="button" value="下一个" id="next" name="next">
        </div>



        </div>
        <script>

            var flagtype = "final";
            var re_percentInf = new Array();
            var field = null;
            var re_stuInf = new Array();
            var re_stuInf_index = 0;
            var re_stuInf_sum =0;

            var find_field="";


            function formFiled(isChecked,filedName,filedPer){
                this.isChecked=isChecked;
                this.filedName=filedName;
                this.filedPer=Number(filedPer)/100;
            }

            //删除字段按钮的js代码
            function  Delete(obj){
                var temp = $(obj).parent().parent().prevAll().length+1;//DOM元素转化成jQuery对象
                //alert(temp);
                var deleteTr =  $("#table tr:eq("+temp+")");

                var reg=/\d+/;//.match(reg);
                var trId = deleteTr.attr("id");

                if(trId != undefined){
                    trId=trId.match(reg)[0];
                    layer.msg('确定删除该考核项目及该考核项目录入的成绩吗？', {
                        time: 0 //不自动关闭
                        ,icon: 3
                        ,skin: 'layer-ext-moon'
                        ,btn: ['确定','取消']
                        ,yes: function(index){

                            $.post(
                             "phpData/entryScore6.php",//插入新的自定义字段
                             {trId:trId},
                             function(data){
                             //输出结果正常情况下为1（供测试使用）
                             //alert("删除自定义字段的js代码"+data);

                                 deleteTr.remove();
                             });
                            layer.close(index);
                        }
                    });
                }else{
                    deleteTr.remove();
                }
                //deleteTr.remove();
            }

             $(function(){

                $("#range").change(function(){
                    var temp = Number($("#range").val());
                    $("#norPer").text("("+temp+"%)");
                    $("#finPer").text("("+(100-temp)+"%)");
                });

                $("#selectcourse").change(function(){
                    var courseName = $("#selectcourse").val();
                    $("#classlab").html("");
                    if("" == courseName){
                        $("#selectclass").empty();
                        $("#selectclass").append("<option value='' selected></option>");
                        $("#percent").css("display","none");
                        $("#anniu").css("display","none");
                    }else{

                        $.post("phpData/return_class.php",{courseName:courseName,userId:<?php echo $_SESSION['userid'];?>},function(data){
                            $("#selectclass").empty();
                            $("#selectclass").append("<option value='' selected></option>");
                            $("#selectclass").append(data);
                            console.log("return_class "+data);
                        });
                    }
                });//end change

                $("#selectclass").change(function(){
                    var courseName = $("#selectcourse").val();
                    var classid = $("#selectclass").val();
                    if("" == classid){
                        $("#percent").css("display","none");
                        $("#anniu").css("display","none");
                        $("#normal").css("display","none");
                        $("#Grade").css("display","none");
                    }
                    else {
                        //发送post请求得出期末与平时的比例和平时成绩中分布（名字和比例）
                        $.post("phpData/entryScore1.php",{courseName:courseName,userId:<?php echo $_SESSION['userid'];?>,classId:classid},function(data){
                            var json = JSON.parse(data);
                            console.log("entryScore1 "+json);

                            re_percentInf = json.percentInf;

                            $("#range").val((1-re_percentInf.finalPer)*100);
                           var tempPer = $("#range").val();
                            $("#norPer").text("("+tempPer+"%)");
                            $("#finPer").text("("+(100-tempPer)+"%)");
                            console.log(tempPer);

                            $("#attendance").val(re_percentInf.attendancePer*100);

                            //根据Id返回来的自定义字段信息
                            field = json.field;
                            console.log(field);
                            var str="";
                            for(var j=0;j<field.length;j++)
                            {
                                var tempNum = field[j].userDefineId;
                                str +=
                                "<tr id='tr"+tempNum+"'>"+
                                "<td><input type='checkbox' name='check"+tempNum+"' /></td>"+
                                "<td><input type='text' name='field"+tempNum+"'  value='"+field[j].userDefineName+"'/></td>"+
                                "<td><input type='text' name='percent"+tempNum+"' value='"+(field[j].userDefinePer*100)+"'/></td>"+
                                "<td><button class='deleteBtn' onclick='Delete(this)'name='delete"+tempNum+"' title='删除该考核项目'>X</button></td>"+
                                "</tr>";
                                //console.log(field[j].filedName+field[j].filedPer*100);
                            }
                           // $("#table").empty();
                            $("#table tr:gt(1)").remove();
                            $("#table").append(str);


                        });
                        $("#percent").css("display","block");

                        $("#anniu").css("display","block");
                    }

                });

                $("#entryNormal").click(function(){//录入平时成绩按钮
                    flagtype = "normal";
                    $("#normal").css("display","block");
                    $("#selectcourse").attr('disabled', true);
                    $("#selectclass").attr('disabled', true);
                    $("#range").attr('disabled', true);
                    $(this).attr('disabled', true);
                    $("#entryFinal").attr('disabled', true);
                });

                $("#entryFinal").click(function(){//录入期末成绩按钮
                    flagtype = "final";
                    $("#Grade").css("display","block");
                    $("#normal").css("display","none");
                    $("#selectcourse").attr('disabled', true);
                    $("#selectclass").attr('disabled', true);
                    $("#range").attr('disabled', true);
                    $(this).attr('disabled', true);
                    $("#entryNormal").attr('disabled', true);
                    $("#inputFen input:eq(0)").focus();

                    //alert($("#selectcourse").val()+" "+$("#selectclass").val());
                    $.post("phpData/entryScore3.php",{courseName:$("#selectcourse").val(),userId:<?php echo $_SESSION['userid'];?>,classId:$("#selectclass").val()},
                        function(data){

                            var json = JSON.parse(data);

                            console.log("entrySorce3"+json);
                            re_stuInf = json;
                            re_stuInf_sum=re_stuInf.length-1;

                            $("#inputFen").empty().append("<label for='grade'>期末成绩：</label><input type='text' id='grade' name='grade'>");

                            //填充学生信息
                            $("#stuCode").html(re_stuInf[0]["stuCode"]);
                            $("#stuName").html(re_stuInf[0]["stuName"]);
                            $("#grade").val(re_stuInf[0]["finalGrade"]);

                            $("#Grade").css("display","block");
                            $("#normal").css("display","none");

                        });

                });

                $("#prev").click(function(){
                    if(flagtype == "normal"){
                    var tt = find_field.split("-");
                    if(--re_stuInf_index >= 0){

                        //填充学生信息
                        $("#stuCode").html(re_stuInf[re_stuInf_index]["stuCode"]);
                        $("#stuName").html(re_stuInf[re_stuInf_index]["stuName"]);
                        for(var q=0;q< tt.length-1;q++)//填充
                        {
                            //填充分数
                            var s = tt[q];
                            $("#"+s).val(re_stuInf[re_stuInf_index][s]);
                        }
                        }
                    else {
                        //alert("当前学生已为该班第一个！");
                        layer.alert("当前学生已为该班第一个！", {
                            icon: 7,
                            skin: 'layer-ext-moon' //该皮肤由layer.seaning.com友情扩展。关于皮肤的扩展规则，去这里查阅
                        });
                        re_stuInf_index = 0;
                        $(this).attr('disabled', true);
                    }}else{
                        if(--re_stuInf_index >= 0){

                            //填充学生信息
                            $("#stuCode").html(re_stuInf[re_stuInf_index]["stuCode"]);
                            $("#stuName").html(re_stuInf[re_stuInf_index]["stuName"]);
                            $("#grade").val(re_stuInf[re_stuInf_index]["finalGrade"]);
                        }
                        else {
                            //alert("当前学生已为该班第一个！");
                            layer.alert("当前学生已为该班第一个！", {
                                icon: 7,
                                skin: 'layer-ext-moon' //该皮肤由layer.seaning.com友情扩展。关于皮肤的扩展规则，去这里查阅
                            });
                            re_stuInf_index = 0;
                            $(this).attr('disabled', true);
                        }
                    }
                    $("#inputFen input:eq(0)").focus();
                });

                $("#next").click(function(){
                    $("#prev").attr('disabled',false);
                    //录入平时成绩
                    if(flagtype == "normal"){
                        var tt = find_field.split("-");

                            //处理当前数据
                            for(var q=0;q< tt.length-1;q++)//填充
                            {
                                var s = tt[q];
                                re_stuInf[re_stuInf_index][s]=$("#"+s).val();
                            }

                            //填充下一个学生信息
                            if(++re_stuInf_index <= re_stuInf_sum){

                            $("#stuCode").html(re_stuInf[re_stuInf_index]["stuCode"]);
                            $("#stuName").html(re_stuInf[re_stuInf_index]["stuName"]);
                                for(var q=0;q< tt.length-1;q++)//填充
                                {
                                    //填充分数
                                    var s = tt[q];
                                    $("#"+s).val(re_stuInf[re_stuInf_index][s]);
                                }
                            }
                        else{
                                console.log(re_stuInf);
                                //保存录入的平时成绩到数据库
                                $.post(
                                    "phpData/entryScore4.php",
                                    {flag:"normal",student_inf:re_stuInf,courseName:$("#selectcourse").val(),find_field:find_field,
                                        userId:<?php echo $_SESSION['userid'];?>,classId:$("#selectclass").val()},
                                    function(data){console.log(data);});
                                //提示录入完成，刷新本页面
                               // alert("录入平时成绩完毕,信息已保存！");
                                layer.msg('录入期末成绩完毕,信息已保存！', {
                                    time: 0 //不自动关闭
                                    ,icon: 6
                                    ,skin: 'layer-ext-moon'
                                    ,btn: ['确定']
                                    ,yes: function(){
                                        window.location.reload();
                                    }
                                });

                        }
                    }else{

                        //处理当前数据
                        re_stuInf[re_stuInf_index]["finalGrade"]=$("#grade").val();

                        if(++re_stuInf_index <= re_stuInf_sum){
                            //填充学生信息
                            $("#stuCode").html(re_stuInf[re_stuInf_index]["stuCode"]);
                            $("#stuName").html(re_stuInf[re_stuInf_index]["stuName"]);
                            $("#grade").val(re_stuInf[re_stuInf_index]["finalGrade"]);
                        }
                        else{
                            //保存录入的期末成绩到数据库
                            $.post(
                                "phpData/entryScore4.php",
                                {flag:"final",student_inf:re_stuInf,courseName:$("#selectcourse").val(),userId:<?php echo $_SESSION['userid'];?>,classId:$("#selectclass").val()},
                                function(){

                                });
                            //提示录入完成，刷新本页面
//                            alert("录入期末成绩完毕,信息已保存！");
                            layer.msg('录入期末成绩完毕,信息已保存！', {
                                time: 0 //不自动关闭
                                ,icon: 6
                                ,skin: 'layer-ext-moon'
                                ,btn: ['确定']
                                ,yes: function(){
                                    window.location.reload();
                                }
                            });

                        }

                }
                    $("#inputFen input:eq(0)").focus();
                    console.log(re_stuInf_sum+" "+re_stuInf_index);
                });


                $("#normalAdd").click(function(){

                    var rowNum = $("#table").find("tr").length ;
                    var fieldNum = rowNum - 1 ;

                    var str =
                        "<tr>"+
                        "<td><input type='checkbox' name='check' /></td>"+
                        "<td><input type='text' name='field'  /></td>"+
                        "<td><input type='text' name='percent'/></td>"+
                        "<td><button class='deleteBtn' onclick='Delete(this)' title='删除该考核项目'>X</button></td>"+
                        "</tr>";
                    $("#table").append(str);
                    //alert(str);
                    //alert($("#table").find("tr").length);
                });



                $("#yes").click(function(){//点击保存并开始录入
                    var field = new Array();
                    //判断是否有空值
                    var flag = true;
                    //判断百分比和是否为100%
                    var seePer = 0.0;


                    var rowNum = $("#table").find("tr").length ;//table的总行数
                    var index = rowNum - 1;//table除去首行的行数
        //            alert(rowNum+" "+index);

        //            var hang = $("#table tr:eq("+1+")");
        //            var lie1 = hang.find(":checkbox").is(':checked');
        //            var lie2 = hang.find(":text").eq(0).val();
        //            var lie3 = hang.find(":text").eq(1).val();


                    //取信息并填充
                    for ( var i = 1;i <= index; i++)
                    {
                        var hang = $("#table tr:eq("+i+")");
                        var lie1 = hang.find(":checkbox").is(':checked');
                        var lie2 = hang.find(":text").eq(0).val();
                        var lie3 = hang.find(":text").eq(1).val();
                        if("" == lie2 || "" == lie3) {flag=false;break;}//如果考勤项目名称或者其比例为空，则不能进行录入
                        else{
                            var f = new formFiled(lie1,lie2,lie3);
        //                    alert(f.isChecked+" "+ f.filedName+" "+ f.filedPer);
                            field.push(f);
                            seePer += f.filedPer;
                        }
                    }

                    if(flag){
                        if(seePer.toFixed(2) == 1.00){//判断百分比和是否为100%
                            //alert("yes");

                            //把选中的字段
                            $("#inputFen").empty();
                            var str="";
                            var num=0;

                            //alert(field.length);
                            for(var j=0;j<field.length;j++)
                            {
                                if(true == field[j].isChecked)
                                {
                                    var temp = field[j].filedName;
                                    str += "<label for='"+temp+"'>"+temp+"：</label><input type='text' id='"+temp+"' name='"+temp+"'><br>";
                                    find_field += temp+"-";
                                    num++;
                                }
                            }
                            if(num>0){
                                //将出勤率百分比，用户自定义字段字段及百分比插入数据库（第一次为insert，往后都是update）
                                var reg=/\d+/;//.match(reg);
                                var fullField = new Array();
                                for ( var a = 1;a <= index; a++)
                                {
                                    if(a == 1){
                                        var full = {Per:$("#attendance").val()};
                                    }
                                    else{
                                        var hangTr = $("#table tr:eq("+a+")");//$("div").eq(0).attr('id')
                                        //alert(hangTr.attr("id"));
                                        var trId = hangTr.attr("id");

                                        var name = hangTr.find(":text").eq(0).val();
                                        var ppp = hangTr.find(":text").eq(1).val();

                                        if(trId == undefined){
                                            var full = {fId:null,fName:name,fPer:ppp};
                                        }else{//update
                                            var full = {fId:trId.match(reg)[0],fName:name,fPer:ppp};
                                        }
                                    }
                                    fullField.push(full);

                                }
                                console.log(fullField);
                                $.post(
                                    "phpData/entryScore5.php",
                                    {fullField:fullField,courseName:$("#selectcourse").val(),userId:<?php echo $_SESSION['userid'];?>,classId:$("#selectclass").val()},
                                    function(data){
                                        console.log("phpData/entryScore5.php"+data);
                                        //输出结果正常情况下为11
                                    });



                               //发送post请求得到学生的信息和自定义字段对应的分数
                                $.post("phpData/entryScore2.php",{courseName:$("#selectcourse").val(),userId:<?php echo $_SESSION['userid'];?>,classId:$("#selectclass").val(),field:find_field},
                                    function(data){
                                        var json = JSON.parse(data);
                                       console.log("entryScore2"+data);
                                        console.log(json);
                                        re_stuInf = json;
                                        re_stuInf_sum=re_stuInf.length-1;


                                        $("#inputFen").append(str);
                                        console.log("*"+str+"*"+find_field);

                                        var tt = find_field.split("-");

                                        //填充学生信息
                                        $("#stuCode").html(re_stuInf[0]["stuCode"]);
                                        $("#stuName").html(re_stuInf[0]["stuName"]);
                                         for(var q=0;q< tt.length-1;q++)
                                         {
                                             //填充分数
                                            var s = tt[q];
                                            $("#"+s).val(re_stuInf[0][s]);
                                         }
                                        $("#Grade").css("display","block");
                                        $("#normal").css("display","none");

                                    });

                            }else{
                                //alert('请至少选择一项需要录入成绩的考核项目！');
                                layer.alert('请至少选择一项需要录入成绩的考核项目！', {
                                    icon: 7,
                                    skin: 'layer-ext-moon' //该皮肤由layer.seaning.com友情扩展。关于皮肤的扩展规则，去这里查阅
                                });
                            }

                        }
                        else{
                            //alert("平时成绩占比百分率和不为100%！");
                            layer.alert('平时成绩占比百分率和不为100%！', {
                                icon: 7,
                                skin: 'layer-ext-moon' //该皮肤由layer.seaning.com友情扩展。关于皮肤的扩展规则，去这里查阅
                            });
                        }
                    }
                    else{
                        //alert("请填写完信息再开始录入！");
                        layer.alert('请填写完信息再开始录入！', {
                            icon: 7,
                            skin: 'layer-ext-moon' //该皮肤由layer.seaning.com友情扩展。关于皮肤的扩展规则，去这里查阅
                        });
                    }
                });

            });//document.onload
</script>
</body>
</html>


