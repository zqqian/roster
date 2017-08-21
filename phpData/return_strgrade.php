<?php
$check = $_POST['check'];
$courseId = $_POST['courseId'];
$classId = $_POST['classId'];
$userId = $_POST['userId'];

//echo $userId.$classId.$courseId;
require "../mysql-connect.php";
$find_id="select * from basic_relation where userId=$userId and courseId=$courseId and classId=$classId";
$result=mysqli_query($db,$find_id);
$row = mysqli_fetch_assoc($result);
$Id=$row['Id'];
//$inf=$row['enterYear'].$row['className'].$row['courseName'];


//接下来写sql语句返回该门班级该门课程的学生成绩列表

$str="<thead><tr><th>学号</th><th>姓名</th><th>成绩</th></tr></thead><tbody>";
echo $str;

if("Fgrade" == $check){//如果是期末成绩
    $find_Fgrade="select   s.stuCode,s.stuName,finalGrade
from student as s
left outer join grade as g
on(s.stuId=g.stuId and g.Id=$Id)
where s.classId=$classId order by s.stuId";

    $set=mysqli_query($db,$find_Fgrade);
    $i=0;
    while($row=mysqli_fetch_assoc($set)){
        if( $i % 2 == 1)echo "<tr><td>";
        else echo "<tr class='success'><td>";
        echo $row['stuCode']."</td><td>".$row['stuName']."</td><td>";
        if(null == $row['finalGrade'])
            echo "暂未录入</td></tr>";
        else
            echo $row['finalGrade']."</td></tr>";
        $i++;
    }
    echo "</tbody>";

}else{
    $find_Ngrade="select   s.stuId,s.stuName,s.stuCode,fieldGrade,definegrade.userDefineId,userDefineName
from student as s
left outer join definegrade
on(s.stuId=definegrade.stuId and definegrade.Id=$Id)
left outer join userdefine on
(definegrade.userdefineId=userdefine.userdefineId)
where s.classId=$classId and definegrade.userdefineId=$check order by s.stuId";
    $set=mysqli_query($db,$find_Ngrade);
    $i=0;
    while($row=mysqli_fetch_assoc($set)){
        if( $i % 2 == 1)echo "<tr><td>";
        else echo "<tr class='success'><td>";

        echo $row['stuCode']."</td><td>".$row['stuName']."</td><td>";
        if(null == $row['fieldGrade'])
            echo "暂未录入</td></tr>";
        else
            echo $row['fieldGrade']."</td></tr>";
        $i++;
    }
    echo "</tbody>";
}



