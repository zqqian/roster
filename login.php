<?php
/**
 * Created by PhpStorm.
 * User: 卢
 * Date: 2017/8/2
 * Time: 22:03
 */
session_start();
$savePath = "./session_save_dir/";
$username=$_GET['userName'];
$pwd=$_GET['password'];
//echo $username."*".$pwd;
require_once 'mysql-connect.php';

if($username==""||$pwd==""){
	echo "用户名和密码不能为空";
}else{
	$num=file_get_contents("http://127.0.0.1/roster/check_username.php?id=".$username);
    if($num)   
	{
		echo $username."该用户不存在!";
		
    }else{
			$pw3=substr(md5(md5(md5($pwd)).md5($username)),0,20);
		 $sql = "select passWord from user where userName = '$username' ";  
            $result=mysqli_query($db,$sql);
			$row = mysqli_fetch_assoc($result);
			
            if($row['passWord']==$pw3)  
            {  
                
                echo "password confirm successfully"; 
$_SESSION['username']=$username;				 
			  
				// set cookie or session
				//jump to userSee.php
				
            }  
            else  
            {  
		
               echo "wrong password !";  
		}
	mysqli_close($db);
	
}}





?>