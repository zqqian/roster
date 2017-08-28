<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/25
 * Time: 15:17
 */
header("Content-type: text/html; charset=utf-8");
require_once("functions.php");
session_start();
$username=$_POST['RuserName'];
$email=$_POST['email'];
$pw_length=6;
$randpwd="";
$chars='0123456789';
while(strlen($randpwd)<$pw_length) {
    $randpwd .= substr($chars, (mt_rand() % strlen($chars)), 1);
}
$_SESSION['randpwd']=$randpwd;
$title="云点名注册激活";
$content= "亲爱的".$username.":<br/>感谢您在云点名注册了新帐号。<br/>本次注册的验证码为:".$randpwd."<br/>注:验证码仅在本次注册有效
，请在登录页面填入验证码激活您的账号。<br/><p style='text-align:right'>--------云点名</p>";
$flag = sendMail($email,$title,$content);
if($flag){
    echo "1";
}else{
    echo "0";
}