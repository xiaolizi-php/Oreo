<?php
error_reporting(0);
define('SYSTEM_ROOT', dirname(__FILE__).'/');
define('ROOT', dirname(SYSTEM_ROOT).'/');
date_default_timezone_set('Asia/Shanghai');
$date = date("Y-m-d H:i:s");
session_start();
$scriptpath=str_replace('\\','/',$_SERVER['SCRIPT_NAME']);
$sitepath = substr($scriptpath, 0, strrpos($scriptpath, '/'));
$siteurl = ($_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://').$_SERVER['HTTP_HOST'].$sitepath.'/';
if(is_file(SYSTEM_ROOT.'oreo_static/safe/oreo_scan.php')){//Oreo安全扫描
 require_once(SYSTEM_ROOT.'oreo_static/safe/oreo_scan.php');
}
require SYSTEM_ROOT.'oreo.config.php';
try {
    $DB = new PDO("mysql:host={$oreoconfig['host']};dbname={$oreoconfig['dbname']};port={$oreoconfig['port']}",$oreoconfig['user'],$oreoconfig['pwd']);
}catch(Exception $e){
    exit('链接数据库失败:'.$e->getMessage());
}
$DB->exec("set names utf8");
$rs=$DB->query("select * from oreo_site");
while($row=$rs->fetch()){ 
	$conf[$row['o']]=$row['r'];
}
if($conf['wxpay_mode']==1){
    define('WX_API_APPID',  $conf['wx_api_appid']);
    define('WX_API_MCHID',  $conf['wx_api_mchid']);
    define('WX_API_KEY',  $conf['wx_api_key']);
    define('WX_API_APPSECRET',  $conf['wx_api_appsecret']);
}
if($conf['qqpay_mode']==1){
    define('QQ_API_MCH_ID',  $conf['qq_api_mchid']);
    define('QQ_API_MCH_KEY',  $conf['qq_api_mchkey']);
}
if(!$conf['local_domain'])$conf['local_domain']=$_SERVER['HTTP_HOST'];
$password_hash='!@#%!s!0';
require_once(SYSTEM_ROOT."oreo_static/pay/alipay/alipay_core.function.php");
require_once(SYSTEM_ROOT."oreo_static/pay/alipay/alipay_md5.function.php");
include_once(SYSTEM_ROOT."oreo_important.php");
include_once(SYSTEM_ROOT."oreo_static/other/oreo_session.php");
$referer=empty($_SERVER['HTTP_REFERER']) ? array() : array($_SERVER['HTTP_REFERER']);
$oreoport = (int)$_SERVER['SERVER_PORT'] == 80 ? 'http://'.$_SERVER['HTTP_HOST'] : 'https://'.$_SERVER['HTTP_HOST'];
function customError($errno, $errstr, $errfile, $errline)
{ 
echo "<b>Error number:</b> [$errno],error on line $errline in $errfile<br />";
die();
}
set_error_handler("customError",E_ERROR);
$getfilter="'|\\b(and|or)\\b.+?(>|<|=|\\bin\\b|\\blike\\b)|\\/\\*.+?\\*\\/|<\\s*script\\b|\\bEXEC\\b|UNION.+?SELECT|UPDATE.+?SET|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE).+?FROM|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE)";
$postfilter="\\b(and|or)\\b.{1,6}?(=|>|<|\\bin\\b|\\blike\\b)|\\/\\*.+?\\*\\/|<\\s*script\\b|\\bEXEC\\b|UNION.+?SELECT|UPDATE.+?SET|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE).+?FROM|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE)";
$cookiefilter="\\b(and|or)\\b.{1,6}?(=|>|<|\\bin\\b|\\blike\\b)|\\/\\*.+?\\*\\/|<\\s*script\\b|\\bEXEC\\b|UNION.+?SELECT|UPDATE.+?SET|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE).+?FROM|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE)";
function StopAttack($StrFiltKey,$StrFiltValue,$ArrFiltReq){  
$StrFiltValue=arr_foreach($StrFiltValue);
if (preg_match("/".$ArrFiltReq."/is",$StrFiltValue)==1){   
slog("<br><br>操作IP: ".$_SERVER["REMOTE_ADDR"]."<br>操作时间: ".strftime("%Y-%m-%d %H:%M:%S")."<br>操作页面:".$_SERVER["PHP_SELF"]."<br>提交方式: ".$_SERVER["REQUEST_METHOD"]."<br>提交参数: ".$StrFiltKey."<br>提交数据: ".$StrFiltValue);
print "<div style=\"position:fixed;top:0px;width:100%;height:100%;background-color:white;color:green;font-weight:bold;border-bottom:5px solid #999;\"><br>您的提交带有不合法参数,谢谢合作!<br><br>了解更多请点击:<a href=\"http://webscan.360.cn\">http://webscan.360.cn</a></div>";
exit();
}
if (preg_match("/".$ArrFiltReq."/is",$StrFiltKey)==1){   
slog("<br><br>操作IP: ".$_SERVER["REMOTE_ADDR"]."<br>操作时间: ".strftime("%Y-%m-%d %H:%M:%S")."<br>操作页面:".$_SERVER["PHP_SELF"]."<br>提交方式: ".$_SERVER["REQUEST_METHOD"]."<br>提交参数: ".$StrFiltKey."<br>提交数据: ".$StrFiltValue);
print "<div style=\"position:fixed;top:0px;width:100%;height:100%;background-color:white;color:green;font-weight:bold;border-bottom:5px solid #999;\"><br>您的提交带有不合法参数,谢谢合作!<br><br>了解更多请点击:<a href=\"http://webscan.360.cn\">http://webscan.360.cn</a></div>";
exit();
}  
}  
foreach($_GET as $key=>$value){ 
StopAttack($key,$value,$getfilter);
}
foreach($_POST as $key=>$value){ 
StopAttack($key,$value,$postfilter);
}
foreach($_COOKIE as $key=>$value){ 
StopAttack($key,$value,$cookiefilter);
}
foreach($referer as $key=>$value){ 
StopAttack($key,$value,$getfilter);
}
function slog($logs)
{
$toppath=$_SERVER["DOCUMENT_ROOT"]."/log.htm";
$Ts=fopen($toppath,"a+");
fputs($Ts,$logs."\r\n");
fclose($Ts);
}
function arr_foreach($arr) {
static $str;
if (!is_array($arr)) {
return $arr;
}
  foreach ($arr as $key => $val ) {

    if (is_array($val)) {

        arr_foreach($val);
    } else {

      $str[] = $val;
    }
  }
  return implode($str);
}



?>