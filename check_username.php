<?php
/*
PHP+AJAX 检查注册账号时用户名是否存在
参考：http://blog.csdn.net/zxh543362234/article/details/46943859
*/
header("Content-Type:text/html;charset=utf-8");//设置页面显示中文
error_reporting(0);

if(isset($_GET['id']))
{
	sleep(1);//为了显示等待检测这么一个动态效果，所以这里等待一秒执行
	require('mysql-connect.php');
	$sql="select * from user where userName= '".$_GET['id']."'";
	$result = mysqli_query($db,$sql);

	//这里的echo输出的内容便是将要返回给之前byphp()这个函数的值
	if(mysqli_num_rows($result) > 0)
	{
		echo "该用户名已经存在！";
	}
	else
	{
		echo "该用户名可用";
	}
	mysqli_close($db);//连接数据库的连接数是有限的,连接过后需要及时关闭掉不需要的连接
}