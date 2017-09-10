
<?php
session_start();
header("Content-Type:text/html;charset=UTF-8");

$userId=$_POST['userId'];
$textvalue=$_POST['textvalue'];

$dir = dirname(dirname(__FILE__));//找到当前脚本所在路径
$filepath = $dir . "/validation/" . $userId."/".$textvalue;


/*if (!file_exists($filepath)) {    //判断文件夹是否存在，不存在的话就创建这么一个文件夹
    echo "<script>alert('验证码已失效！')</script>";
}
else require "autoidname.php";*/

if (!file_exists($filepath)) {    //判断文件夹是否存在，不存在的话就创建这么一个文件夹
    echo "0";
}
else echo"1";



?>
