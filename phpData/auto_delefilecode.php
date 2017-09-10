<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2017/9/9
 * Time: 13:47
 */
session_start();
header("Content-Type:text/html;charset=UTF-8");


$userId=$_POST['userId'];
$authcode=$_SESSION['authcode'];
echo $authcode;
$dir = dirname(dirname(__FILE__));//找到当前脚本所在路径
$delete_file = $dir . "/validation/" . $userId."/".$authcode;
rmdir($delete_file);