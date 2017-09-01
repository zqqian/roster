<?php
header("Content-Type:text/html;charset=UTF-8");
//根据课程和班级名,userId 找到finalPer,   用户自定义字段的分布，    该班级的所有学生信息

$courseName = $_POST['courseName'];
$userId = $_POST['userId'];
$classId = $_POST['classId'];
$field = $_POST['field'];

//$courseName = '数据库';
//$userId = 18;
//$classId = 55;
//$field = "实验一-实验二-实验三-";
//$Id=51;

$field_split= explode('-',$field);//字符串按字符分割


require "../mysql-connect.php";


//1.找到finalPer,attendancePer
$sql = "SELECT `Id`,`finalPer`,`attendancePer`,`classSize` FROM `basic_relation` WHERE `userId`=$userId  and `classId`=$classId and `courseName`='$courseName'";
$set=mysqli_query($db,$sql);
$row = mysqli_fetch_assoc($set);
//$finalPer=$row['finalPer'];
//$attendancePer=$row['attendancePer'];
//$classSize=$row['classSize'];
$Id=$row['Id'];



//$sql0 = "max(case p.userDefineName when '实验一' then p.fieldGrade else -1 end) '实验一',
//max(case p.userDefineName when '实验二' then p.fieldGrade else -1 end) '实验二',
//max(case p.userDefineName when '实验三' then p.fieldGrade else -1 end) '实验三'";//原测试$sql2
$sql1 = "SELECT p.stuId,stuCode,stuName,";
$sql2="";
$sql3 ="FROM
(select distinct u.userDefineId,userDefineName,u.Id,b.classId,s.stuId,s.stuCode,s.stuName ,d.defineGradeId,d.fieldGrade
from userdefine as u join basic_relation as b on(u.Id=b.Id)
join student as s on(b.classId=s.classId)
left outer join definegrade as d on(u.userDefineId=d.userDefineId and s.stuId=d.stuId)
where u.Id=51
)as p
group by p.stuId";




for($i=0;$i<count($field_split)-1;$i++) {
    if($i != count($field_split)-2)
        $sql2 = $sql2."max(case p.userDefineName when '$field_split[$i]' then p.fieldGrade else null end) '$field_split[$i]',";
    else
        $sql2 = $sql2."max(case p.userDefineName when '$field_split[$i]' then p.fieldGrade else null end) '$field_split[$i]'";
}

$sql = $sql1.$sql2.$sql3;
$set=mysqli_query($db,$sql);

$stuArr=array();

while($row=mysqli_fetch_assoc($set)){
    $temp=array('stuId'=>$row['stuId'],'stuName'=>$row['stuName'],'stuCode'=>$row['stuCode']);
    for($i=0;$i<count($field_split)-1;$i++) {
        $t = $row[$field_split[$i]];
        $temp[$field_split[$i]]=$t;//如果没有录入成绩的话返回-1
    }
    array_push($stuArr,$temp);
}

echo json_encode($stuArr);





