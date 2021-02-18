<?php
function proxy_get($url)
{
	return 0;
}
function curl_get($url)
{
$ch=curl_init($url);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Linux; U; Android 4.4.1; zh-cn; R815T Build/JOP40D) AppleWebKit/533.1 (KHTML, like Gecko)Version/4.0 MQQBrowser/4.5 Mobile Safari/533.1');
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
$content=curl_exec($ch);
curl_close($ch);
return($content);
}
function do_notify($url){
	$return = curl_get($url);
	if(strpos($return,'success')!==false){
		return true;
	}else{
		proxy_get($url);
	}
}

//腾讯云验证码短信
function tensms($phone,$code){	
require_once __DIR__ . "/oreo_plugin/tenmsg/SmsSingleSender.php";
global $conf;
$phoneNumbers=[$phone];
$appid = $conf['oreo_tenmsg_appid'];
$appkey =  $conf['oreo_tenmsg_key'];
$templateId = $conf['oreo_tenmsg_templateId'];
$smsSign =  $conf['oreo_tenmsg_smsSign'];
try {
    $ssender = new SmsSingleSender($appid, $appkey);
    $con= $smsSign."验证码：".$code."，请保管好您的验证码，官方人员不会向您索取验证码，感谢您的支持！";
    $result = $ssender->send(0, "86", $phoneNumbers[0],$con, "", "");
    $rsp = json_decode($result,true);
	return $rsp['result'];
} catch(\Exception $e) {
} 
}
//腾讯云接口安全检查短信
function OreoPaySmsQclou($phone,$OreoUser,$jsonmsg){	
	require_once __DIR__ . "/oreo_plugin/tenmsg/SmsSingleSender.php";
	global $conf;
	$phoneNumbers=[$phone];
	$appid = $conf['oreo_tenmsg_appid'];
	$appkey =  $conf['oreo_tenmsg_key'];
	$templateId = $conf['oreo_tenmsg_templateId'];
	$smsSign =  $conf['oreo_tenmsg_smsSign'];
	try {
		$ssender = new SmsSingleSender($appid, $appkey);
		$result = $ssender->send(0, "86", $phoneNumbers[0],
			"尊敬的用户：".$OreoUser."，您的接口安全出现异常，您的".$jsonmsg."，请登录后台检查情况。", "", "");
		$rsp = json_decode($result,true);
		return $rsp['result'];
	} catch(\Exception $e) {
	} 
	}
