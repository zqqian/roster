<?php

require_once "get_user_info.php";

$oldpassword=$_POST['oldpassword'];
$newpassword=$_POST['newpassword'];
$newpassword2=$_POST['newpassword2'];

$pw3=substr(md5(md5(md5($oldpassword)).md5($username)),0,20);
if($oldpassword!=""&&$username!=""&&&&$userid!=""){
	$sql = "select passWord from user where userName = '$username' ";
            $result=mysqli_query($db,$sql);
			$row = mysqli_fetch_assoc($result);
			
            if($row['passWord']==$pw3)  
            {
				if($newpassword==""||$newpassword2==""||$newpassword!=$newpassword2){
					echo "0";
<<<<<<< HEAD
				}
                else{
					$npw=substr(md5(md5(md5($$newpassword)).md5($username)),0,20);
					$sql = "UPDATE `roster`.`user` SET `passWord` = $npw' WHERE `user`.`userId` = $userid";
					$result=mysqli_query($db,$sql_insert);
					if(!$result) echo"0";//ʧ��
					else
                    {
                        echo"1";}
=======
				}else{
					$npw=substr(md5(md5(md5($newpassword)).md5($username)),0,20);
					$sql = "UPDATE `roster`.`user` SET `passWord` = $npw WHERE `user`.`userId` = `$userid`";
					$result=mysqli_query($db,$sql_insert);
					echo "0";
					else         echo"1";
>>>>>>> bc0c07197ece2eaac46d8e04ba86694cf82daec0
				}

				//echo "q";/*"<script> alert('Login successfully');parent.location.href='./userSee.php'; </script>"; */
            }  
            else  
            {  
		
               echo "2";/*"wrong password !";*/
		}
	
	
}else{
	echo "0";
}

		    
?>
