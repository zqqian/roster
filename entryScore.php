<?php
require_once 'get_user_info.php';
//用于检测是否登录，测试本页面时可暂时屏蔽以下几行php代码
if(!$is_login){
    echo "<script> alert('Please login...');parent.location.href='./index.php'; </script>";
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>成绩查询</title>
    <script src="js/jquery-3.2.1.js"></script>
   <!-- <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">-->
    <style>
        body{text-align: center;}
        select{width:200px;}
        .kuang{width: 500px;height:500px;float:left;border:pink solid 1px;}
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
        <br>
        <input type="button" value="录入平时成绩" id="entryNormal" name="entryNormal"/>
        <input type="button" value="录入期末成绩" id="entryFinal" name="entryFinal"/>
        <hr>
        <span>30</span>
        <input type="range" step="5" value="30" min="0" max="100" name="range" id="range"/>
        <div id="normal" class="kuang">

        </div>

        <div id="final" class="kuang">

        </div>

        <script>
    $(function(){

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
                });

            }
        });//end change

        $("#entryNormal").click(function(){
            alert("normal");
        });
        $("#entryFinal").click(function(){
            alert("final");
        });

        $("#range").change(function(){
            var temp = $("#range").val();
            $("#rangeSpan").text(temp);
        });






    });//document.onload
</script>
</body>
</html>


