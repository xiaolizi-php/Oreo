<?php
include("../../oreo/oreo.core.php");
if($islogin2==1){}else exit('{"code":-3,"msg":"No Login"}');
$act=isset($_GET['act'])?daddslashes($_GET['act']):null;
header('Access-Control-Allow-Origin:*');  
@header('Content-Type: application/json; charset=UTF-8');

switch($act){
//新用户初次设置
case 'MyIsBuyer':
	$MyId=daddslashes(strip_tags($_POST['MyId']));
	$showtime=date("Y-m-d");
	if($MyId!=$pid)exit('{"code":-1,"msg":"非法操作！"}');
	$Shop_user=$DB->query("select * from oreo_shop_user where user='$pid' limit 1")->fetch();
	if(!$Shop_user){
		$oreo_user=$DB->query("select * from oreo_user where id='$pid' limit 1")->fetch();
		if(!$oreo_user['phone'])exit('{"code":2,"msg":"请先绑定手机号码"}');
	    $DB->exec("INSERT INTO `oreo_shop_user` (`user`, `name`, `qq`, `phone`,  `email`, `money`, `frozen_balance`, `type`, `reg_time`, `activation`) VALUES ('{$pid}', '{$oreo_user['names']}', '{$oreo_user['qq']}', '{$oreo_user['phone']}', '{$oreo_user['email']}', '0', '0', '1', '{$showtime}', '1')");
	    exit('{"code":1,"msg":"succ"}');
	}else
			exit('{"code":-1,"msg":"无需重复操作！"}');
break;
//绑定手机号码
case 'oreo_sendcode':
	$situation=trim(daddslashes($_POST['situation']));
	$myphonebd=trim(strip_tags(daddslashes($_POST['myphonebd'])));
	if(isset($_SESSION['send_mail']) && $_SESSION['send_mail']>time()-10){
		exit('{"code":-1,"msg":"请勿频繁发送验证码"}');
	}
	require_once SYSTEM_ROOT.'oreo_static/other/class.geetestlib.php';
	$GtSdk = new GeetestLib($conf['CAPTCHA_ID'], $conf['PRIVATE_KEY']);

	$data = array(
		'user_id' => $pid, # 网站用户id
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
		
		$row=$DB->query("select * from oreo_regcode where email='$phone' order by id desc limit 1")->fetch();
		if($row['time']>time()-60){
			exit('{"code":-1,"msg":"两次发送短信之间需要相隔60秒！"}');
		}
		$count=$DB->query("select count(*) from oreo_regcode where email='$phone' and time>'".(time()-3600*24)."'")->fetchColumn();
		if($count>2){
			exit('{"code":-1,"msg":"该手机号码发送次数过多，暂无法发送！"}');
		}
		$count=$DB->query("select count(*) from oreo_regcode where ip='$clientip' and time>'".(time()-3600*24)."'")->fetchColumn();
		if($count>5){
			exit('{"code":-1,"msg":"你今天发送次数过多，已被禁止发送"}');
		}
		if(!$myphonebd){
		$phone=$userrow['phone'];
		}else{
		$phone=$myphonebd;
		}
		$code = rand(111111,999999);
		$result = tensms($phone, $code);
		if($result===0){
			if($DB->exec("insert into `oreo_regcode` (`type`,`code`,`email`,`time`,`ip`,`status`) values ('3','".$code."','".$phone."','".time()."','".$clientip."','0')")){
				$_SESSION['send_mail']=time();
				exit('{"code":0,"msg":"succ"}');
			}else{
				exit('{"code":-1,"msg":"写入数据库失败。'.$DB->errorCode().'"}');
			}
		}else{
			exit('{"code":-1,"msg":"短信发送失败 '.$result.'"}');
		}
break;
//极验证
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
//绑定手机号码
case 'verifycodesjbd':
	$code=trim(strip_tags(daddslashes($_POST['code'])));
	if($conf['mail_cloud']==2){
		$row=$DB->query("select * from oreo_regcode where type=3 and code='$code' and status='0' order by id desc limit 1")->fetch();
	}
	if(!$row){
		exit('{"code":-1,"msg":"验证码不正确！"}');
	}
	if($row['time']<time()-3600 || $row['status']>0){
		exit('{"code":-1,"msg":"验证码已失效，请重新获取"}');
	}
	$_SESSION['verify_ok']=$pid;
	$DB->exec("update `oreo_regcode` set `status` ='1' where `id`='{$row['id']}'");
	$DB->exec("update `oreo_user` set `phone` ='{$row['email']}' where `id`='{$pid}'");
	exit('{"code":1,"msg":"succ"}');
break;
//用户实名认证
case 'edit_My_Real':
        /*if(strlen($_POST["real_name"]) >12 or strlen($_POST["real_name"]) <6 or !ishz($_POST["real_name"])){
			exit('{"code":-1,"msg":"身份证姓名为空或不符合规则"}');
		}*/if(strlen($_POST["sfnumber"]) !=18 or !isszzm($_POST["sfnumber"])){
			exit('{"code":-2,"msg":"身份证号码为空或不符合规则"}');
		}/*if(!preg_match('/^[A-z0-9._-]+@[A-z0-9._-]+\.[A-z0-9._-]+$/',$_POST["alipay_id"])){
		    exit('{"code":-1,"msg":"支付宝账号不符合规则"}');
	    }if(empty($_FILES['real_aphoto']['tmp_name'])){
			exit('{"code":-3,"msg":"未选择正面图片"}');
		}if(empty($_FILES['real_bphoto']['tmp_name'])){
			exit('{"code":-3,"msg":"未选择反面图片"}');
		} if(!istp($_FILES['real_aphoto'])){
			exit('{"code":-3,"msg":"身份证正面图片格式错误"}');
		}if(!istp($_FILES['real_bphoto'])){
			exit('{"code":-3,"msg":"身份证反面图片格式错误"}');
		}*/else{
			/*
			$filesrc='certification/'; //身份证照片存储目录
			$userids=$pid;
			$real_aphoto=uploadtp($_FILES['real_aphoto'],$userids,$filesrc);//身份证正面图片
			$real_bphoto=uploadtp($_FILES['real_bphoto'],$userids,$filesrc);//身份证反面图片
			*/
            $real_name=$_POST["real_name"];//身份证姓名
			$sfnumber=$_POST["sfnumber"];//身份证号码
			$alipay_id=$_POST["alipay_id"];//支付宝账号
			$real_time=date("Y-m-d H:i:s",time());//申请时间
			//公安联网查询身份证是否有效合法
			$user=$DB->query("select * from oreo_shop_user where user='{$pid}' limit 1")->fetch();
			if($user['frozen_balance']<0.1)exit('{"code":-1,"msg":"您的余额不足以执行本次操作！"}');
			$real_name=$_POST["real_name"];
            $sfnum=$_POST["sfnumber"];
            $real=gongan($real_name,$sfnum);
			$data = json_decode($real, true);
			$sex=($data['data']['sex']); //性别
            $address=($data['data']['address']); //详细地址
            $birthday=($data['data']['birthday']);//生日
            $code=($data['resp']['code']); //0为匹配,5为不匹配,14为无此身份证号码
		    if($code==5){
			$DB->exec("update `oreo_shop_user` set frozen_balance=frozen_balance-0.1 where `user`='$pid' ");
			$DB->exec("update `oreo_shop_details` set money=money-0.1 where `user`='$pid' and name='oreo实名认证'");
			exit('{"code":-1,"msg":"身份证号码与姓名不匹配,扣除认证费0.1元"}');
			}if($code==14){
			$DB->exec("update `oreo_shop_user` set frozen_balance=frozen_balance-0.1 where `user`='$pid' ");
			$DB->exec("update `oreo_shop_details` set money=money-0.1 where `user`='$pid' and name='oreo实名认证'");	
			exit('{"code":-1,"msg":"无此身份证号码,扣除认证费0.1元"}');
			}if($code==0){
			$DB->exec("INSERT INTO `oreo_shop_real` (`user`, `sex`, `address`, `birthday`, `alipay_id`, `real_name`, `sfnumber`, `real_time`, `activation`) VALUES ('{$pid}', '{$sex}', '{$address}', '{$birthday}','{$alipay_id}', '{$real_name}', '{$sfnumber}', '{$real_time}', '3')");
			$DB->exec("update `oreo_shop_details` set money=money-0.1 where `user`='$pid' and name='oreo实名认证'");	
			$DB->exec("update `oreo_shop_user` set activation='3', frozen_balance=frozen_balance-0.1 where `user`='$pid' ");
            exit('{"code":1,"msg":"succ"}');
			}else{
			exit('{"code":-1,"msg":"未知错误"}');
			}
	  }
break;	
//添加新的商品
case 'Add_My_Shops':
        if(!$_POST["name"])exit('{"code":-1,"msg":"商品名称不能为空！"}');
		if(!$_POST["money"])exit('{"code":-1,"msg":"商品价格不能为空！"}');
		if(!$_POST["stock"])exit('{"code":-1,"msg":"商品库存不能为空！"}');
		if(!$_POST["text"])exit('{"code":-1,"msg":"商品简介不能为空！"}');
		$my_shop=$DB->query("select * from oreo_shop_guarantee where seller='$pid' and name='$name' limit 1")->fetch();
		$my_shop_name=$my_shop["name"];
		if($_POST["name"]==$my_shop_name)exit('{"code":-1,"msg":"您有相同名称的商品请修改商品名称！"}');
		if(empty($_FILES['photo']['tmp_name'])){
			exit('{"code":-3,"msg":"未选择图片"}');
		} if(!istp($_FILES['photo'])){
			exit('{"code":-3,"msg":"图片格式错误"}');
		}else{
			$filesrc='guarantee/';//图片上传目录
			$userids=$pid;
            $name=$_POST["name"];//商品名称
			$money=$_POST["money"];//商品价格
			$stock=$_POST["stock"];//商品库存
			$text=$_POST["text"];//商品简介
			$type=$_POST["type"];//商品状态
			$photo=uploadtp($_FILES['photo'],$userids,$filesrc);//商品图片
			$add_time=date("Y-m-d",time());//添加时间
			$unique_code=create_unique();//唯一识别码
			$DB->exec("INSERT INTO `oreo_shop_guarantee` (`seller`, `seller_qq`, `name`, `text`, `photo`, `money`, `stock`, `evaluate_good`, `evaluate_bad`, `type`, `addtime`, `unique_code`) VALUES ('{$pid}', '{$userrow['qq']}', '{$name}', '{$text}', '{$photo}', '{$money}', '{$stock}', '0', '0', '{$type}', '{$add_time}', '{$unique_code}')");
			exit('{"code":1,"msg":"succ"}');
	  }
break;	
//商品状态为正常接单
case 'Commodity_ZcJd':
	$shopid=daddslashes(strip_tags($_POST['shopid']));//商品ID
	$shopuncode=daddslashes(strip_tags($_POST['shopuncode']));//商品唯一识别码
	$My_Shop=$DB->query("select * from oreo_shop_guarantee where id='$shopid' and seller='$pid' and unique_code='$shopuncode' limit 1")->fetch();
	if(!$My_Shop)exit('{"code":-1,"msg":"非法操作，我们将记录您的非法操作并作出相应的处罚！"}');
	    $DB->exec("update `oreo_shop_guarantee` set  type='1' where id='$shopid' and seller='$pid' and unique_code='$shopuncode'");
	    exit('{"code":1,"msg":"succ"}');
break;
//商品状态为拒绝接单
case 'Commodity_JjDz':
	$shopid=daddslashes(strip_tags($_POST['shopid']));//商品ID
	$shopuncode=daddslashes(strip_tags($_POST['shopuncode']));//商品唯一识别码
	$My_Shop=$DB->query("select * from oreo_shop_guarantee where id='$shopid' and seller='$pid' and unique_code='$shopuncode' limit 1")->fetch();
	if(!$My_Shop)exit('{"code":-1,"msg":"非法操作，我们将记录您的非法操作并作出相应的处罚！"}');
	    $DB->exec("update `oreo_shop_guarantee` set  type='2' where id='$shopid' and seller='$pid' and unique_code='$shopuncode'");
	    exit('{"code":1,"msg":"succ"}');
break;
//删除商品
case 'Commodity_DelShop':
	$shopid=daddslashes(strip_tags($_POST['shopid']));//商品ID
	$shopuncode=daddslashes(strip_tags($_POST['shopuncode']));//商品唯一识别码
	$My_Shop=$DB->query("select * from oreo_shop_guarantee where id='$shopid' and seller='$pid' and unique_code='$shopuncode' limit 1")->fetch();
	if(!$My_Shop)exit('{"code":-1,"msg":"非法操作，我们将记录您的非法操作并作出相应的处罚！"}');
	   $str = $My_Shop['photo']; 
       $Array=explode('/',$str);
	   unlink ( './temp/src/guarantee/'.$Array['8'] );//删除商品图片函数
	   $DB->exec("DELETE FROM oreo_shop_guarantee WHERE id='$shopid' AND seller='$pid' AND unique_code='$shopuncode'");
	   exit('{"code":1,"msg":"succ"}');
break;
//修改商品
case 'Edit_My_Shops':
	if(!$_POST["name"])exit('{"code":-1,"msg":"商品名称不能为空！"}');
		if(!$_POST["money"])exit('{"code":-1,"msg":"商品价格不能为空！"}');
		if(!$_POST["stock"])exit('{"code":-1,"msg":"商品库存不能为空！"}');
		if(!$_POST["text"])exit('{"code":-1,"msg":"商品简介不能为空！"}');
		else if($_FILES['photo']){//如果修改了商品图片
		    if(!istp($_FILES['photo'])){
			exit('{"code":-1,"msg":"图片格式错误"}');
		    }
			$filesrc='guarantee/';//图片上传目录
			$userids=$pid;
			$shop_id=$_POST["shop_id"];//商品ID
			//验证是否本账号操作
			$shop_seller=$_POST["shop_seller"];//商家名称
			if($shop_seller==$pid){exit('{"code":-1,"msg":"非法操作，我们将记录您的非法操作并作出相应的处罚！"}');}
			$shop_safe_code=$_POST["shop_safe_code"];//商品唯一识别码
			//先删除原来的图片
			$My_Shop=$DB->query("select * from oreo_shop_guarantee where id='$shop_id' and seller='$shop_seller' and unique_code='$shop_safe_code' limit 1")->fetch();
			$str = $My_Shop['photo']; 
            $Array=explode('/',$str);
	        unlink ( './temp/src/guarantee/'.$Array['8'] );//删除商品图片函数
            $name=$_POST["name"];//商品名称
			$money=$_POST["money"];//商品价格
			$stock=$_POST["stock"];//商品库存
			$text=$_POST["text"];//商品简介
			$type=$_POST["type"];//商品状态
			$photo=uploadtp($_FILES['photo'],$userids,$filesrc);//商品图片
			//验证Token
			$module = $_POST['module'];
            $timestamp = $_POST['timestamp'];
            $token = md5($module.'#$@%!^*'.$timestamp);
            if($token != $_POST['token']){
			exit('{"code":-1,"msg":"非法数据来源，我们将记录您的非法操作并作出相应的处罚！"}');
            }//验证token结束
			$DB->exec("update `oreo_shop_guarantee` set  name='$name', text='$text', money='$money', stock='$stock', type='$type', photo='$photo' where id='$shop_id' and seller='$shop_seller' and unique_code='$shop_safe_code'");
			exit('{"code":1,"msg":"succ"}');
	  }else{
			$shop_id=$_POST["shop_id"];//商品ID
			$shop_seller=$_POST["shop_seller"];//商家名称
			//验证是否本账号操作
			if($shop_seller!=$pid){exit('{"code":-1,"msg":"非法操作，我们将记录您的非法操作并作出相应的处罚！"}');}
			$shop_safe_code=$_POST["shop_safe_code"];//商品唯一识别码
            $name=$_POST["name"];//商品名称
			$money=$_POST["money"];//商品价格
			$stock=$_POST["stock"];//商品库存
			$text=$_POST["text"];//商品简介
			$type=$_POST["type"];//商品状态
			//验证Token
			$module = $_POST['module'];
            $timestamp = $_POST['timestamp'];
            $token = md5($module.'#$@%!^*'.$timestamp);
            if($token != $_POST['token']){
			exit('{"code":-1,"msg":"非法数据来源，我们将记录您的非法操作并作出相应的处罚！"}');
            }//验证token结束
			$DB->exec("update `oreo_shop_guarantee` set name='$name', text='$text', money='$money', stock='{$stock}', type='$type' where id='$shop_id' and seller='$shop_seller' and unique_code='$shop_safe_code'");
			exit('{"code":1,"msg":"succ"}');
	  }
break;
//买家确认收货
case 'Order_evaluation':
    //验证Token
	$module = $_POST['module'];
    $timestamp = $_POST['timestamp'];
    $token = md5($module.'#$@%!^*'.$timestamp);
    if($token != $_POST['token']){
	exit('{"code":-1,"msg":"非法数据来源，我们将记录您的非法操作并作出相应的处罚！"}');
    }//验证token结束
	$out_trade_no=daddslashes(strip_tags($_POST['shop_num']));//商品订单号
	$shop_type=daddslashes(strip_tags($_POST['shop_type']));//商品评价（1为好评，2为差评）
	$My_Shop=$DB->query("select * from oreo_shop_details where out_trade_no='$out_trade_no' and user='$pid' and shop_type='2' limit 1")->fetch();
	if(!$My_Shop)exit('{"code":-1,"msg":"订单不存在或已评价！"}');
	if($shop_type==1){
	$DB->exec("update `oreo_shop_details` set  shop_type='3 ', user_endtime='$date' where out_trade_no='$out_trade_no'");
	$DB->exec("update `oreo_shop_guarantee` set  evaluate_good=evaluate_good+1 where unique_code='{$My_Shop['unique_code']}'");
	$DB->exec("update `oreo_shop_user` set  frozen_balance=frozen_balance-{$My_Shop['money']} where user='{$My_Shop['user']}'");
	$DB->exec("update `oreo_shop_user` set  money=money+{$My_Shop['money']} where user='{$My_Shop['seller']}'");
	exit('{"code":1,"msg":"succ"}');
	}else{
	$DB->exec("update `oreo_shop_details` set  shop_type='3 ', user_endtime='$date' where out_trade_no='$out_trade_no'");
	$DB->exec("update `oreo_shop_guarantee` set  evaluate_bad=evaluate_bad+1 where unique_code='{$My_Shop['unique_code']}'");
	$DB->exec("update `oreo_shop_user` set  frozen_balance=frozen_balance-{$My_Shop['money']} where user='{$My_Shop['user']}'");
	$DB->exec("update `oreo_shop_user` set  money=money+{$My_Shop['money']} where user='{$My_Shop['seller']}'");
	exit('{"code":1,"msg":"succ"}');
	}
	    
break;



































case 'edit_GoumaiZnAd':
	$uid=daddslashes(strip_tags($_POST['uid']));
	$userad=$DB->query("select * from oreo_ad where uid='{$uid}' limit 1")->fetch();
	if($userad['type']==1)exit('{"code":-1,"msg":"您成功购买广告位，请补充您的信息"}');
	if($userad['type']==2)exit('{"code":-2,"msg":"您已经开通站内广告位，请耐心等待管理员审核您的广告内容，无需再次操作！"}');
	if($userrow['money']<$conf['z_ad_money'])exit('{"code":-3,"msg":"您的余额不足以执行本次操作，请先充值！"}');
      $nmoney=$conf['z_ad_money'];
	  $time=date('Y-m-d',strtotime("+1 month"));
	  $sds=$DB->exec("INSERT INTO `oreo_ad` (`uid`, `ad_type`, `dtime`, `type`) VALUES ('{$uid}', '1', '{$time}', '1')");
	  $sqs=$DB->exec("update `oreo_user` set money=money-{$nmoney} where `id`='$uid'");
			exit('{"code":1,"msg":"succ"}');
		
break;	
case 'edit_AdText':
	$uid=daddslashes(strip_tags($_POST['uid']));
	$adtext=$_POST['adtext'];
	$userad=$DB->query("select * from oreo_ad where uid='{$uid}' and ad_type='1' limit 1")->fetch();
	if(!$userad)exit('{"code":-1,"msg":"未找到您的广告位数据"}');
	if($userad['type']==0)exit('{"code":-2,"msg":"您的广告位已被管理员暂停服务"}');
    if($userad['type']==2)exit('{"code":-2,"msg":"管理员正在审核您的广告内容"}');
	if($userad['type']==3)exit('{"code":-2,"msg":"您的广告位已审核通过并正在展示"}');
	  $time=date('Y-m-d',strtotime("+1 month"));
	  $sqs=$DB->exec("update `oreo_ad` set  dtime='$time', text='$adtext', type='2'  where `uid`='$uid' and `ad_type`='1'  ");
	exit('{"code":1,"msg":"succ"}');
		
break;	
case 'edit_GoumaiSysAdsss':
	$uid=daddslashes(strip_tags($_POST['uid']));
	$syskeys=daddslashes(strip_tags($_POST['syskeys']));
	$userad=$DB->query("select * from oreo_ad where uid='{$uid}' limit 1")->fetch();
	if($userad['type']==1)exit('{"code":-1,"msg":"您成功购买广告位，请补充您的信息"}');
	if($userad['type']==2)exit('{"code":-2,"msg":"您已经开通站内广告位，请耐心等待管理员审核您的广告内容，无需再次操作！"}');
	if($userrow['money']<$conf['z_ad_money'])exit('{"code":-3,"msg":"您的余额不足以执行本次操作，请先充值！"}');
      $nmoney=$conf['z_ad_money'];
	  $time=date('Y-m-d',strtotime("+1 month"));
	  $sds=$DB->exec("INSERT INTO `oreo_ad` (`uid`, `ad_type`, `dtime`, `type`) VALUES ('{$uid}', '1', '{$time}', '1')");
	  $sqs=$DB->exec("update `oreo_user` set money=money-{$nmoney} where `id`='$uid'");
			exit('{"code":1,"msg":"succ"}');
		
break;
case 'delete_sqszh':
    $names=daddslashes(strip_tags($_POST['mingc']));
	$id=daddslashes(strip_tags($_POST['denglu']));
	$rows=$DB->query("select * from oreo_user where id='$id' AND names='$names' and sjid='$pid' limit 1")->fetch();
    if(!$rows)exit('{"code":-1,"msg":"请不要恶意篡改数据，否则系统自动冻结您的账号"}');
	$sql = "DELETE FROM oreo_user WHERE id='$id' AND names='$names' and sjid='$pid' ";
    if($DB->exec($sql))
    exit('{"code":1,"msg":"succ"}');
    else
 	exit('{"code":-1,"msg":"删除失败！"}');	
break;
case 'delete_QcTianjia':
    $url=daddslashes(strip_tags($_POST['url']));
	$token=daddslashes(strip_tags($_POST['token']));
	$sql = "DELETE FROM oreo_qcback WHERE url='$url' AND token='$token' AND userid='$pid' ";
    if($DB->exec($sql))
    exit('{"code":1,"msg":"succ"}');
    else
 	exit('{"code":-1,"msg":"删除失败！"}');	
break;	
case 'delete_TenSmsDel':
    $domains=daddslashes(strip_tags($_POST['domains']));
	$ids=daddslashes(strip_tags($_POST['ids']));
	$sql = "DELETE FROM oreo_tensms WHERE domain='$domains' AND id='$ids' AND pid='$pid' ";
    if($DB->exec($sql))
    exit('{"code":1,"msg":"succ"}');
    else
 	exit('{"code":-1,"msg":"删除失败！"}');	
break;	
case 'Edit_sqszhgl':
    $names=daddslashes(strip_tags($_POST['mingc']));
	$id=daddslashes(strip_tags($_POST['denglu']));
	$email=daddslashes(strip_tags($_POST['email']));
	$qq=daddslashes(strip_tags($_POST['lianxiqq']));
	$password = md5($_POST['dlpassword'].$password_hash);
	$rows=$DB->query("select * from oreo_user where id='$id' and sjid='$pid'limit 1")->fetch();
    if(!$rows)exit('{"code":-1,"msg":"请不要恶意篡改数据，否则系统自动冻结您的账号"}');
	if(!$password){
    if(strlen($_POST['dlpassword'])<8)exit('{"code":-1,"msg":"密码不能少于8字符."}');
	}
	if(preg_match("/^[A-Za-z0-9]+$/", $id) == false)exit('{"code":-1,"msg":"登录账户不能为中文."}');
	if(!preg_match('/^[A-z0-9._-]+@[A-z0-9._-]+\.[A-z0-9._-]+$/', $email)){
	 exit('{"code":-1,"msg":"邮箱格式不正确"}');
	}
    if($password){
	$sqs=$DB->exec("update `oreo_user` set  names='$names', id='$id', email='$email', qq='$qq', password='$password'  where `id`='$id' and sjid='$pid' ");
	}else{
	$sqs=$DB->exec("update `oreo_user` set  names='$names', id='$id', email='$email', qq='$qq'  where `id`='$id' and sjid='$pid' ");
	}		
    exit('{"code":1,"msg":"succ"}');
break;	
case 'Tj_sqszh':
    $names=daddslashes(strip_tags($_POST['mingc']));
	$id=daddslashes(strip_tags($_POST['denglu']));
	$email=daddslashes(strip_tags($_POST['email']));
	$qq=daddslashes(strip_tags($_POST['lianxiqq']));
	$password = md5($_POST['dlpassword'].$password_hash);
	$sysnum=daddslashes(strip_tags($_POST['syskeysnum']));
	$type=daddslashes(strip_tags($_POST['gradecodes']));
	$rows=$DB->query("select * from oreo_user where id='$id' limit 1")->fetch();
    if($rows)exit('{"code":-1,"msg":"当前登录账户已存在，请换别的"}');
    if(strlen($_POST['dlpassword'])<8)exit('{"code":-1,"msg":"密码不能少于8字符."}');
	if(preg_match("/^[A-Za-z0-9]+$/", $id) == false)exit('{"code":-1,"msg":"登录账户不能为中文."}');
	if(!preg_match('/^[A-z0-9._-]+@[A-z0-9._-]+\.[A-z0-9._-]+$/', $email)){
	 exit('{"code":-1,"msg":"邮箱格式不正确"}');
	}
    $rows2=$DB->query("select * from oreo_authsys where syskeys='$sysnum' and grade_code1='$type' limit 1")->fetch();
    if(!$rows2)exit('{"code":-1,"msg":"请不要恶意篡改数据，否则系统自动冻结您的账号"}');
    $sdss=$DB->exec("INSERT INTO `oreo_user` (`names`, `id`, `email`, `qq`, `password`, `sjname`, `sjid`, `grade_name`, `action`) VALUES ('{$names}', '{$id}', '{$email}', '{$qq}', '{$password}', '{$userrow['names']}', '{$userrow['id']}', '{$conf['oreo_scname1']}', '1')");
	$sqs=$DB->exec("update `oreo_user` set  sysnum=CONCAT_WS(',','{$sysnum}',sysnum),  type=CONCAT_WS(',','{$type}',type)  where `id`='$id' and qq='$qq' ");   
    exit('{"code":1,"msg":"succ"}');
break;	
case 'edit_ShanchuSq':
    $sdomain=daddslashes(strip_tags($_POST['sdomain']));
	$skeys=daddslashes(strip_tags($_POST['skeys']));
	$sghm=daddslashes(strip_tags($_POST['sghm']));
	$rows=$DB->query("select * from oreo_authorize where domain='$sdomain' AND syskey='$skeys' and gh_code='$sghm' limit 1")->fetch();
    if(!$rows)
	exit('{"code":-1,"msg":"当前记录不存在！"}');
	$sql = "DELETE FROM oreo_authorize WHERE domain='$sdomain' AND syskey='$skeys' AND gh_code='$sghm' ";
    if($DB->exec($sql))
    exit('{"code":1,"msg":"succ"}');
    else
 	exit('{"code":-1,"msg":"删除失败！"}');	
break;	
case 'm_YumiGh':
	$yumi=daddslashes(strip_tags($_POST['yumi']));
	$gh_code=daddslashes(strip_tags($_POST['gh_code']));
	$ym=$DB->query("select * from oreo_authorize where domain='$yumi' limit 1")->fetch();
	if(!$ym)exit('{"code":-1,"msg":"域名不存在或有误"}');
	$code=$DB->query("select * from oreo_authorize where domain='$yumi' and gh_code='$gh_code' limit 1")->fetch();
	if(!$code)exit('{"code":-1,"msg":"过户码不存在或有误"}');
	$gh_codes=ghcode(7); 
	$sqs=$DB->exec("update `oreo_authorize` set  `qq` ='{$userrow['qq']}', `sjname` ='{$userrow['names']}' , `sjid` ='{$userrow['id']}', `gh_code` ='{$gh_codes}'  where  domain='$yumi' and gh_code='$gh_code' ");
	exit('{"code":-1,"msg":"过户成功，原QQ已被替换： '.$userrow['qq'].' <br/>并且自动重新生成新的过户码<br/>详细信息请到我的授权页面查看和修改"}');
	
break;	
case 't_Kami':
	$kamis=daddslashes(strip_tags($_POST['kamis']));
	$ym=$DB->query("select * from oreo_kami where kami='$kamis' and type='0' limit 1")->fetch();
	if(!$ym)exit('{"code":-1,"msg":"卡密不存在或已使用"}');
	if($ym&&$ym['sysnum']==''){
	$sqs=$DB->exec("update `oreo_kami` set  `type` ='1', `username` ='{$pid}'   where  kami='$kamis' and type='0' ");
	$sqs=$DB->exec("UPDATE oreo_user SET  money=money+{$ym['money']}  where `id`='$pid'");
	exit('{"code":-1,"msg":"卡密兑换成功，兑换金额: '.$ym['money'].' <br/>请检查是否到账<br/>若有问题请联系管理员"}');   
	}	
	if($ym&&$ym['sysnum']!='0'){
	if($userrow['type']!=''||$userrow['sysnum']!=''||$userrow['grade_code3']!='')exit('{"code":-1,"msg":"只有普通用户才能使用授权卡密"}');	
	$sqs=$DB->exec("update `oreo_kami` set  `type` ='1', `username` ='{$pid}'   where  kami='$kamis' and type='0' ");
	$sqs=$DB->exec("UPDATE oreo_user SET  kami='1' , `sysnum` ='{$ym['sysnum']}'  where `id`='$pid'");
	exit('{"code":-1,"msg":"卡密兑换成功，兑换内容: '.$ym['name'].' <br/>请到授权页面进行授权<br/>若有问题请联系管理员"}');   
	}	
	
break;	
case 'Goumai_gmqx1':
	$gmqx1cxm=daddslashes(strip_tags($_POST['gmqx1cxm']));
	$gmqx1djm=daddslashes(strip_tags($_POST['gmqx1djm']));
	$out_trade_no=date("YmdHis").rand(111,999);
	$trade_no=date("YmdHis").rand(11,99);
	$fz=$DB->query("select * from oreo_authsys where syskeys='$gmqx1cxm' and grade_code1='$gmqx1djm'  limit 1")->fetch();
	if(!$fz)exit('{"code":-1,"msg":"请不要恶意篡改参数！"}');
	$row=$DB->query("select * from oreo_powera where glcx1='$gmqx1cxm' limit 1")->fetch();
	$cxjg=$row['money1'];
    if($userrow['money']<$cxjg)exit('{"code":-1,"msg":"您的余额不足以执行本次操作，请先充值！"}');
	if($usernum['type']==''){
	   $ztcx1=$DB->query("select * from oreo_user where id='{$pid}' and concat(',',sysnum,',') LIKE '%,{$gmqx1cxm},%' and concat(',',type,',') LIKE '%,{$gmqx1djm},%' limit 1")->fetch();
       if(!$ztcx1){	
           $nmoney=round($userrow['money']-$cxjg,2);
	       $sqs=$DB->exec("update `oreo_user` set  `money` ='{$nmoney}',  `grade_name` ='{$conf['oreo_scname1']}', sysnum=CONCAT_WS(',','{$gmqx1cxm}',sysnum),  type=CONCAT_WS(',','{$gmqx1djm}',type)  where `id`='$pid'");
		   $order=$DB->exec("insert into `oreo_order` (`trade_no`,`out_trade_no`,`type`,`pid`,`addtime`,`name`,`money`,`status`,`endtime`)values ('{$trade_no}','{$out_trade_no}','余额支付','{$pid}','{$date}','{$fz['name']}-{$conf['oreo_scname1']}','{$cxjg}','1','{$date}')");
		   exit('{"code":1,"msg":"succ"}');
	  }else{
 		   $nmoney=round($userrow['money']-$cxjg,2);
		   $sqs=$DB->exec("update `oreo_user` set  `grade_name` ='{$conf['oreo_scname1']}', type=CONCAT_WS(',','{$gmqx1djm}',type),`money` ='{$nmoney}'  where `id`='$pid'");
		   $order=$DB->exec("insert into `oreo_order` (`trade_no`,`out_trade_no`,`type`,`pid`,`addtime`,`name`,`money`,`status`,`endtime`)values ('{$trade_no}','{$out_trade_no}','余额支付','{$pid}','{$date}','{$fz['name']}-{$conf['oreo_scname1']}','{$cxjg}','1','{$date}')");
		   exit('{"code":1,"msg":"succ"}');
	  }
	}
break;
case 'Goumai_gmqx2':
	$gmqx2cxm=daddslashes(strip_tags($_POST['gmqx2cxm']));
	$gmqx2djm=daddslashes(strip_tags($_POST['gmqx2djm']));
	$out_trade_no=date("YmdHis").rand(111,999);
	$trade_no=date("YmdHis").rand(11,99);
	$fz=$DB->query("select * from oreo_authsys where syskeys='$gmqx2cxm' and grade_code2='$gmqx2djm'  limit 1")->fetch();
	if(!$fz)exit('{"code":-1,"msg":"请不要恶意篡改参数！"}');
	$row=$DB->query("select * from oreo_powerb where glcx2='$gmqx2cxm' limit 1")->fetch();
	$cxjg=$row['money2'];
    if($userrow['money']<$cxjg)exit('{"code":-1,"msg":"您的余额不足以执行本次操作，请先充值！"}');
	if($usernum['type']==''){
	   $ztcx1=$DB->query("select * from oreo_user where id='{$pid}' and concat(',',sysnum,',') LIKE '%,{$gmqx2cxm},%' and concat(',',type,',') LIKE '%,{$gmqx2djm},%' limit 1")->fetch();
	   if(!$ztcx1){
	       $nmoney=round($userrow['money']-$cxjg,2);
	       $sqs=$DB->exec("update `oreo_user` set  `money` ='{$nmoney}', `grade_name` ='{$conf['oreo_scname2']}',  sysnum=CONCAT_WS(',','{$gmqx2cxm}',sysnum),  type=CONCAT_WS(',','{$gmqx2djm}',type)  where `id`='$pid'");
	       $order=$DB->exec("insert into `oreo_order` (`trade_no`,`out_trade_no`,`type`,`pid`,`addtime`,`name`,`money`,`status`,`endtime`)values ('{$trade_no}','{$out_trade_no}','余额支付','{$pid}','{$date}','{$fz['name']}-{$conf['oreo_scname2']}','{$cxjg}','1','{$date}')");
		   exit('{"code":1,"msg":"succ"}');
	   }else{
	       $nmoney=round($userrow['money']-$cxjg,2);
	       $sqs=$DB->exec("update `oreo_user` set  `grade_name` ='{$conf['oreo_scname2']}', type=CONCAT_WS(',','{$gmqx2djm}',type),`money` ='{$nmoney}'  where `id`='$pid'");
	       $order=$DB->exec("insert into `oreo_order` (`trade_no`,`out_trade_no`,`type`,`pid`,`addtime`,`name`,`money`,`status`,`endtime`)values ('{$trade_no}','{$out_trade_no}','余额支付','{$pid}','{$date}','{$fz['name']}-{$conf['oreo_scname2']}','{$cxjg}','1','{$date}')");
		   exit('{"code":1,"msg":"succ"}');
      }
    }
break;
case 'Goumai_gmqx3':
    $out_trade_no=date("YmdHis").rand(111,999);
	$trade_no=date("YmdHis").rand(11,99);
	$row=$DB->query("select * from oreo_powerc limit 1")->fetch();
	$cxjg=$row['money3'];
    if($userrow['money']<$cxjg)exit('{"code":-1,"msg":"您的余额不足以执行本次操作，请先充值！"}');
	   $ztcx1=$DB->query("select * from oreo_user where id='{$pid}' and grade_code3='6' limit 1")->fetch();
	   if(!$ztcx1){
	       $nmoney=round($userrow['money']-$cxjg,2);
	       $sqs=$DB->exec("update `oreo_user` set  `grade_name` ='{$conf['oreo_scname3']}', `money` ='{$nmoney}',  `grade_code3` ='6',  `sysnum` ='6',  `type` ='6'  where `id`='$pid'");
	       $order=$DB->exec("insert into `oreo_order` (`trade_no`,`out_trade_no`,`type`,`pid`,`addtime`,`name`,`money`,`status`,`endtime`)values ('{$trade_no}','{$out_trade_no}','余额支付','{$pid}','{$date}','{$conf['oreo_scname3']}','{$cxjg}','1','{$date}')");
		   exit('{"code":1,"msg":"succ"}');
	   }
break;
case 'Goumai_bcjsj2':
	$bcj2cxm=daddslashes(strip_tags($_POST['bcj2cxm']));
	$bcj2djm=daddslashes(strip_tags($_POST['bcj2djm']));
	$bcj2scxdjm=daddslashes(strip_tags($_POST['bcj2scxdjm']));
	$out_trade_no=date("YmdHis").rand(111,999);
	$trade_no=date("YmdHis").rand(11,99);
	$fz=$DB->query("select * from oreo_authsys where syskeys='$bcj2cxm' and grade_code2='$bcj2djm'  limit 1")->fetch();
	if(!$fz)exit('{"code":-1,"msg":"请不要恶意篡改参数！"}');
	$row1=$DB->query("select * from oreo_powera where glcx1='$bcj2cxm' limit 1")->fetch();
	$row2=$DB->query("select * from oreo_powerb where glcx2='$bcj2cxm' limit 1")->fetch();
	$jiage1=$row1['money1'];
	$jiage2=$row2['money2'];
	$cxjg=round($jiage2-$jiage1);
	if($userrow['money']<$cxjg)exit('{"code":-1,"msg":"您的余额不足以执行本次操作，请先充值！"}');
	if($usernum['type']==''){
	   $nmoney=round($userrow['money']-$cxjg,2);
	   $sqs=$DB->exec("UPDATE oreo_user SET `grade_name` ='{$conf['oreo_scname2']}', type= replace(type, '{$bcj2scxdjm}', '{$bcj2djm}') ,`money` ='{$nmoney}'  where `id`='$pid'");
	   $order=$DB->exec("insert into `oreo_order` (`trade_no`,`out_trade_no`,`type`,`pid`,`addtime`,`name`,`money`,`status`,`endtime`)values ('{$trade_no}','{$out_trade_no}','余额支付','{$pid}','{$date}','{$fz['name']}-差价升级-{$conf['oreo_scname2']}','{$cxjg}','1','{$date}')"); 
	   exit('{"code":1,"msg":"succ"}');
    }
break;
case 'Goumai_bcjsj3':
	$bcj3cxm=daddslashes(strip_tags($_POST['bcj3cxm']));
	$bcj3djm=daddslashes(strip_tags($_POST['bcj3djm']));
	$bcj3scxdjm=daddslashes(strip_tags($_POST['bcj3scxdjm']));
	$out_trade_no=date("YmdHis").rand(111,999);
	$trade_no=date("YmdHis").rand(11,99);
	$fz=$DB->query("select * from oreo_authsys where syskeys='$bcj3cxm' and grade_code3='$bcj3djm'  limit 1")->fetch();
	if(!$fz)exit('{"code":-1,"msg":"请不要恶意篡改参数！"}');
	$row1=$DB->query("select * from oreo_powerb where glcx2='$bcj3cxm' limit 1")->fetch();
	$row2=$DB->query("select * from oreo_powerc  limit 1")->fetch();
	$jiage1=$row1['money2'];
	$jiage2=$row2['money3'];
	$cxjg=round($jiage2-$jiage1);
	if($userrow['money']<$cxjg)exit('{"code":-1,"msg":"您的余额不足以执行本次操作，请先充值！"}');
	if($usernum['type']==''){
	   $nmoney=round($userrow['money']-$cxjg,2);
	   $sqs=$DB->exec("UPDATE oreo_user SET `grade_name` ='{$conf['oreo_scname3']}', `money` ='{$nmoney}',  `grade_code3` ='6',  `sysnum` ='6',  `type` ='6'   where `id`='$pid'");
	   $order=$DB->exec("insert into `oreo_order` (`trade_no`,`out_trade_no`,`type`,`pid`,`addtime`,`name`,`money`,`status`,`endtime`)values ('{$trade_no}','{$out_trade_no}','余额支付','{$pid}','{$date}','{$fz['name']}-差价升级-{$conf['oreo_scname3']}','{$cxjg}','1','{$date}')"); 
	   exit('{"code":1,"msg":"succ"}');
    }
break;
case 'Goumai_sfsq':
	$sfname=$_POST['sfname'];
	$sfdomain=daddslashes(strip_tags($_POST['sfdomain']));
	$sfversion=daddslashes(strip_tags($_POST['sfversion']));
	$sfip=daddslashes(strip_tags($_POST['sfip']));
	$sfcxm=daddslashes(strip_tags($_POST['sfcxm']));
	$out_trade_no=date("YmdHis").rand(111,999);
	$trade_no=date("YmdHis").rand(11,99);
    $cxszb=$DB->query("select * from oreo_authorize where authid='$sfcxm' and domain='$sfdomain' limit 1")->fetch();
	if($cxszb){
		$sjnames=$cxszb['sjname'];
		$tjqq=$cxszb['qq'];
		exit('{"code":-1,"msg":"该域名已经被 '.$sjnames.' 添加授权<br/>联系QQ：'.$tjqq.'<br/>如需过户请联系添加者QQ获取过户码"}');
	}
	if($conf['oreo_dqsj']==0){
	$time=1924876800;
	}else{
	$time=$conf['oreo_dtime'];	
	}
	if($conf['oreo_scyz']==0){
	$ip_qh=0;
	}else{
	$ip_qh=1;
	}if($conf['oreo_sqfs']==0){
	$yumi=0;
	}else{
	$yumi=1;
	}
	$sjname=$userrow['names'];
	$row=$DB->query("select * from oreo_authsys where syskeys='$sfcxm' limit 1")->fetch();
	$cxjg=$row['money'];
	$authnames=$row['name'];
	$key = random(16);
	$gh_code=ghcode(7);
    if($userrow['money']<$row['money'])exit('{"code":-1,"msg":"您的余额不足以执行本次操作，请先充值！"}');
      $nmoney=round($userrow['money']-$cxjg,2);
	  $sqs=$DB->exec("update `oreo_user` set `money` ='{$nmoney}' where `id`='$pid'");  
      $sdss=$DB->exec("INSERT INTO `oreo_authorize` (`web_name`, `qq`, `domain`, `ip`, `time`, `syskey`, `version`, `ip_qh`, `yumi`, `sjname`, `authname`, `authid`, `gh_code`, `sjid`) VALUES ('{$sfname}', '{$userrow['qq']}', '{$sfdomain}', '{$sfip}', '{$time}', '{$key}', '{$sfversion}', '{$ip_qh}', '{$yumi}', '{$sjname}', '{$authnames}', '{$sfcxm}', '{$gh_code}', '{$userrow['id']}')");
	  $order=$DB->exec("insert into `oreo_order` (`trade_no`,`out_trade_no`,`type`,`pid`,`addtime`,`name`,`money`,`status`,`endtime`)values ('{$trade_no}','{$out_trade_no}','余额支付','{$pid}','{$date}','{$authnames}-域名单次授权','{$cxjg}','1','{$date}')");  
	  exit('{"code":1,"msg":"succ"}');	
break;
case 'New_TianjiaQc':
    $title=daddslashes(strip_tags($_POST['title']));
	$url=daddslashes(strip_tags($_POST['url']));
	$xieyi=daddslashes(strip_tags($_POST['xieyi']));
	$callback=daddslashes(strip_tags($_POST['callback']));
	if(!$title||!$url||!$xieyi){exit('{"code":-1,"msg":"各项不能留空"}');}
	if($xieyi!='http://' && $xieyi!='https://'){exit('{"code":-1,"msg":"回调域名前段协议格式错误"}');}
	$cxyh=$DB->query("SELECT * FROM `oreo_authorize` WHERE domain='$callback' limit 1")->fetch();
	if(!$cxyh){exit('{"code":-1,"msg":"回调域名不存在或不在授权域名列表当中"}');}
	$qsj=$cxyh['sjid'];
	if($qsj!=$pid){exit('{"code":-1,"msg":"该域名不在您的管理下"}');}
	$cxurl=$DB->query("SELECT * FROM `oreo_qcback` WHERE callback LIKE '%{$callback}%' limit 1")->fetch();
    if($cxurl){exit('{"code":-1,"msg":"该站点已存在"}');}
    $token=ghcode(16); 
	$addtime=date("Y-m-d H:i:s");
	$sds=$DB->exec("INSERT INTO `oreo_qcback` (`token`, `userid`, `title`, `url`, `callback`, `addtime`, `state`, `in_all`) VALUES ('$token', '$pid', '$title', '$url', '{$xieyi}{$callback}/user/connect.php', '$addtime', '1', '0')");
	exit('{"code":1,"msg":"添加成功"}');
break;
case 'New_TianjiaTenSms':
    $domain=daddslashes(strip_tags($_POST['domain']));
	if(!$domain){exit('{"code":-1,"msg":"域名不能留空"}');}
	$cxyh=$DB->query("SELECT * FROM `oreo_authorize` WHERE domain='$domain' limit 1")->fetch();
	if(!$cxyh){exit('{"code":-1,"msg":"域名不存在或不在授权域名列表当中"}');}
	$qsj=$cxyh['sjid'];
	if($qsj!=$pid){exit('{"code":-1,"msg":"该域名不在您的管理下"}');}
	$cxurl=$DB->query("SELECT * FROM `oreo_tensms` WHERE domain LIKE '%{$domain}%' limit 1")->fetch();
    if($cxurl){exit('{"code":-1,"msg":"该站点已存在"}');}
    $token=ghcode(16); 
	$addtime=date("Y-m-d H:i:s");
	$sds=$DB->exec("INSERT INTO `oreo_tensms` (`pid`, `domain`, `token`, `surplus`, `addtime`, `type`) VALUES ('$pid', '$domain', '$token', '0', '$addtime', '1')");
	exit('{"code":1,"msg":"添加成功"}');
break;
case 'Goumai_mfsq':
	$mfname=$_POST['mfname'];
	$mfdomain=daddslashes(strip_tags($_POST['mfdomain']));
	$mfversion=daddslashes(strip_tags($_POST['mfversion']));
	$mfip=daddslashes(strip_tags($_POST['mfip']));
	$mfcxm=daddslashes(strip_tags($_POST['mfcxm']));
    $cxszb=$DB->query("select * from oreo_authorize where authid='$mfcxm' and domain='$mfdomain' limit 1")->fetch();
	if($cxszb){
		$sjnames=$cxszb['sjname'];
		$tjqq=$cxszb['qq'];
		exit('{"code":-1,"msg":"该域名已经被 '.$sjnames.' 添加授权<br/>联系QQ：'.$tjqq.'<br/>如需过户请联系添加者QQ获取过户码"}');
	}
	if($conf['oreo_dqsj']==0){
	$time=1924876800;
	}else{
	$time=$conf['oreo_dtime'];	
	}
	if($conf['oreo_scyz']==0){
	$ip_qh=0;
	}else{
	$ip_qh=1;
	}if($conf['oreo_sqfs']==0){
	$yumi=0;
	}else{
	$yumi=1;
	}
	if($userrow['type']==''){
	exit('{"code":-1,"msg":"您无权操作"}');	
	}
	$sjname=$userrow['names'];
	$row=$DB->query("select * from oreo_authsys where syskeys='$mfcxm' limit 1")->fetch();
	$authnames=$row['name'];
	$gh_code=ghcode(7);
	$key = random(16);
      $sdss=$DB->exec("INSERT INTO `oreo_authorize` (`web_name`, `qq`, `domain`, `ip`, `time`, `syskey`, `version`, `ip_qh`, `yumi`, `sjname`, `authname`, `authid`, `gh_code`, `sjid`) VALUES ('{$mfname}', '{$userrow['qq']}', '{$mfdomain}', '{$mfip}', '{$time}', '{$key}', '{$mfversion}', '{$ip_qh}', '{$yumi}', '{$sjname}', '{$authnames}', '{$mfcxm}', '{$gh_code}', '{$userrow['id']}')");
	  exit('{"code":1,"msg":"succ"}');	
break;
case 'Goumai_Kmmfsq':
	$kmname=$_POST['kmname'];
	$kmdomain=daddslashes(strip_tags($_POST['kmdomain']));
	$kmversion=daddslashes(strip_tags($_POST['kmversion']));
	$kmip=daddslashes(strip_tags($_POST['kmip']));
	$kmcxm=daddslashes(strip_tags($_POST['kmcxm']));
    $cxszb=$DB->query("select * from oreo_authorize where authid='$kmcxm' and domain='$kmdomain' limit 1")->fetch();
	if($cxszb){
		$sjnames=$cxszb['sjname'];
		$tjqq=$cxszb['qq'];
		exit('{"code":-1,"msg":"该域名已经被 '.$sjnames.' 添加授权<br/>联系QQ：'.$tjqq.'<br/>如需过户请联系添加者QQ获取过户码"}');
	}
	if($conf['oreo_dqsj']==0){
	$time=1924876800;
	}else{
	$time=$conf['oreo_dtime'];	
	}
	if($conf['oreo_scyz']==0){
	$ip_qh=0;
	}else{
	$ip_qh=1;
	}if($conf['oreo_sqfs']==0){
	$yumi=0;
	}else{
	$yumi=1;
	}
	if($userrow['kami']!=1){
	exit('{"code":-1,"msg":"您无权操作"}');	
	}
	$sjname=$userrow['names'];
	$row=$DB->query("select * from oreo_authsys where syskeys='$kmcxm' limit 1")->fetch();
	$authnames=$row['name'];
	$gh_code=ghcode(7);
	$key = random(16);
      $sdss=$DB->exec("INSERT INTO `oreo_authorize` (`web_name`, `qq`, `domain`, `ip`, `time`, `syskey`, `version`, `ip_qh`, `yumi`, `sjname`, `authname`, `authid`, `gh_code`, `sjid`) VALUES ('{$kmname}', '{$userrow['qq']}', '{$kmdomain}', '{$kmip}', '{$time}', '{$key}', '{$kmversion}', '{$ip_qh}', '{$yumi}', '{$sjname}', '{$authnames}', '{$kmcxm}', '{$gh_code}', '{$userrow['id']}')");
	  $sqs=$DB->exec("update `oreo_user` set `kami` ='0', `sysnum`='' where `id`='$pid'");  
	  exit('{"code":1,"msg":"succ"}');	
break;
case 'Goumai_XgauSq':
	$ename=daddslashes(strip_tags($_POST['ename']));
	$edomain=daddslashes(strip_tags($_POST['edomain']));
	$eversion=daddslashes(strip_tags($_POST['eversion']));
	$eip=daddslashes(strip_tags($_POST['eip']));
	$eqq=daddslashes(strip_tags($_POST['eqq']));
	$ekeys=daddslashes(strip_tags($_POST['ekeys']));
	$eghm=daddslashes(strip_tags($_POST['eghm']));
	
	$cszb=$DB->query("select * from oreo_authorize where syskey='$ekeys'  limit 1")->fetch();
    $cxszb=$DB->query("select * from oreo_authorize where authid='{$cszb['authid']}' and gh_code!='$eghm' limit 1")->fetch();
	if($cxszb['domain']==$edomain){
		$sjnames=$cxszb['sjname'];
		$tjqq=$cxszb['qq'];
		exit('{"code":-1,"msg":"该域名已经被 '.$sjnames.' 添加授权<br/>联系QQ：'.$tjqq.'<br/>如需过户请联系添加者QQ获取过户码"}');
	}
	  $sqs=$DB->exec("UPDATE oreo_authorize SET `web_name` ='{$ename}',`qq` ='{$eqq}',`ip` ='{$eip}',`version` ='{$eversion}'  where `syskey`='$ekeys' and `syskey`='$ekeys' and `gh_code`='$eghm'");
	  exit('{"code":1,"msg":"succ"}');	
	
break;		
case 'm_EditPassword':
	$lastpassword=daddslashes(strip_tags($_POST['lastpassword']));
	$newpassword=daddslashes(strip_tags($_POST['newpassword']));
	if($lastpassword=='' || $newpassword=='' )exit('{"code":-1,"msg":"密码不能为空."}');
    if($lastpassword!=$newpassword)exit('{"code":-1,"msg":"两个密码不相同，请检查."}');
	if(strlen($lastpassword)<6)exit('{"code":-1,"msg":"密码不能少于6字符."}');
	if(isset($_SESSION['edit_password']) && $_SESSION['edit_password']>time()-0){
		exit('{"code":-1,"msg":"请勿频繁修改密码"}');
	}
	$password = md5($_POST['newpassword'].$password_hash);
	$abc=$DB->exec("UPDATE `oreo_user` SET `password`='$password' WHERE `id`='$pid'");
	$_SESSION['edit_password']=time();
	exit('{"code":1,"msg":"succ"}');
break;		
case 's_Work':
	$types=daddslashes(strip_tags($_POST['types']));
	$biaoti=daddslashes(strip_tags($_POST['biaoti']));
	$text=daddslashes(strip_tags($_POST['text']));
	$qq=daddslashes(strip_tags($_POST['qq']));
	if($conf['owrk_zt']==0)exit('{"code":-1,"msg":"未开放工单系统"}');
	if(isset($_SESSION['work_submit']) && $_SESSION['work_submit']>time()-2400){
		exit('{"code":-1,"msg":"请勿频繁提交工单"}');
	}
	if($conf['owrk_zt']==1){
		$num = rand(100000000,999999999);
		$edata=date("Y-m-d");
		$sds=$DB->exec("INSERT INTO `oreo_work` (`uid`, `num`, `types`, `biaoti`, `text`, `qq`, `edata`, `wdata`, `active`) VALUES ('{$pid}', '{$num}', '{$types}', '{$biaoti}', '{$text}', '{$qq}', '{$edata}', ' ', '0')");
		$_SESSION['work_submit']=time();
		$email=$conf['web_qq'].'@qq.com';
		$siteurl = ($_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://').$_SERVER['HTTP_HOST'].'/';
		$sub = $conf['web_title'].' - 您有新的工单要处理';
		$msg = '<h2>新的工单等你来处理</h2>尊敬的管理员您的网站【'.$conf['web_title'].'】收到一个工单<br/>工单编号为：'.$num.'<br/>工单类型为：'.$types.'<br/>工单标题为：'.$biaoti.'<br/>请尽快登录后台处理订单：【<a href="'.$siteurl.'" target="_blank">登录后台</a>】<br/>';
		$result = send_mail($email, $sub, $msg);
			exit('{"code":1,"msg":"succ"}');
		}else{
			('{"code":-1,"msg":"提交失败'.$DB->errorCode().'"}');
		}
break;	

case 'verifycode':
	$code=trim(strip_tags(daddslashes($_POST['code'])));
	if($conf['mail_cloud']==2){
		$row=$DB->query("select * from oreo_regcode where type=3 and code='$code' and email='{$userrow['phone']}' order by id desc limit 1")->fetch();
	}else{
		$row=$DB->query("select * from oreo_regcode where type=2 and code='$code' and email='{$userrow['email']}' order by id desc limit 1")->fetch();
	}
	if(!$row){
		exit('{"code":-1,"msg":"验证码不正确！"}');
	}
	if($row['time']<time()-3600 || $row['status']>0){
		exit('{"code":-1,"msg":"验证码已失效，请重新获取"}');
	}
	$_SESSION['verify_ok']=$pid;
	$DB->exec("update `oreo_regcode` set `status` ='1' where `id`='{$row['id']}'");
	exit('{"code":1,"msg":"succ"}');
break;
case 'verifycodesjbd':
	$code=trim(strip_tags(daddslashes($_POST['code'])));
	if($conf['mail_cloud']==2){
		$row=$DB->query("select * from oreo_regcode where type=3 and code='$code' and status='0' order by id desc limit 1")->fetch();
	}
	if(!$row){
		exit('{"code":-1,"msg":"验证码不正确！"}');
	}
	if($row['time']<time()-3600 || $row['status']>0){
		exit('{"code":-1,"msg":"验证码已失效，请重新获取"}');
	}
	$_SESSION['verify_ok']=$pid;
	$DB->exec("update `oreo_regcode` set `status` ='1' where `id`='{$row['id']}'");
	$DB->exec("update `oreo_user` set `phone` ='{$row['email']}' where `id`='{$pid}'");
	$DB->exec("update `oreo_user` set `phone` ='{$row['email']}' where `id`='{$pid}'");
	exit('{"code":1,"msg":"succ"}');
break;
case 'edit_info':
	$names=trim(strip_tags(daddslashes($_POST['names'])));
	$email=daddslashes(strip_tags($_POST['email']));
	$qq=daddslashes(strip_tags($_POST['qq']));

	if($qq==null || $email==null || $names==null){
		exit('{"code":-1,"msg":"请确保每项都不为空"}');
	}
		$sqs=$DB->exec("update `oreo_user` set  `names` ='{$names}',`qq` ='{$qq}',`email` ='{$email}' where `username`='$pid'");	
		exit('{"code":1,"msg":"succ"}');
break;
case 'edit_bind':
	$email=daddslashes(strip_tags($_POST['email']));
	$phone=daddslashes(strip_tags($_POST['phone']));
	$code=daddslashes(strip_tags($_POST['code']));

	if($code==null || $email==null && $phone==null){
		exit('{"code":-1,"msg":"请确保每项都不为空"}');
	}
	if($conf['verifytype']==1){
		$row=$DB->query("select * from oreo_regcode where type=3 and code='$code' and email='$phone' order by id desc limit 1")->fetch();
	}else{
		$row=$DB->query("select * from oreo_regcode where type=2 and code='$code' and email='$email' order by id desc limit 1")->fetch();
	}
	if(!$row){
		exit('{"code":-1,"msg":"验证码不正确！"}');
	}
	if($row['time']<time()-3600 || $row['status']>0){
		exit('{"code":-1,"msg":"验证码已失效，请重新获取"}');
	}
	if($conf['verifytype']==1){
		$sqs=$DB->exec("update `oreo_user` set `phone` ='{$phone}' where `id`='$pid'");
	}else{
		$sqs=$DB->exec("update `oreo_user` set `email` ='{$email}' where `id`='$pid'");
	}
	if($sqs || $DB->errorCode()=='0000'){
		exit('{"code":1,"msg":"succ"}');
	}else{
		exit('{"code":-1,"msg":"保存失败！'.$DB->errorCode().'"}');
	}
break;
case 'checkbind':
	if($conf['verifytype']==1 && (empty($userrow['phone']) || strlen($userrow['phone'])!=11)){
		exit('{"code":1,"msg":"bind"}');
	}elseif($conf['verifytype']==0 && (empty($userrow['email']) || strpos($userrow['email'],'@')===false)){
		exit('{"code":1,"msg":"bind"}');
	}elseif(isset($_SESSION['verify_ok']) && $_SESSION['verify_ok']===$pid){
		exit('{"code":1,"msg":"bind"}');
	}else{
		exit('{"code":2,"msg":"need verify"}');
	}
break;
	
default:
	exit('{"code":-4,"msg":"No Act"}');
break;
}