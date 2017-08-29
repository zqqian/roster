<?php
require_once "get_user_info.php";
// $classlab=$_POST['classlab'];
// $courseName=$_POST['courseName'];
// $num=$_POST['num'];
// $nownum=$POST['nownum'];
// $remaimnum=$POST['remaimnum'];
/*
$sql = "select classId from class_course_user where userId = '$userid' ";
$result=mysqli_query($db,$sql);
						while($row = mysqli_fetch_assoc($result)){
							$classid=$row['classId'];
							$sql2 = "select className from class where classId = '$classid' ";
						$result2=mysqli_query($db,$sql2);
						$row2 = mysqli_fetch_assoc($result2);
						echo "<option name=".$row2['className']." value=".$row2['className'].">".$row2['className']."</option>";
							
							
						}

*/
$classnum;
$classlist;
$num;
$nownum;
$nowstatus;
$remainnum;
$id;
//get date
//insert into xxxx (addDateTime) values (now())

$sql = "SELECT * FROM `classroster` WHERE `rosterDate` = CURDATE() AND `Id` = '$id'";
$result=mysqli_query($db,$sql);
if($result){
	$row = mysqli_fetch_assoc($result);
	
}else{
$sql = "INSERT INTO `roster`.`classroster` (`classRosterId`, `rosterDate`, `attendanceRate`, `realStu`, `shouldStu`, `Id`) VALUES (NULL, CURDATE(), NULL, 0, '$num', '$Id');";

$result=mysqli_query($db,$sql);
}
		

		
if($nownum&&($nowstatus==0||$nowstatus==1)){
	
$sql = "INSERT INTO `roster`.`sturoster` (`stuRosterId`, `rosterDate`, `attendance`, `stuId`, `Id`) VALUES (NULL, NOW(), '$nowstatus', '$nownum', '$Id');";


$result=mysqli_query($db,$sql);
	if($result&&$nowstatus==1){
	
	$sql = "UPDATE `roster`.`classroster` SET `realStu` = realStu +1 WHERE `Id` =$Id AND `rosterDate` = CURDATE()";
	$result=mysqli_query($db,$sql);

	}
}/*
if($remainnum){

$sql = "SELECT DISTINCT `student`.`stuId` \n"
    . "FROM sturoster, student\n"
    . "WHERE (\n"
    . "(\n"
    . "`student`.`Id` =8\n"
    . ")and `student`.`stuId` NOT IN(\n"
    . "SELECT DISTINCT `sturoster`.`stuId`\n"
    . "FROM sturoster, student\n"
    . "WHERE ((`student`.`Id` =8) AND (`sturoster`.`rosterDate` =CURDATE( )))))\n"
    . "ORDER BY `sturoster`.`stuId` ASC\n";
$result=mysqli_query($db,$sql);
$i=0;
while($row[$i++] = mysqli_fetch_assoc($result));
$randnum=rand(0,$i-1);

$randstuid=$row[$randnum]['stuId'];
//var_dump($randstuid);



}

echo $randstuid;
*/
?>