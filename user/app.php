<?php

require_once __DIR__ . "/../oreo/oreo_plugin/tenmsg/SmsSingleSender.php";



$appid = 1400245342; 
$appkey = "669a3375c451cafc8890ec89e1b0ea76";
$phoneNumbers = ["18631246519"];
$templateId = 229945;  
$smsSign = "oreopay"; 
$code = rand(1111111,9999999);
try {
    $ssender = new SmsSingleSender($appid, $appkey);
    $result = $ssender->send(0, "86", $phoneNumbers[0],
        "验证码：".$code."，请保管好您的验证码，官方人员不会向您索取验证码，感谢您的支持！", "", "");
    $rsp = json_decode($result);
	echo $result;
    
} catch(\Exception $e) {
    echo var_dump($e);
}



