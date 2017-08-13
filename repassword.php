<?php
/*从数据库获取用户注册的密码*/
 echo '1234';
$newpassword=isset($_POST['newpassword']) ? htmlspecialchars($_POST['newpassword']) :'';
/*将新密码存储到数据库，若存储成功则返回更改成功*/
 echo '新密码：'.$newpassword.'\n 更改成功';
?>