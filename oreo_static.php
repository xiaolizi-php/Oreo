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
header('Access-Control-Allow-Origin:*'); 
$ac = $_GET['a'];
$url = $_GET['u'];
$ip = getIP();
$like = $_GET['like'];
if(!$ac){
	echo '查询无效!';
	die;
}
if($ac=='getip'){
    echo getIP();
	die;
}

//查询cdn静态资源代码
if($ac=='cx'){  
	$domain_pd = get_domain($url);
	$time=time();
	
	$row=$DB->query("SELECT * FROM `oreo_authorize` WHERE domain='$domain_pd'  ")->fetch();
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
	if($conf['oreo_dqsj']==1){
    $time=time();
	$domain_time=$row['time'];
	$domain_ip=$row['ip'];

    if ($time>$domain_time){
         echo $conf['message_2']; //授权过期
         die;
    }}
	$domain_ip=$row2['ip'];
	$ip_qh=$row2['ip_qh'];	
    $auth_id=$row2['authid'];
	if(!empty($authid)){
		if($authid!=$auth_id){
	      echo $conf['message_4']; //检测授权程序	
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
	echo $conf['oreo_cdn']; //通过   
}

if($ac=='ycdl'){  
	$myurl=trim(strip_tags(daddslashes($_POST['myurl'])));
	$oreo_user=trim(strip_tags(daddslashes($_POST['oreo_user'])));
	$password=md5($_POST['oreo_pwd'].$password_hash);
	if($_POST['oreo_user']=='' || $_POST['oreo_pwd']==''){exit('{"code":-1,"msg":"不要提交空数据！"}');}
    $cx=$DB->query("select * from oreo_user where id='$oreo_user' and password='$password'")->fetch();
	$wdata=date("Y-m-d / H:i:s");
	if(!$cx){
		$safe=$DB->query("select * from oreo_user where id='$oreo_user'")->fetch();
		if($safe){
		$sdss=$DB->exec("INSERT INTO `oreo_safe` (`pid`, `time`, `login`, `state`, `url`) VALUES ('$oreo_user', '$wdata', '尝试远程登录','登陆失败-登录密码不正确', '$myurl')");	
		}exit('{"code":-1,"msg":"账号不存在或密码错误"}');
		}
	$cxauth=$DB->query("select * from oreo_authorize where sjid='$oreo_user' and domain='$myurl' ")->fetch();
	if(!$cxauth){
	exit('{"code":-1,"msg":"您的域名与授权域名不一致，尚不能登录远程账号"}');
	}		
	$xieru = file_get_contents(('http://'.$myurl . '/user/ajax.php?act=oreo_xrzh') .'&oreo_user='. $oreo_user.'&oreo_pwd='. $password.'&oreo_yctype=1');
	$sdss=$DB->exec("INSERT INTO `oreo_safe` (`pid`, `time`, `login`, `state`, `url`) VALUES ('$oreo_user', '$wdata', '尝试远程登录','登录成功', '$myurl')");	
	exit('{"code":1,"msg":"登录成功"}');
}
if($ac=='ycdlhq'){  
	$domain=trim(strip_tags(daddslashes($_GET['oreo_user'])));
	$myupdatekey=trim(strip_tags(daddslashes($_GET['oreo_pwd'])));
	$oreo_yctype=trim(strip_tags(daddslashes($_GET['oreo_yctype'])));
	$urls=trim(strip_tags(daddslashes($_GET['oreo_url'])));
	if($_GET['oreo_yctype']==2||!$_GET['oreo_yctype']){
	 $cx=$DB->query("select * from oreo_authorize where domain='$domain' and syskey='$myupdatekey' and authid='{$_GET['authid']}'")->fetch();
	if(!$cx){
		exit('{"errors":444}');
		}
		if($cx){
		exit('{"qq":'.$cx['qq'].',"domain":"'.$cx['domain'].'","updatekey":"'.$cx['syskey'].'","gh_code":"'.$cx['gh_code'].'","sjname":"'.$cx['sjname'].'","oreo_yctype":"2"}');
		}
	}if($_GET['oreo_yctype']==1||!$_GET['oreo_yctype']){
	
    $cx=$DB->query("select * from oreo_user where id='$domain' and password='$myupdatekey'")->fetch();
	if(!$cx){
		exit('{"errors":444}');
		}
	if($cx){
	 $qcback=$DB->query("select * from oreo_qcback where userid='$domain' and callback like '%$urls%'  limit 1")->fetch();  
	 $pay_safe=$DB->query("select * from oreo_pay_safe where user='$domain' and domain='$urls'  limit 1")->fetch();  
	 $auth=$DB->query("select * from oreo_authorize where domain='$urls' and authid='{$_GET['authid']}'")->fetch();
		exit('{"money":'.$cx['money'].',"action":'.$cx['action'].',"gradename":"'.$cx['grade_name'].'","uid":"'.$cx['id'].'","beta":"'.$cx['beta'].'","updatekey":"'.$auth['syskey'].'","oreo_yctype":"1","oreo_qctoken":"'.$qcback['token'].'","oreo_pay_safe_token":"'.$pay_safe['token'].'"}');
		}	
}
}
if($ac=='gonggao'){  
    if($like=='oreo'){
	$rsss=$DB->query("SELECT * FROM oreo_gonggao where type='1' ");
    while($res = $rsss->fetch()){
	echo '<tr>
    <td>'.$res['text'].'</td>
	</tr>';
}}
}
if($ac=='ycdldcsq'){  
	$domain=trim(strip_tags(daddslashes($_POST['domain'])));
	$myupdatekey=trim(strip_tags(daddslashes($_POST['myupdatekey'])));
	if($_POST['domain']=='' || $_POST['myupdatekey']==''){exit('{"code":-1,"msg":"不要提交空数据！"}');}
    $cx=$DB->query("select * from oreo_authorize where domain='$domain' and syskey='$myupdatekey'")->fetch();
	$wdata=date("Y-m-d / H:i:s");
	if(!$cx){
		$safe=$DB->query("select * from oreo_user where id='{$cx['sjid']}'")->fetch();
		if($safe){
		$sdss=$DB->exec("INSERT INTO `oreo_safe` (`pid`, `time`, `login`, `state`, `url`) VALUES ('{$cx['sjid']}', '$wdata', '下级-尝试远程登录','登陆失败-域名或升级码错误', '$domain')");	
		}exit('{"code":-1,"msg":"授权域名不存在或升级码错误"}');
		}
	$xieru = file_get_contents(('http://'.$domain . '/user/ajax.php?act=oreo_xrzhdcsq') .'&oreo_user='. $domain.'&oreo_pwd='. $myupdatekey.'&oreo_yctype=2');
	$sdss=$DB->exec("INSERT INTO `oreo_safe` (`pid`, `time`, `login`, `state`, `url`) VALUES ('{$cx['sjid']}', '$wdata', '下级-尝试远程登录','登录成功', '$domain')");	
	exit('{"code":1,"msg":"登录成功"}');
}
	if($ac=='gethmd'){  
	$name=trim(strip_tags(daddslashes($_POST['name'])));
    $qq=trim(strip_tags(daddslashes($_POST['qq'])));
    $email=trim(strip_tags(daddslashes($_POST['email'])));
    $url=trim(strip_tags(daddslashes($_POST['url'])));
	$jblx=trim(strip_tags(daddslashes($_POST['jblx'])));
    $hmdly=trim(strip_tags(daddslashes($_POST['hmdly'])));
	$jbzqq=trim(strip_tags(daddslashes($_POST['jbzqq'])));
	 if($_POST['name']=='' || $_POST['qq']=='' || $_POST['email']=='' || $_POST['url']=='' || $_POST['hmdly']=='' ){
		exit('{"code":-1,"msg":"不要提交空数据！"}');
	}
     $row=$DB->query("select type from oreo_hmd where jbzqq='{$jbzqq}'")->fetch();
     if($row&&$row['type']==0){
     exit('{"code":-1,"msg":"我们会携手打击失信人员，您上次提交的信息正在审核中，审核结束才能再次提交新的信息，请谅解."}');
     }
    $row=$DB->query("select type from oreo_hmd where qq='$qq'")->fetch();;
     if($row&&$row['type']==0){
     exit('{"code":-1,"msg":"该信息已经在数据库当中，请勿重复提交."}');
     }
    
		$time=date("Y-m-d");
       $sds=$DB->exec("INSERT INTO `oreo_hmd` (`name`, `qq`, `email`, `url`, `jblx`, `hmdly`, `jbzqq`, `time`, `type`) VALUES ('{$name}', '{$qq}', '{$email}', '{$url}', '{$jblx}', '{$hmdly}', '{$jbzqq}', '{$time}', '0')");
		exit('{"code":0,"msg":"已成功收到您的举报，我们会携手打击失信人员！"}');
}
if($ac=='template'){  
	$domain_pd = get_domain($url);
	$time=time();
	
	$row=$DB->query("SELECT * FROM `oreo_authorize` WHERE domain='$domain_pd'  ")->fetch();
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
	if($conf['oreo_dqsj']==1){
    $time=time();
	$domain_time=$row['time'];
	$domain_ip=$row['ip'];

    if ($time>$domain_time){
         echo $conf['message_2']; //授权过期
         die;
    }}
	$domain_ip=$row2['ip'];
	$ip_qh=$row2['ip_qh'];	
    $auth_id=$row2['authid'];
	if(!empty($authid)){
		if($authid!=$auth_id){
	      echo $conf['message_4']; //检测授权程序	
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
	$stname = $_GET['stname'];
	if($stname=="Oreo支付失信名单"){
	$rs=$DB->query("SELECT * FROM oreo_hmd order by id desc limit 99999"); 
     while($row = $rs->fetch()){ 
	 if($row['type']==0){
	 $types='已解除';
	 }else{
	 $types='黑名单';}
	 echo '
              <tr>
              <td> '.$row['name']. '</td>
              <td> '.$row['qq']. '</td>
              <td> '.$row['url']. '</td>
              <td> '.$row['jblx']. '</td>
              <td> '.date("Y-m-d",$row['time']).'</td>
			  <td> '.$types.'</td>
              </tr>';	
	}die;
	}
	$template=$DB->query("select * from oreo_html where name='$stname'")->fetch();     
	echo $template['code']; //通过   
}
//oreo云短信
if($ac=='OreoSms'){  
	$domain=trim(strip_tags(daddslashes($_GET['domain'])));
	$smstoken=trim(strip_tags(daddslashes($_GET['smstoken'])));
	$code=trim(strip_tags(daddslashes($_GET['oreosmscode'])));
	$phone=trim(strip_tags(daddslashes($_GET['phone'])));
	if($_GET['domain']=='' || $_GET['smstoken']==''){exit('{"result":-1,"msg":"参数有误"}');}
    $cx=$DB->query("select * from oreo_tensms where domain='$domain' and token='$smstoken' and surplus>0")->fetch();
	if(!$cx)exit('{"code":-1,"msg":"token不匹配"}');
    $result = tensms($phone,$code);	
	if($result===0){
	 $sqs=$DB->exec("update `oreo_tensms` set surplus=surplus-1 where `pid`='{$cx['pid']}' and `token`='{$smstoken}'");
	 exit('{"code":1,"result":"0"}');
	}else{
	exit('{"code":1,"result":"777"}');
	}
}
//oreo云短信获取极验证
if($ac=='OreoSmsGts'){  
	$domain=trim(strip_tags(daddslashes($_GET['domain'])));
	$smstoken=trim(strip_tags(daddslashes($_GET['smstoken'])));
	if($_GET['domain']=='' || $_GET['smstoken']==''){exit('{"code":-1,"msg":"参数有误"}');}
    $cx=$DB->query("select * from oreo_tensms where domain='$domain' and token='$smstoken' and surplus>0 ")->fetch();
	if(!$cx)exit('{"code":-1,"msg":"token不匹配"}');
	exit('{
	"getsid":"'.$conf['CAPTCHA_ID'].'",
	"getskey":"'.$conf['PRIVATE_KEY'].'"
	}');
}
?>