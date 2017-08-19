<?php
header("Content-Type:text/html;charset=UTF-8");
/**
 * Created by PhpStorm.
 * User: 卢
 * Date: 2017/8/18
 * Time: 18:48
 */
$classId = $_POST['classId'];
$userId = $_POST['userId'];

$find_course = "SELECT courseId,courseName FROM basic_relation WHERE userId=$userId and classId=$classId";
//echo $find_course;
require "mysql-connect.php";
$set=mysqli_query($db,$find_course);

while($row=mysqli_fetch_assoc($set)){
    echo "<option value='".$row['courseId']."'>".$row['courseName']."</option>";
}
mysqli_close($db);