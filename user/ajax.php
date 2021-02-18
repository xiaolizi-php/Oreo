<?php
include("../oreo/oreo.core.php");
$act=isset($_GET['act'])?daddslashes($_GET['act']):null;
header('Access-Control-Allow-Origin:*'); 
@header('Content-Type: application/json; charset=UTF-8');

switch($act){
case 'sendsmsten':
	$phone=trim(daddslashes($_POST['phone']));

	if(isset($_SESSION['send_mail']) && $_SESSION['send_mail']>time()-10){
		exit('{"code":-1,"msg":"请勿频繁发送验证码"}');
	}
	require_once SYSTEM_ROOT.'oreo_static/other/class.geetestlib.php';
	$GtSdk = new GeetestLib($conf['CAPTCHA_ID'], $conf['PRIVATE_KEY']);

	$data = array(
		'user_id' => 'public', # 网站用户id
		'client_type' => "web", # web:电脑上的浏览器；h5:手机上的浏览器，包括移动应用内完全内置的web_view；native：通过原生SDK植入APP应用的方式
		'ip_address' => $clientip # 请在此处传输用户请求验证时所携带的IP
	);

	if ($_SESSION['gtserver'] == 1) {   //服务器正常
		$result = $GtSdk->success_validate($_POST['geetest_challenge'], $_POST['geetest_validate'], $_POST['geetest_seccode'], $data);
		if ($result) {
			//echo '{"status":"success"}';
		} else{
			exit('{"code":-1,"msg":"验证失败，请重新验证"}');
		}
	}else{  //服务器宕机,走failback模式
		if ($GtSdk->fail_validate($_POST['geetest_challenge'],$_POST['geetest_validate'],$_POST['geetest_seccode'])) {
			//echo '{"status":"success"}';
		}else{
			exit('{"code":-1,"msg":"验证失败，请重新验证"}');
		}
	}
	$row=$DB->query("select * from oreo_user where phone='$phone' limit 1")->fetch();
	if($row){
		exit('{"code":-1,"msg":"该手机号已经注册过，如需找回信息，请返回登录页面点击找回密码"}');
	}
	$row=$DB->query("select * from oreo_regcode where email='$phone' order by id desc limit 1")->fetch();
	if($row['time']>time()-60){
		exit('{"code":-1,"msg":"两次发送短信之间需要相隔60秒！"}');
	}
	$count=$DB->query("select count(*) from oreo_regcode where email='$phone' and time>'".(time()-3600*24)."'")->fetchColumn();
	if($count>2){
		exit('{"code":-1,"msg":"该手机号码发送次数过多，请更换号码！"}');
	}
	$count=$DB->query("select count(*) from oreo_regcode where ip='$clientip' and time>'".(time()-3600*24)."'")->fetchColumn();
	if($count>5){
		exit('{"code":-1,"msg":"你今天发送次数过多，已被禁止注册"}');
	}
	$code = rand(111111,999999);
	$result = tensms($phone, $code);
	if($result===0){
		if($DB->exec("insert into `oreo_regcode` (`type`,`code`,`email`,`time`,`ip`,`status`) values ('1','".$code."','".$phone."','".time()."','".$clientip."','0')")){
			$_SESSION['send_mail']=time();
			exit('{"code":0,"msg":"succ"}');
		}else{
			exit('{"code":-1,"msg":"写入数据库失败。'.$DB->errorCode().'"}');
		}
	}else{
		exit('{"code":-1,"msg":"短信发送失败 '.$result.'"}');
	}
break;	
case 'captcha':
	require_once SYSTEM_ROOT.'oreo_static/other/class.geetestlib.php';
	$GtSdk = new GeetestLib($conf['CAPTCHA_ID'], $conf['PRIVATE_KEY']);
	$data = array(
		'user_id' => isset($pid)?$pid:'public', 
		'client_type' => "web", 
		'ip_address' => $clientip 
	);
	$status = $GtSdk->pre_process($data, 1);
	$_SESSION['gtserver'] = $status;
	$_SESSION['user_id'] = isset($pid)?$pid:'public';
	echo $GtSdk->get_response_str();
break;
case 'Cx_sqdomain':
    $domain=daddslashes(strip_tags($_POST['domain']));
	$userad=$DB->query("select * from oreo_authorize where domain='$domain' limit 1")->fetch();
	$datea=$userad['CreateTime'];
	$qq=$userad['qq'];
	if($userad)exit('{"code":1,"CreateTime":"'.$datea.'","qq":"'.$qq.'","domain":"'.$domain.'"}');
	else
	exit('{"code":-1,"msg":"未查到有关信息"}');
break;
case 'Cx_sqzts':
    $qq=daddslashes(strip_tags($_POST['qq']));
	$userad=$DB->query("select * from oreo_user where qq='$qq' and type IS NOT NULL and sysnum IS NOT NULL limit 1")->fetch();
	$names=$userad['names'];
	$qq=$userad['qq'];
	$datea=$userad['CreateTime'];
	$grade_name=$userad['grade_name'];
	if($grade_name=='普通用户')exit('{"code":-1,"msg":"未查到有关信息"}');
	if($userad)exit('
	{
		"code":1,
		"names":"'.$names.'",
		"qq":"'.$qq.'",
		"CreateTime":"'.$datea.'",
		"ptdjs":"'.$grade_name.'"
		}');
	else
	exit('{"code":-1,"msg":"未查到有关信息"}');
break;
case 'sendcode':
	$email=trim(daddslashes($_POST['email']));
	if(isset($_SESSION['send_mail']) && $_SESSION['send_mail']>time()-10){
		exit('{"code":-1,"msg":"请勿频繁发送验证码"}');
	}
	
	$row=$DB->query("select * from oreo_regcode where email='$email' order by id desc limit 1")->fetch();
	if($row['time']>time()-60){
		exit('{"code":-1,"msg":"两次发送邮件之间需要相隔60秒！"}');
	}
	$count=$DB->query("select count(*) from oreo_regcode where email='$email' and time>'".(time()-3600*24)."'")->fetchColumn();
	if($count>6){
		exit('{"code":-1,"msg":"该邮箱发送次数过多，请更换邮箱！"}');
	}
	$sub = $conf['web_title'].' - 验证码获取';
	$code = rand(1111111,9999999);
	$msg = '您的验证码是：'.$code;
	$result = send_mail($email, $sub, $msg);
	if($result===true){
		if($DB->exec("insert into `oreo_regcode` (`type`,`code`,`email`,`time`,`ip`,`status`) values ('0','".$code."','".$email."','".time()."','".$clientip."','0')")){
			$_SESSION['send_mail']=time();
			exit('{"code":0,"msg":"succ"}');
		}else{
			('{"code":-1,"msg":"写入数据库失败。'.$DB->errorCode().'"}');
		}
	}else{
		file_put_contents('mail.log',$result);
		exit('{"code":-1,"msg":"邮件发送失败"}');
	}
break;
case 'reg':
	$names=trim(strip_tags(daddslashes($_POST['names'])));
	$id=trim(strip_tags(daddslashes($_POST['username'])));
    $qq=trim(strip_tags(daddslashes($_POST['qq'])));
	$sjname=trim(strip_tags(daddslashes($_POST['sjname'])));
    $password = md5($_POST['password'].$password_hash);
	$email=trim(strip_tags(daddslashes($_POST['email'])));
	$phone=trim(daddslashes($_POST['phone']));
	$code=trim(strip_tags(daddslashes($_POST['code'])));
	if(strlen($_POST['password'])<8)exit('{"code":-1,"msg":"密码不能少于8字符."}');
	if(strlen($_POST['username'])<5)exit('{"code":-1,"msg":"账号不能少于5字符."}');
	if(preg_match("/^[A-Za-z0-9]+$/", $id) == false)exit('{"code":-1,"msg":"登录账户不能为中文."}');
	if(isset($_SESSION['reg_submit']) && $_SESSION['reg_submit']>time()-2600){
		exit('{"code":-1,"msg":"请勿频繁注册"}');
	}
	$row=$DB->query("select * from oreo_user where email='$email' limit 1")->fetch();
	if($row){
		exit('{"code":-1,"msg":"该邮箱已经注册过，如需找回信息，请返回登录页面点击找回密码"}');
	}
	$row=$DB->query("select * from oreo_user where id='$id' limit 1")->fetch();
	if($row){
		exit('{"code":-1,"msg":"当前用户名已存在，请更换别的用户名"}');
	}
	if($conf['verifytype']==0 && !preg_match('/^[A-z0-9._-]+@[A-z0-9._-]+\.[A-z0-9._-]+$/', $email)){
		exit('{"code":-1,"msg":"邮箱格式不正确"}');
	}
	if($conf['mail_cloud']==1) {
    $row=$DB->query("select * from oreo_regcode where type=0 and code='$code' and email='$email' order by id desc limit 1")->fetch();
	if(!$row){
		exit('{"code":-1,"msg":"验证码不正确！"}');
	}
	if($row['time']<time()-3600 || $row['status']>0){
		exit('{"code":-1,"msg":"验证码已失效，请重新获取"}');
	}}
	$dengji='普通用户';
	$scriptpath=str_replace('\\','/',$_SERVER['SCRIPT_NAME']);
	$sitepath = substr($scriptpath, 0, strrpos($scriptpath, '/'));
	$siteurl = ($_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://').$_SERVER['HTTP_HOST'].$sitepath.'/';
		$sds=$DB->exec("INSERT INTO `oreo_user` 
		    (`names`, `id`, `qq`, `password`, `email`, `phone`, `type`, `action`, `sysnum`, `grade_code3`, `grade_name`) VALUES 
		('{$names}', '{$id}', '{$qq}', '{$password}', '{$email}', '{$phone}', '', '1', '', '', '普通用户')");
		$pid=$DB->lastInsertId();
		if($sds){
			$sub = $conf['web_title'].' - 注册成功通知';
			$msg = '<h2>会员注册成功通知</h2>感谢您注册'.$conf['web_title'].'！<br/>您的账号：'.$id.'<br/>您的登录密码：'.$_POST['password'].'<br/>您当前的等级：'.$dengji.'<br/>'.$conf['web_title'].'官网：<a href="http://'.$_SERVER['HTTP_HOST'].'/" target="_blank">'.$_SERVER['HTTP_HOST'].'</a><br/>【<a href="'.$siteurl.'" target="_blank">用户控制面板</a>】';
			$result = send_mail($email, $sub, $msg);
			$DB->exec("update `oreo_regcode` set `status` ='1' where `id`='{$row['id']}'");
			$_SESSION['reg_submit']=time();
			exit('{"code":1,"msg":"注册会员成功！"}');
		}else{
			exit('{"code":-1,"msg":"注册会失败！'.$DB->errorCode().'"}');
		}
	
break;
case 'Zhmmima':
	$email=trim(daddslashes($_POST['email']));
	$code=trim(daddslashes($_POST['code']));
	$password=md5($_POST['password'].$password_hash);
	$password2=md5($_POST['password2'].$password_hash);
	$row=$DB->query("select * from oreo_regcode where type=0 and code='$code' and email='$email' order by id desc limit 1")->fetch();
	$email=$row['email'];
	if(!$row){
		exit('{"code":-1,"msg":"验证码不正确！"}');
	}
	if($row['time']<time()-3600 || $row['status']>0){
		exit('{"code":-1,"msg":"验证码已失效，请重新获取"}');
	}
	if(strlen($_POST['password2'])<8)exit('{"code":-1,"msg":"密码不能少于8字符."}');
	if($password!=$password2)exit('{"code":-1,"msg":"两个密码不相同，请检查."}');
	$row=$DB->query("select * from oreo_user where email='$email'")->fetch();
	if(!$row){
		exit('{"code":-1,"msg":"该邮箱无用户绑定记录，请检查"}');
	}else{
	$sqs=$DB->exec("update `oreo_user` set `password` ='{$password2}' where email='{$email}' ");
    $sqs=$DB->exec("update `oreo_regcode` set `type` ='1' where code='{$code}' and email='$email' ");
	exit('{"code":1,"msg":"找回密码成功"}');
	die;
	}
break;
default:
	exit('{"code":-4,"msg":"No Act"}');
break;
}