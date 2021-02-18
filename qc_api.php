<?php
header("Content-type: text/html; charset=utf-8"); 
if(empty($_GET['token']) || $_GET['token'] == ""){
	exit('{"code":-1,"msg":"您的站点无权进行Oreo免签登录，请前往授权站免费获取权限"}');
}
include "./oreo/oreo.core.php";

$token = aysafe_replace($_GET['token']);

$row=$DB->query("SELECT * FROM `oreo_qcback` WHERE token='$token' limit 1 ")->fetch();

if(!$row){
	exit('{"code":-1,"msg":"您的Token有误！"}');
}
if($row['state'] != 1){
	exit('{"code":-1,"msg":"您的有关权限已停用或权限未激活"}');
}
$callback = $row['callback'];
?>
<html>
<head>
<title>QQ登录</title>
</head>
<?php
require_once("./oreo/oreo_plugin/qcback/QC.conf.php");
require_once("./oreo/oreo_plugin/qcback/QC.class.php");
if($callback != ""){
$urlCookie = base64_encode($callback);
setcookie("Moleft_QQLogin_CallBack",$urlCookie);
$QC=new QC($QC_config);
$QC->qq_login();
$abc=$DB->exec("UPDATE `oreo_qcback` SET  `in_all`=in_all+1 WHERE  token='$token'");
}
else{
exit('{"code":-1,"msg":"您还未配置回调地址"}');
}
?>
</html>