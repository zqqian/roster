
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
</head>
<?php
/*
PHP+AJAX 检查注册账号时用户名是否存在
参考：http://blog.csdn.net/zxh543362234/article/details/46943859


*/
error_reporting(0);
if($_GET['id'])
{
	sleep(1);//为了显示等待检测这么一个动态效果，所以这里等待一秒执行
	require_once 'mysql-connect.php';
	
	$sql = "select * from user where userName='$_GET[id]'";
	$result = mysql_query($sql);
	
	//这里的echo输出的内容便是将要返回给之前byphp()这个函数的值
	if(is_array(mysql_fetch_row($result)))
	{
		echo "用户名已经存在！";
	}
	else
	{
		echo " 用户名可用";
	}
}
?>