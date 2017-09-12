<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2017/9/9
 * Time: 13:47
 */
session_start();
header("Content-Type:text/html;charset=UTF-8");

function deldir($dir) {

    //先删除目录下的文件：

    $dh=opendir($dir);

    while ($file=readdir($dh)) {

        if($file!="." && $file!="..") {

            $fullpath=$dir."/".$file;

            if(!is_dir($fullpath)) {

                unlink($fullpath);

            } else {

                deldir($fullpath);

            }

        }

    }



    closedir($dh);

    //删除当前文件夹：

    if(rmdir($dir)) {

        return true;

    } else {

        return false;

    }

}


$userId=$_POST['userId'];
$authcode=$_SESSION['authcode'];
echo $authcode;
$dir = dirname(dirname(__FILE__));//找到当前脚本所在路径
$dirName = $dir . "/validation/" . $userId;

deldir($dirName);