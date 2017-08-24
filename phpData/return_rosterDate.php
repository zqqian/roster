<?php
header("Content-Type:text/html;charset=UTF-8");



$search = $_POST['search'];
$courseName = $_POST['selected_course'];
$userId = $_POST['userId'];


//测试所用数据
//$search = "选择班级";
/*$search = "选择日期";
$courseName = "数据库";
$userId = 18;*/
require "../mysql-connect.php";



if("选择班级" == $search){

   /* $className = "2015 计算机科学与技术1";*/
    $className = $_POST['select_class'];

    $class_split= explode(' ',$className);//字符串按字符分割
    $enterYear = $class_split[0];
    $className = $class_split[1];
    //echo $enterYear.'*'.$className;

    //找Id和classId
    $find_id="select * from basic_relation where userId=$userId and courseName='$courseName'and enterYear=$enterYear and className='$className'";
    $result=mysqli_query($db,$find_id);
    $row = mysqli_fetch_assoc($result);
    $Id=$row['Id'];
    $classId=$row['classId'];

    //echo $Id.$classId;

    //找班级点名信息
    $find_class = "SELECT Id,stuCode,stuName,count(*) as 'sum',count(*)-sum(attendance)  as 'arrive', (count(*)-sum(attendance))/count(*) as 'rate'
FROM student left outer join sturoster
on(student.stuId=sturoster.stuId  and Id=$Id )
where classId=$classId
group by student.stuId";
    $set=mysqli_query($db,$find_class);

    $str="<thead><tr><th>学号</th><th>姓名</th><th>点名次数</th><th>实到次数</th><th>平均出勤率</th></tr></thead><tbody>";
    if(mysqli_num_rows($set)<1) exit("1");
    else echo $str;




    $class_return_sum=array();
    $i=0;
    while($row=mysqli_fetch_assoc($set)){
        if( null == $row['Id'])
            $row['sum'] = null;
        if($i % 2 == 1) echo "<tr><td>";
        else echo "<tr class='success'><td>";
        echo $row['stuCode']."</td><td>".$row['stuName']."</td><td>";
        if(null == $row['sum'])
            echo "0</td><td>";
        else
            echo $row['sum']."</td><td>";
        if(null == $row['arrive'])
            echo "0</td><td>";
        else
            echo $row['arrive']."</td><td>";
        if(null == $row['sum'])
            echo "100%</td></tr>";
        else
            echo ($row['arrive']*100)."%"."</td></tr>";
        $i++;
    }
    echo "</tbody>";
    /*var_dump($class_return_sum);
    echo "<br>";*/
//    echo json_encode($class_return_sum);


}else if("选择日期" == $search){
    $str="<thead><tr><th>班级</th><th>点名时间</th><th>班级人数</th><th>点名人数</th><th>实到人数</th><th>班级出勤率</th></tr></thead><tbody>";
    echo $str;
    $date = $_POST['selected_date'];
   // $date = "2017-08-01";
    $data_con = $date."%";
    $find_date = "SELECT enterYear,className,concat(enterYear,className),rosterDate,realStu,shouldStu,attendanceRate,classSize
FROM classroster as a
left outer join basic_relation as b on
( a.Id=b.Id)
where  userId=$userId and rosterDate like '$data_con'
order by rosterDate asc";
    $set=mysqli_query($db,$find_date);

    $date_return_sum=array();
    $i=0;
    while($row=mysqli_fetch_assoc($set)){
//        $temp=array(
//            'class_name'=>$row['concat(enterYear,className)'],
//            'call_time'=>$row['rosterDate'],
//            'realStu'=>$row['realStu'],
//            'shouldStu'=>$row['shouldStu'],
//            'attendance_rate_ave'=>$row['attendanceRate'],
//            'classSize'=>$row['classSize']);
//        array_push($date_return_sum,$temp);
        if( $i % 2 == 1)echo "<tr><td>";
        else echo "<tr class='success'><td>";
        echo $row['concat(enterYear,className)']."</td><td>".$row['rosterDate']."</td><td>";
        $row['classSize']."</td><td>";
        if(null == $row['classSize'])
            echo "0</td><td>";
        else
            echo  $row['classSize']."</td><td>";
         if(null ==   $row['shouldStu'])
            echo "0</td><td>";
        else
            echo  $row['shouldStu']."</td><td>";
         if(null ==  $row['realStu'])
            echo "0</td><td>";
        else
            echo $row['realStu']."</td><td>";
        if(null == $row['shouldStu'])
            echo "100%</td></tr>";
        else
            echo ($row['attendanceRate']*100)."%"."</td></tr>";
        $i++;
    }
    echo "</tbody>";
//    var_dump($date_return_sum);
//    echo "<br>";
//    echo json_encode($date_return_sum);
}else{

}
mysqli_close($db);