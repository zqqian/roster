<?php
header("Content-Type:text/html;charset=UTF-8");
$Class = $_POST['Class'];
$course = $_POST['course'];
//$gradeType =  array();
$gradeType1 = $_POST['gradeType1'];
$gradeType2 = $_POST['gradeType2'];
$gradeType3 = $_POST['gradeType3'];

echo $Class.$course."<br>";
//echo var_dump($gradeType);

echo $gradeType1."%".$gradeType2."%".$gradeType3."%";