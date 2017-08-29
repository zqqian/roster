<?php
require_once "get_user_info.php";

$courseid;
$classid;
$userid;
$num_of_manuallcall;

if(isset($courseid)&&isset($classid)&&isset($userid)&&isset($num_of_manuallcall)){
	//先通过用户id和classid和courseid确定总Id
$sql = "SELECT * FROM `class_course_user` WHERE `classId` = $classid AND `courseId` = $courseid AND `userId` = $userid LIMIT 0, 30 ";
$result=mysqli_query($db,$sql);
if($result){
$row=mysqli_fetch_assoc($result);
$Id=$row['Id'];
}
//再判断是否存在点名
$sql = "SELECT * FROM `classroster` WHERE `rosterDate` = CURDATE( ) AND `Id` = $Id";
$result=mysqli_query($db,$sql);
if($result){
$row=mysqli_fetch_assoc($result);
$class_roster_id=$row['classRosterId'];
//这里有bug

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


// random algorithm
$remain_i=$i;
$a[$i];
$b[$i];
$iii=0;
for($ii=0;$ii<$i;$ii++){
	$a[$ii]=0;
}
while($remain_i--){
	
	
$randnum=rand(1,$remain_i+1);
//echo $randnum;
$nowi=0;
$nowii=0;
//echo $nowii;
while(1){
	
	if($a[$nowii]!=1){
		
		$nowi++;
		
	}
	
if($nowi==$randnum){
	$a[$nowii]=1;
	break;
}$nowii++;	
}

$b[$iii++]=$nowii;


}
//


for($iiii=0;$iiii<$i;$iiii++){
	$radstu[$iiii]=$row[$b[$iiii]]['stuId'];
}
echo json_encode($radstu);

	
}




//var_dump($randstuid);












?>