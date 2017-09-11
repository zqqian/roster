<?php

session_start();
header("Content-Type:text/html;charset=UTF-8");


$ID=$_GET['ID'];
$userId=$_GET['userId'];

/*$dir = dirname(__FILE__);//找到当前脚本所在路径
$fileuserid= $dir . "/validation/" . $userId."/".$userId;


if (!file_exists($fileuserid)){//判断文件夹是否存在，不存在的话就表明未扫二维码就直接进入，所以弹出警示框，并跳转至白度。
echo "<script>
    alert('请通过正规的渠道进入签到界面！');
    location.href='http://www.baidu.com';
</script>";
}
else*/
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
    <title>签到界面</title>
    <script src="js/jquery-3.2.1.js"></script>
    <link rel="stylesheet" href="style/placeholder.css">
    <link rel="stylesheet" href="style/button_one.css">
    <link href='http://cdn.webfont.youziku.com/webfonts/nomal/107666/45803/59b66284f629db133c19ab74.css' rel='stylesheet' type='text/css' />
    <link href='http://cdn.webfont.youziku.com/webfonts/nomal/107666/45803/59b6647cf629db133c19ab77.css' rel='stylesheet' type='text/css' />
</head>
<style>
    #autoidname_text{margin-top:80px;}
    #text1{margin-top:100px;width:400px;height:70px;}
    #text2{margin-top:25px;width:400px;height:70px;}
     #yes{margin-top:40px;}
    #autoid_text{width:100%;height:50px;background-color:#40AFFE;margin:0px;paddind:0px;text-align:center;line-height:50px;}
    #stuid,#stuname::-ms-input-placeholder{text-align: center; font-size:16px;}
    #stuid,#stuname::-webkit-input-placeholder{text-align: center;font-size:16px;}
    #stuname,#stuid::-ms-input-placeholder{text-align: center; font-size:16px;}
    #stuname,#stuid::-webkit-input-placeholder{text-align: center;font-size:16px;}
</style>
<body>
<center>
    <div id="autoid_text">
     <span style="font-family:'LiDeBiao-Xing3d15a1cfe31a492';font-size:25px;" >云点名学生信息录入页</span>
    </div>
<div id="autoidname_text">
    <span   style="font-family:'LiDeBiao-Xing3d159a1c741a492';font-size:30px;" >输入学号与姓名</span></br>
    <div id="text1">
        <span   style="font-family:'LiDeBiao-Xing3d159a1c741a492';font-size:20px;" >
<!--            <input type="text" id='stuid' value=''/>-->
            <input required='' type='text' id='stuid'>
       <label alt='学号' placeholder='学号'></label>
        </span></br>
    </div>
    <div id="text2">
    <span  style="font-family:'LiDeBiao-Xing3d159a1c741a492';font-size:20px;" >
<!--        <input type="text" id='stuname' value=''/>-->
            <input required='' type='text' id='stuname'>
       <label alt='姓名' placeholder='姓名'></label>
    </span></br>
    </div>
        <!--    <input  style="font-family:'LiDeBiao-Xing3d157e98241a492';width:120px;height:35px;border-radius:20px;" type="button" id="yes" value="提交"></span>-->
    <input class="button_one white" style="font-family:'LiDeBiao-Xing3d159a1c741a492';width:120px;height:35px;border-radius:20px;font-size:25px;"  type="button" id="yes"  value="提交"/>
</div>
</center>
</body>
<script>
//    alert("jjjjjjjjjjjj");
    var stuCode="";
    var stuName="";
    function checkUserid(){
         stuCode=document.getElementById("stuid").value;
         stuName=document.getElementById("stuname").value;

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
                 var inf = xmlhttp.responseText;//接受PHP的返回值 
                console.log(inf);
                 if(inf==0){ alert ('此时已无法签到，请找老师补签！');}
                else  if(inf==1){ alert ('签到成功！'); }
                else if(inf==2){alert ('姓名或者学号不正确！');}
                else if(inf==3){alert ('请把信息填齐全！');}
                else {alert ('0000000000000');}
                                     


            }
            else { /*$("#checkUsername").text("正在检查");*/}

        };//接受返回值  
        xmlhttp.open("POST","phpData/auto_insertidname.php",true);//这个页面便是你要进行选择查询的PHP页面 
       // xmlhttp.send({ID:"51_",uerId:18,stuCode:stuCode,stuName:stuName});

        xmlhttp.setRequestHeader("X-Requested-With", "XMLHttpRequest");

        var formData = new FormData();
        formData.append('ID', '<?php echo $ID;?>');
        formData.append('userId',<?php echo $userId;?>);
        formData.append('stuCode',stuCode);
        formData.append('stuName',stuName);
        xmlhttp.send(formData);
    }
    var t= document.getElementById("yes");
    t.onclick =checkUserid;//function(){ alert("hello"); }
    /* alert("dddd1");
     $(function(){

     $("#yes").click(function(){
     alert("dddd2");
     var stuCode=$("#stuid").val().trim();
     var stuName=$("#stuname").val().trim();
     alert(stuCode+"  "+stuName);
     $.post("phpData/auto_insertidname.php",{ID:<?php /*echo $ID;*/?>,uerId:<?php /*echo $_SESSION['userid'];*/?>,stuCode:stuCode,stuName:stuName},function
     (data){
     console.log(data);




     });


     });

     });
     */
</script>

</html>