<?php
require_once 'get_user_info.php';
$kc=$_POST['select_course'];
$bj=$_POST['select_class'];
$classrosterid;
$time = time();
//�������key
$randomkey=mt_rand(1007,10000007);
$rand=md5(md5($randomkey).md5($time));

//д�����ݿ�
$sql = "INSERT INTO `roster`.`key` (`Id`, `key`, `time`) VALUES (\'$classrosterid\', \'$rand\', CURRENT_TIMESTAMP);";

//���key
echo $rand;

?>