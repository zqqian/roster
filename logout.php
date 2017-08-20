<?php
session_start();
//删除用户导出学生成绩时在服务器上产生的Excel文件
$temp = $_SESSION['excel'];
for ($i = 0; $i < count($temp); $i++)
{
    $filename = $temp[$i];
    if (file_exists($filename)) {
        echo "<script>console.log('The file $filename exists and delete.');</script>";
        @unlink($filename);
    } else {
        echo "<script>console.log('The file $filename does not exist.');</script>";
    }

}
session_unset();
session_destroy();





