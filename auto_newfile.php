<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2017/9/7
 * Time: 13:43
 */
session_start();
header("Content-Type:text/html;charset=UTF-8");


$userId=$_POST['userId'];
$flag=$_POST['flag'];

/*$path = "auto_newfilename/".$userId;
if (!file_exists($path)){
    mkdir($path,0777,true);
    echo "创建成功！";
}*/
if($flag==1) {
    $dir = dirname(__FILE__);//找到当前脚本所在路径
    $filepath = $dir . "/validation/" . $userId."/".$userId;


    if (!file_exists($filepath)) {//判断文件夹是否存在，不存在的话就创建这么一个文件夹
        mkdir($filepath, 0777, true);
        echo "创建成功！";
    }
}
else if($flag==0){
    $dir = dirname(__FILE__);//找到当前脚本所在路径
    $delete_file = $dir . "/validation/" . $userId."/".$userId;
    rmdir($delete_file);
    echo "fjdsskjf";
    $_SESSION['lastauthcode']="lwx";
}