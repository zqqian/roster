<?php
// 连接服务器，并且选择roster数据库

	
$db = mysql_connect("localhost","roster","roster666") 
	or die("连接数据库失败！");

mysql_select_db("roster")
	or die ("不能连接到user".mysql_error());
	
	

	
?>