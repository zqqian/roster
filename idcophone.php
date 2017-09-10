<?php
session_start();
header("Content-Type:text/html;charset=UTF-8");

$userId=$_GET['userId'];
$ID=$_GET['ID'];

//$userId=18;
//$ID=51;

$dir = dirname(__FILE__);//找到当前脚本所在路径
$fileuserid= $dir . "/validation/" . $userId."/".$userId;


if (!file_exists($fileuserid)){//判断文件夹是否存在，不存在的话就创建这么一个文件夹
    echo "<script>alert('此二维码已失效，请找老师补签！')</script>";
}
else {
    $file = $dir . "/validation/" . $userId . "/" . "counter.txt";
    if (!file_exists($file)) {//判断文件是否存在，不存在的话就创建这么一个文件
        $myfile = fopen($file, "a") or die("Unable to open file!");  //w  重写  a追加
        $txt = "1";
        fwrite($myfile, $txt);
        fclose($myfile);

    } else{
        $counter = intval(file_get_contents($file));
        if (!isset($_SESSION['visit'])) {
            $_SESSION['visit'] = true;
            $counter++;
            $fp = fopen($file, "w");
            fwrite($fp, $counter);
            fclose($fp);
        } else {}

    }



//    echo "<script>alert('".$ID."');</script>";


    $url="idcode_phone.php?ID=".$ID."& userId=".$userId;
    echo "<script type='text/javascript'>";
    echo "window.location.href='".$url."'";
    echo "</script>";
    //require "idcode_phone.php";

}
?>






