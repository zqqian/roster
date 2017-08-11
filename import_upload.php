<?php
header("Content-Type:text/html;charset=UTF-8");

//接收表单数据
$year = $_POST['enterYear'];
$course = $_POST['course'];
$className = $_POST['className'];

//判断是否有错误号
if($_FILES['file']['error']){
    switch($_FILES['file']['error']){
        case 1: $str = '上传的文件超过了 php.ini 中 upload_max_filesize 选项限制的值';
            break;
        case 2: $str = '上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值';//默认为2M 需修改请找php.ini 搜索MAX_FILE_SIZE
            break;
        case 3: $str = '文件只有部分被上传';
            break;
        case 4: $str = '没有文件被上传';
            break;
        case 6: $str = '找不到临时文件夹';
            break;
        case 7: $str = '文件写入失败';
            break;
    }
    echo $str;
}
else{
    //判断你准许的文件大小
    if($_FILES['file']['size'] > (pow(1024 , 2) * 2)){//2的21次方 2M 默认为2M 需修改请找php.ini
        exit('文件大小超过准许大小');//exit() 函数输出一条消息，并退出当前脚本 该函数是 die() 函数的别名
    }

    //判断你准许的mime类型  文件后缀
    $allowMime=['application/vnd.ms-excel' , 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
    $allowSubFix=['xls' , 'xlsx' ];

    $info = pathinfo($_FILES['file']['name']);//pathinfo() 函数以数组或字符串的形式返回关于文件路径的信息
    $subFix = $info['extension'];

    if(!in_array($subFix ,$allowSubFix)){
        exit('不准许的文件后缀');
    }

    if(!in_array($_FILES['file']['type'] , $allowMime)){
        exit('不准许的mime类型');
    }

    //拼接上传路径
    $path = "tempExcel";
    if (!file_exists($path)){//判断文件夹是否存在，不存在的话就创建这么一个文件夹
        mkdir($path);
    }
    //文件名随机   uniqid()函数 用于生成一个唯一ID
    $name =iconv("UTF-8", "GBK", $year.$className.$course .".". $subFix);

    //判断是否是上传文件
    if(is_uploaded_file($_FILES['file']['tmp_name'])){
        if(move_uploaded_file($_FILES['file']['tmp_name'], $path."/".$name) ){
            //连接数据库，并存入文件信息
            /*
            1.从session里取出用户的信息（用户id）
            2.连接数据库，引入文件   require_once 'mysql-connect.php';
            3.向数据库插入班级信息，$class_insert = "insert into class (className,enterYear) values('$className',$year)";
              缺少班级总人数，班级总人数在读取Excel表之后再插入
            4.向数据库插入课程信息 $course_insert = "insert into course (courseName) values($course)";
            5.向class_course_user表插入信息
            $userId  从session里直接获取
            $classId   $classId_select="SELECT classId FROM class WHERE className='$className'";
            $courseId  $courseId_select="SELECT courseId FROM course WHERE className='$course'";

            $id_insert = "insert into class_course_user (userId,classId,courseId) values('$userId','$classId','$courseId')";

            6.利用PHPExcel来读取Excel表中学生的信息，然后把学生的信息插入数据库中（解数据库记得及时关闭链接）
                需要考虑一下怎么大批量插入数据的问题，思路：利用array（）  百度更好的方法

                $stuName
                $stuCode
                $Id 通过 SELECT Id FROM class_course_user
                         WHERE classId=$classId and courseId=$courseId and userId=$userId

                $stu_insert="INSERT INTO student(stuName ,stuCode ,Id) VALUES ('$stuName', '$stuCode', $Id);"
            7.插入班级总人数
            $stu_num
            insert into class (classSize) values($stu_num)
            */
            echo  '上传成功';
        }else{
            echo '文件移动失败';
        }
    }else{
        exit('不是上传文件');

    }
}

//以下代码备用 暂时不用删除
/*if(is_uploaded_file($_FILES['file']['tmp_name'])){
    move_uploaded_file($_FILES['file']['tmp_name'], "./".iconv("UTF-8", "GBK", $_FILES['file']['name']));
    echo '1';
}*/