//腾讯云通知类短信
function tensms_msg($sms_type,$phone,$user_name,$real_type,$order_num,$apply_type){	
require_once __DIR__ . "/oreo_plugin/tenmsg/SmsSingleSender.php";
global $conf;
$phoneNumbers=[$phone];
$appid = $conf['oreo_tenmsg_appid'];
$appkey =  $conf['oreo_tenmsg_key'];
$templateId = $conf['oreo_tenmsg_templateId'];
$smsSign =  $conf['oreo_tenmsg_smsSign'];

try {
    $ssender = new SmsSingleSender($appid, $appkey);
	if($sms_type==1){
    $result = $ssender->send(0, "86", $phoneNumbers[0],
	"尊敬的用户：".$user_name."，您的认证信息有新的动态".$real_type."。", "", "");}
	if($sms_type==2){
    $result = $ssender->send(0, "86", $phoneNumbers[0],
	"尊敬的用户：".$user_name."，您的认证信息有新的动态".$real_type."。", "", "");}
	if($sms_type==3){
    $result = $ssender->send(0, "86", $phoneNumbers[0],
	"尊敬的用户:".$user_name."，您的退款订单".$order_num."，因".$apply_type."，出现异常，我们将人工审核后退款到指定账户，如有问题请及时联系我们。", "", "");}
	if($sms_type==4){
    $result = $ssender->send(0, "86", $phoneNumbers[0],
	"尊敬的用户:".$user_name."，您的退款订单".$order_num."，已成功退款到您的".$apply_type."账户上，请查收，如有问题请及时联系我们。", "", "");}
    $rsp = json_decode($result,true);
	return $rsp['result'];
} catch(\Exception $e) {
} 
}
function get_curl($url, $post=0, $referer=0, $cookie=0, $header=0, $ua=0, $nobaody=0)
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	$httpheader[] = "Accept:*/*";
	$httpheader[] = "Accept-Encoding:gzip,deflate,sdch";
	$httpheader[] = "Accept-Language:zh-CN,zh;q=0.8";
	$httpheader[] = "Connection:close";
	curl_setopt($ch, CURLOPT_HTTPHEADER, $httpheader);
	if ($post) {
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	}
	if ($header) {
		curl_setopt($ch, CURLOPT_HEADER, true);
	}
	if ($cookie) {
		curl_setopt($ch, CURLOPT_COOKIE, $cookie);
	}
	if($referer){
		if($referer==1){
			curl_setopt($ch, CURLOPT_REFERER, 'http://m.qzone.com/infocenter?g_f=');
		}else{
			curl_setopt($ch, CURLOPT_REFERER, $referer);
		}
	}
	if ($ua) {
		curl_setopt($ch, CURLOPT_USERAGENT, $ua);
	}
	else {
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Linux; U; Android 4.0.4; es-mx; HTC_One_X Build/IMM76D) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0");
	}
	if ($nobaody) {
		curl_setopt($ch, CURLOPT_NOBODY, 1);
	}
	curl_setopt($ch, CURLOPT_ENCODING, "gzip");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$ret = curl_exec($ch);
	curl_close($ch);
	return $ret;
}
function real_ip(){
$ip = $_SERVER['REMOTE_ADDR'];
if(isset($_SERVER['HTTP_X_FORWARDED_FOR']) && preg_match_all('#\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}#s', $_SERVER['HTTP_X_FORWARDED_FOR'], $matches)) {
	foreach ($matches[0] AS $xip) {
		if (!preg_match('#^(10|172\.16|192\.168)\.#', $xip)) {
			$ip = $xip;
			break;
		}
	}
} elseif (isset($_SERVER['HTTP_CLIENT_IP']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_CLIENT_IP'])) {
	$ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (isset($_SERVER['HTTP_CF_CONNECTING_IP']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_CF_CONNECTING_IP'])) {
	$ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
} elseif (isset($_SERVER['HTTP_X_REAL_IP']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_X_REAL_IP'])) {
	$ip = $_SERVER['HTTP_X_REAL_IP'];
}
return $ip;
}
function send_mail($to, $sub, $msg) {
	global $conf;
		include_once ROOT.'oreo/oreo_static/other/oreo_smtp.php';
		$From = $conf['mail_name'];
		$Host = $conf['mail_smtp'];
		$Port = $conf['mail_port'];
		$SMTPAuth = 1;
		$Username = $conf['mail_name'];
		$Password = $conf['mail_pwd'];
		$Nickname = $conf['web_name'];
		$SSL = $conf['mail_port']==465?1:0;
		$mail = new SMTP($Host , $Port , $SMTPAuth , $Username , $Password , $SSL);
		$mail->att = array();
		if($mail->send($to , $From , $sub , $msg, $Nickname)) {
			return true;
		} else {
			return $mail->log;
		}
	}
function daddslashes($string, $force = 0, $strip = FALSE) {
	!defined('MAGIC_QUOTES_GPC') && define('MAGIC_QUOTES_GPC', get_magic_quotes_gpc());
	if(!MAGIC_QUOTES_GPC || $force) {
		if(is_array($string)) {
			foreach($string as $key => $val) {
				$string[$key] = daddslashes($val, $force, $strip);
			}
		} else {
			$string = addslashes($strip ? stripslashes($string) : $string);
		}
	}
	return $string;
}

function strexists($string, $find) {
	return !(strpos($string, $find) === FALSE);
}

function dstrpos($string, $arr) {
	if(empty($string)) return false;
	foreach((array)$arr as $v) {
		if(strpos($string, $v) !== false) {
			return true;
		}
	}
	return false;
}

function checkmobile() {
	$useragent = strtolower($_SERVER['HTTP_USER_AGENT']);
	$ualist = array('android', 'midp', 'nokia', 'mobile', 'iphone', 'ipod', 'blackberry', 'windows phone');
	if((dstrpos($useragent, $ualist) || strexists($_SERVER['HTTP_ACCEPT'], "VND.WAP") || strexists($_SERVER['HTTP_VIA'],"wap")))
		return true;
	else
		return false;
}
function authcode($string, $operation = 'DECODE', $key = '', $expiry = 0) {
	$ckey_length = 4;
	$key = md5($key ? $key : ENCRYPT_KEY);
	$keya = md5(substr($key, 0, 16));
	$keyb = md5(substr($key, 16, 16));
	$keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length): substr(md5(microtime()), -$ckey_length)) : '';
	$cryptkey = $keya.md5($keya.$keyc);
	$key_length = strlen($cryptkey);
	$string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($string.$keyb), 0, 16).$string;
	$string_length = strlen($string);
	$result = '';
	$box = range(0, 255);
	$rndkey = array();
	for($i = 0; $i <= 255; $i++) {
		$rndkey[$i] = ord($cryptkey[$i % $key_length]);
	}
	for($j = $i = 0; $i < 256; $i++) {
		$j = ($j + $box[$i] + $rndkey[$i]) % 256;
		$tmp = $box[$i];
		$box[$i] = $box[$j];
		$box[$j] = $tmp;
	}
	for($a = $j = $i = 0; $i < $string_length; $i++) {
		$a = ($a + 1) % 256;
		$j = ($j + $box[$a]) % 256;
		$tmp = $box[$a];
		$box[$a] = $box[$j];
		$box[$j] = $tmp;
		$result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
	}
	if($operation == 'DECODE') {
		if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16)) {
			return substr($result, 26);
		} else {
			return '';
		}
	} else {
		return $keyc.str_replace('=', '', base64_encode($result));
	}
}

