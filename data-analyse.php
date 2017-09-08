<?php
<<<<<<< HEAD

=======
error_reporting(0);
>>>>>>> c15eedd494145a249f15a16debe0eca32218a242
require_once 'get_user_info.php';
$kc=$_POST['select_course'];
$bj=$_POST['select_class'];

//$userid=18;
if($kc==""&&$bj==""){
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

echo json_encode($data, JSON_UNESCAPED_UNICODE);
	
}else{

$sql = "SELECT * FROM `grade_statistics` WHERE `userId` = '$userid' AND `className` = \"$bj\" AND `courseName` = \"$kc\" LIMIT 0, 30 ";
$result=mysqli_query($db,$sql);
if($result){
	$row = mysqli_fetch_assoc($result);
	//var_dump($row);
	$data2['score_percent'][0]=$row['0-59'];
	$data2['score_percent'][1]=$row['60-69'];
	$data2['score_percent'][2]=$row['70-79'];
	$data2['score_percent'][3]=$row['80-89'];
	$data2['score_percent'][4]=$row['90-100'];
	$data2['score_pass_rate']=$row['passRate'];
	$id=$row['Id'];
	
	
	//var_dump($id);
	$sql = "SELECT * FROM `classroster` WHERE `Id` = '$id' LIMIT 0, 30 ";
	$result=mysqli_query($db,$sql);
	$i=0;
	while($row = mysqli_fetch_assoc($result)){
		$data2['attendance_date'][$i]=$row['rosterDate'];
		$data2['attendance_rate'][$i++]=$row['attendanceRate'];

	}
}	
	
	echo json_encode($data2, JSON_UNESCAPED_UNICODE);
}


?>