<?php
require '../oreo/oreo.core.php';
@header('Content-Type: text/html; charset=UTF-8');
$type = $_POST['type'];
$name = $_POST['WIDsubject'];
$money = $_POST['WIDtotal_fee'];
$pid = $_POST['id'];
$trade_no=date("YmdHis").rand(11111,99999);
$out_trade_no=date("YmdHis").rand(111,999);
$sitename=urlencode(base64_encode(daddslashes($queryArr['sitename'])));
$DB->exec("insert into `oreo_order` (`trade_no`,`out_trade_no`,`type`,`pid`,`addtime`,`name`,`money`,`status`)
values ('".$trade_no."','".$out_trade_no."','".$type."','".$pid."','".$date."','".$name."','".$money."','0')");
$row=$DB->query("SELECT * FROM oreo_order WHERE trade_no='{$trade_no}' limit 1")->fetch();
if(!$row)sysmsg('系统找不到您的订单信息，请重试或联系管理员.');
if(empty($out_trade_no))sysmsg('订单号(out_trade_no)不能为空');
if(!preg_match('/^[a-zA-Z0-9.\_\-|]+$/',$out_trade_no))sysmsg('订单号(out_trade_no)格式不正确');
if(!$type)sysmsg('您提交的订单有参数错误等问题，若有问题联系管理员.');
if($type=='alipay'){
if($conf['alipay_mode']==0){
echo "
支付宝接口关闭";
}
if($conf['alipay_mode']==1){
	require_once(SYSTEM_ROOT."oreo_static/pay/alipay/alipay.config.php");
	require_once(SYSTEM_ROOT."oreo_static/pay/alipay/alipay_submit.class.php");
	//构造要请求的参数数组，无需改动
	if(checkmobile()==true){
		$alipay_service = "alipay.wap.create.direct.pay.by.user";
	}else{
		$alipay_service = "create_direct_pay_by_user";
	}
	$parameter = array(
		"service" => $alipay_service,
		"partner" => trim($alipay_config['partner']), //合作身份者id
		"seller_id" => trim($alipay_config['partner']), //收款支付宝用户号
		"payment_type"	=> "1", //支付方式
		"notify_url"	=> $oreoport.'/pay/alipay/alipay_notify.php', //服务器异步通知页面路径
		"return_url"	=> $oreoport.'/pay/alipay/alipay_return.php', //页面跳转同步通知页面路径
		"out_trade_no"	=> $trade_no, //商户订单号
		"subject"	=> $row['name'], //订单名称
		"total_fee"	=> $row['money'], //付款金额
		"_input_charset"	=> strtolower('utf-8')
	);
	if(checkmobile()==true){
		$parameter['app_pay'] = "Y";
	}
	//建立请求
	$alipaySubmit = new AlipaySubmit($alipay_config);
	$html_text = $alipaySubmit->buildRequestForm($parameter,"get", "正在跳转");
	echo $html_text;
}
if($conf['alipay_mode']==2){
require_once(SYSTEM_ROOT."oreo_static/pay/epay/yzf_alipay.php");
require_once(SYSTEM_ROOT."oreo_static/pay/epay/epay_submit.class.php");
$parameter = array(
	"pid" => trim($alipay_config['partner']),
	"type" => $type, 
	"notify_url"	=> $oreoport.'/pay/alipay/oreo_alipay_notify.php',
	"return_url"	=> $oreoport.'/pay/alipay/oreo_alipay_return.php',
	"out_trade_no"	=> $trade_no,
	"name"	=> $row['name'],
	"money"	=> $row['money']
);
//建立请求
$alipaySubmit = new AlipaySubmit($alipay_config);
$html_text = $alipaySubmit->buildRequestForm($parameter);
echo $html_text;
}
}
if($type=='wxpay'){	
if($conf['wxpay_mode']==0){
echo "
微信支付接口关闭";
}
if($conf['wxpay_mode']==1){
	if(strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger')!==false){
		echo "<script>window.location.href='./pay/weixin/wxjspay.php?trade_no={$trade_no}';</script>";
	}elseif(checkmobile()==true){
	if($conf['wxpay_h5']==1){
		echo "<script>window.location.href='./pay/weixin/wxwappay2.php?trade_no={$trade_no}&sitename={$sitename}';</script>";
	}else{
	}
		echo "<script>window.location.href='./pay/weixin/wxwappay.php?trade_no={$trade_no}&sitename={$sitename}';</script>";
	}else{
		echo "<script>window.location.href='./pay/weixin/wxpay.php?trade_no={$trade_no}&sitename={$sitename}';</script>";
	}
}
if($conf['wxpay_mode']==2){
require_once(SYSTEM_ROOT."oreo_static/pay/epay/yzf_wxpay.php");
require_once(SYSTEM_ROOT."oreo_static/pay/epay/epay_submit.class.php");
$parameter = array(
	"pid" => trim($alipay_config['partner']),
	"type" => $type,
	"notify_url"	=> $oreoport.'/pay/weixin/oreo_wxpay_notify.php',
	"return_url"	=> $oreoport.'/pay/weixin/oreo_wxpay_return.php',
	"out_trade_no"	=> $trade_no,
	"name"	=> $row['name'],
	"money"	=> $row['money']
);
//建立请求
$alipaySubmit = new AlipaySubmit($alipay_config);
$html_text = $alipaySubmit->buildRequestForm($parameter);
echo $html_text;
}
}
if($type=='qqpay'){	
if($conf['qqpay_mode']==0){
echo "
QQ钱包接口关闭";
}
if($conf['qqpay_mode']==1){
	echo "<script>window.location.href='pay/qqpay/qqpay.php?trade_no={$trade_no}&sitename={$sitename}';</script>";
}
if($conf['qqpay_mode']==2){
require_once(SYSTEM_ROOT."oreo_static/pay/epay/yzf_qqpay.php");
require_once(SYSTEM_ROOT."oreo_static/pay/epay/epay_submit.class.php");
$parameter = array(
	"pid" => trim($alipay_config['partner']),
	"type" => $type,
	"notify_url"	=> $oreoport.'/pay/qqpay/oreo_qqpay_notify.php',
	"return_url"	=> $oreoport.'/pay/qqpay/oreo_qqpay_return.php',
	"out_trade_no"	=> $trade_no,
	"name"	=> $row['name'],
	"money"	=> $row['money']
);
//建立请求
$alipaySubmit = new AlipaySubmit($alipay_config);
$html_text = $alipaySubmit->buildRequestForm($parameter);
echo $html_text;
}
}
?>
</body>
</html>