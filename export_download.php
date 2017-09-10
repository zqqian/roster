<?php session_start();
header("Content-Type:text/html;charset=UTF-8");
//$Class = $_POST['Class'];
//$course = $_POST['course'];
//$gradeType = $_POST['gradeType'];
//$userId = $_POST['userId'];

$Class = 55;
$course = 39;
$gradeType = "final";
$userId = 18;

$letter=array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q');

require "mysql-connect.php";
$find_id="select * from basic_relation where userId=$userId and courseId=$course and classId=$Class";
$result=mysqli_query($db,$find_id);
$row = mysqli_fetch_assoc($result);
$Id=$row['Id'];
$inf=$row['enterYear'].$row['className'].$row['courseName'];

date_default_timezone_set("PRC");
$dir=dirname(__FILE__);
require $dir."/PHPExcel/PHPExcel.php";
$objPHPExcel=new PHPExcel();
$objSheet=$objPHPExcel->getActiveSheet();
$objSheet->setTitle($inf);

if ( "normal" == $gradeType ){//平时成绩
    //取出这个用户所有的自定义字段Id
    $field = array();//字段数组
    $sql_nomal = "SELECT * FROM `userdefine` WHERE `Id`=$Id";
    $set = mysqli_query($db,$sql_nomal);
    while($row=mysqli_fetch_assoc($set)){
        array_push($field,$row['userDefineName']);
    }

    $objSheet->setCellValue("A1","学号")->setCellValue("B1","姓名");
    for($t=0;$t<count($field);$t++){
        $name = $letter[2+$t]."1";
        $objSheet->setCellValue($name,$field[$t]);
    }

    $sql1 = "SELECT p.stuId,stuCode,stuName,";
    $sql2="";
    $sql3 ="FROM
            (select distinct u.userDefineId,userDefineName,u.Id,b.classId,s.stuId,s.stuCode,s.stuName ,d.defineGradeId,d.fieldGrade
            from userdefine as u join basic_relation as b on(u.Id=b.Id)
            join student as s on(b.classId=s.classId)
            left outer join definegrade as d on(u.userDefineId=d.userDefineId and s.stuId=d.stuId)
            where u.Id=$Id
            )as p
            group by p.stuId";
    for($i=0;$i<count($field);$i++) {
        if($i != count($field)-1)
            $sql2 = $sql2."max(case p.userDefineName when '$field[$i]' then p.fieldGrade else null end) '$field[$i]',";
        else
            $sql2 = $sql2."max(case p.userDefineName when '$field[$i]' then p.fieldGrade else null end) '$field[$i]'";
    }

    $sql = $sql1.$sql2.$sql3;
    $set=mysqli_query($db,$sql);

    $i=2;
    while($row=mysqli_fetch_assoc($set)){
        $objSheet->setCellValue("A".$i,$row['stuCode'])->setCellValue("B".$i,$row['stuName']);
        for($t=0;$t<count($field);$t++){
            $objSheet->setCellValue($letter[2+$t].$i,$row[''.$field[$t].'']);
        }
        $i++;
    }

} else if  ( "final" == $gradeType ){//期末成绩

    $objSheet->setCellValue("A1","学号")->setCellValue("B1","姓名");
    $objSheet->setCellValue("C1","考勤分")->setCellValue("D1","考勤总分");
    $objSheet->setCellValue("E1","自定义考核分")->setCellValue("F1","自定义考核总分");
    $objSheet->setCellValue("G1","总平时分")->setCellValue("H1","期末卷面分");
    $objSheet->setCellValue("I1","总期末分")->setCellValue("J1","综合得分 ");



    $sql_final="select b.stuId,b.stuCode,b.stuName,
b.rate*100 as '考勤分',

b.rate*100*b.attendancePer*(1-b.finalPer) as '考勤总分',
sum(b.fieldGrade*b.userDefinePer)/(1-b.attendancePer) as '自定义考核分',
sum(b.fieldGrade*b.userDefinePer)*(1-b.finalPer) as '自定义考核总分',

(b.rate*100*b.attendancePer+sum(b.fieldGrade*b.userDefinePer))*(1-b.finalPer) as '总平时分',
b.finalGrade as '期末分',

 b.finalGrade*b.finalPer as '期末总分',
((b.rate*100*b.attendancePer+sum(b.fieldGrade*b.userDefinePer))*(1-b.finalPer)+b.finalGrade*b.finalPer)  as '综合得分'
from
(select a.stuId,a.stuCode,a.stuName,a.rate,a.Id,userDefineName,fieldGrade,finalGrade,userDefinePer,attendancePer,finalPer
from (SELECT student.stuId,stuCode,stuName, (count(*)-sum(attendance))/count(*) as 'rate',sturoster.Id
FROM student
left outer join sturoster
on(student.stuId=sturoster.stuId  and sturoster.Id=$Id)
where student.classId=$Class
group by student.stuId) as a
left outer join definegrade
on(a.stuId=definegrade.stuId)
left outer join grade on
(a.stuId=grade.stuId)
left outer join userdefine on
(definegrade.userdefineId=userdefine.userdefineId)
left outer join class_course_user on
(definegrade.Id=class_course_user.Id)) as b
group by b.stuId
";

    $set=mysqli_query($db,$sql_final);
    $i=2;
    while($row=mysqli_fetch_assoc($set)){
        $objSheet->setCellValue("A".$i,$row['stuCode'])->setCellValue("B".$i,$row['stuName']);
        $objSheet->setCellValue("C".$i,$row['考勤分'])->setCellValue("D".$i,$row['考勤总分']);
        $objSheet->setCellValue("E".$i,$row['自定义考核分'])->setCellValue("F".$i,$row['自定义考核总分']);
        $objSheet->setCellValue("G".$i,$row['总平时分'])->setCellValue("H".$i,$row['期末分']);
        $objSheet->setCellValue("I".$i,$row['期末总分'])->setCellValue("J".$i,$row['综合得分']);
        $i++;
    }
} else if ( "roster" == $gradeType ){//点名情况
    $dateStart = $_POST['start'];
    $dataEnd = $_POST['end'];

    $objSheet->setCellValue("A1","学号")->setCellValue("B1","姓名");
    $objSheet->setCellValue("C1","出勤率")->setCellValue("D1","点名次数");
    $objSheet->setCellValue("E1","到课次数");

    $sql_roster="SELECT Id,stuCode,stuName,count(*) as 'sum',count(*)-sum(attendance)  as 'arrive', (count(*)-sum(attendance))/count(*) as 'rate'
FROM student left outer join sturoster
on(student.stuId=sturoster.stuId  and Id=$Id and rosterDate between '$dateStart' and
'$dataEnd')
where classId=$Class
group by student.stuId";
    $set=mysqli_query($db,$sql_roster);
    $i=2;
    while($row=mysqli_fetch_assoc($set)){
        $objSheet->setCellValue("A".$i,$row['stuCode'])->setCellValue("B".$i,$row['stuName']);
       if($row['Id']==null){
           $objSheet->setCellValue("C".$i,'100%')->setCellValue("D".$i,0)->setCellValue("E".$i,0);
       }else{
           $rate=round((float)$row['rate'],2)*100;
           $objSheet->setCellValue("C".$i,(String)$rate.'%');
           $objSheet->setCellValue("D".$i,$row['sum'])->setCellValue("E".$i,$row['arrive']);
       }
        $i++;
    }
} else {
    //一般情况下不会出现的情况
    exit('error!');
}
mysqli_close($db);

$objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,"Excel5");
$objWriter->save($dir."/tempExcel/".$Class.$course.$gradeType.".xls");
//由以上代码得到用户所需的Excel文件

//把用户在服务器上产生的文件的路径保存到session的一个数组里 （$_SESSION['excel']）等待用户退出清空session之前把文件路径取出，然后删除掉文件
if(isset($_SESSION['excel'])){//数组存在
    $temp=$_SESSION['excel'];
    array_push($temp,"tempExcel/".$Class.$course.$gradeType.".xls");
    $_SESSION['excel']=$temp;
}else{
    $temp=array();
    array_push($temp,"tempExcel/".$Class.$course.$gradeType.".xls");
    $_SESSION['excel']=$temp;
}


