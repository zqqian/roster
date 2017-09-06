<?php
header("Content-Type:text/html;charset=UTF-8");

$courseName = $_POST['courseName'];
$userId = $_POST['userId'];
$classId = $_POST['classId'];


//$courseName = '数据库';
//$userId = 18;
//$classId = 55;
//$Id=51;

require "../mysql-connect.php";



$sql = "SELECT `Id`,`finalPer`,`attendancePer`,`classSize` FROM `basic_relation` WHERE `userId`=$userId  and `classId`=$classId and `courseName`='$courseName'";
$set=mysqli_query($db,$sql);
$row = mysqli_fetch_assoc($set);
$Id=$row['Id'];


$sql0 = "SELECT s.stuId,stuCode,stuName,finalGrade,classSize,b.Id,g.gradeId
FROM student as s
left outer join basic_relation as b on(s.classId = b.classId and b.Id=$Id)
left outer join grade as g on(s.stuId = g.stuId and b.Id=g.Id)
where s.classId=$classId";

$set=mysqli_query($db,$sql0);

$stu_final=array();

while($row=mysqli_fetch_assoc($set)){

    $temp=array('gradeId'=>$row['gradeId'],'stuId'=>$row['stuId'],'stuName'=>$row['stuName'],'stuCode'=>$row['stuCode'],'finalGrade'=>$row['finalGrade']);
    array_push($stu_final,$temp);
}

echo json_encode($stu_final);
mysqli_close($db);