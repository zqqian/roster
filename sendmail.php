<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/25
 * Time: 15:17
 */
session_start();
$username=$_POST['RuserName'];
$email=$_POST['email'];
$auth_code=$_POST['Auth_code'];
require_once "Smtp.class.php";
$pw_length=6;
$randpwd="";
$chars='0123456789';
while(strlen($password)<$pw_length) {
    $password .= substr($chars, (mt_rand() % strlen($chars)), 1);
}
$_SESSION['randpwd']=$randpwd;
$smtpserver = "smtp.exmail.qq.com";//SMTP服务器        ?????
$smtpserverport =25;//SMTP服务器端口                       ?????
$smtpusermail = "2392844503@qq.com";//SMTP服务器的用户邮箱????
$smtpemailto = $username;//发送给谁                 ?????
$smtpuser = "web@daixiaorui.com";//SMTP服务器的用户帐号，注：部分邮箱只需@前面的用户名
$smtppass = "cabxzplotfpcecaj";//SMTP服务器的用户密码
$emailsubject="用户注册验证码";//邮件主题
$mailtype = "HTML";//邮件格式（HTML/TXT）,TXT为文本邮件
$smtpemailfrom = $smtpusermail;
$emailbody = "亲爱的".$username."：<br/>感谢您使用我们的网站。<br/>请点击链接激活您的帐号。<br/>
本次注册的激活验证码为：<h3>  $randpwd  <h3> &nbsp;&nbsp;验证码仅在本次注册有效。<br/>
<br/>如果此次激活请求非你本人所发，请忽略本邮件。<br/><p style='text-align:right'>-------- 云点名</p>";
//************************ 配置信息 ****************************
$smtp = new Smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
$smtp->debug = false;//是否显示发送的调试信息
$state = $smtp->sendmail($smtpemailto, $smtpusermail, $emailsubject, $emailbody, $mailtype);
if($state==1){
    echo "1";
}
else{
   echo "0";
}