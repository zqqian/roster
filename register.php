<?php
error_reporting(0);
header("Content-Type:text/html;charset=utf-8");//设置页面显示中文

//接收注册信息
$username=$_POST['RuserName'];
$email=$_POST['email'];
$pwd1=$_POST['Rpassword1'];
$pwd2=$_POST['Rpassword2'];
$school=$_POST['Rschool'];
$academy=$_POST['Racademy'];

<<<<<<< HEAD
    require_once 'mysql-connect.php';



    $pw3=substr(md5(md5($pw1).md5($username)),0,20);
    $sql_insert = "insert into user (userName,passWord,email,college,academy) values('$username','$pw3','$email','$school','$academy')";
=======
require_once 'mysql-connect.php';
if($username==""|| $pwd1==""||$pwd2==""||$email==""){
	echo"2";
}else if($pwd1!=$pwd2){
	echo"3";	
}else{
	$num=file_get_contents("http://127.0.0.1/roster/check_username.php?id=".$username);
    if(!$num)    //如果已经存在该用户
	{
		echo "4";
		
    }else{
		$pwd3=substr(md5(md5($pwd1).md5($username)),0,20);
		$sql_insert = "insert into user (userName,passWord,email,college,academy) values('$username','$pwd3','$email','$school','$academy')";

		$result=mysqli_query($db,$sql_insert);
		if(!$result) echo"0";//注册失败
		else         echo"1";
}
	mysqli_close($db);
}
>>>>>>> 19b4f4a40e46dd66da1a8d61b4812a90fc6a9669

	
	
	

   





/* function check_input($value)
{

//if (get_magic_quotes_gpc())
//  {
//  $value = stripslashes($value);
//  }
//
//if (!is_numeric($value))
//  {
//  $value = "'" . mysql_real_escape_string($value) . "'";
//  }
return $value;
}

$username=check_input($_POST['RuserName']);
$email=check_input($_POST['email']);
$pwd1=check_input($_POST['Rpassword1']);
$pwd2=check_input($_POST['Rpassword2']);
$school=check_input($_POST['Rschool']);
$academy=check_input($_POST['Racademy']);

//echo $username."*".$email."*".$pwd1."*".$pwd2."*".$school."*".$academy;

// by zqqian
require_once 'mysql-connect.php';
$name=$username;
$password=$pwd1;
$pwd_again=$pwd2;
//$code=$_POST['check'];

if($name==""|| $password=="")
{
	echo"用户名或者密码不能为空";
}
else
{
    if($password!=$pwd_again)
    {
    	echo"两次输入的密码不一致,请重新输入！";
    	echo"<a href='register.php'>重新输入</a>";

    }
//  if need to open check code
//    else if($code!=$_SESSION['check'])
//    {
//    	echo"验证码错误！";
//    }
	else {
		$sql = "select userName from user where userName = '$username'"; //SQL语句
        $result = mysql_query($sql);    //执行SQL语句
        $num = mysql_num_rows($result); //统计执行结果影响的行数
        if($num)    //如果已经存在该用户
        {
            echo "<script>alert('用户名已存在'); history.go(-1);</script>";
        }
		else{
				$pw3=md5(md5($pw1).md5($username));
			$sql_insert = "insert into user (userName,passWord,email,college,academy) values('$username','$pw3','$email','$school','$academy')";

			$result=mysql_query($sql_insert);
			if(!$result)
			{
				echo"注册不成功！";
				echo"<a href='register.php'>返回</a>";
			}
			else
			{
    		echo"注册成功!";
			// jump to index.php?
			 echo "<script>alert('注册成功！'); history.go(-1);</script>";
			}
    }



	}

}*/
// refer to http://blog.csdn.net/jimoshuicao/article/details/17403327
?>