<?php
header("Content-Type:text/html;charset=UTF-8");
//根据课程和班级名,userId 找到finalPer,   用户自定义字段的分布，    该班级的所有学生信息


//$courseName = '数据库';
//$userId = 18;
//$classId = 55;

$courseName = $_POST['courseName'];
$userId = $_POST['userId'];
$classId = $_POST['classId'];

require "../mysql-connect.php";

//1.找到finalPer,attendancePer
$sql = "SELECT `Id`,`finalPer`,`attendancePer`,`classSize` FROM `basic_relation` WHERE `userId`=$userId  and `classId`=$classId and `courseName`='$courseName'";
$set=mysqli_query($db,$sql);
$row = mysqli_fetch_assoc($set);
$finalPer=$row['finalPer'];
$attendancePer=$row['attendancePer'];
$classSize=$row['classSize'];
$Id=$row['Id'];

$infArr=array('finalPer'=>$finalPer,'attendancePer'=>$attendancePer,'classSize'=>$classSize);

//2. 用户自定义字段的分布
$find_field="SELECT `userDefineId`,`userDefineName`,`userDefinePer` FROM `userdefine` WHERE `Id`=$Id";
$set=mysqli_query($db,$find_field);

$fieldArr=array();
while($row=mysqli_fetch_assoc($set)){
    $temp=array('userDefineId'=>$row['userDefineId'],'userDefineName'=>$row['userDefineName'],'userDefinePer'=>$row['userDefinePer']);
    array_push($fieldArr,$temp);
}

//3.该班级的所有学生信息
/*$find_stu="SELECT * FROM `student` WHERE `classId`=$classId order by stuId";
$set=mysqli_query($db,$find_stu);

$stuArr=array();
while($row=mysqli_fetch_assoc($set)){
    $temp=array('stuId'=>$row['stuId'],'stuName'=>$row['stuName'],'stuCode'=>$row['stuCode']);
    array_push($stuArr,$temp);
}*/

$sumArr=array('percentInf'=>$infArr,'field'=>$fieldArr/*,'stuInf'=>$stuArr*/);

//echo var_dump($sumArr);
echo json_encode($sumArr);