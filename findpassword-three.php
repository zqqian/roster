<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/27
 * Time: 22:07
 */
require_once "get_user_info.php";
error_reporting(1);
$newpassword=$_POST['Newpassword'];
$renewpassword=$_POST['Renewpassword'];
$username=$_POST['Username'];
if($newpassword==""||$renewpassword==""||$newpassword!=$renewpassword){
    echo "2";
}
else {
    $sql = "select passWord from user where userName = '$username' ";
        $npw = substr(md5(md5(md5($newpassword)) . md5($username)), 0, 20);
        //echo $npw;
        $sql = "UPDATE `user` SET `passWord` = '$npw' WHERE userName = '$username'";
        $result = mysqli_query($db, $sql);
        //var_dump($result);
        if (!$result) echo "0";//ʧ��
        else {
            echo "1";
        }
}
?>