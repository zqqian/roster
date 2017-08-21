<?php

$showClass = $_POST['showClass'];
$showCourse = $_POST['showCourse'];
$userId = $_POST['userId'];

echo $showClass.$showCourse.$userId;
require "../mysql-connect.php";
$find_id="select * from basic_relation where userId=$userId and courseId=$showCourse and classId=$showClass";
$result=mysqli_query($db,$find_id);
$row = mysqli_fetch_assoc($result);
$Id=$row['Id'];
//$inf=$row['enterYear'].$row['className'].$row['courseName'];


//接下来写sql语句返回该门班级该门课程的学生成绩列表