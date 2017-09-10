<?php

$course = $_GET['course'];
$class = $_GET['class'];
$userId = $_GET['userId'];

//$course = 39;
//$class = 55;
//$userId = 18;

require "../mysql-connect.php";
$find_id="select * from basic_relation where userId=$userId and courseId=$course and classId=$class";
$result=mysqli_query($db,$find_id);
$row = mysqli_fetch_assoc($result);
$Id=$row['Id'];

$find_start_end = "SELECT Id,min(rosterDate) as min,max(rosterDate) as max FROM `classroster`  group by Id having Id=$Id";
$result=mysqli_query($db,$find_start_end);
$row = mysqli_fetch_assoc($result);

$start = $row['min'];
$end = $row['max'];

$arr = array(substr($start,0,10),substr($end,0,10));

echo json_encode($arr);

