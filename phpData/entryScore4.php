<?php
//用于记录学生的自定义字段分数和期末分数
header("Content-Type:text/html;charset=UTF-8");

$flag = $_POST['flag'];
$student_inf = $_POST['student_inf'];
$courseName = $_POST['courseName'];
$userId = $_POST['userId'];
$classId = $_POST['classId'];




require "../mysql-connect.php";


/*$flag = "normal";
$student_inf = array();
$courseName = "数据库";
$userId = 18;
$classId = 55;
$Id=51;
$find_field="实验一-实验二-";
$student_inf[0]["stuCode"]="20151845100";
$student_inf[0]["stuId"]=340;
$student_inf[0]["stuName"]="李一";
$student_inf[0]["实验一"]=100.00;
$student_inf[0]["实验二"]=100.00;
$student_inf[1]["stuCode"]="20151845101";
$student_inf[1]["stuId"]=341;
$student_inf[1]["stuName"]="李二";
$student_inf[1]["实验一"]=11.00;
$student_inf[1]["实验二"]=11.00;*/








$sql = "SELECT `Id`,`finalPer`,`attendancePer`,`classSize` FROM `basic_relation` WHERE `userId`=$userId  and `classId`=$classId and `courseName`='$courseName'";
$set=mysqli_query($db,$sql);
$row = mysqli_fetch_assoc($set);
$Id=$row['Id'];


if("normal" == $flag){
    //录入平时成绩


   $find_field = $_POST['find_field'];
    $field_split= explode('-',$find_field);//字符串按字符分割

    for($i = 0; $i < count($student_inf); $i++){
        //取出学生id
        $stuId = $student_inf[$i]['stuId'];//$Id

        for($j=0;$j<count($field_split)-1;$j++) {

            $str = $field_split[$j];//字段名
            //找字段的userdefineID
            $find_strId="SELECT * FROM `userdefine` WHERE `userDefineName`='$str'and Id=$Id";

            $result=mysqli_query($db,$find_strId);
            $row = mysqli_fetch_assoc($result);
            $userDefineId=$row['userDefineId'];

            $strgrade = $student_inf[$i][$str];//字段分


            //查找 	defineGradeId
            $find_dgId="SELECT * FROM definegrade join userdefine  on
              (definegrade.userDefineId=userdefine.userDefineId)
              where definegrade.Id=$Id and definegrade.stuId=$stuId and userdefine.userDefineName='$str'";

            $set=mysqli_query($db,$find_dgId);



            if (mysqli_num_rows($set)<1 ){
                //insert
                if($strgrade!=""){
                    $strgrade = floatval($student_inf[$i][$str]);
                $sql_insert = "INSERT INTO `definegrade`( `Id`, `stuId`, `userDefineId`, `fieldGrade`) VALUES ($Id,$stuId,$userDefineId,$strgrade)";
                $r=mysqli_query($db,$sql_insert);
                echo $sql_insert.$r."<br> ";}
                else echo "null";

            }else{
                $row = mysqli_fetch_assoc($set);
                $defineGradeId=$row['defineGradeId'];
                $strgrade = floatval($strgrade);
                //update
                $sql_update = "UPDATE `definegrade` SET `fieldGrade`= $strgrade where `defineGradeId`=$defineGradeId";
                $r=mysqli_query($db,$sql_update);
                echo  $sql_update .$r." <br>";
            }



        }


    }





}else if("final" == $flag){
    //录入期末成绩
    for($i = 0; $i < count($student_inf); $i++){
        $gradeId=intval($student_inf[$i]['gradeId']);
        $finalGrade = $student_inf[$i]['finalGrade'];
        if($gradeId != null){
            //update
            $finalGrade = floatval($student_inf[$i]['finalGrade']);
            $sql_update = "UPDATE grade SET finalGrade=$finalGrade WHERE gradeId=$gradeId";
            $r=mysqli_query($db,$sql_update);
            echo "update".$r;
        }else if($gradeId == null && $finalGrade != null){
            //insert
            $stuId = intval($student_inf[$i]['stuId']);
            $sql_insert = "INSERT INTO grade(`gradeId`, `stuId`, `finalGrade`, `attendanceGrade`, `totalGrade`, `Id`) VALUES (0,$stuId,$finalGrade,null,null,$Id)";
            $r=mysqli_query($db,$sql_insert);
            echo "insert".$r;
        }
    }
}else{
    exit('error');
}

mysqli_close($db);