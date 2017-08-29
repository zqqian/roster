<?php

require_once 'get_user_info.php';
$userid=18;
$sql = "SELECT distinct `courseId`\n"
    . " FROM `class_course_user` WHERE `userId` = '$userid' LIMIT 0, 30 ";

$result=mysqli_query($db,$sql);
if($result){
	while($row = mysqli_fetch_assoc($result)){
		$courseid=$row['courseId'];
		$sql = "SELECT * FROM `course` WHERE `courseId` = '$courseid' LIMIT 0, 30 ";
		$result2=mysqli_query($db,$sql);
		$row2= mysqli_fetch_assoc($result2);
		$coursename=$row2['courseName'];
		//var_dump($coursename);
		$sql = "SELECT * FROM `class_course_user` WHERE `courseId` = '$courseid' AND `userId` = '$userid' LIMIT 0, 30 ";
		$result2=mysqli_query($db,$sql);
		$i=0;
	while($row2= mysqli_fetch_assoc($result2)){
		$classid=$row2['classId'];
		//var_dump($classid);
		$sql3 = "SELECT * FROM `class` WHERE `classId` = '$classid' LIMIT 0, 30 ";
		$result3=mysqli_query($db,$sql3);
		$row3= mysqli_fetch_assoc($result3);
		$data[$coursename][$i++]=$row3['className'];
	}
		
		
	}

	
}else{

}

//var_dump($data);

echo json_encode($data);

?>