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
    <link href='http://cdn.webfont.youziku.com/webfonts/nomal/107666/45803/59ba3899f629d815106db5bc.css' rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="style/button_one.css"></head>
<script src="js/layer/layer.js"></script>
<link rel="stylesheet" href="style/placeholder.css">
<style>
    #stuid{width:500px;margin-top:50px;}
    #stuname{width:500px;}
    #yes{margin-top:40px;}
    #autospan{display:block;margin-top:90px;}
</style>

<body class="body">
<center>
    <div>
        <span id="autospan" style="font-family:'LiDeBiao-Xing3d24965ffd1a492';font-size:30px;">请输入学号与姓名</span>

        <input required='' type='text' id='stuid'  value='' >
        <label alt='请输入学号' placeholder='学号'></label>
        <!--    <span>邮箱</span>-->
        <!--    <input type="text" id="email" placeholder="请输入注册邮箱">-->
        <input required='' type='text'  id='stuname' value='' >
        <label alt='请输入姓名' placeholder='姓名'></label>
        <!--    <p><input style="font-family:'LiDeBiao-Xing3d24965ffd1a492';" type="button" id="yes" value="提交" style='padding: 6px 17px;background-color:
        #3c00ff4d;color: blue;'></p>-->
    </div>
    <input class="button_one white"  style="font-family:'LiDeBiao-Xing3d24965ffd1a492';font-size:25px;color:#000000;padding-left:15px;
height:35px;width:80px;" type="button" id="yes" value="提交" />
</center>
</body>

<script>

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
                if(inf==0){
                     alert ('此时已无法签到，请找老师补签！');
//                    layer.alert('此时已无法签到，请找老师补签！', {
//                        icon: 5,
//                        skin: 'layer-ext-moon' //该皮肤由layer.seaning.com友情扩展。关于皮肤的扩展规则，去这里查阅
//                    })
                }
                else  if(inf==1){
                    alert ('签到成功！');
//                    layer.alert('签到成功！', {
//                        icon: 6,
//                        skin: 'layer-ext-moon' //该皮肤由layer.seaning.com友情扩展。关于皮肤的扩展规则，去这里查阅
//                    })
                }
                else if(inf==2){
                     alert ('姓名或者学号不正确！');
//                    layer.alert('姓名或者学号不正确！', {
//                        icon: 5,
//                        skin: 'layer-ext-moon' //该皮肤由layer.seaning.com友情扩展。关于皮肤的扩展规则，去这里查阅
//                    })
                }
                else if(inf==3){
                     alert ('请把信息填齐全！');
//                    layer.alert('请把信息填齐全！', {
//                        icon: 5,
//                        skin: 'layer-ext-moon' //该皮肤由layer.seaning.com友情扩展。关于皮肤的扩展规则，去这里查阅
//                    })
                }
                else {
                }



            }
            else {}

        };//接受返回值  
        xmlhttp.open("POST","phpData/auto_insertidname.php",true);//这个页面便是你要进行选择查询的PHP页面 
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