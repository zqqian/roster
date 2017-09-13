<?php
header("Content-Type:text/html;charset=UTF-8");

$userId=$_GET['userId'];
$ID1=$_GET['ID'];
$myDate=$_GET['myDate'];

//$userId=18;
//$ID1="51_";
//$myDate="2017-08-01 00:00:00";

$ID = explode('_',$ID1);
$len=count($ID);


require "../mysql-connect.php";


$reclass=array();
$restuCode=array();
$restuName=array();
$reattendance=array();
$restuId=array();
$restu=array();

if(isset($userId)&&isset($ID)&&isset($myDate)) {

    for ($i = 0; $i < $len - 1; $i++) {

        $sql1 = "select className,enterYear from basic_relation where Id=" . $ID[$i];
//        echo $sql1."<br/>";
        $result1 = mysqli_query($db, $sql1);
        $row1 = mysqli_fetch_assoc($result1);

        $sql2 = "select * from sturoster where rosterDate='" . $myDate . "' and Id=" . $ID[$i] . " and `attendance`=1";
//        echo $sql2."<br/>";
        $result2 = mysqli_query($db, $sql2);
        if ($result2) {//如果存在未签到的人的话
            while ($row2 = mysqli_fetch_assoc($result2)) {
                array_push($reclass, $row1['enterYear']. $row1['className']);

                array_push($reattendance, $row2['attendance']);
                array_push($restuId, $row2['stuId']);

                $sql3 = "select * from student where stuId=" . $row2['stuId'];
//                echo $sql3."<br/>";
                $result3 = mysqli_query($db, $sql3);
                $row3 = mysqli_fetch_assoc($result3);

                array_push($restuCode, $row3['stuCode']);
                array_push($restuName, $row3['stuName']);


            }

        }

    }
}
$count=count($restuId);
if($count==0)
    echo 0;
else {
    for ($i = 0; $i < $count; $i++) {
        $restu[$i] = array(array_shift($reclass), array_shift($restuCode), array_shift($restuName), array_shift($reattendance), array_shift($restuId));
        //0：入学年份+班级
        //1：学号
        //2：姓名
        //3：状态
        //4：stuId
    }
//    echo $restu[0][0],$restu[0][1],$restu[0][2],$restu[0][3],$restu[0][4];
    echo json_encode($restu);

}
mysqli_close($db);