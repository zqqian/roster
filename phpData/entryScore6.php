<?php
//用于删除用户自定义字段，对应录入界面的删除字段按钮
header("Content-Type:text/html;charset=UTF-8");

$trId = $_POST['trId'];
//echo $trId;


require "../mysql-connect.php";

$sql_delete = "DELETE FROM `userdefine` WHERE `userDefineId`=".$trId;
//echo $sql_delete;
$r=mysqli_query($db,$sql_delete) or die(mysqli_error($db));
echo $r;

mysqli_close($db);