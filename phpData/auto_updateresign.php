<?php
header("Content-Type:text/html;charset=UTF-8");

$rosterDate=$_GET['rosterDate'];
$arr=$_GET['arr'];
$temp=$_GET['temp'];

//$rosterDate="2017-08-01 00:00:00";

require "../mysql-connect.php";
//echo $arr[$temp-1][4],$arr[$temp-1][5];

        $sql1 = "update `roster`.`sturoster` set attendance=0 where stuId=" .$arr[$temp-1][4]." and rosterDate='".$rosterDate."' and Id=".$arr[$temp-1][5];

//                    echo $sql4;
        $result1 = mysqli_query($db, $sql1);
        array_splice($arr,$temp-1,1);

echo json_encode($arr);
mysqli_close($db);
