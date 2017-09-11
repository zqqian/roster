<?php

header("Content-Type:text/html;charset=UTF-8");

$ID1=$_POST['ID'];
$myDate=$_POST['myDate'];


$ID = explode('_',$ID1);
$len=count($ID);

require "../mysql-connect.php";

for($i=0;$i<$len-1;$i++) {
    $sql1 = "select classId,classSize from basic_relation where Id=".$ID[$i] ;
    $result1 = mysqli_query($db, $sql1);

    if($result1) {
        $row1 = mysqli_fetch_assoc($result1);


        //初始化班级的点名记录，出勤为0人
        $sql2 = "INSERT INTO `roster`.`classroster` (`classRosterId`, `rosterDate`, `attendanceRate`, `realStu`, `shouldStu`, `Id`) VALUES (NULL, '$myDate', 0,0,". $row1['classSize'].','.$ID[$i].");";
        $result2 = mysqli_query($db, $sql2);

        //找出改班级所有的人数并初始化出勤记录，记为“缺勤”
        $sql3 = "select stuId from student where classId=" . $row1['classId'];
        $result3= mysqli_query($db, $sql3);

        if ($result3) {
            while ($row3 = mysqli_fetch_assoc($result3)) {
                $sql4 = "INSERT INTO `roster`.`sturoster` (`stuRosterId`, `rosterDate`, `attendance`, `stuId`, `Id`) VALUES (NULL,'$myDate',1," . $row3['stuId'] . ',' . $ID[$i] . ");";
                $result4 = mysqli_query($db, $sql4);
            }
        }
    }

}
mysqli_close($db);
