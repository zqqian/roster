<?php

require_once "get_user_info.php";

$oldpassword=$_POST['oldpassword'];
$newpassword=$_POST['newpassword'];
$userid=$_POST['userId'];
$pw3=substr(md5(md5(md5($$oldpassword)).md5($username)),0,20);
		    $sql = "select passWord from user where userId = '$userid' ";
            $result=mysqli_query($db,$sql);
			$row = mysqli_fetch_assoc($result);

            if($row['passWord']!=$pw3)
            {
				echo "0";
            }
         else if($newpassword!=$oldpassword){
                   echo"2";
              }
            else
            {
				$npw=substr(md5(md5(md5($$oldpassword)).md5($username)),0,20);
				$sql = "UPDATE `roster`.`user` SET `passWord` = $npw' WHERE `user`.`userId` = $userid";
				$result=mysqli_query($db,$sql_insert);
				if(!$result) echo"3";//ʧ��
				else         echo"1";
		}
?>
