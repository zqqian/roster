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
    <title>成绩查询</title>
    <script src="js/jquery-3.2.1.js"></script>
   <!-- <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">-->
    <style>
        body{text-align: center;}
        select{width:200px;}

        #show{width: 100%;height:auto;background: rgba(255, 192, 203, 0.48);}

        #normal{width: 500px;height:400px;border:pink solid 1px;margin: 10px auto;display:none;}
        .xiang{
            width:400px;
            height: 50px;
            border:red solid 1px;

        }
        #normalAdd{float: right;font-size: 18px;display: block;border-radius: 5px;}
        .deleteBtn{color:red;}
        #table{margin: 25px auto;clear: both;}
        #table td{border:pink solid 1px;margin: 25px auto;}
        #table td input{text-align: center;}



        #Grade{border: red solid 1px;width: 300px;height: 300px;left:500px;text-align: center;margin: 10px auto;
                display: none;}

        #percent{width:500px;height:80px;border:red solid 1px;margin:10px auto;line-height: 80px;display: none;}

        #anniu{width:500px;height:30px;border:red solid 1px;margin:10px auto;line-height: 30px;display: none;}

        #inputFen{width:300px;height:auto;border: 1px solid red;margin: 10px auto;
            line-height: 40px;}
    </style>

</head>

<body>
        <label for="selectcourse" >选择课程：</label>
        <select id="selectcourse" name="course">
            <option  value="" selected></option>
            <?php
            $sql = "SELECT courseName FROM `basic_relation` WHERE userId=$userid";
            $result=mysqli_query($db,$sql);
            while($row = mysqli_fetch_assoc($result)){
                echo "<option value=".$row['courseName'].">".$row['courseName']."</option>";
            }
            ?>
        </select>
        <br>
        <label for="selectclass">选择班级：</label>
        <select id="selectclass" >
            <option  value="" selected></option>
        </select>


        <div id="show">

            <div id="percent">
        <span>平时成绩<span id="norPer">(30%)</span></span>
        <input type="range" step="5" value="30" min="0" max="100" name="range" id="range"/>
        <span>期末成绩<span id="finPer">(70%)</span></span>
        </div>

        <div id="anniu">
        <input type="button" value="录入平时成绩" id="entryNormal" name="entryNormal"/>
        <input type="button" value="录入期末成绩" id="entryFinal" name="entryFinal"/>
        </div>

        <div id="normal" >
            <button id="normalAdd" title="添加考核项目">+</button>

                <table id="table">
                    <tr>
                        <th>是否勾选</th>
                        <th>考核项目名称</th>
                        <th colspan="2">平时成绩占比（%）</th>

                    </tr>
                    <tr>
                        <td><input type="checkbox" name="check" disabled/></td>
                        <td><input type="text" name="field" value="出勤率" disabled/></td>
                        <td><input type="text" name="percent"/></td>

                    </tr>
                </table>
            <input type="button" id="yes" value="保存并开始录入"/>


        </div>
<!--<div id="nomalGrade" class="enterGrade">
    <p id="NstuCode">学号</p>
    <p id="NstuName">姓名</p>
    <div id="Ninput">
        <!--<label for="">   </label><input type="text" id="   " name="   ">
    </div>
    <input type="button" value="上一个" id="Nprev" name="Nprev">
    <input type="button" value="下一个" id="Nnext" name="Nnext">
</div>-->

        <div id="Grade">
            <p id="stuCode">学号</p>
            <p id="stuName">姓名</p>
            <div id="inputFen">
                <label for="grade">期末成绩：</label><input type="text" id="grade" name="grade">
            </div>
            <input type="button" value="上一个" id="prev" name="prev" style="margin-right: 20px;">
            <input type="button" value="下一个" id="next" name="next">
        </div>
