<?php
require '../oreo/oreo.core.php';

$type=isset($_GET['type'])?daddslashes($_GET['type']):exit('No type!');
$trade_no=isset($_GET['trade_no'])?daddslashes($_GET['trade_no']):exit('No trade_no!');

@header('Content-Type: text/html; charset=UTF-8');
function creat_callback($data){
	global $DB;
	$userrow=$DB->query("SELECT * FROM oreo_user WHERE id='{$data['pid']}' limit 1")->fetch();
	$array=array('pid'=>$data['pid'],'trade_no'=>$data['trade_no'],'out_trade_no'=>$data['out_trade_no'],'type'=>$data['type'],'name'=>$data['name'],'money'=>$data['money'],'trade_status'=>'TRADE_SUCCESS');
	$arg=argSort(paraFilter($array));
	$prestr=createLinkstring($arg);
	$urlstr=createLinkstringUrlencode($arg);
	$sign=md5Sign($prestr, $userrow['key']);
	if(strpos($data['notify_url'],'?'))
		$url['notify']=$data['notify_url'].'&'.$urlstr.'&sign='.$sign.'&sign_type=MD5';
	else
		$url['notify']=$data['notify_url'].'?'.$urlstr.'&sign='.$sign.'&sign_type=MD5';
	if(strpos($data['return_url'],'?'))
		$url['return']=$data['return_url'].'&'.$urlstr.'&sign='.$sign.'&sign_type=MD5';
	else
		$url['return']=$data['return_url'].'?'.$urlstr.'&sign='.$sign.'&sign_type=MD5';
	return $url;
}
$row=$DB->query("SELECT * FROM oreo_order WHERE trade_no='{$trade_no}' limit 1")->fetch();
if($row['status']>=1){
	$url=creat_callback($row);
	exit('{"code":1,"msg":"付款成功","backurl":"'.$url['return'].'"}');
}else{
	exit('{"code":-1,"msg":"未付款"}');
}

?>