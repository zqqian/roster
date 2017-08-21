<?php session_start();
header("Content-Type:text/html;charset=UTF-8");
$Class = $_POST['Class'];
$course = $_POST['course'];
$gradeType = $_POST['gradeType'];
$userId = $_POST['userId'];
$dateStart = $_POST['start'];
$dataEnd = $_POST['end'];
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

if ( "nomal" == $gradeType ){//平时成绩
    $sql_nomal="";

    $set=mysqli_query($db,$sql_nomal);
    while($row=mysqli_fetch_assoc($set)){
        //填充Excel表
    }


} else if  ( "final" == $gradeType ){//期末成绩
    $sql_final="";

    $set=mysqli_query($db,$sql_final);
    while($row=mysqli_fetch_assoc($set)){
        //填充Excel表
    }
} else if ( "roster" == $gradeType ){//点名情况
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


