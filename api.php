<?php
/**
 * Oreo授权系统
 * =======================================================
 * 版权所有 (C) 2019 www.oreo.com，并保留所有权利。
 * Q Q: 609451870
 * =======================================================
 */
include './oreo/oreo.core.php';
date_default_timezone_set('PRC');
header("content-type:text/html;charset=utf-8");


$ac = $_GET['auth'];//查询所有授权
if(!$ac){
	echo '查询无效!';
	die;
}

//开始查询所有授权域名和网站名称
if($ac=='selectauth'){  
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
$header = get_all_headers();//获取header
$ret = array();
$ret['OreoAuthList'] = $header; //json第一段
header('content-type:application/json;charset=utf8');
$OreoMyToken=($ret['OreoAuthList']['oreomytoken']);
$OreoUser=($ret['OreoAuthList']['oreouser']);
//开始查询有效性
$user=$DB->query("select * from oreo_user where id='{$OreoUser}' and token='{$OreoMyToken}' ")->fetch();
if($user){
	$auth=$DB->query("SELECT * FROM oreo_authorize order by id desc limit 0,99999");				
    while($row = $auth->fetch())
    {   

	   echo('{"WebName":"'.$row['web_name'].'","WebUrl":"'.$row['domain'].'"}'."<pre>");
   }
}else{
     exit('{"code":-777,"msg":"您的Token或User无效"}');
  }
}
?>