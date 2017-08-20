
<?php
header("Content-Type:text/html;charset=utf-8");      //设置头部信息
//isset()检测变量是否设置
if(isset($_REQUEST['authcode'])){
    session_start();
    //strtolower()小写函数
    if(strtolower($_REQUEST['authcode'])== $_SESSION['authcode']){
        //跳转页面
        echo "<script language=\"javascript\">";
        echo "document.location=\"autoidname.php\"";
        echo "</script>";
    }else{
        //提示以及跳转页面
        echo "<script language=\"javascript\">";
        echo "alert('输入错误!');";
        echo "document.location=\"idcophone.php\"";
        echo "</script>";
    }
    exit();
}
?>
