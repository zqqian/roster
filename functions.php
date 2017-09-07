<?php
/**
 *发送邮件方法
 *@param $to：接收者 $title：标题 $content：邮件内容
 *@return bool true:发送成功 false:发送失败
 */

function sendMail($to,$title,$content){

    require_once("phpmailer/class.phpmailer.php");
    require_once("phpmailer/class.smtp.php");
//实例化PHPMailer核心类
    $mail = new PHPMailer();

//使用smtp鉴权方式发送邮件
    $mail->isSMTP();

//smtp需要鉴权 这个必须是true
    $mail->SMTPAuth=true;

//链接qq域名邮箱的服务器地址
    $mail->Host = 'smtp.qq.com';

//设置使用ssl加密方式登录鉴权
    $mail->SMTPSecure = 'ssl';

//设置ssl连接smtp服务器的远程服务器端口号，以前的默认是25，但是现在新的好像已经不可用了 可选465或587
    $mail->Port = 465;

//设置发送的邮件的编码 可选GB2312，utf-8
    $mail->CharSet = 'UTF-8';

//设置发件人姓名（昵称
    $mail->FromName = '云点名';

//smtp登录的账号 这里填入字符串格式的qq号即可
    $mail->Username ='2392844503';

//smtp登录的密码 使用生成的授权码（就刚才保存的最新的授权码）
    $mail->Password = 'uvhkfzotjwzwdihd';

//设置发件人邮箱地址
    $mail->From = '2392844503@qq.com';

//邮件正文是否为html编码
    $mail->isHTML(true);

//设置收件人邮箱地址
    $mail->addAddress($to,'尊敬的客户');

//添加多个收件人 则多次调用方法即可
// $mail->addAddress('xxx@163.com','尊敬的客户');

//添加该邮件的主题
    $mail->Subject = $title;

//添加邮件正文 上方将isHTML设置成了true
    $mail->Body = $content;

    $status = $mail->send();

//判断与提示信息
    if($status) {
        return true;
    }else{
        return false;
    }
}