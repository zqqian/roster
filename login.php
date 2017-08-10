<?php
/**
 * Created by PhpStorm.
 * User: 卢
 * Date: 2017/8/2
 * Time: 22:03
 */
$username=$_GET['userName'];
$pwd=$_GET['password'];
//echo $username."*".$pwd;
require_once 'mysql-connect.php';

if($username==""||$pwd==""){
	echo "用户名和密码不能为空";
}else{
	$num=file_get_contents("check_username.php?id=".$username);
    if($num)    //如果已经存在该用户
	{
		echo $username."该用户不存在!".$num;
		
    }else{
		$pw3=md5(md5($pwd).md5($username));
		 $sql = "select userName,passWord from user where userName = '$username' and password = '$pw3'";  
            $result=mysqli_query($db,$sql); 
            if($result)  
            {  
                
                echo "password confirm successfuly";  
            }  
            else  
            {  
                echo "<script>alert('用户名或密码不正确！');history.go(-1);</script>";  
		}
	mysqli_close($db);
	
}}





?>