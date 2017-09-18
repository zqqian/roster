
<?php

error_reporting(0);
header("Content-Type:text/html;charset=UTF-8");
require_once 'get_user_info.php';
$post=$_POST['select'];

//$post=array ('class0'=> "计算机科学与技术1", 'class1'=> "计算机科学与技术2",'course'=> "数据库");

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
//	var_dump($post) ;

//	$post2=json_decode($post);
//	var_dump($post2);

	//传过来数组总长度
	$num = count($post);
//	echo $num;
	//班级总数
	//	$kc=$post2['course']-1;
	$kc = $num-1;
//	echo "班级总数".$kc;
	//过来的课程名
	$courseName = $post['course'];
//	echo "课程名".$courseName."<br>";
	$data;
	$all="";

	$sql="SELECT * FROM grade_statistics WHERE userId = $userid  AND courseName = '$courseName'
AND className in (";//'计算机科学与技术1','计算机科学与技术2'

	for($q=0;$q<$kc;$q++){
		$Sclass="class".$q;

		$bj=$post[$Sclass];
//		echo "<br>".$bj."<br>";
		if($q==$kc-1)
			$all .= "'".$bj."'";
		else
			$all .= "'".$bj."',";
//		echo $all."<br>";
	}
echo $all."<br>";

	$all= $sql.$all.")";
//	echo "<br>".$all;

	$result=mysqli_query($db,$all);

	$kc=0;
	while($row = mysqli_fetch_assoc($result)){
		//$data2[$kc]['score_percent']=$row['rosterDate'];
		$data2[$kc]['score_percent'][0]=$row['0-59'];
		$data2[$kc]['score_percent'][1]=$row['60-69'];
		$data2[$kc]['score_percent'][2]=$row['70-79'];
		$data2[$kc]['score_percent'][3]=$row['80-89'];
		$data2[$kc]['score_percent'][4]=$row['90-100'];
		$data2[$kc]['score_pass_rate']=$row['passRate'];
		$id=$row['Id'];

		$sql_classroster="SELECT MONTH(rosterDate) as month,avg(attendanceRate) as rate
FROM (SELECT * FROM `classroster` WHERE `Id` =$id) as a
group by MONTH(rosterDate)";
		$result1=mysqli_query($db,$sql_classroster);

		$i=0;
		while($row = mysqli_fetch_assoc($result1)){
			$data2[$kc]['attendance_date'][$i]=$row['month'];
			$data2[$kc]['attendance_rate'][$i]=$row['rate'];
			$i++;
		}

		$kc++;
	}




//	echo "<br>";
//	var_dump($data2);




	//对于每个班级

//	for($j=0;$j<$kc;$j++){
//		$Sclass="class"+$j;
//
//		$bj=$post2[$classnum];
//
//		$sql = "SELECT * FROM `grade_statistics` WHERE `userId` = ".$userid."AND className = '$bj' AND `courseName` = '$courseName'";
//
//		$result=mysqli_query($db,$sql);
//		if(mysqli_num_rows($db)>0){
//			$row = mysqli_fetch_assoc($result);
//			$data2['score_percent'][$kc][0]=$row['0-59'];
//			$data2['score_percent'][$kc][1]=$row['60-69'];
//			$data2['score_percent'][$kc][2]=$row['70-79'];
//			$data2['score_percent'][$kc][3]=$row['80-89'];
//			$data2['score_percent'][$kc][4]=$row['90-100'];
//			$data2['score_pass_rate'][$kc]=$row['passRate'];
//			$id=$row['Id'];
//		}
//
//
//
//	}

	/*for( $ii=0;$ii<$num;$ii++){
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
	
		
	}*/
	

echo json_encode($data2);
}


?>