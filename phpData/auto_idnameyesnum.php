<?php
session_start();
header("Content-Type:text/html;charset=UTF-8");


$ID1=$_POST['ID'];
$myDate=$_POST['myDate'];


$ID = explode('_',$ID1);
$len=count($ID);
$num=0;

require "../mysql-connect.php";

for($i=0;$i<$len-1;$i++) {
    $sql1 = "select count(*) as num
            from sturoster
            where RosterDate='".$myDate."' and Id=".$ID[$i]." and `attendance`=0";
    //"select distinct count(*)   from sturoster where Id=".$ID[$i]." and RosterDate=".$myDate." and attendance='0'";
    $result1 = mysqli_query($db, $sql1);
    $row1=mysqli_fetch_assoc($result1);
    $num=$row1['num'];
   /* if ($result1) {
        while($row1=mysqli_fetch_assoc($result1)){
            $num++;
        }

    }*/
}
echo $num;


/*select *
from sturoster
where Id=51 and RosterDate=‘2017-09-12 18:40:10’ and attendance='0'*/
