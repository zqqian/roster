<?php require_once 'get_user_info.php';?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>导入学生信息</title>
	<script src="js/jquery-3.2.1.js"></script>
	<style>
        span{
            color: red;
            font-size: 14px;
        }
        td{
            height: 35px;
            text-align: center;
            font-size: 16px;
        }
        #importForm{
            width:500px;
            margin:0 auto;
            display: block;
            border:pink solid 3px;
            border-radius: 10px;
        }
        #importTable{
            margin:0 auto;
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
                <td><input type="text" name="course" id="course" placeholder="请输入完整的课程名"></td>
            </tr>

            <tr>
                <td>所授班级名：</td>
                <td><input type="text" name="className" id="className" placeholder="请输入完整的班级名"></td>
            </tr>

            <tr>
                <td>文件上传说明：</td>
                <td>
                    <div id="showExample">
                        <span>*上传文件必须是一个扩展名为.xls或.xlsx的Excel文件<span>
                                <!--

                                这里再加一个有标准格式的Excel文件，加上类似淘宝放大镜的效果用于提示

                                -->
                    </div>
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
                formData.append('username',"<?php echo $username; ?>");
                formData.append('userid',"<?php echo $userid;?>");

            xhr.send(formData);
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    alert(xhr.responseText);

                }
            };
            }
         }
    });
</script>
</body>
</html>