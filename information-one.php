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
$username=$_POST['Information_Username'];
$email=$_POST['Information_Email'];
$pw_length=6;
$email_code_reset="";
$chars='0123456789';
while(strlen($email_code_reset)<$pw_length) {
    $email_code_reset .= substr($chars, (mt_rand() % strlen($chars)), 1);
}
$_SESSION['re_email_code']= $email_code_reset;
$title="云点名邮箱验证";
$content= "亲爱的".$username.":<br/><br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;本次重设密码的邮箱验证码为:".$email_code_reset."<br/><br/>注:验证码仅在本次有效
，请在重设密码页面填入验证码验证您的邮箱。<br/><br/><p style='text-align:right'>--------云点名</p>";
$flag = sendMail($email,$title,$content);
if($flag){
    echo "1";
}else{
    echo "0";
}