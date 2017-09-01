<?php
header("Content-Type:text/html;charset=UTF-8");

$twocodedata = $_POST['twocodedata'];
$userId = $_POST['userId'];

$find_twocodedata="insert into 'twocode_data'('userId','twocode') values($userId,'$twocodedata')";

require "../mysql-connect.php";

$set=mysqli_query($db,$find_twocodedata);

mysqli_close($db);
?>