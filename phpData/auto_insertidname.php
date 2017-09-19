<?php

session_start();
header("Content-Type:text/html;charset=UTF-8");


$userId=$_POST['userId'];
$ID1=$_POST['ID'];
$stuCode=$_POST['stuCode'];
$stuName=$_POST['stuName'];


$dir = dirname(__FILE__);//找到当前脚本所在路径
$fileuserid= $dir . "/validation/" . $userId."/".$userId;


if (!file_exists($fileuserid)){//判断文件夹是否存在，不存在的话就表明未扫二维码就直接进入，所以弹出警示框，并跳转至白度。
    echo "<script>
//alert('请通过正规渠道进入该网页！');
               windows.location.herf='zhenggui.php';
            </script>";
}
else {

    /*$userId=18;
    $ID1="52_53_";
    $stuCode="20151845602";
    $stuName="卢二";
    */
    $ID = explode('_', $ID1);

    $len = count($ID);
//echo $stuName;

    require "../mysql-connect.php";

    $dir = dirname(dirname(__FILE__));//找到当前脚本所在路径
    $backup_path = $dir . "/validation/" . $userId;
    $i = 0;
    if ($handle = @opendir($backup_path)) {
        while (false !== ($file = readdir($handle)))//读取文件夹里的文件
        {
            if ($file != "." && $file != "..") {
                $file_array[$i]["filename"] = $file;
                $i++;
            }

        }
        closedir($handle);//关闭文件夹
    }
    if ($i == 0) {//判断文件夹是否存在，不存在的话就创建这么一个文件夹
        echo "0";//"<script> alert ('此时已无法签到，请找老师补签！'); </script>";
    } else {

        if ($stuCode == "" || $stuName == "") {
            echo "3";//"<script> alert ('请把信息填齐全！'); </script>";
        } else {

            for ($i = 0; $i < $len - 1; $i++) {
                $sql1 = "select classId,classSize from basic_relation where Id=" . $ID[$i];
                $result1 = mysqli_query($db, $sql1);

                if ($result1) {
                    $row1 = mysqli_fetch_assoc($result1);
//                echo $row1['classId']."<br>";
                    $sql3 = "select stuId from student where classId='$row1[classId]'and stuCode='$stuCode'and stuName='$stuName'";
//                echo $sql3;
                    $result3 = mysqli_query($db, $sql3);
                    $row3 = mysqli_fetch_assoc($result3);
                    if ($row3) {

                        $sql4 = "update `roster`.`sturoster` set attendance=0 where stuId=" . $row3['stuId'];
//                    echo $sql4;
                        $result4 = mysqli_query($db, $sql4);
                        echo "1";//"<script> alert ('签到成功！'); </script>";
                    } else echo "2";//"<script> alert ('姓名或者学号不正确！'); </script>";

                }
            }
        }
    }
    mysqli_close($db);
}





