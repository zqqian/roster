<?php
header("Content-Type:text/html;charset=UTF-8");


//测试数据
$courseName = "数据库";
$userId = 18;

//$courseName = $_POST['selected_course'];
//$userId = $_POST['userId'];



require "../mysql-connect.php";

//找班级
$find_class = "SELECT `enterYear`,`className`  FROM `basic_relation` WHERE `userId` = $userId AND `courseName` = '$courseName'";
$set=mysqli_query($db,$find_class);
$class_arr=array();
while($row=mysqli_fetch_assoc($set)){
    array_push($class_arr,$row['enterYear']." ".$row['className']);
}

//var_dump($class_arr);
//json_encode($class_arr);
//echo "<br>";
//echo json_encode($class_arr);




//找日期

$find_id="select * from basic_relation where userId=$userId and courseName='$courseName'";
$result=mysqli_query($db,$find_id);
$row = mysqli_fetch_assoc($result);
$Id=$row['Id'];



//////////////////////////////////////////////////////////////////////////////////////////////////
$find_date = "SELECT rosterDate
FROM classroster as a
left outer join basic_relation as b on
( a.Id=b.Id)
where courseName='$courseName' and userId=$userId
order by rosterDate asc";
$set=mysqli_query($db,$find_date);
$date_arr=array();


while($row=mysqli_fetch_assoc($set)){
    array_push($date_arr,substr($row['rosterDate'],0,10));

}
//echo "<br>";
//var_dump($date_arr);
//json_encode($date_arr);
//echo "<br>";
//echo json_encode($date_arr);

mysqli_close($db);


$sum=array('search_class'=>$class_arr,'search_date'=>$date_arr);

var_dump($sum);
echo "<br>".json_encode($sum);

/*json格式样例
 * $exam1=array(1,2,3,4);
$exam2=array(11,22,33,44);
$sum=array('num1'=>$exam1,'num2'=>$exam2);

var_dump($sum);
echo "<br>".json_encode($sum);*/



/*$check = $_POST['check'];
$courseId = $_POST['courseId'];
$classId = $_POST['classId'];
$userId = $_POST['userId'];*/


