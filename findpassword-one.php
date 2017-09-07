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
$username=$_POST['Username'];
$email=$_POST['Email'];
$pw_length=6;
$email_code="";
$chars='0123456789';
while(strlen($email_code)<$pw_length) {
$email_code .= substr($chars, (mt_rand() % strlen($chars)), 1);
}
$_SESSION['email_code']= $email_code;
$title="云点名邮箱验证";
$content= "亲爱的".$username.":<br/>&nbsp;&nbsp;本次找回密码的邮箱验证码为:".$email_code."<br/>注:验证码仅在本次有效
，请在找回密码页面填入验证码验证您的邮箱。<br/><p style='text-align:right'>--------云点名</p>";
$flag = sendMail($email,$title,$content);
if($flag){
echo "1";
}else{
echo "0";
}