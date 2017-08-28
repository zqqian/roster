<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/27
 * Time: 21:54
 */
session_start();
$username=$_POST['Username'];
$email=$_POST['Email'];
//检查如否存在该用户名和邮箱及是否匹配
require_once 'mysql-connect.php';
$num=file_get_contents("http://127.0.0.1/roster/check_username.php?id=".$username);
if(!$num) {
    $sql = "select email from user where userName = '$username' ";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_assoc($result);
    if ($row['email'] == $email) {
        echo "1";
    } else {
        echo "0";
    }
}
else {
    echo "2";
}
mysqli_close($db);

