<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2017/9/10
 * Time: 11:28
 */

header("Content-Type:text/html;charset=UTF-8");

$classid_s=$_GET['classid_s'];
$courseName=$_GET['courseName'];
$userid=$_GET['userId'];

$ID=array();

require "../mysql-connect.php";

$len=count($classid_s);

for($i=0;$i<$len;$i++) {
    $sql = "select * from basic_relation where userId = '$userid' and classId='$classid_s[$i]' and courseName='$courseName'";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_assoc($result);
    array_push($ID, $row['Id']);
}

echo json_encode($ID);