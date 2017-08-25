<?php

require_once "get_user_info.php";
error_reporting(1);
$oldpassword=$_POST['oldpassword'];
$newpassword=$_POST['newpassword'];
$newpassword2=$_POST['newpassword2'];

$pw3=substr(md5(md5(md5($oldpassword)).md5($username)),0,20);
		    $sql = "select passWord from user where userName = '$username' ";
            $result=mysqli_query($db,$sql);
			$row = mysqli_fetch_assoc($result);

            if($row['passWord']==$pw3)
            {
				if($newpassword==""||$newpassword2==""||$newpassword!=$newpassword2){
					echo "3";
				}
                else{
<<<<<<< HEAD
					$npw=substr(md5(md5($$newpassword).md5($username)),0,20);
					$sql = "UPDATE `roster`.`user` SET `passWord` = $npw WHERE `user`.`userId` = $userid";
					$result=mysqli_query($db,$sql);
=======
					$npw=substr(md5(md5(md5($newpassword)).md5($username)),0,20);
					//echo $npw;
					$sql = "UPDATE `user` SET `passWord` = '$npw' WHERE userName = '$username'";
					$result=mysqli_query($db,$sql);
					//var_dump($result);
>>>>>>> 33d554f35fcdc72ee8e01baca59b7ece8afb3a84
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
