<?php
header("Content-Type:text/html;charset=UTF-8");


$classid_s=$_GET['classids'];
$userid=$_GET['userId'];
$num_of_manuallcall=$_GET['num'];


require "../mysql-connect.php";

/*$classids="59 60";
$userid="18";
$num_of_manuallcall="10";*/
$randomallid=array();
$randomallname=array();
$randomallstu = array();
$randomstu=array();
$randomallstate=array();
$randomallclassid=array();
$randomalltime=array();
$randomallstuid=array();
$classsizeall=0;
date_default_timezone_set('prc');
$randomtimestart=date('Y-m-d H:i:s',time());



if(isset($classid_s)&&isset($userid)&&isset($num_of_manuallcall)) {
    $len=sizeof($classid_s);
    for($j=0;$j<$len;$j++)
    {

        $sql = "select stuCode,stuName,stuId from student\n"
            . "where classId=".$classid_s[$j] ;
        $result = mysqli_query($db, $sql);
        if ($result) {
            while($row=mysqli_fetch_assoc($result)){
                array_push($randomallid, $row['stuCode']);
                array_push($randomallname, $row['stuName']);
                array_push($randomallstate,"1");//默认值为不到：1
                array_push($randomallclassid,$classid_s[$j]);
                array_push($randomalltime,$randomtimestart);
                array_push( $randomallstuid,$row['stuId']);
            }
        }




        $sql = "select classSize from class\n"
        . "where classId=$classid_s[$j] LIMIT 0, 30 ";
        $result = mysqli_query($db, $sql);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $classsizeall+=(float)$row['classSize'];
        }


    }

//    echo $classsizeall."   ".$randomallid[15]."   ".$len.$randomallid[0].$randomallname[0].$randomallid[8].$randomallname[8];

//    print_r($randomallid);
    $random = array();
    while(count($random) < $num_of_manuallcall) {
        $_tmp = mt_rand(0, $classsizeall - 1);
        if (!in_array($_tmp, $random)) { //当数组中不存在相同的元素时，才允许插入
            $random[] = $_tmp;
        }
    }

    /*echo $random[0]."   ".$random[1]."   ".$random[2]."   ".$random[3]."   ".$random[4]."   ".$random[5]."   ".$random[6]."   ".$random[7]."   ".$random[8]."   ".$random[9];*/



    $count=count($randomallid);
    for($i=0;$i<$count;$i++){
        $randomallstu[$i]=array(array_shift($randomallid),array_shift($randomallname),array_shift($randomallstate),array_shift($randomallclassid),array_shift($randomalltime),array_shift($randomallstuid));
    }

//    echo $randomallstu[1][0].$randomallstu[1][1].$randomallstu[1][2].$randomallstu[15][0];


    for($i=0;$i<$num_of_manuallcall;$i++){
        array_push($randomstu,$randomallstu[$random[$i]]);
        //0：学号
        //1：姓名
        //2：状态
        //3：班级
        //4：时间
        //5：stuId
    }

//    echo $random[0]."   ".$random[1]."   ".$random[2]." ".$randomstu[0][0].$randomstu[0][1].$randomstu[0][2].$randomstu[2][0].$randomstu[2][1].$randomstu[2][2];
//    echo  CURDATE();
    echo json_encode($randomstu);


}













