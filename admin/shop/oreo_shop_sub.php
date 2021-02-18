<?php
include("../../oreo/oreo.core.php");
if($islogin==1){}else exit('{"code":-3,"msg":"No Login"}');
$act=isset($_GET['act'])?daddslashes($_GET['act']):null;
header('Access-Control-Allow-Origin:*');  
@header('Content-Type: application/json; charset=UTF-8');

switch($act){
//实名认证通过
case 'Shop_RealOk':
    $user=daddslashes(strip_tags($_POST['user']));
	$DB->exec("update `oreo_shop_user` set  activation='2'  where `user`='$user' ");
	$DB->exec("update `oreo_shop_real` set  activation='2'  where `user`='$user' ");
	//发送申请成功的手机短信
	$user_info=$DB->query("select * from oreo_shop_user where user='$user' limit 1")->fetch();
	$sms_type='2';
	$user_name=$user;
	$phone=$user_info['phone'];
	$real_type='：实名认证已通过';
	$result = tensms_msg($sms_type,$phone, $user_name,$real_type);
	exit('{"code":1,"msg":"succ"}');
break;
//实名认证驳回
case 'Shop_RealNo':
    $user=daddslashes(strip_tags($_POST['user']));
	$Real_User=$DB->query("select * from oreo_shop_real where user='$user' limit 1")->fetch();
	$str = $Real_User['real_aphoto'];
    $Array=explode('/',$str);
	unlink ( '../../user/shop/temp/src/certification/'.$Array['8'] );
    $str = $Real_User['real_bphoto'];
    $Array=explode('/',$str);
	unlink ( '../../user/shop/temp/src/certification/'.$Array['8'] );
	$user_id=$DB->exec("update `oreo_shop_user` set  activation='1'  where `user`='$user' ");
	$DB->exec("DELETE FROM oreo_shop_real WHERE user='$user'");
    //发送申请驳回的手机短信
	$user_info=$DB->query("select * from oreo_shop_user where user='$user' limit 1")->fetch();
	$sms_type='1';
	$user_name=$user;
	$phone=$user_info['phone'];
	$real_type='：实名认证已驳回';
	$result = tensms_msg($sms_type,$phone, $user_name,$real_type);
	exit('{"code":1,"msg":"succ"}');
break;
//编辑平台用户
case 'Shop_Edit_User':
    $user=daddslashes(strip_tags($_POST['user']));//账号
	$name=daddslashes(strip_tags($_POST['name']));
	$qq=daddslashes(strip_tags($_POST['qq']));
	$phone=daddslashes(strip_tags($_POST['phone']));
	$email=daddslashes(strip_tags($_POST['email']));
	$money=daddslashes(strip_tags($_POST['money']));
	$type=daddslashes(strip_tags($_POST['type']));
	$DB->exec("update `oreo_shop_user` set  name='$user', qq='$qq', phone='$phone', email='$email', money='$money', type='$type' where `user`='$user' ");
	exit('{"code":1,"msg":"succ"}');
break;
//删除平台用户
case 'Shop_Del_User':
    $user=daddslashes(strip_tags($_POST['user']));//账号
	//首先查询该用户是否实名认证
	$Real_User=$DB->query("select * from oreo_shop_real where user='$user' limit 1")->fetch();
	//如果实名认证就删除实名认证记录
	
	if($Real_User){
		/*
	$str = $Real_User['real_aphoto'];
    $Array=explode('/',$str);
	unlink ( '../../user/shop/temp/src/certification/'.$Array['8'] );
    $str = $Real_User['real_bphoto'];
    $Array=explode('/',$str);
	unlink ( '../../user/shop/temp/src/certification/'.$Array['8'] );
	*/
	$DB->exec("DELETE FROM oreo_shop_real WHERE user='$user'");
	}
	//查询该用户是否有商品
	$Shop_User=$DB->query("select * from oreo_shop_guarantee where seller='$user'")->fetch();
	//如果存在商品给予删除处理
	if($Shop_User){
		$DB->exec("DELETE FROM oreo_shop_guarantee WHERE seller='$user'");
	}
	$DB->exec("DELETE FROM oreo_shop_user WHERE user='$user'");
	exit('{"code":1,"msg":"succ"}');
break;















































	
case 'edit_Hmdxiugai':
    $id=daddslashes(strip_tags($_POST['id']));
	$name=daddslashes(strip_tags($_POST['name']));
	$qq=daddslashes(strip_tags($_POST['qq']));
	$email=daddslashes(strip_tags($_POST['email']));
	$url=daddslashes(strip_tags($_POST['url']));
	$jblx=daddslashes(strip_tags($_POST['jblx']));
	$hmdly=daddslashes(strip_tags($_POST['hmdly']));
	$time = strtotime($_POST['time']);
	$jbzqq=daddslashes(strip_tags($_POST['jbzqq']));
	$type=daddslashes(strip_tags($_POST['type']));
	$sqs=$DB->exec("update `oreo_hmd` set `name` = '$name', `qq` = '$qq', `email` = '$email', `url` = '$url', `jblx` = '$jblx', `hmdly` = '$hmdly', `time` = '$time',  `jbzqq` = '$jbzqq',  `type` = '$type'  WHERE `id` = '$id'");
	 exit('{"code":1,"msg":"succ"}');
	
break;
case 'edit_NewgonggaoXiugai':
	$id=daddslashes(strip_tags($_POST['id']));
	$name=daddslashes(strip_tags($_POST['name']));
	$text=$_POST['text'];
	$type=daddslashes(strip_tags($_POST['type']));
    $sqs=$DB->exec("update `oreo_notice` set `name` ='{$name}',`text` ='{$text}',`type` ='{$type}' where `id`='$id' ");
	   exit('{"code":1,"msg":"succ"}');
break;
case 'edit_ShuanchuAd':
$id=$_POST['ids'];
$sql=$DB->exec("DELETE FROM oreo_notice WHERE id='$id'");
exit('{"code":1,"msg":"succ"}');
break;
case 'edit_Newgonggao':
	$name=daddslashes(strip_tags($_POST['namet']));
	$text=$_POST['textt'];
	$type=daddslashes(strip_tags($_POST['typet']));
	$addtime=date("Y-m-d");
    $sds=$DB->exec("INSERT INTO `oreo_notice` (`name`, `text`, `type`, `dtime`) VALUES ('{$name}', '{$text}', '{$type}', '{$addtime}')");
	exit('{"code":1,"msg":"添加成功"}');
break;
case 'edit_Hmdtianjia':
	$name=daddslashes(strip_tags($_POST['namet']));
	$qq=daddslashes(strip_tags($_POST['qqt']));
	$email=daddslashes(strip_tags($_POST['emailt']));
	$url=daddslashes(strip_tags($_POST['urlt']));
	$jblx=daddslashes(strip_tags($_POST['jblxt']));
	$hmdly=daddslashes(strip_tags($_POST['hmdlyt']));
	$time = strtotime($_POST['timet']);
	$jbzqq=daddslashes(strip_tags($_POST['jbzqqt']));
	$type=daddslashes(strip_tags($_POST['typet']));
	if(!$name||!$time){
		exit('{"code":-1,"msg":"名称和时间不能为空"}');
	}else{
	      $sds=$DB->exec("INSERT INTO `oreo_hmd` (`name`, `qq`, `email`, `url`, `jblx`, `hmdly`, `time`, `jbzqq`, `type`) VALUES ('$name', '$qq', '$email', '$url', '$jblx', '$hmdly', '$time', '$jbzqq', '$type')");
		   exit('{"code":1,"msg":"succ"}');
		   die;
	}
break;
case 'edit_Xsshanchu':
    $id=daddslashes(strip_tags($_POST['ids']));
	$sql="DELETE FROM oreo_hmd WHERE id='$id'";	
if($DB->exec($sql))
	 exit('{"code":1,"msg":"succ"}');
else
	 exit('{"code":-1,"msg":"删除失败！"}'); 
    exit('{"code":1,"msg":"succ"}');
break;		
case 'edit_Htmlxiugai':
    $id=daddslashes(strip_tags($_POST['id']));
	$name=daddslashes(strip_tags($_POST['name']));
	$code=daddslashes(strip_tags($_POST['code']));
	$sqs=$DB->exec("update `oreo_html` set `name` = '$name',  `code` = '$code'  WHERE `id` = '$id'");
	exit('{"code":1,"msg":"succ"}');
break;	
case 'edit_Htmlctianjia':
    $name=daddslashes(strip_tags($_POST['namet']));
	$code=$_POST['codet'];
	if(!$name||!$code){
		exit('{"code":-1,"msg":"名称和代码内容不能为空"}');
	}else{
		  $sds=$DB->exec("INSERT INTO `oreo_html` (`name`, `code`) VALUES ('$name', '$code')");
		   exit('{"code":1,"msg":"succ"}');
		   die;
	}
break;	
case 'edit_Htmlshanchu':
    $id=daddslashes(strip_tags($_POST['ids']));
	$sql="DELETE FROM oreo_html WHERE id='$id'";	
if($DB->exec($sql))
	 exit('{"code":1,"msg":"succ"}');
else
	 exit('{"code":-1,"msg":"删除失败！"}'); 
break;
case 'edit_Huifu':
	$num=($_POST['num']);	
	$qqmail=($_POST['qq']);	
	$huifu=daddslashes(strip_tags($_POST['huifu']));
	$active=daddslashes(strip_tags($_POST['active']));
		if($conf['mail_cloud']==1){
		if($active==1 && $qqmail!=''){
		$wdata=date("Y-m-d");
		$sqs=$DB->exec("update `oreo_work` set `huifu` ='{$huifu}',`wdata` ='{$wdata}',`active` ='{$active}' where `num`='$num'");
		$qqemail=$qqmail.'@qq.com';
        $siteurl = ($_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://').$_SERVER['HTTP_HOST'].'/';
		$sub = $conf['web_title'].' - 您提交的工单已有回复';
		$msg = '<h2>您的工单已有新的进展</h2>尊敬的用户您好,您的工单编号为：'.$num.'的工单已经有最新的进展。<br/>请尽快登录后台查看详细内容：【<a href="'.$siteurl.'" target="_blank">登录后台</a>】<br/>';
		$result = send_mail($qqemail, $sub, $msg);
		exit('{"code":1,"msg":"succ"}');
		}}else{
		$wdata=date("Y-m-d");
		$sqs=$DB->exec("update `oreo_work` set `huifu` ='{$huifu}',`wdata` ='{$wdata}',`active` ='{$active}' where `num`='$num'");
		exit('{"code":1,"msg":"succ"}');
		}
break;		
case 'edit_Cdnurl':
	$oreo_cdn=daddslashes(strip_tags($_POST['oreo_cdn']));  
	foreach ($_POST as $k => $value) {
        if($k=='pwd')continue;
        $value=daddslashes($value);
        $DB->query("insert into oreo_site set `o`='{$k}',`r`='{$value}' on duplicate key update `r`='{$value}'");
    }
	 exit('{"code":1,"msg":"succ"}');
break;	
case 'edit_Work':
	$owrk_zt=daddslashes(strip_tags($_POST['owrk_zt'])); 
	$owrk_ask=daddslashes(strip_tags($_POST['owrk_ask'])); 
	foreach ($_POST as $k => $value) {
        if($k=='pwd')continue;
        $value=daddslashes($value);
        $DB->query("insert into oreo_site set `o`='{$k}',`r`='{$value}' on duplicate key update `r`='{$value}'");
    }
	 exit('{"code":1,"msg":"succ"}');
break;	
case 'edit_ShanchuAsk':
$id=$_POST['ids'];
$asknum=$_POST['asknum'];
$rows=$DB->query("select * from oreo_work where uid='$id' AND num='$asknum' limit 1")->fetch();
if(!$rows)
	exit('{"code":-1,"msg":"当前记录不存在！"}');
$urls=explode(',',$rows['url']);
$sql="DELETE FROM oreo_work WHERE uid='$id' AND num='$asknum'";	
if($DB->exec($sql))
	 exit('{"code":1,"msg":"succ"}');
else
	 exit('{"code":-1,"msg":"删除失败！"}');
break;
case 'edit_Tianjia':
    $web_name=daddslashes(strip_tags($_POST['web_namet']));
	$domain=daddslashes(strip_tags($_POST['domaint']));
	$ip=daddslashes(strip_tags($_POST['ipt']));
	$qq=daddslashes(strip_tags($_POST['qqt']));
	$sjid=daddslashes(strip_tags($_POST['sjidt']));
	$version=daddslashes(strip_tags($_POST['versiont']));
	$syskey=daddslashes(strip_tags($_POST['syskeyt']));
	$ip_qh=daddslashes(strip_tags($_POST['ip_qht']));
	$yumi=daddslashes(strip_tags($_POST['yumit']));
	$authid=daddslashes(strip_tags($_POST['authidt']));
	$time = strtotime($_POST['timet']);
	$cxyh=$DB->query("SELECT * FROM `oreo_user` WHERE id='$sjid' limit 1")->fetch();
	if($sjid&&!$cxyh){
		 exit('{"code":-1,"msg":"上级用户不存在,若不需要请留空"}');
    }
	$cxszb=$DB->query("select * from oreo_authorize where authid='$authid' and domain='$domain' limit 1")->fetch();
	if($cxszb){
		$sjnames=$cxszb['sjname'];
		$tjqq=$cxszb['qq'];
		$authn=$cxszb['authname'];
		exit('{"code":-1,"msg":"您添加的域名在：'.$authn.' <br/>该域名已经被 '.$sjnames.' 添加授权<br/>联系QQ：'.$tjqq.'"}');
	}
	$scjg=$DB->query("SELECT * FROM `oreo_authsys` WHERE syskeys='$authid' ")->fetch();
    $sccxname=$scjg['name'];
	$gh_code=ghcode(7);
	$sds=$DB->exec("INSERT INTO `oreo_authorize` (`web_name`, `domain`, `ip`, `qq`, `sjid`, `version`, `syskey`, `ip_qh`, `yumi`, `authid`, `time`, `authname`, `gh_code`, `sjname`) VALUES ('{$web_name}', '{$domain}', '{$ip}', '{$qq}', '{$sjid}', '{$version}', '{$syskey}', '{$ip_qh}', '{$yumi}', '{$authid}', '{$time}', '{$sccxname}', '{$gh_code}', '{$cxyh['names']}')");$pid=$DB->lastInsertId();
     if($sds){
		 exit('{"code":1,"msg":"添加成功"}');
}else{
        exit('{"code":-1,"msg":"添加失败！"}');
}
break;
case 'edit_Xiugai':
    $id=daddslashes(strip_tags($_POST['id']));
	$web_name=daddslashes(strip_tags($_POST['web_name']));
	$authid=daddslashes(strip_tags($_POST['authids']));
	$domain=daddslashes(strip_tags($_POST['domain']));
	$ip=daddslashes(strip_tags($_POST['ip']));
	$qq=daddslashes(strip_tags($_POST['qq']));
	$sjname=daddslashes(strip_tags($_POST['sjname']));
	$version=daddslashes(strip_tags($_POST['version']));
	$syskey=daddslashes(strip_tags($_POST['syskey']));
	$ip_qh=daddslashes(strip_tags($_POST['ip_qh']));
	$yumi=daddslashes(strip_tags($_POST['yumi']));
	$time = strtotime($_POST['time']);
	
	$cxszb=$DB->query("select * from oreo_authorize where authid='$authid' and id!='$id'")->fetch();
	if($cxszb['domain']==$domain){
		$sjnames=$cxszb['sjname'];
		$tjqq=$cxszb['qq'];
		$authn=$cxszb['authname'];
		exit('{"code":-1,"msg":"您修改的域名在：'.$authn.' <br/>该域名已经被 '.$sjnames.' 添加授权<br/>联系QQ：'.$tjqq.'"}');
	}
	$sqs=$DB->exec("update `oreo_authorize` set `web_name` ='{$web_name}',`domain` ='{$domain}',`ip` ='{$ip}',`qq` ='{$qq}',`version` ='{$version}',`syskey` ='{$syskey}',`ip_qh` ='{$ip_qh}',`yumi` ='{$yumi}',`time` ='{$time}' where `id`='$id' and sjname='$sjname'");
	exit('{"code":1,"msg":"修改成功"}');
break;
case 'edit_Gongxg':
    $id=daddslashes(strip_tags($_POST['id']));
	$text=($_POST['text']);
	$type=daddslashes(strip_tags($_POST['type']));
	$sqs=$DB->exec("update `oreo_gonggao` set `text` ='{$text}',`type` ='{$type}' where `id`='$id'");
	exit('{"code":1,"msg":"修改成功"}');
break;
case 'edit_Adxg':
    $id=daddslashes(strip_tags($_POST['id']));
	$uid=daddslashes(strip_tags($_POST['uid']));
	$time=daddslashes(strip_tags($_POST['time']));
	$id=daddslashes(strip_tags($_POST['id']));
	$text=($_POST['text']);
	$type=daddslashes(strip_tags($_POST['type']));
	$sqs=$DB->exec("update `oreo_ad` set `text` ='{$text}',`type` ='{$type}',`dtime` ='{$time}' where `id`='$id' and uid='$uid'");
	exit('{"code":1,"msg":"修改成功"}');
break;
case 'edit_Adtianjia':
	$text=($_POST['text']);
	$ad_type=daddslashes(strip_tags($_POST['ad_typet']));
	$authid=daddslashes(strip_tags($_POST['authidt']));
	$uid=daddslashes(strip_tags($_POST['uidt']));
	$dtime=daddslashes(strip_tags($_POST['dtimet']));
	$type=daddslashes(strip_tags($_POST['type']));
	$cxyh=$DB->query("SELECT * FROM `oreo_user` WHERE id='$uid' limit 1")->fetch();
	if(!$text||!$uid||!$type)exit('{"code":-1,"msg":"各项不能为空"}');
	if(!$cxyh)exit('{"code":-1,"msg":"用户账号不存在"}');
	$sys=$DB->query("select * from oreo_authsys where syskeys='$authid'  limit 1")->fetch();
	$authnames=$sys['name'];
	if($ad_type==1){
		$authid='';
		$authnames='';
	}
	$sds=$DB->exec("INSERT INTO `oreo_ad` (`text`, `type`, `ad_type`, `authid`, `authname`, `uid`, `dtime`) VALUES ('{$text}', '{$type}', '{$ad_type}', '{$authid}', '{$authnames}', '{$uid}', '{$dtime}')");
	exit('{"code":1,"msg":"添加成功"}');
break;
case 'edit_Gongtianjia':
	$text=($_POST['text']);
	$type=daddslashes(strip_tags($_POST['type']));
	$sds=$DB->exec("INSERT INTO `oreo_gonggao` (`text`, `type`) VALUES ('{$text}', '{$type}')");
	exit('{"code":1,"msg":"添加成功"}');
break;
case 'edit_Shanchu':
    $id=daddslashes(strip_tags($_POST['ids']));
	$scsname=daddslashes(strip_tags($_POST['scsname']));
	$sql="DELETE FROM oreo_authorize WHERE id='$id'";	
    if($DB->exec($sql))
	 exit('{"code":1,"msg":"succ"}');
    else
	 exit('{"code":-1,"msg":"删除数据失败！"}');
break;
case 'edit_Wzxx':
    $web_title=daddslashes(strip_tags($_POST['web_title']));
	$local_domain=daddslashes(strip_tags($_POST['local_domain']));
	$web_qq=daddslashes(strip_tags($_POST['web_qq']));
	$web_beian=daddslashes(strip_tags($_POST['web_beian']));
	$web_copyright=daddslashes(strip_tags($_POST['web_copyright']));
	$oreo_scname1=daddslashes(strip_tags($_POST['oreo_scname1']));
	$oreo_scname2=daddslashes(strip_tags($_POST['oreo_scname2']));
	$oreo_scname3=daddslashes(strip_tags($_POST['oreo_scname3']));
	foreach ($_POST as $k => $value) {
        if($k=='pwd')continue;
        $value=daddslashes($value);
        $DB->query("insert into oreo_site set `o`='{$k}',`r`='{$value}' on duplicate key update `r`='{$value}'");
    }
	exit('{"code":1,"msg":"succ"}');
break;	
case 'edit_Zxzfpz':
    $oreo_zxcz=daddslashes(strip_tags($_POST['oreo_zxcz']));
	$oreo_ordername=daddslashes(strip_tags($_POST['oreo_ordername']));
	$oreo_zfsm=daddslashes(strip_tags($_POST['oreo_zfsm']));
	foreach ($_POST as $k => $value) {
        if($k=='pwd')continue;
        $value=daddslashes($value);
        $DB->query("insert into oreo_site set `o`='{$k}',`r`='{$value}' on duplicate key update `r`='{$value}'");
    }
	exit('{"code":1,"msg":"succ"}');
break;	
case 'edit_Oreomsg':
    $message_1=daddslashes(strip_tags($_POST['message_1']));
	$message_3=daddslashes(strip_tags($_POST['message_3']));
	$message_2=daddslashes(strip_tags($_POST['message_2']));
	$message_4=daddslashes(strip_tags($_POST['message_4']));
	foreach ($_POST as $k => $value) {
        if($k=='pwd')continue;
        $value=daddslashes($value);
        $DB->query("insert into oreo_site set `o`='{$k}',`r`='{$value}' on duplicate key update `r`='{$value}'");
    }
	exit('{"code":1,"msg":"succ"}');
break;	
case 'edit_Adpass':
    $admin_user=daddslashes(strip_tags($_POST['admin_user']));
    $admin_pwd=daddslashes(strip_tags($_POST['admin_pwd']));
	$rpassword=daddslashes(strip_tags($_POST['rpassword']));
	if(!$_POST['admin_pwd']){
	exit('{"code":-1,"msg":"填写密码！"}');
	}
	if($admin_pwd!=$rpassword){
	exit('{"code":-1,"msg":"两次密码不一致！"}');
	}else{
	foreach ($_POST as $k => $value) {
        if($k=='pwd')continue;
        $value=daddslashes($value);
        $DB->query("insert into oreo_site set `o`='{$k}',`r`='{$value}' on duplicate key update `r`='{$value}'");
    }
    if(!empty($_POST['admin_pwd'])){
        $pwd =  md5($_POST['admin_pwd'].$password_hash."admin");
        $DB->query("update `oreo_site` set `r` ='{$pwd}' where `o`='admin_pwd'");
    }
	}
     exit('{"code":1,"msg":"succ"}');	
break;
/*	
case 'edit_Version':
    $authid=daddslashes(strip_tags($_POST['authid']));
    $name=daddslashes(strip_tags($_POST['name']));
	$content = base64_encode($_POST['content']);
	$file=daddslashes(strip_tags($_POST['file']));
	$sds=$DB->exec("INSERT INTO `oreo_version` (`authid`, `name`, `content`, `file`) VALUES ('{$authid}', '{$name}', '{$content}', '{$file}')");
    $pid=$DB->lastInsertId();
     if($sds){
		 exit('{"code":1,"msg":"添加成功"}');
}else{
        exit('{"code":-1,"msg":"添加失败！"}');
}
break;
*/
case 'edit_Gxxiugai':
    $id=daddslashes(strip_tags($_POST['id']));
	$name=daddslashes(strip_tags($_POST['name']));
	$beta=daddslashes(strip_tags($_POST['beta']));
	$content = base64_encode($_POST['content']);
	$file=daddslashes(strip_tags($_POST['file']));
    $sqs=$DB->exec("update `oreo_version` set `name` ='{$name}',`content` ='{$content}',`file` ='{$file}',`beta` ='{$beta}' where `id`='$id'");
    exit('{"code":1,"msg":"修改成功"}');
break;
case 'edit_Gxshanchu':
    $id=daddslashes(strip_tags($_POST['ids']));
	$sql="DELETE FROM oreo_version WHERE id='$id'";	
    if($DB->exec($sql))
	 exit('{"code":1,"msg":"succ"}');
    else
	 exit('{"code":-1,"msg":"删除数据失败！"}');
break;	
case 'edit_QCtianjia':
    $userid=daddslashes(strip_tags($_POST['userid']));
	$title=daddslashes(strip_tags($_POST['title']));
	$url=daddslashes(strip_tags($_POST['url']));
	$callback=daddslashes(strip_tags($_POST['callback']));
	$state=daddslashes(strip_tags($_POST['state']));
	if(!$userid||!$qq){exit('{"code":-1,"msg":"各项不能留空"}');}
	$cxyh=$DB->query("SELECT * FROM `oreo_user` WHERE id='$userid' limit 1")->fetch();
	if(!$cxyh){exit('{"code":-1,"msg":"用户账号不存在"}');}
    $cxurl=$DB->query("SELECT * FROM `oreo_qcback` WHERE url='$url' limit 1")->fetch();
    if($cxurl){exit('{"code":-1,"msg":"该站点已存在"}');}
    $token=ghcode(16); 
	$addtime=date("Y-m-d H:i:s");
	$sds=$DB->exec("INSERT INTO `oreo_qcback` (`token`, `userid`, `title`, `url`, `callback`, `addtime`, `state`) VALUES ('$token', '$userid', '$title', '$url', '$callback', '$addtime', '$state')");
	exit('{"code":1,"msg":"添加成功"}');
break;	
case 'edit_Sqstianjia':
    $names=daddslashes(strip_tags($_POST['namez']));
	$id=daddslashes(strip_tags($_POST['idz']));
	$qq=daddslashes(strip_tags($_POST['qqz']));
	$email=daddslashes(strip_tags($_POST['emailz']));
	$money=daddslashes(strip_tags($_POST['moneyz']));
	$password=md5($_POST['passwordz'].$password_hash);
	$sjid=daddslashes(strip_tags($_POST['sjidz']));
	$action=daddslashes(strip_tags($_POST['actionz']));
	$beta=daddslashes(strip_tags($_POST['betaz']));
	if(!$id||!$password){exit('{"code":-1,"msg":"各项不能留空"}');}
	$cxyh=$DB->query("SELECT * FROM `oreo_user` WHERE id='$id' limit 1")->fetch();
	if($cxyh){exit('{"code":-1,"msg":"用户名存在"}');}
	if(strlen($_POST['passwordz'])<8)exit('{"code":-1,"msg":"密码不能少于8字符."}');
	if(preg_match("/^[A-Za-z0-9]+$/", $id) == false)exit('{"code":-1,"msg":"登录账户不能为中文."}');
	if(!preg_match('/^[A-z0-9._-]+@[A-z0-9._-]+\.[A-z0-9._-]+$/', $email)){ exit('{"code":-1,"msg":"邮箱格式不正确"}');}
	$cxyh=$DB->query("SELECT * FROM `oreo_user` WHERE id='$sjid' limit 1")->fetch();
	if($sjid&&!$cxyh){ exit('{"code":-1,"msg":"上级用户不存在,若不需要请留空"}');}
	if($sjid){$sjname=$cxyh['names'];}
	$sds=$DB->exec("INSERT INTO `oreo_user` (`names`, `id`, `qq`, `email`, `password`, `sjid`, `action`, `money`, `sjname`, `beta`, `kami`) VALUES ('$names', '$id', '$qq', '$email', '$password', '$sjid', '$action', '$money', '$sjname', '$beta', '0')");
    $pid=$DB->lastInsertId();
     if($sds){
		 exit('{"code":1,"msg":"添加成功"}');
}else{
        exit('{"code":-1,"msg":"添加失败！"}');
}
break;	
case 'edit_OreoSmsXg':
    $id=daddslashes(strip_tags($_POST['id']));
	$token=daddslashes(strip_tags($_POST['token']));
	$surplus=daddslashes(strip_tags($_POST['surplus']));
	$cztoken=daddslashes(strip_tags($_POST['cztoken']));
	$type=daddslashes(strip_tags($_POST['type']));
	if($cztoken==1){
	$token=ghcode(16); 
	}
	$sqs=$DB->exec("UPDATE `oreo_tensms` set `token` = '$token', `surplus` = '$surplus', `type` = '$type' WHERE `id` = '$id'");
	exit('{"code":1,"msg":"修改成功"}');	
break;
case 'edit_QCxiugai':
    $id=daddslashes(strip_tags($_POST['id']));
	$title=daddslashes(strip_tags($_POST['title']));
	$url=daddslashes(strip_tags($_POST['url']));
	$callback=daddslashes(strip_tags($_POST['callback']));
	$state=daddslashes(strip_tags($_POST['state']));
	$sqs=$DB->exec("UPDATE `oreo_qcback` set `title` = '$title', `url` = '$url', `callback` = '$callback',  `state` = '$state'   WHERE `id` = '$id'");
	exit('{"code":1,"msg":"修改成功"}');	
break;
case 'edit_Sqsxiugai':
    $id=daddslashes(strip_tags($_POST['id']));
	$names=daddslashes(strip_tags($_POST['names']));
	$qq=daddslashes(strip_tags($_POST['qq']));
	$email=daddslashes(strip_tags($_POST['email']));
	$money=daddslashes(strip_tags($_POST['money']));
	$password=md5($_POST['password'].$password_hash);
	$action=daddslashes(strip_tags($_POST['action']));
	$beta=daddslashes(strip_tags($_POST['beta']));
	$scjg=$DB->query("SELECT * FROM `oreo_user` WHERE id='$id' limit 1")->fetch();
	if($scjg['password']==$_POST['password']){
	$sqs=$DB->exec("UPDATE `oreo_user` set   `names` = '$names',  `qq` = '$qq',  `email` = '$email', `action` = '$action', `money` = '$money', `beta` = '$beta'  WHERE `id` = '$id'");
	exit('{"code":1,"msg":"修改成功"}');
	}else{
	$sqs=$DB->exec("UPDATE `oreo_user` set   `names` = '$names',  `qq` = '$qq',  `email` = '$email',  `password` = '$password', `action` = '$action', `money` = '$money', `beta` = '$beta'  WHERE `id` = '$id'");
    }exit('{"code":1,"msg":"修改成功"}');
	
break;
case 'edit_Ycqx':
    $id=daddslashes(strip_tags($_POST['idq']));
	$sqs=$DB->exec("UPDATE `oreo_user` set   `type` = '',  `sysnum` = '',  `grade_code3` = '',  `grade_name` = '普通用户'  WHERE `id` = '$id'");
    exit('{"code":1,"msg":"移除所有权限成功"}');
	
break;		
case 'edit_QCshanchu':
    $id=daddslashes(strip_tags($_POST['ids']));
	$sql="DELETE FROM oreo_qcback WHERE id='$id'";	
    if($DB->exec($sql))
	 exit('{"code":1,"msg":"succ"}');
    else
	 exit('{"code":-1,"msg":"删除数据失败！"}');
break;
case 'Del_OreoSms':
    $id=daddslashes(strip_tags($_POST['ids']));
	$sql="DELETE FROM oreo_tensms WHERE id='$id'";	
    if($DB->exec($sql))
	 exit('{"code":1,"msg":"succ"}');
    else
	 exit('{"code":-1,"msg":"删除数据失败！"}');
break;
case 'edit_Sqsshanchu':
    $id=daddslashes(strip_tags($_POST['ids']));
	$sql="DELETE FROM oreo_user WHERE id='$id'";	
    if($DB->exec($sql))
	 exit('{"code":1,"msg":"succ"}');
    else
	 exit('{"code":-1,"msg":"删除数据失败！"}');
break;
case 'edit_Zgaoqx':
	$money3=daddslashes(strip_tags($_POST['money3']));
	$glcx3=daddslashes(strip_tags($_POST['glcx3']));
	$glcx4=daddslashes(strip_tags($_POST['glcx4']));
	$sqtj3=daddslashes(strip_tags($_POST['sqtj3']));
	$sqxg3=daddslashes(strip_tags($_POST['sqxg3']));
	$sqsc3=daddslashes(strip_tags($_POST['sqsc3']));
	$sqall3=daddslashes(strip_tags($_POST['sqall3']));
	$cxall3=daddslashes(strip_tags($_POST['cxall3']));
	$tjsq3=daddslashes(strip_tags($_POST['tjsq3']));
	$tjsqxg3=daddslashes(strip_tags($_POST['tjsqxg3']));
	$tjsqsc3=daddslashes(strip_tags($_POST['tjsqsc3']));
	$tjsqall3=daddslashes(strip_tags($_POST['tjsqall3']));
	$tjsyall3=daddslashes(strip_tags($_POST['tjsyall3']));
	$ztcx=$DB->query("SELECT * FROM `oreo_powerc`")->fetch();
	if(!$ztcx){
	$sds=$DB->exec("INSERT INTO `oreo_powerc` (`money3`, `glcx3`, `glcx4`, `sqtj3`, `sqxg3`, `sqsc3`, `sqall3`, `cxall3`, `tjsq3`, `tjsqxg3`, `tjsqsc3`, `tjsqall3`, `tjsyall3`) VALUES ('$money3', '$glcx3', '$glcx4', '$sqtj3', '$sqxg3', '$sqsc3', '$sqall3', '$cxall3', '$tjsq3', '$tjsqxg3', '$tjsqsc3', '$tjsqall3', '$tjsyall3')");	
	}else{
    $sqs=$DB->exec("UPDATE `oreo_powerc` SET `sqtj3` = '$sqtj3', `glcx3` = '$glcx3', `glcx4` = '$glcx4',  `sqxg3` = '$sqxg3',  `sqsc3` = '$sqsc3',  `sqall3` = '$sqall3',  `cxall3` = '$cxall3',  `tjsq3` = '$tjsq3',  `tjsqxg3` = '$tjsqxg3',  `tjsqsc3` = '$tjsqsc3',  `tjsqall3` = '$tjsqall3',  `tjsyall3` = '$tjsyall3',  `money3` = '$money3'");
	}exit('{"code":1,"msg":"修改成功"}');
break;	

case 'edit_Tjkami':
	$name=daddslashes(strip_tags($_POST['names']));
	$money=daddslashes(strip_tags($_POST['money']));
	$sysnum=daddslashes(strip_tags($_POST['sysnum']));
	$pl=daddslashes(strip_tags($_POST['pl']));
	$kami=daddslashes(strip_tags($_POST['kami']));
	$cssl=daddslashes(strip_tags($_POST['cssl']));
	$hddx=daddslashes(strip_tags($_POST['hddx']));
	if($name==1){
		if($pl==2){
		for($i = 1; $i<=$cssl; $i++){
		$kami=ghcode(32);	
		$sds=$DB->exec("INSERT INTO `oreo_kami` (`name`, `money`, `sysnum`, `kami`, `hddx`) VALUES ('$name', '$money', '', '$kami', '$hddx')");		
		}
		exit('{"code":1,"msg":"批量添加成功"}');
    }
	$sds=$DB->exec("INSERT INTO `oreo_kami` (`name`, `money`, `sysnum`, `kami`, `hddx`) VALUES ('$name', '$money', '', '$kami', '$hddx')");	
	exit('{"code":1,"msg":"修改成功"}');
	}
	if($name==2){
		if($pl==2){
		for($i = 1; $i<=$cssl; $i++){
		$kami=ghcode(32);	
		$sys=$DB->query("select * from oreo_authsys where syskeys='$sysnum'  limit 1")->fetch();
		$sds=$DB->exec("INSERT INTO `oreo_kami` (`name`, `money`, `sysnum`, `kami`) VALUES ('{$sys['name']}-授权卡密', '{$sys['money']}', '{$sys['syskeys']}', '$kami')");		
		}
		exit('{"code":1,"msg":"批量添加成功"}');
    }
	$sys=$DB->query("select * from oreo_authsys where syskeys='$sysnum'  limit 1")->fetch();
	$sds=$DB->exec("INSERT INTO `oreo_kami` (`name`, `money`, `sysnum`, `kami`) VALUES ('{$sys['name']}-授权卡密', '{$sys['money']}', '{$sys['syskeys']}', '$kami')");		
	exit('{"code":1,"msg":"修改成功"}');
	}
break;
case 'edit_Xcxtj':
    $name=daddslashes(strip_tags($_POST['namet']));
	$syskeyst=daddslashes(strip_tags($_POST['syskeyst']));
	$moneyt=daddslashes(strip_tags($_POST['moneyt']));
	$ad_text=$_POST['ad_textt'];
	$ad_money=daddslashes(strip_tags($_POST['ad_moneyt']));
	$ad_type=daddslashes(strip_tags($_POST['ad_typet']));
    $type=daddslashes(strip_tags($_POST['typet']));
	$sjzf=getRandomString(6); 
	$otable=getRandomString(6); 
	$grade_code1=getRandomString(7); 
	$grade_code2=getRandomString(8); 
	$grade_code3=getRandomString(9); 
	if(!$name||!$syskeyst){
		exit('{"code":-1,"msg":"名称和程序验证码不能为空"}');
	}else{
		$sds=$DB->exec("INSERT INTO `oreo_authsys` (`name`, `syskeys`, `type`, `money`, `ad_text`, `ad_money`, ad_type`, `sjzf`, `otable`, `grade_code1`, `grade_code2`, `grade_code3`) VALUES ('$name', '$syskeyst', '$type', '$moneyt', '$ad_text', '$ad_money', '$ad_type', '$sjzf', '$otable', '$grade_code1', '$grade_code2', '$grade_code3')");
        $pid=$DB->lastInsertId();
        if($sds){
		 exit('{"code":1,"msg":"添加成功"}');
    }else{
        exit('{"code":-1,"msg":"添加失败！"}');
    } 
 } 
break;
case 'edit_Xcxxg':
    $id=daddslashes(strip_tags($_POST['id']));
    $name=daddslashes(strip_tags($_POST['name']));
	$money=daddslashes(strip_tags($_POST['money']));
	$type=daddslashes(strip_tags($_POST['type']));
	$ad_text=$_POST['ad_text'];
	$ad_money=daddslashes(strip_tags($_POST['ad_money']));
	$ad_type=daddslashes(strip_tags($_POST['ad_type']));
    $sqs=$DB->exec("UPDATE `oreo_authsys` SET `name` = '$name',  `type` = '$type',  `money` = '$money',  `ad_text` = '$ad_text',  `ad_money` = '$ad_money',  `ad_type` = '$ad_type'  WHERE `id` = '$id'");
	exit('{"code":1,"msg":"succ"}');
break;
case 'edit_Xckami':
    $kami=daddslashes(strip_tags($_POST['kamisc']));	
    $sql="DELETE FROM oreo_kami WHERE kami='$kami'";	
    if($DB->exec($sql))
	 exit('{"code":1,"msg":"succ"}');
    else
	 exit('{"code":-1,"msg":"删除数据失败！"}');
break;
case 'edit_XcxShanchu':
    $id=daddslashes(strip_tags($_POST['ids']));
    $syskeys=daddslashes(strip_tags($_POST['syskeys']));	
    $sql="DELETE FROM oreo_authsys WHERE id='$id'";	
	$sql2="DELETE FROM oreo_powera WHERE glcx='$syskeys'";
	$sql3="DELETE FROM oreo_powerb WHERE glcx='$syskeys'";
    if($DB->exec($sql))
	 exit('{"code":1,"msg":"succ"}');
    else
	 exit('{"code":-1,"msg":"删除数据失败！"}');
break;
case 'edit_Adshanchu':
    $id=daddslashes(strip_tags($_POST['ids']));	
    $sql="DELETE FROM oreo_ad WHERE id='$id'";	
    if($DB->exec($sql))
	 exit('{"code":1,"msg":"succ"}');
    else
	 exit('{"code":-1,"msg":"删除数据失败！"}');
break;
case 'edit_Gongshanchu':
    $id=daddslashes(strip_tags($_POST['ids']));	
    $sql="DELETE FROM oreo_gonggao WHERE id='$id'";	
    if($DB->exec($sql))
	 exit('{"code":1,"msg":"succ"}');
    else
	 exit('{"code":-1,"msg":"删除数据失败！"}');
break;
case 'edit_Payset':
	$alipay_mode=daddslashes(strip_tags($_POST['alipay_mode']));
	$ali_api_partner=daddslashes(strip_tags($_POST['ali_api_partner']));
	$ali_api_seller_email=daddslashes(strip_tags($_POST['ali_api_seller_email']));
	$ali_api_key=daddslashes(strip_tags($_POST['ali_api_key']));
	$ali_epay_api_url=daddslashes(strip_tags($_POST['ali_epay_api_url']));
	$ali_epay_api_id=daddslashes(strip_tags($_POST['ali_epay_api_id']));
	$ali_epay_api_key=daddslashes(strip_tags($_POST['ali_epay_api_key']));
	$ali_close_info=daddslashes(strip_tags($_POST['ali_close_info']));
	$wxpay_mode=daddslashes(strip_tags($_POST['wxpay_mode']));
	$wx_api_appid=daddslashes(strip_tags($_POST['wx_api_appid']));
	$wx_api_mchid=daddslashes(strip_tags($_POST['wx_api_mchid']));
	$wx_api_key=daddslashes(strip_tags($_POST['wx_api_key']));
	$wx_api_appsecret=daddslashes(strip_tags($_POST['wx_api_appsecret']));
	$wx_epay_api_url=daddslashes(strip_tags($_POST['wx_epay_api_url']));
	$wx_epay_api_id=daddslashes(strip_tags($_POST['wx_epay_api_id']));
	$wx_epay_api_key=daddslashes(strip_tags($_POST['wx_epay_api_key']));
	$wx_close_info=daddslashes(strip_tags($_POST['wx_close_info']));
	$qqpay_mode=daddslashes(strip_tags($_POST['qqpay_mode']));
	$qq_api_mchid=daddslashes(strip_tags($_POST['qq_api_mchid']));
	$qq_api_mchkey=daddslashes(strip_tags($_POST['qq_api_mchkey']));
	$qq_epay_api_url=daddslashes(strip_tags($_POST['qq_epay_api_url']));
	$qq_epay_api_id=daddslashes(strip_tags($_POST['qq_epay_api_id']));
	$qq_epay_api_key=daddslashes(strip_tags($_POST['qq_epay_api_key']));
	$qq_close_info=daddslashes(strip_tags($_POST['qq_close_info']));
	foreach ($_POST as $k => $value) {
        if($k=='pwd')continue;
        $value=daddslashes($value);
        $DB->query("insert into oreo_site set `o`='{$k}',`r`='{$value}' on duplicate key update `r`='{$value}'");
    }
	 exit('{"code":1,"msg":"succ"}');
break;	
case 'edit_ZAdinput':
	$shop_ad=daddslashes(strip_tags($_POST['shop_ad']));
	$z_ad_money=daddslashes(strip_tags($_POST['z_ad_money']));
	$z_ad_text=$_POST['z_ad_text'];
	foreach ($_POST as $k => $value) {
        if($k=='pwd')continue;
        $value=daddslashes($value);
        $DB->query("insert into oreo_site set `o`='{$k}',`r`='{$value}' on duplicate key update `r`='{$value}'");
    }
	 exit('{"code":1,"msg":"succ"}');
break;	
case 'edit_Dispatch':
	$mail_cloud=daddslashes(strip_tags($_POST['mail_cloud']));
	$mail_smtp=daddslashes(strip_tags($_POST['mail_smtp']));
	$mail_port=daddslashes(strip_tags($_POST['mail_port']));
	$mail_name=daddslashes(strip_tags($_POST['mail_name']));
	$mail_pwd=daddslashes(strip_tags($_POST['mail_pwd']));
	$CAPTCHA_ID=daddslashes(strip_tags($_POST['CAPTCHA_ID']));
	$PRIVATE_KEY=daddslashes(strip_tags($_POST['PRIVATE_KEY']));
	$oreo_tenmsg_appid=daddslashes(strip_tags($_POST['oreo_tenmsg_appid']));
	$oreo_tenmsg_key=daddslashes(strip_tags($_POST['oreo_tenmsg_key']));
	$oreo_tenmsg_templateId=daddslashes(strip_tags($_POST['oreo_tenmsg_templateId']));
	$oreo_tenmsg_smsSign=daddslashes(strip_tags($_POST['oreo_tenmsg_smsSign']));
	foreach ($_POST as $k => $value) {
        if($k=='pwd')continue;
        $value=daddslashes($value);
        $DB->query("insert into oreo_site set `o`='{$k}',`r`='{$value}' on duplicate key update `r`='{$value}'");
    }
	 exit('{"code":1,"msg":"succ"}');
break;
case 'edit_Zxsqsz':
    $oreo_ipyz=daddslashes(strip_tags($_POST['oreo_ipyz']));
	$oreo_scyz=daddslashes(strip_tags($_POST['oreo_scyz']));
	$oreo_sqfs=daddslashes(strip_tags($_POST['oreo_sqfs']));
	$oreo_dqsj=daddslashes(strip_tags($_POST['oreo_dqsj']));
	$oreo_dtime = strtotime($_POST['oreo_dtime']);
	$_POST['oreo_dtime']= strtotime($_POST['oreo_dtime']); 
    foreach ($_POST as $k => $value) {
        if($k=='pwd')continue;
        $value=daddslashes($value);
        $DB->query("insert into oreo_site set `o`='{$k}',`r`='{$value}' on duplicate key update `r`='{$value}'");
    }
	$sqs=$DB->exec("update `oreo_authorize` set  `ip_qh` ='{$oreo_scyz}',`yumi` ='{$oreo_sqfs}'  ");
	
	 exit('{"code":1,"msg":"succ"}');
break;
default:
	exit('{"code":-4,"msg":"No Act"}');
break;
}