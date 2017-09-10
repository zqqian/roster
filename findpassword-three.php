<?php
header("Content-Type:text/html;charset=UTF-8");
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/27
 * Time: 22:07
 */

session_start();
require_once 'mysql-connect.php';
$is_login=false;
if(isset($_SESSION['username'])){
    $is_login=true;
    $username=$_SESSION['username'];
    $sql = "select userId from user where userName = '$username' ";
    $result=mysqli_query($db,$sql);
    $row = mysqli_fetch_assoc($result);
    $userid=$row['userId'];

    $_SESSION['userid']=$userid;
    //mysqli_close($db);
}else{

}

error_reporting(1);
$newpassword=$_POST['Newpassword'];
$renewpassword=$_POST['Renewpassword'];
$username=$_POST['Username'];
if($newpassword=="" || $renewpassword=="" || $newpassword != $renewpassword ){
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