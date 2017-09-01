<?php
header("Content-Type:text/html;charset=UTF-8");

$classid_s=$_POST['classids'];
$randomstu=$_POST['arr'];
$courseName=$_POST['courseName'];
$userid=$_POST['userId'];
$num_of_manuallcall=$_POST['num'];
$shouroster=array();//存储应到人数，下标对应ID
$realroster=array();//存储实到人数，下标对应ID
$ID=array();//存储Id，下标对应classid_s


/*$randomstu=$_POST['arr'];
$courseName=$_POST['courseName'];
$userid=$_GET['userId'];*/



require "../mysql-connect.php";

$len=sizeof($classid_s);

for($i=0;$i<$len;$i++){
	$sql = "select * from basic_relation where userId = '$userid' and classId='$classid_s[$i]' and courseName='$courseName'";
	$result=mysqli_query($db,$sql);
	$row = mysqli_fetch_assoc($result);
	array_push($ID, $row['Id']);
	array_push($shouroster, 0);
	array_push($realroster, 0);
//	echo $row['Id'];
}

for($i=0;$i<$num_of_manuallcall;$i++){
	if($randomstu[$i][2]==2) continue;
	//判断此人的Id,并且改变班级的实到与应到人数
	for($j=0;$j<$len;$j++){

		if($randomstu[$i][3]==$classid_s[$j]){
			$shouroster[$j]++;
			if($randomstu[$i][2]==0)
				$realroster[$j]++;
			break;
		}

	}
	//把非跳过的学生添加到学生点名记录
	$date=$randomstu[$i][4];
	$att=$randomstu[$i][2];
	$stu_id=$randomstu[$i][5];
	$sql = "INSERT INTO `roster`.`sturoster` (`stuRosterId`, `rosterDate`, `attendance`, `stuId`, `Id`) VALUES (NULL,'$date','$att','$stu_id', '$ID[$j]');";
	$result=mysqli_query($db,$sql);
}

for($i=0;$i<$len;$i++) {
	if($shouroster[$i]==0) continue;
	$attend=round((float)$realroster[$i]/(float)$shouroster[$i],2);
	$rossterdate=$randomstu[$i][4];
	$sql = "INSERT INTO `roster`.`classroster` (`classRosterId`, `rosterDate`, `attendanceRate`, `realStu`, `shouldStu`, `Id`) VALUES (NULL, '$rossterdate', $attend,$realroster[$i], $shouroster[$i], '$ID[$i]');";
	$result=mysqli_query($db,$sql);
}















/*$sql = "select Id from basic_relation where userId = '$userid' and classid=class_s";
$result=mysqli_query($db,$sql);
						while($row = mysqli_fetch_assoc($result)){
							$classid=$row['classId'];
							$sql2 = "select className from class where classId = '$classid' ";
						$result2=mysqli_query($db,$sql2);
						$row2 = mysqli_fetch_assoc($result2);
						echo "<option name=".$row2['className']." value=".$row2['className'].">".$row2['className']."</option>";
							
							
						}



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