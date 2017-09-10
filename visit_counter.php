<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2017/9/8
 * Time: 21:28
 */
session_start();
header("Content-Type:text/html;charset=UTF-8");

$userId = $_POST['userId'];

    $dir = dirname(__FILE__);//找到当前脚本所在路径
    $filepath = $dir . "/validation/" . $userId . "/" . "counter.txt";

    if (!file_exists($filepath)) {//判断文件夹是否存在，不存在的话就创建这么一个文件夹
        echo "0";
    } else {
        echo intval(file_get_contents($filepath));
    }
