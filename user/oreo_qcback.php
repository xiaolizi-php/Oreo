<?php 
session_start();
header("Content-type: text/html; charset=utf-8");
?>
<html>
<head>
<title>QQ登录成功</title>
</head>
<body>
<?php
require_once("../oreo/oreo_plugin/qcback/QC.conf.php");
require_once("../oreo/oreo_plugin/qcback/QC.class.php");
$QC=new QC($QC_config);
if($_GET['code']){
    $access_token=$QC->qq_callback();
    $openid=$QC->get_openid($access_token);
    //$arr = $QC->get_user_info();
    //$nn = $arr["nickname"];
    $nickname = "未获取";
    $urlCookie = base64_decode($_COOKIE["Moleft_QQLogin_CallBack"]);
    echo 'Oreo授权系统提示：登陆成功，正在跳转';
    header('Refresh:1;url='.$urlCookie.'?openid='.$openid.'&callback='.$access_token.'&nickname='.$nickname);
    setcookie ("Moleft_QQLogin_CallBack", "", time() - 3600);
}
function base_encode($str) {
    $src = array("/", "+", "=");
    $dist = array("_a", "_b", "_c");
    $old = base64_encode($str);
    $new = str_replace($src, $dist, $old);
    return $new;
}
function base_decode($str) {
    $src = array("_a", "_b", "_c");
    $dist = array("/", "+", "=");
    $old = str_replace($src, $dist, $str);
    $new = base64_decode($old);
    return $new;
}
?>
</body>
</html>
