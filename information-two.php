<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/27
 * Time: 22:07
 */

session_start();
$email_code_reset=$_POST['Email_code_reset'];
$email_code_right_reset=$_SESSION['re_email_code'];
if($email_code_reset==$email_code_right_reset)
{
    echo "1";
}
else{
    echo "0";
}
