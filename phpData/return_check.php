<?php
header("Content-Type:text/html;charset=UTF-8");
/**
 * Created by PhpStorm.
 * User: 卢
 * Date: 2017/8/18
 * Time: 18:48
 */

$courseId = $_POST['courseId'];
$classId = $_POST['classId'];
$userId = $_POST['userId'];

//echo $userId.$classId.$courseId;
require "../mysql-connect.php";
$find_id="select * from basic_relation where userId=$userId and courseId=$courseId and classId=$classId";
$result=mysqli_query($db,$find_id);
$row = mysqli_fetch_assoc($result);
$Id=$row['Id'];

$find_define="SELECT `userDefineId`,`userDefineName` FROM userdefine WHERE Id=$Id";
$set=mysqli_query($db,$find_define);
while($row=mysqli_fetch_assoc($set)){
    echo "<option value='".$row['userDefineId']."'>".$row['userDefineName']."</option>";
}
mysqli_close($db);
/*$find_course = "SELECT courseId,courseName FROM basic_relation WHERE userId=$userId and classId=$classId";
//echo $find_course;
require "../mysql-connect.php";
$set=mysqli_query($db,$find_course);

while($row=mysqli_fetch_assoc($set)){
    echo "<option value='".$row['courseId']."'>".$row['courseName']."</option>";
}
mysqli_close($db);*/