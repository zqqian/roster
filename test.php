<?php
/*require_once "get_user_info.php";
require_once 'mysql-connect.php';

$sql = "SELECT DISTINCT `student`.`stuId` \n"
. "FROM sturoster, student\n"
. "WHERE (\n"
. "(\n"
. "`student`.`Id` =8\n"
. ")and `student`.`stuId` NOT IN(\n"
. "SELECT DISTINCT `sturoster`.`stuId`\n"
. "FROM sturoster, student\n"
. "WHERE ((`student`.`Id` =8) AND (`sturoster`.`rosterDate` =CURDATE( )))))\n"
. "ORDER BY `sturoster`.`stuId` ASC\n";
$result=mysqli_query($db,$sql);
$i=0;
while($row[$i++] = mysqli_fetch_assoc($result));
$randnum=rand(0,$i-1);

$randstuid=$row[$randnum]['stuId'];
var_dump($randstuid);*/
?>
