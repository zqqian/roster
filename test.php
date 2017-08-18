<?php
session_start();
var_dump($_SESSION);

$userid = $_SESSION['userid'];
$find_class = "SELECT className FROM class as a,class_course_user as b where a.classId=b.classId and b.userId=".$userid;

require "mysql-connect.php";

$set=mysqli_query($db,$find_class);
while($row=mysqli_fetch_assoc($set)){
    echo "<option value='".$row['className']."'>".$row['className']."</option>";
}
