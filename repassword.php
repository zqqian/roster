<?php

require_once "get_user_info.php";
error_reporting(1);
$oldpassword=$_POST['oldpassword'];
$newpassword=$_POST['newpassword'];
$newpassword2=$_POST['newpassword2'];


					$npw=substr(md5(md5($$newpassword).md5($username)),0,20);
					$sql = "UPDATE `roster`.`user` SET `passWord` = $npw WHERE `user`.`userId` = $userid";
					$result=mysqli_query($db,$sql);

					$npw=substr(md5(md5(md5($newpassword)).md5($username)),0,20);
					//echo $npw;
					$sql = "UPDATE `user` SET `passWord` = '$npw' WHERE userName = '$username'";
					$result=mysqli_query($db,$sql);
					//var_dump($result);
					if(!$result) echo"0";//ʧ��
					else
                    {
                        echo"1";}
				}

				//echo "q";/*"<script> alert('Login successfully');parent.location.href='./userSee.php'; </script>"; */
            }
            else
            {

               echo "2";/*"wrong password !";*/
		}
?>