function random($length, $numeric = 0) {
	$seed = base_convert(md5(microtime().$_SERVER['DOCUMENT_ROOT']), 16, $numeric ? 10 : 35);
	$seed = $numeric ? (str_replace('0', '', $seed).'012340567890') : ($seed.'zZ'.strtoupper($seed));
	$hash = '';
	$max = strlen($seed) - 1;
	for($i = 0; $i < $length; $i++) {
		$hash .= $seed{mt_rand(0, $max)};
	}
	return $hash;
}

function showmsg($content = '未知的异常',$type = 4,$back = false)
{
switch($type)
{
case 1:
	$panel="success";
break;
case 2:
	$panel="info";
break;
case 3:
	$panel="warning";
break;
case 4:
	$panel="danger";
break;
}

echo '<div class="panel panel-'.$panel.'">
      <div class="panel-heading">
        <h3 class="panel-title">提示信息</h3>
        </div>
        <div class="panel-body">';
echo $content;

if ($back) {
	echo '<hr/><a href="'.$back.'"><< 返回上一页</a>';
}
else
    echo '<hr/><a href="javascript:history.back(-1)"><< 返回上一页</a>';

echo '</div>
    </div>';
}
function sysmsg($msg = '未知的异常',$die = true) {
    ?>  
<!DOCTYPE html>
<html lang="en">
<head><meta charset="utf-8" /><title><?php echo $conf['web_title']; ?> - 站点提示</title><meta name="viewport" content="width=device-width, initial-scale=1.0"><meta content="<?php echo $conf['web_title']; ?>" name="author" /><link rel="shortcut icon" href="../favicon.ico"><link href="../assets/user/css/icons.min.css" rel="stylesheet" type="text/css" /><link href="../assets/user/css/app.min.css" rel="stylesheet" type="text/css" /></head>
<body>
<div class="mt-5 mb-5"><div class="container"><div class="row justify-content-center"><div class="col-12"><div class="text-center"><img src="../assets/user/images/maintenance.svg" height="140" alt="File not found Image">
<h3 class="mt-4">糟糕，我们貌似遇到了些问题</h3>
<p class="text-muted"><?php echo $msg; ?>.</p>
<div class="row mt-5"><div class="col-md-4"><div class="text-center mt-3 pl-1 pr-1"><i class="dripicons-jewel bg-primary maintenance-icon text-white mb-2"></i>
<h5 class="text-uppercase">遇到问题怎么办?</h5>
<p class="text-muted">首先请认真阅读问题内容并且做出对应的更改方案.</p></div></div> <div class="col-md-4"><div class="text-center mt-3 pl-1 pr-1"><i class="dripicons-clock bg-primary maintenance-icon text-white mb-2"></i>
<h5 class="text-uppercase">我们的时效性?</h5>
<p class="text-muted">如果您已知晓问题的所在您可以极速处理当前存在的问题即可解决当前的问题.</p></div></div> <div class="col-md-4"><div class="text-center mt-3 pl-1 pr-1"><i class="dripicons-question bg-primary maintenance-icon text-white mb-2"></i>
<h5 class="text-uppercase">问题多次出现怎么办?</h5>
<p class="text-muted">如果该问题反复出现那么您可能需要联系管理员来获取最佳的解决方案.</p>
</div></div> </div> </div></div> </div></div></div><footer class="footer footer-alt"><?php echo $conf['web_copyright']; ?>. </footer><script src="../assets/user/js/app.min.js"></script>
</body>
</html>	
    <?php
    if ($die == true) {
        exit;
    }
}
function getdomain($url){
	$arr=parse_url($url);
	return $arr['host'];
}
function getRandomString($len, $chars=null)  
{  
    if (is_null($chars)) {  
        $chars = "abcdefghijklmnopqrstuvwxyz";  
    }  
    mt_srand(10000000*(double)microtime());  
    for ($i = 0, $str = '', $lc = strlen($chars)-1; $i < $len; $i++) {  
        $str .= $chars[mt_rand(0, $lc)];  
    }  
    return $str;  
} 
function ghcode($len, $chars=null)  
{  
    if (is_null($chars)) {  
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";  
    }  
    mt_srand(10000000*(double)microtime());  
    for ($i = 0, $str = '', $lc = strlen($chars)-1; $i < $len; $i++) {  
        $str .= $chars[mt_rand(0, $lc)];  
    }  
    return $str;  
}  
// 获取域名
function get_domain($url){
    $host = strtolower ($url);
    if (strpos ($host, '/') !== false){
        $parse = @parse_url ($host);
        $host = $parse ['host'];
        }
    $topleveldomaindb = array ('com', 'edu', 'gov', 'int', 'mil', 'net', 'org', 'biz', 'info', 'pro', 'name', 'museum', 'coop', 'aero', 'xxx', 'idv', 'mobi', 'cc', 'me', 'top', 'cn', 'xin', 'xyz', 'hk', 'tw', 'tk', 'me',
	'xin', 'club', 'site', 'co', 'pro', 'vip', 'link');
    $str = '';
    foreach ($topleveldomaindb as $v){
        $str .= ($str ? '|' : '') . $v;
        }
    
    $matchstr = "[^\.]+\.(?:(" . $str . ")|\w{2}|((" . $str . ")\.\w{2}))$";
    if (preg_match ("/" . $matchstr . "/ies", $host, $matchs)){
        $domain = $matchs ['0'];
        }else{
        $domain = $host;
        }
    return $domain;
}
function getIP()
{
    static $realip;
    if (isset($_SERVER)) {
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $realip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            if (isset($_SERVER['HTTP_CLIENT_IP'])) {
                $realip = $_SERVER['HTTP_CLIENT_IP'];
            } else {
                $realip = $_SERVER['REMOTE_ADDR'];
            }
        }
    } else {
        if (getenv('HTTP_X_FORWARDED_FOR')) {
            $realip = getenv('HTTP_X_FORWARDED_FOR');
        } else {
            if (getenv('HTTP_CLIENT_IP')) {
                $realip = getenv('HTTP_CLIENT_IP');
            } else {
                $realip = getenv('REMOTE_ADDR');
            }
        }
    }
    return $realip;
}
function aysafe_replace($string) {
	$string = str_replace('shell', '', $string);
	$string = str_replace('php', '', $string);
	$string = str_replace('bak', '', $string);
	$string = str_replace('$', '', $string);
	$string = str_replace('echo', '', $string);
	$string = str_replace('cookie', '', $string);
	$string = str_replace('eval', '', $string);
	$string = str_replace('encode', '', $string);
	$string = str_replace('_post', '', $string);
	$string = str_replace('decode', '', $string);
	$string = str_replace('_POST', '', $string);
	$string = str_replace('_get', '', $string);
	$string = str_replace('_GET', '', $string);
	$string = str_replace(' ', '', $string);
	$string = str_replace('%20', '', $string);
	$string = str_replace('%27', '', $string);
	$string = str_replace('%2527', '', $string);
	$string = str_replace('*', '', $string);
	$string = str_replace('"', '', $string);
	$string = str_replace("'", '', $string);
	$string = str_replace(';', '', $string);
	$string = str_replace('<', '&lt;', $string);
	$string = str_replace('>', '&gt;', $string);
	$string = str_replace("{", '', $string);
	$string = str_replace('}', '', $string);
	$string = str_replace('\\', '', $string);
	return $string;
}
//图片上传
	function uploadtp($file,$userids,$filesrc){
		$tmp_filename = $file['tmp_name'];
		if(is_uploaded_file($tmp_filename)){ 
			$allow_mimes = array(
				'image/png' => '.png',
				'image/x-png' => '.png',
				'image/gif' => '.gif',
				'image/jpeg' => '.jpg',
				'image/pjpeg' => '.jpg'
			);        
			if(!array_key_exists($file['type'], $allow_mimes )) {
				return false;
				exit;
			}
			$filexname = 'temp/src/'.$filesrc.$userids.'_'.md5(rand()).'.jpg';
			if (move_uploaded_file($tmp_filename, $filexname)) { 
				$lj="//".$_SERVER['HTTP_HOST']."/user/shop/".$filexname;
				return $lj;
			}else{
				return false;
			}
		}
	}
	//检测图片
	function istp($file){
		$tmp_filename = $file['tmp_name'];
		if(is_uploaded_file($tmp_filename)){ 
			// 是一个上传的文件. 
			$allow_mimes = array(
				'image/png' => '.png',
				'image/x-png' => '.png',
				'image/gif' => '.gif',
				'image/jpeg' => '.jpg',
				'image/pjpeg' => '.jpg'
			);        
			if(!array_key_exists($file['type'], $allow_mimes )) {
				return false;
			}else{
				return true;
			}
		}
	}
	//正则判断数字字母
	function isszzm($str){
		$a=preg_match('/^[0-9a-zA-Z]+$/',$str);
		if($a){
			return true;
		}else{
			return false;
		}
	}
	//正则判断汉字
	function ishz($str){
		$a=preg_match('/^[\x7f-\xff]+$/',$str);
		if($a){
			return true;
		}else{
			return false;
		}
	}
	//生成唯一的MD5
	function create_unique() {   
    $data = $_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']   
    .time() . rand();   
    return sha1($data);   
    //return md5(time().$data);
}  
//Token生成
$module=mt_rand(100000,999999);
//公安身份验证
function gongan($real_name,$sfnum){
 $host = "http://idcard.market.alicloudapi.com";
    $path = "/lianzhuo/idcard";
    $method = "GET";
    $appcode = "522d38bd43f841ec94c4cc5dd87e7cc5";
    $headers = array();
    array_push($headers, "Authorization:APPCODE " . $appcode);
    $querys = "cardno=".$sfnum."&name=".$real_name;
    $bodys = "";
    $url = $host . $path . "?" . $querys;
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_FAILONERROR, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HEADER, false);
    if (1 == strpos("$".$host, "https://"))
    {
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    }
   $response = curl_exec($curl);
   curl_close($curl);
   return $response;
}
//oreo支付系统接口安全验证函数
function OreoJkSafe($xieyi,$domain,$mods, $adtime, $safe, $oreo, $user, $sysnum){
    $url = $xieyi.$domain."/oreo/oreo_function/safe/oreo_super.php?super=selectjk"; //api地址不用修改
    $headers = array();
	array_push($headers,"OreoSafeMods:".$mods,"OreoSafeTime:".$adtime,"OreoSafeMd5:".$safe,"OreoAllMd5:".$oreo,"OreoUser:".$user,"OreoSysNum:".$sysnum);
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_FAILONERROR, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HEADER, false);
    if (1 == strpos("$".$host, "https://"))
    {
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    }
	$response = curl_exec($curl);
    curl_close($curl);
    return $response;
}
//oreo支付系统站点运营报告函数
function OreoYyBaoGao($xieyi,$domain,$mods, $adtime, $safe, $oreo, $user, $sysnum){
    $url = $xieyi.$domain."/oreo/oreo_function/other/oreo_operate.php?super=selectOpRa"; //api地址不用修改
    $headers = array();
	array_push($headers,"OreoSafeMods:".$mods,"OreoSafeTime:".$adtime,"OreoSafeMd5:".$safe,"OreoAllMd5:".$oreo,"OreoUser:".$user,"OreoSysNum:".$sysnum);
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept-Encoding:gzip'));
	curl_setopt($curl, CURLOPT_ENCODING, "gzip");
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_FAILONERROR, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_HEADER, false);
	curl_setopt($curl, CURLOPT_CONNECTTIMEOUT , 3);
	// 最大执行时间
	curl_setopt($curl, CURLOPT_TIMEOUT, 3);
    if (1 == strpos("$".$host, "https://"))
    {
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    }
	$response = curl_exec($curl);
    curl_close($curl);
    return $response;
}
//oreo支付系统站点管理更改管理员用户名
function OreoWebAdmin($xieyi,$domain,$mods, $adtime, $safe, $oreo, $user, $sysnum,$newadmin){
    $url = $xieyi.$domain."/oreo/oreo_function/other/oreo_this_warr.php?super=Oreo_Web_Admin"; //api地址不用修改
    $headers = array();
	array_push($headers,"OreoSafeMods:".$mods,"OreoSafeTime:".$adtime,"OreoSafeMd5:".$safe,"OreoAllMd5:".$oreo,"OreoUser:".$user,"OreoSysNum:".$sysnum,"OreoNewAdmin:".$newadmin);
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept-Encoding:gzip'));
	curl_setopt($curl, CURLOPT_ENCODING, "gzip");
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_FAILONERROR, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_HEADER, false);
	curl_setopt($curl, CURLOPT_CONNECTTIMEOUT , 3);
	// 最大执行时间
	curl_setopt($curl, CURLOPT_TIMEOUT, 3);
    if (1 == strpos("$".$host, "https://"))
    {
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    }
	$response = curl_exec($curl);
    curl_close($curl);
    return $response;
}
//oreo支付系统站点管理更改管理员密码
function OreoWebPass($xieyi,$domain,$mods, $adtime, $safe, $oreo, $user, $sysnum,$newpassword){
    $url = $xieyi.$domain."/oreo/oreo_function/other/oreo_this_warr.php?super=Oreo_Web_Pass"; //api地址不用修改
    $headers = array();
	array_push($headers,"OreoSafeMods:".$mods,"OreoSafeTime:".$adtime,"OreoSafeMd5:".$safe,"OreoAllMd5:".$oreo,"OreoUser:".$user,"OreoSysNum:".$sysnum,"OreoNewPass:".$newpassword);
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept-Encoding:gzip'));
	curl_setopt($curl, CURLOPT_ENCODING, "gzip");
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_FAILONERROR, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_HEADER, false);
	curl_setopt($curl, CURLOPT_CONNECTTIMEOUT , 3);
	// 最大执行时间
	curl_setopt($curl, CURLOPT_TIMEOUT, 3);
    if (1 == strpos("$".$host, "https://"))
    {
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    }
	$response = curl_exec($curl);
    curl_close($curl);
    return $response;
}
//oreo支付系统站点管理更改后台安全码
function OreoWebSafeCode($xieyi,$domain,$mods, $adtime, $safe, $oreo, $user, $sysnum,$new_safe_code){
    $url = $xieyi.$domain."/oreo/oreo_function/other/oreo_this_warr.php?super=Oreo_Web_New_Safe_Code"; //api地址不用修改
    $headers = array();
	array_push($headers,"OreoSafeMods:".$mods,"OreoSafeTime:".$adtime,"OreoSafeMd5:".$safe,"OreoAllMd5:".$oreo,"OreoUser:".$user,"OreoSysNum:".$sysnum,"OreoNewSafeCode:".$new_safe_code);
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept-Encoding:gzip'));
	curl_setopt($curl, CURLOPT_ENCODING, "gzip");
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_FAILONERROR, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_HEADER, false);
	curl_setopt($curl, CURLOPT_CONNECTTIMEOUT , 3);
	// 最大执行时间
	curl_setopt($curl, CURLOPT_TIMEOUT, 3);
    if (1 == strpos("$".$host, "https://"))
    {
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    }
	$response = curl_exec($curl);
    curl_close($curl);
    return $response;
}