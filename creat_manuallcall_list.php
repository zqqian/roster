<?php
require_once "get_user_info.php";

$courseid;
$classid;
$userid;
$num_of_manuallcall;

if(isset($courseid)&&isset($classid)&&isset($userid)&&isset($num_of_manuallcall)){
	//��ͨ���û�id��classid��courseidȷ����Id
$sql = "SELECT * FROM `class_course_user` WHERE `classId` = $classid AND `courseId` = $courseid AND `userId` = $userid LIMIT 0, 30 ";
$result=mysqli_query($db,$sql);
if($result){
$row=mysqli_fetch_assoc($result);
$Id=$row['Id'];
}
//���ж��Ƿ���ڵ���
$sql = "SELECT * FROM `classroster` WHERE `rosterDate` = CURDATE( ) AND `Id` = $Id";
$result=mysqli_query($db,$sql);
if($result){
$row=mysqli_fetch_assoc($result);
$class_roster_id=$row['classRosterId'];
//������bug

}else{
$sql = "INSERT INTO `roster`.`classroster` (`classRosterId`, `rosterDate`, `attendanceRate`, `realStu`, `shouldStu`, `Id`) VALUES (NULL, CURDATE(), NULL, \'0\', $num_of_manuallcall, $Id);";
$result=mysqli_query($db,$sql);
}


$sql = "SELECT DISTINCT `student`.`stuId` \n"
    . "FROM sturoster, student\n"
    . "WHERE (\n"
    . "(\n"
    . "`student`.`classId` =$classId\n"
    . ")and `student`.`stuId` NOT IN(\n"
    . "SELECT DISTINCT `sturoster`.`stuId`\n"
    . "FROM sturoster, student\n"
    . "WHERE ((`student`.`Id` =$Id) AND (`sturoster`.`rosterDate` =CURDATE( )))))\n"
    . "ORDER BY `sturoster`.`stuId` ASC\n";
$result=mysqli_query($db,$sql);
$i=0;
while($row[$i++] = mysqli_fetch_assoc($result));
$randnum=rand(0,$i-1);

$randstuid=$row[$randnum]['stuId'];





	
}




//var_dump($randstuid);












?>