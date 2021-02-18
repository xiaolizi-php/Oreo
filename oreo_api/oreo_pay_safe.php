
<?php
/**
 * Oreo授权系统
 * =======================================================
 * 版权所有 (C) 2019 www.oreo.com，并保留所有权利。
 * Q Q: 609451870
 * =======================================================
 */
include("../oreo/oreo.core.php");
header('Access-Control-Allow-Origin:*');  
@header('Content-Type: application/json; charset=UTF-8');

$ac = $_GET['super'];//查询所有授权
if(!$ac){
	echo '查询无效!';
	die;
}

//函数
function get_all_headers(){
  // 忽略获取的header数据
  $ignore = array('host','accept','content-length','content-type');
  $headers = array();
  foreach($_SERVER as $key=>$value){
    if(substr($key, 0, 5)==='HTTP_'){
      $key = substr($key, 5);
      $key = str_replace('_', ' ', $key);
      $key = str_replace(' ', '-', $key);
      $key = strtolower($key);
      if(!in_array($key, $ignore)){
        $headers[$key] = $value;
      }
    }
  }
  return $headers;
}
//开始获取接口信息
if($ac=='select_pay_safe'){  
$header = get_all_headers();//获取header
$ret = array();
$ret['OreoJkSafeList'] = $header; //json第一段
header('content-type:application/json;charset=utf8');
$modules=($ret['OreoJkSafeList']['oreosafemods']);//安全验证
$timestamp=($ret['OreoJkSafeList']['oreosafetime']);//安全验证
$safe=($ret['OreoJkSafeList']['oreosafemd5']);//安全验证
$OreoAllMd5=($ret['OreoJkSafeList']['oreoallmd5']);//集体密钥
$OreoUser=($ret['OreoJkSafeList']['oreouser']);//Oreo用户名
$OreoSysKey=($ret['OreoJkSafeList']['oreosysnum']);//Oreo升级码
$OreoDomain=($ret['OreoJkSafeList']['oreodomain']);//域名
$OreoPort=($ret['OreoJkSafeList']['oreoport']);//端口
$OreoAliCode=($ret['OreoJkSafeList']['oreoalicode']);//支付宝对接方式
$OreoAliPass=($ret['OreoJkSafeList']['oreoalipass']);//支付宝md5
$OreoWxCode=($ret['OreoJkSafeList']['oreowxcode']);//微信对接方式
$OreoWxPass=($ret['OreoJkSafeList']['oreowxpass']);//微信md5
$OreoTenCode=($ret['OreoJkSafeList']['oreotencode']);//QQ对接方式
$OreoTenPass=($ret['OreoJkSafeList']['oreotenpass']);//QQ钱包md5

if(!$modules||!$timestamp||!$safe||!$OreoAllMd5||!$OreoUser||!$OreoSysKey||!$OreoDomain||!$OreoPort||$OreoAliCode==''||!$OreoAliPass||$OreoWxCode==''||!$OreoWxPass||$OreoTenCode==''||!$OreoTenPass){
  exit('{"code":"-777","msg":"非法参数"}');
}
//首先开始安全验证
$shah=sha1($modules.'or#$@%!^*eo'.$timestamp);//先sha1加密
$token = md5($shah); //本地生成一个token
if($token != $safe){
  exit('{"code":"-1","msg":"您网站于oreo的安全校验失败"}');
}
//检查用户的设置
$oreo_pay_safe=$DB->query("select * from oreo_pay_safe where update_key='$OreoSysKey' and user='$OreoUser' and domain='$OreoDomain'")->fetch();
$oreo_user=$DB->query("select * from oreo_user where  id='$OreoUser'")->fetch();
$sms_type=$oreo_pay_safe['sms_type'];
if($oreo_pay_safe['detection']==0){
    exit('{"code":"-5","msg":"您未开启动态检测，请前往oreo综合服务站开通该功能"}');
}
//查询短信余量
$sms=$DB->query("SELECT * FROM oreo_tensms WHERE pid='$OreoUser' AND domain='{$OreoDomain}' limit 1 ")->fetch(); 
$surplus=$sms['surplus'];//短信余量
//设置发消息
$title=$conf['web_title'];

function OreoPaySms($sms_type, $title, $email, $msg, $jsonmsg, $jsoncodes, $phone, $OreoUser, $surplus, $OreoDomain){
  global $DB;
    if($sms_type==1){
      if($surplus>0){
        $result = OreoPaySmsQclou($phone, $OreoUser,$jsonmsg);
        if($result===0){
            $DB->exec("update `oreo_tensms` set surplus=surplus-1 where `pid`='{$OreoUser}' and `domain`='{$OreoDomain}'");
            exit('{"code":"'.$jsoncodes.'","msg":"'.$jsonmsg.'"}');
            }
      }else{
        $sub = $title.' - 支付接口异常';
        $result = send_mail($email, $sub, $msg);  
        if($result===true){
            exit('{"code":"'.$jsoncodes.'","msg":"'.$jsonmsg.'"}');
            }  
      }  
    }else {
        $sub = $title.' - 支付接口异常';
        $result = send_mail($email, $sub, $msg);  
        if($result===true){
            exit('{"code":"'.$jsoncodes.'","msg":"'.$jsonmsg.'"}');
            }  
    } 
}

//给获取的端口一个定义
if($OreoPort==80){
    $xieyi="http://";
}if($OreoPort==443){
    $xieyi="https://";
}

//验证集体密钥
$my_token='KuBABRmm1gI4q35ElC';
if($OreoAllMd5 != $my_token){
  exit('{"code":-2,"msg":"您网站于oreo的集体Token安全校验失败"}');
}
//如果通过安全开始验证用户名和升级密钥
$oreo=$DB->query("select * from oreo_pay_safe_log where update_key='$OreoSysKey' and user='$OreoUser' and domain='$OreoDomain'")->fetch();
$new_xieyi=$oreo['xieyi'];

if(!$oreo){
  exit('{"code":-3,"msg":"用户信息不存在，请检查你登录的用户名或升级密钥,或许可能您还未同步过数据"}');
}
if($oreo['xieyi'] != $xieyi){
  exit('{"code":-4,"msg":"您当前域名协议为:'.$OreoPort.',和您在oreo综合服务站预留的协议：'.$oreo['xieyi'].'不一致"}');
}
//都通过了之后开始查询信息
//支付宝验证
$safe_alipay=$DB->query("select * from oreo_pay_safe_log where update_key='$OreoSysKey' and user='$OreoUser' and domain='$OreoDomain' and name='alipay'")->fetch();
$oreo_ali_mode=$safe_alipay['jk_mode']; //oreo中的支付宝接口对接方式
$oreo_ali_pass=$safe_alipay['jk_pass']; //oreo中的支付宝接口MD5
//微信验证
$safe_weixin=$DB->query("select * from oreo_pay_safe_log where update_key='$OreoSysKey' and user='$OreoUser' and domain='$OreoDomain' and name='weixin'")->fetch();
$oreo_wx_mode=$safe_weixin['jk_mode']; //oreo中的微信接口对接方式
$oreo_wx_pass=$safe_weixin['jk_pass']; //oreo中的微信宝接口MD5
//QQ钱包验证
$safe_qq=$DB->query("select * from oreo_pay_safe_log where update_key='$OreoSysKey' and user='$OreoUser' and domain='$OreoDomain' and name='qq'")->fetch();
$oreo_qq_mode=$safe_qq['jk_mode']; //oreo中的微信接口对接方式
$oreo_qq_pass=$safe_qq['jk_pass']; //oreo中的微信宝接口MD5


//验证支付宝
if($OreoAliCode!=$oreo_ali_mode){
    $msg="您的支付宝接口对接方式被修改，请登录【<a href='".$xieyi.$OreoDomain."'>支付系统</a>】后台检查情况.<br>如果是本人操作请前往【<a href='https://www.oreopay.com'>Oreo综合服务站</a>】同步最新接口或关闭接口安全动态检查功能。";
    $email=$oreo_user['email'];
    $jsonmsg="支付宝接口对接方式被修改";
    $jsoncodes="-10";
    $phone=$oreo_user['phone'];
    OreoPaySms($sms_type, $title, $email, $msg, $jsonmsg, $jsoncodes, $phone, $OreoUser, $surplus, $OreoDomain);
    
}
else if($OreoAliPass!=$oreo_ali_pass){
    $msg="您的支付宝接口信息被修改，请登录【<a href='".$xieyi.$OreoDomain."'>支付系统</a>】后台检查情况.<br>如果是本人操作请前往【<a href='https://www.oreopay.com'>Oreo综合服务站</a>】同步最新接口或关闭接口安全动态检查功能。";
    $email=$oreo_user['email'];
    $jsonmsg="支付宝接口信息被修改";
    $jsoncodes="-11";
    $phone=$oreo_user['phone'];
    OreoPaySms($sms_type, $title, $email, $msg, $jsonmsg, $jsoncodes, $phone, $OreoUser, $surplus, $OreoDomain);
}
//验证微信
else if($OreoWxCode!=$oreo_wx_mode){
    $msg="您的微信接口对接方式被修改，请登录【<a href='".$xieyi.$OreoDomain."'>支付系统</a>】后台检查情况.<br>如果是本人操作请前往【<a href='https://www.oreopay.com'>Oreo综合服务站</a>】同步最新接口或关闭接口安全动态检查功能。";
    $email=$oreo_user['email'];
    $jsonmsg="微信接口对接方式被修改";
    $jsoncodes="-12";
    $phone=$oreo_user['phone'];
    OreoPaySms($sms_type, $title, $email, $msg, $jsonmsg, $jsoncodes, $phone, $OreoUser, $surplus, $OreoDomain);
}
else if($OreoWxPass!=$oreo_wx_pass){
    $msg="您的微信接口信息被修改，请登录【<a href='".$xieyi.$OreoDomain."'>支付系统</a>】后台检查情况.<br>如果是本人操作请前往【<a href='https://www.oreopay.com'>Oreo综合服务站</a>】同步最新接口或关闭接口安全动态检查功能。";
    $email=$oreo_user['email'];
    $jsonmsg="微信接口信息被修改";
    $jsoncodes="-13";
    $phone=$oreo_user['phone'];
    OreoPaySms($sms_type, $title, $email, $msg, $jsonmsg, $jsoncodes, $phone, $OreoUser, $surplus, $OreoDomain);
}
//验证QQ
else if($OreoTenCode!=$oreo_qq_mode){
    $msg="您的QQ接口对接方式被修改，请登录【<a href='".$xieyi.$OreoDomain."'>支付系统</a>】后台检查情况.<br>如果是本人操作请前往【<a href='https://www.oreopay.com'>Oreo综合服务站</a>】同步最新接口或关闭接口安全动态检查功能。";
    $email=$oreo_user['email'];
    $jsonmsg="QQ接口对接方式被修改";
    $jsoncodes="-14";
    $phone=$oreo_user['phone'];
    OreoPaySms($sms_type, $title, $email, $msg, $jsonmsg, $jsoncodes, $phone, $OreoUser, $surplus, $OreoDomain);
}
else if($OreoTenPass!=$oreo_qq_pass){
    $msg="您的QQ接口信息被修改，请登录【<a href='".$xieyi.$OreoDomain."'>支付系统</a>】后台检查情况.<br>如果是本人操作请前往【<a href='https://www.oreopay.com'>Oreo综合服务站</a>】同步最新接口或关闭接口安全动态检查功能。";
    $email=$oreo_user['email'];
    $jsonmsg="QQ接口信息被修改";
    $jsoncodes="-15";
    $phone=$oreo_user['phone'];
    OreoPaySms($sms_type, $title, $email, $msg, $jsonmsg, $jsoncodes, $phone, $OreoUser, $surplus, $OreoDomain);
}
else{
  exit('{"code":1,"msg":"Oreo综合服务站提醒您：接口一切正常"}');
}

}
?>