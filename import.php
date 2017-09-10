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
    <title>导入学生信息</title>
    <link rel="stylesheet" type="text/css" href="css/summarycss.css">
    <link rel="stylesheet" href="style/placeholder.css">
	<script src="js/jquery-3.2.1.js"></script>
	<style>
        span{
            color: red;
            font-size: 14px;
        }
        td{
            height: 45px;
            text-align: center;
            font-size: 16px;
            vertical-align: inherit;
        }
        #importForm{
            width:500px;
            margin:0 auto;
            display: block;
            border-radius: 10px;
        }
        #importTable{
            margin:0 auto;
            width:540px;
        }
        .box{
            width:450px;
            height:150px;
            line-height: 150px;
            border: orangered solid 5px;
            margin: 0 auto;
            border-radius: 10px;
        }
        .over{
            width:450px;
            height:150px;
            border: orangered dashed  5px;
            background: lightgoldenrodyellow;
            border-radius: 10px;
        }

        select{
            position: relative;
            width: 200px;
            margin: 0 auto;
            padding: 10px 15px;
            background: #fff;
            border-left: 5px solid grey;
            cursor: pointer;
            outline: none;
        }

        input[type='text']{
            width:240px;
        }
        img{width: 300px;}
	</style>
</head>
<script>
    //拖拽事件的设定
    $(document).on({
        dragenter:function(e){//当被拖拽元素进入目标元素时触发
            e.preventDefault();
            $(".box").addClass('over');
        },
        dragover:function(e){//当被拖拽元素在目标元素上移动时触发
            e.preventDefault();
            $(".box").addClass('over');
        },
        dragleave:function(e){//当被拖拽元素离开目标元素时触发
            e.preventDefault();//移除原有浏览器监听效果
            $(".box").removeClass("over");
        },
        drop:function(e){//当被拖拽元素在目标元素上移动时触发
            e.preventDefault();
            $(".box").removeClass('over');
        }
    });
</script>
<body>
    <form id="importForm" action="#"  method="post" enctype="multipart/form-data">
        <table id="importTable">
            <tr>
            <td>入学年份：</td>
            <td>
                <select name="year" id="enterYear" >
                     <option value="" selected></option>
                    <?php
                        for($i=2010;$i<=2024;$i++)
                        echo "<option value='$i'>$i</option>";
                    ?>
                </select>
            </td>
            </tr>

            <tr>
                <td>所授课程名：</td>



                <td>
                    <input required='' type="text" name="course" id="course" placeholder="请输入完整的课程名">
                   </label>
                </td>
            </tr>

            <tr>
                <td>所授班级名：</td>
                <td><input type="text" name="className" id="className" placeholder="请输入完整的班级名"></td>
            </tr>


            <tr>
                <td>文件上传说明：</td>
                <td>
                        <span>*上传文件必须是一个扩展名为.xls或.xlsx的Excel文件</span>
                </td>
            </tr>

            <tr>
                <td>Excel文件格式：</td>
                <td>
                    <img src="img/Excelexample.png">
                </td>
            </tr>

            <tr>
                <td colspan="2"><!--拖拽框-->
                    <center>
                        <div class="box" id="target_box">
                        拖拽文件到此区自动上传
                        </div>
                    </center>
                </td>
            </tr>
        <!--使用表单上传文件
        <input type="file"  name="file" id="file"
               accept="application/vnd.ms-excel,application/vnd.openxhrformats-officedocument.spreadsheetml.sheet">
        <input type="submit" value="上传">-->

         </table>
    </form>
<script>
    //实现AJAX拖拽上传的js代码
    var xhr=null;
    var box=document.getElementById("target_box");
    box.addEventListener('drop', function (e) {//e是鼠标状态  drag当被拖拽元素被拖拽时触发
        //三个值都为非空的时候才能拖拽文件上传Excel
        var year = $("#enterYear").val();
        var course = $("#course").val().trim();
        var className = $("#className").val().trim();
        if("" == year || "" == course || "" == className){
            alert("请填写完整信息再上传学生信息表！");
        } else {
            e.preventDefault();//阻止浏览器对元素的默认处理方式

            var fileList = e.dataTransfer.files;//从鼠标状态中获取文件对象
            //fileList.length 用来获取上传文件的长度，因为这里设定是一次上传一个班的信息，所以规定只能上传一个

            if(fileList.length!=1){
                alert("仅支持一次上传一个Excel文件");
            }else{
            xhr = new XMLHttpRequest();
            xhr.open("post", "import_upload.php", true);
            xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");

            var formData = new FormData();
                formData.append('file', fileList[0]);
                formData.append('enterYear',year);
                formData.append('course',course);
                formData.append('className',className);
                formData.append('username',"<?php echo $_SESSION['username'] ?>");
                formData.append('userid',"<?php echo $_SESSION['userid'] ?>");

            xhr.send(formData);
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    /*
                    *
                    *
                    * 这里根据返回错误代码提示信息，后端返回字符串，若数据库连接有问题则不能及时反映
                    *
                    *
                    *
                    * */
                    alert(xhr.responseText);

                }
            };
            }
         }
    });
</script>
</body>
</html>