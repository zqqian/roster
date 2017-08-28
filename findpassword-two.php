<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/27
 * Time: 22:07
 */

session_start();
$email_code=$_POST['Email_code'];
$email_code_right=$_SESSION['email_code'];
if($email_code==$email_code_right)
{
    echo "1";
}
else{
    echo "0";
}