<!--<button id="btn">yang</button>-->
        </div>
        <script>

            function formFiled(isChecked,filedName,filedPer){
                this.isChecked=isChecked;
                this.filedName=filedName;
                this.filedPer=Number(filedPer)/100;
            }
            function  Delete(){
//                alert("t");
                var temp = ($(this).parent().prevAll().length + 1) + 1;
                $("#table tr:eq("+temp+")").remove();

//            var meTr = $(this).parent();
//            meTr.css("background","red");
            }
    $(function(){
        $("#range").change(function(){
            var temp = Number($("#range").val());
            $("#norPer").text("("+temp+"%)");
            $("#finPer").text("("+(100-temp)+"%)");

        });

//        $("#btn").click(function(){
//
//        });

        $("#selectcourse").change(function(){
            var courseName = $(this).val();
            $("#classlab").html("");
            if("" == courseName){
                $("#selectclass").empty();
                $("#selectclass").append("<option value='' selected></option>");
            }else{

                $.post("phpData/return_class.php",{courseName:courseName,userId:<?php echo $_SESSION['userid'];?>},function(data){
                    $("#selectclass").empty();
                    $("#selectclass").append("<option value='' selected></option>");
                    $("#selectclass").append(data);
                    console.log(data);
                });
            }
        });//end change

        $("#selectclass").change(function(){
            var classid = $("#selectclass").val();
            if("" == classid){
                //
            }
            else {
                $("#percent").css("display","block");
                //发送post请求得出期末与平时的比例和平时成绩中分布（名字和比例）
                $("#anniu").css("display","block");
            }

        });

        $("#entryNormal").click(function(){
            $("#normal").css("display","block");
        });
        $("#entryFinal").click(function(){
            $("#Grade").css("display","block");
            $("#normal").css("display","none");
        });

        $("#range").change(function(){
//            var temp = $("#range").val();
//            $("#rangeSpan").text(temp);
        });

        $("#normalAdd").click(function(){

            var rowNum = $("#table").find("tr").length ;
            var fieldNum = rowNum - 1 ;

            var str =
                "<tr>"+
                "<td><input type='checkbox' name='check"+rowNum+"' /></td>"+
                "<td><input type='text' name='field"+rowNum+"'  /></td>"+
                "<td><input type='text' name='percent"+rowNum+"'/></td>"+
                "<td><button class='deleteBtn' onclick='Delete()' title='删除该考核项目'>X</button></td>"+
                "</tr>";
            $("#table").append(str);
            alert(str);
            alert($("#table").find("tr").length);
        });

        $(".deleteBtn").click(function(){
            alert();
//            var meTr = $(this).parent().parent();
//            alert(meTr.html());

        });

        $("#yes").click(function(){
            var field = new Array();
            //判断是否有空值
            var flag = true;
            ////判断百分比和是否为100%
            var seePer = 0.0;


            var rowNum = $("#table").find("tr").length ;//table的总行数
            var index = rowNum - 1;//table除去首行的行数
//            alert(rowNum+" "+index);

//            var hang = $("#table tr:eq("+1+")");
//            var lie1 = hang.find(":checkbox").is(':checked');
//            var lie2 = hang.find(":text").eq(0).val();
//            var lie3 = hang.find(":text").eq(1).val();


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
                if(seePer == 1.0){//判断百分比和是否为100%
                    alert("yes");
                    //将用户写入的字段及百分比插入数据库（第一次为insert，往后都是update）

                    //把选中的字段
                    $("#inputFen").empty();
                    var str="";
                    alert(field.length);
                    for(var j=0;j<field.length;j++)
                    {
                        if(true == field[j].isChecked)
                        {
                            var temp = field[j].filedName;
                            str += "<label for='"+temp+"'>"+temp+"：</label><input type='text' id='"+temp+"' name='"+temp+"'><br>";}
                    }
                    $("#inputFen").append(str);
                    console.log("*"+str);
                }
                else{
                    alert("平时成绩占比百分率和不为1！");
                }
            }
            else{
                alert("请填写完信息再开始录入！");
            }






        });





    });//document.onload
</script>
</body>
</html>


