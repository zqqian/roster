<?php
header("Content-Type:text/html;charset=UTF-8");

$courseName = $_POST['courseName'];
$userId = $_POST['userId'];

$find_class = "SELECT classId,enterYear,className FROM basic_relation WHERE userId=$userId and courseName='$courseName'";
//echo $userId.$courseName.$find_class;

require "../mysql-connect.php";

$set=mysqli_query($db,$find_class);

while($row=mysqli_fetch_assoc($set)){
    echo "<option value='".$row['classId']."'>".$row['enterYear'].$row['className']."</option>";
}
mysqli_close($db);