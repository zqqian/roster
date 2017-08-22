<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/22
 * Time: 18:32
 */
$userId = $_POST['userId'];
$Newemail=$_POST['email'];
$Newschool=$_POST['school'];
$Newacademy=$_POST['academy'];
//echo $userId.$Newacademy.$Newschool.$Newemail;

$sql_update="UPDATE user SET email='$Newemail',academy='$Newacademy' WHERE userId=$userId";
//echo $sql_update;
$r=mysqli_query($db,$sql_update);
if($r==1) echo "1";
else echo "0";
mysqli_close($db);