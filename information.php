<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/12
 * Time: 20:21
 */
require_once 'mysql-connect.php';
require_once 'get_user_info.php';
if(!$is_login){
	exit();
}

$sql = "select email from user where userName = '$username' ";
$result=mysqli_query($db,$sql);
$row = mysqli_fetch_assoc($result);

$email=$row['email'];			

$sql = "select college from user where userName = '$username' ";
$result=mysqli_query($db,$sql);
$row = mysqli_fetch_assoc($result);
$college=$row['college'];	
$sql = "select academy from user where userName = '$username' ";
$result=mysqli_query($db,$sql);
$row = mysqli_fetch_assoc($result);
$academy=$row['academy'];	
 $a['username']=$username;
 $a['email']=$email;
 $a['college']=$college;
 $a['academy']=$academy;
 echo json_encode($a);
 
//var_dump($a);
 ?>
