<?php
/*
PHP+AJAX 检查注册账号时用户名是否存在
参考：http://blog.csdn.net/zxh543362234/article/details/46943859


*/
 if($_GET[id]){
    sleep(1);// what use for ?
    $conn=mysql_connect('localhost','roster','roster666');
    mysql_select_db('roster',$conn);
    $sql="SELECT * FROM `user` WHERE `userName`='$_GET[id]'";
    $q=mysql_query($sql);
 
    if(is_array(mysql_fetch_row($q))){
      echo "用户名已经存在"; 
    }else{
      echo "用户名可以使用"; 
    }
 }  
?>