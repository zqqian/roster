<?php
require_once 'get_user_info.php';
//用于检测是否登录，测试本页面时可暂时屏蔽以下几行php代码
if(!$is_login){
 echo "<script> alert('Please login...');parent.location.href='./index.php'; </script>";
}
?>
<!doctype html>
<html>
<head>
 <meta charset="utf-8">
 <title>重置密码</title>
 <script src="js/jquery-3.2.1.js"></script>
 <style>
  /*为适应低版本的浏览器而设置*/
  header,section,footer,aside,nav,main,article,figure {display:block;}
  .password{border-left-color:#000;margin:30%;  }
 </style>
</head>
<body>
<center>
 <form  id="repassword">
  <input type="text" name="oldpassword" id="oldpassword" placeholder="请输入原密码">
  <input type="text" name="newpassword" id="newpassword" placeholder="请输入新密码">
  <input type="text" name="renewpassword" id="renewpassword"placeholder="重新输入新密码">
  <span id="repasswordspan"></span>
  <button type="button" id="tijiao">提交</button>
  <button type="reset" id="chongzhi">重置</button>
 </form>
</center>
<script>
 $(function(){
  var newpassword=$("#newpassword").val();
  var oldpassword=$("#oldpassword").val();
  var newpassword2=$("#renewpassword").val();
  alert(newpassword);
  alert(oldpassword);
  alert(newpassword2);
  $("#tijiao").click(function() {
   if (newpassword.length ==1) {
    $("#repasswordspan").html("*新密码不能为空");
    $("#newpassword").focus();
   }
   else if (newpassword.length < 6) {
    $("#repasswordspan").html("*新密码不能低于6位");
    $("newpassword").focus();
   }
   else if (newpassword != newpassword2) {
    $("#repasswordspan").html("*两次输入的新密码不一致");
    $("#newpassword").focus();
   }
   else {
    $.post("repassword.php", {
     userId:<?php echo $_SESSION['userid'];?>,
     oldpassword: oldpassword,
     newpassword: newpassword
    }, function (data) {
     if (data == "1") {
      $("#repasswordspan").html("*原密码输入错误");
     }
     else if (data = "2") {
      $("#repasswordspan").html("*新密码和旧密码一致，无法重置");
     }
     else if (data = "3") {
      $("#repasswordspan").html("");
      alert("重置成功");
     }
    })
   }
  })
  })
</script>
</body>
</html>
