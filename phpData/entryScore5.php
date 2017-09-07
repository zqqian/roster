<?php
//用于保存用户自定义的字段
header("Content-Type:text/html;charset=UTF-8");

$fullField = $_POST['fullField'];

$courseName = $_POST['courseName'];
$userId = $_POST['userId'];
$classId = $_POST['classId'];

require "../mysql-connect.php";

$sql = "SELECT `Id`,`finalPer`,`attendancePer`,`classSize` FROM `basic_relation` WHERE `userId`=$userId  and `classId`=$classId and `courseName`='$courseName'";
$set=mysqli_query($db,$sql);
$row = mysqli_fetch_assoc($set);
$Id=$row['Id'];

$attendancePer = floatval($fullField[0]['Per'])*(1/100);

$sql_att_insert = "UPDATE `class_course_user` SET `attendancePer`=$attendancePer WHERE `Id`=$Id";
$r=mysqli_query($db,$sql_att_insert);
echo "att_insert".$r." ";

for($i = 1; $i < count($fullField); $i++){
    $userDefineId=intval($fullField[$i]['fId']);
    $userDefineName = $fullField[$i]['fName'];
    $userDefinePer = floatval($fullField[$i]['fPer'])*(1/100);

    if($userDefineId != null){
        //update

        $sql_update = "UPDATE `userdefine` SET `userDefineName`='$userDefineName',`userDefinePer`=$userDefinePer WHERE `userDefineId`=$userDefineId";
        $r=mysqli_query($db,$sql_update);
        echo "update".$r." ";
    }else if($userDefineId == null){
        //insert
        $sql_insert = "INSERT INTO `userdefine`( `userDefineName`, `userDefinePer`, `Id`) VALUES ('$userDefineName',$userDefinePer,$Id)";
        $r=mysqli_query($db,$sql_insert);
        echo "insert".$r." ";
    }
}


mysqli_close($db);