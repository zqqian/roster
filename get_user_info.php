<?php
/*
How to use?

-----------------------
if has login 
there have three variable
 
$username is user name
$userid is user id
$is_login is true or false

-----------------------
if someone who didn't login successfully but open this page

it will jump to index.php automatically.
*/

session_start();
require_once 'mysql-connect.php';
$is_login=false;
if(isset($_SESSION['username'])){
	$is_login=true;
	$username=$_SESSION['username'];
	$sql = "select userId from user where userName = '$username' ";
	$result=mysqli_query($db,$sql);
			$row = mysqli_fetch_assoc($result);
	$userid=$row['userId'];

	$_SESSION['userid']=$userid;
	//mysqli_close($db);
}else{
echo "<script> alert('Please login...');parent.location.href='./index.php'; </script>";
}

?>