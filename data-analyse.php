
<?php
error_reporting(0);
require_once 'get_user_info.php';
$post=$_POST['select'];


//$userid=18;
if($post==""){
    $sql = "SELECT distinct `courseId`\n"
    . " FROM `class_course_user` WHERE `userId` = '$userid' LIMIT 0, 30 ";


$result=mysqli_query($db,$sql);
$i=0;
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
		$j=0;
		$data[$i]['coursename']=$coursename;
	while($row2= mysqli_fetch_assoc($result2)){
		$classid=$row2['classId'];
		//var_dump($classid);
		$sql3 = "SELECT * FROM `class` WHERE `classId` = '$classid' LIMIT 0, 30 ";
		$result3=mysqli_query($db,$sql3);
		$row3= mysqli_fetch_assoc($result3);
		
		//$data[$coursename][$i++]=$row3['className'];
		$data[$i]['classname'][$j++]=$row3['className'];
	
	}
	$i++;	
		
	}


    }

    //var_dump($data);

    echo json_encode($data);

}








else{
	$post2=json_decode($post);
	$num = count($post2);
	$kc=$post2['course']-1;
	for( $ii=0;$ii<$num;$ii++){
		$classnum="class"+$ii;
		$bj=$post2[$classnum];
	$sql = "SELECT * FROM `grade_statistics` WHERE `userId` = '$userid' AND `className` = \"$bj\" AND `courseName` = \"$kc\" LIMIT 0, 30 ";
$result=mysqli_query($db,$sql);
if($result){
$row = mysqli_fetch_assoc($result);
//var_dump($row);
$data2['score_percent'][$kc][0]=$row['0-59'];
$data2['score_percent'][$kc][1]=$row['60-69'];
$data2['score_percent'][$kc][2]=$row['70-79'];
$data2['score_percent'][$kc][3]=$row['80-89'];
$data2['score_percent'][$kc][4]=$row['90-100'];
$data2['score_pass_rate'][$kc]=$row['passRate'];
$id=$row['Id'];


//var_dump($id);
$sql = "SELECT * FROM `classroster` WHERE `Id` = '$id' LIMIT 0, 30 ";
$result=mysqli_query($db,$sql);
$i=0;
while($row = mysqli_fetch_assoc($result)){
$data2['attendance_date'][$kc][$i]=$row['rosterDate'];
$data2['attendance_rate'][$kc][$i++]=$row['attendanceRate'];
}
}
	
		
	}
	

echo json_encode($data2);
}


?>