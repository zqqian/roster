<?php

session_start();
$savePath = "./session_save_dir/";
$username=$_POST['userName'];
$pwd=$_POST['password'];
//echo $username."*".$pwd;
require_once 'mysql-connect.php';

if($username==""||$pwd==""){
	echo "3" /*"用户名和密码不能为空"*/;
}else{
	$num=file_get_contents("http://127.0.0.1/roster/check_username.php?id=".$username);
    if($num)   
	{
		echo"2" /*$username."该用户不存在!"*/;
		
    }else{
			$pw3=substr(md5(md5(md5($pwd)).md5($username)),0,20);
		    $sql = "select passWord from user where userName = '$username' ";
            $result=mysqli_query($db,$sql);
			$row = mysqli_fetch_assoc($result);
			
            if($row['passWord']==$pw3)  
            {
				$_SESSION['username']=$username;
//			    echo session_id();
				// set cookie or session
				//jump to userSee.php
				echo "0";/*"<script> alert('Login successfully');parent.location.href='./userSee.php'; </script>"; */
            }  
            else  
            {  
		
               echo "1";/*"wrong password !";*/
		}
		mysqli_close($db);
	
}}





?>