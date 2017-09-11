<?php
header("Content-Type:text/html;charset=UTF-8");

$classId = $_POST['classId'];
$userId = $_POST['userId'];

$find_course = "SELECT courseId,courseName FROM basic_relation WHERE userId=$userId and classId=$classId";
//echo $find_course;
require "../mysql-connect.php";
$set=mysqli_query($db,$find_course);

while($row=mysqli_fetch_assoc($set)){
    echo "<option value='".$row['courseId']."'>".$row['courseName']."</option>";
}
mysqli_close($db);