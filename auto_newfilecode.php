<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2017/9/7
 * Time: 23:34
 */

session_start();
header("Content-Type:text/html;charset=UTF-8");

/*function delFile($dirName){
    if(file_exists($dirName) && $handle=opendir($dirName)){
        while(false!==($item = readdir($handle))){
            if($item!= "." && $item != ".."){
                if(file_exists($dirName.'/'.$item) && is_dir($dirName.'/'.$item)){
                    delFile($dirName.'/'.$item);
                }else{
                    if(unlink($dirName.'/'.$item)){
                        return true;
                    }
                }
            }
        }
        closedir( $handle);
    }
}*/

$userId=$_POST['userId'];

 $authcode=$_SESSION['authcode'];

$dir = dirname(__FILE__);//找到当前脚本所在路径

$dirName = $dir . "/validation/" . $userId."/".$_SESSION['lastauthcode'];
/*delFile($dirName);*/
if(file_exists($dirName)) {
    rmdir($dirName);
    echo "删除成功";
}
$_SESSION['lastauthcode']=$authcode;


$filepath = $dir . "/validation/" . $userId."/".$authcode;
if (!file_exists($filepath)) {//判断文件夹是否存在，不存在的话就创建这么一个文件夹
    mkdir($filepath, 0777, true);
    echo "创建成功！";
}
?>
