<?php
include("./oreo/oreo.core.php");
header("Content-type: text/html; charset=utf-8"); 
if(empty($_GET['myid']||$_GET['oreo_token'])){
    echo '
    <html>
    <head>
        <meta charset="utf-8" />
        <title>微信扫码登录</title>
        <link rel="shortcut icon" href="./assets/user/images/favicon.ico">
        <link href="./assets/user/css/app.min.css" rel="stylesheet" type="text/css" />
    </head>
    <body style=" background-color: #f6f6f6;">
                <div class="content-page">
                    <div class="content">
                        <div class="row">
                            <div class="col-xl-12">
                            <div style="margin-top: 5em;">
                                <div style="text-align: center;font-size: 50px;line-height: 1.6;" >您的站点无权进行Oreo免签登录</div>
                                <div style="line-height: 1.6;text-align: center;">
                                <img style="width: 300px;margin: 15px;" class="qrcode lightBorder" src="./assets/user/images/wx_openid_err.jpg"></div>
                            </div> 
                            <div style="width: 300px;margin: 0 auto;">
                            <div style="margin-top: 15px;background-color: #232323;-webkit-border-radius: 100px;-webkit-box-shadow: inset 0 5px 10px -5px #191919,0 1px 0 0 #444;text-align: center;padding: 2px 14px;color: #fff;font-family: "Microsoft Yahei";">
				                <p style="margin: 0;font-size: 25px;">请前往授权站免费获取权限</p>
                            </div>
                            </div>
                            </div>
                        </div> 
                    </div>
                </div>
            </div> 
        </div>
    </body>
</html>';
    exit();
}else{
  $token=$_GET['myid'];
  $thiz_myid=$DB->query("select * from oreo_wx_seesion where token='{$token}' limit 1")->fetch();
  if($thiz_myid['type']==1){
    echo'
    <html>
    <head>
        <meta charset="utf-8" />
        <title>微信扫码登录</title>
        <link rel="shortcut icon" href="./assets/user/images/favicon.ico">
        <link href="./assets/user/css/app.min.css" rel="stylesheet" type="text/css" />
    </head>
    <body style=" background-color: #f6f6f6;">
                <div class="content-page">
                    <div class="content">
                        <div class="row">
                            <div class="col-xl-12">
                            <div style="margin-top: 5em;">
                                <div style="text-align: center;font-size: 70px;line-height: 1.6;" >二维码已失效</div>
                                <div style="line-height: 1.6;text-align: center;">
                                <img style="width: 350px;margin: 15px;" class="qrcode lightBorder" src="./assets/user/images/wx_openid_err.jpg"></div>
                            </div> 
                            <div style="width: 350px;margin: 0 auto;">
                            <div style="margin-top: 15px;background-color: #232323;-webkit-border-radius: 100px;-webkit-box-shadow: inset 0 5px 10px -5px #191919,0 1px 0 0 #444;text-align: center;padding: 2px 14px;color: #fff;font-family: "Microsoft Yahei";">
				                <p style="margin: 0;font-size: 30px;">请返回刷新页面重试</p>
                            </div>
                            </div>
                            </div>
                        </div> 
                    </div>
                </div>
            </div> 
        </div>
    </body>
</html>';
    exit;
  }
}
$oreo_token = aysafe_replace($_GET['oreo_token']);
$row=$DB->query("SELECT * FROM `oreo_wxback` WHERE token='$oreo_token' limit 1 ")->fetch();
if(!$row){
    echo'
    <html>
    <head>
        <meta charset="utf-8" />
        <title>微信扫码登录</title>
        <link rel="shortcut icon" href="./assets/user/images/favicon.ico">
        <link href="./assets/user/css/app.min.css" rel="stylesheet" type="text/css" />
    </head>
    <body style=" background-color: #f6f6f6;">
                <div class="content-page">
                    <div class="content">
                        <div class="row">
                            <div class="col-xl-12">
                            <div style="margin-top: 5em;">
                                <div style="text-align: center;font-size: 70px;line-height: 1.6;" >您的Token有误</div>
                                <div style="line-height: 1.6;text-align: center;">
                                <img style="width: 350px;margin: 15px;" class="qrcode lightBorder" src="./assets/user/images/wx_openid_err.jpg"></div>
                            </div> 
                            <div style="width: 350px;margin: 0 auto;">
                            <div style="margin-top: 15px;background-color: #232323;-webkit-border-radius: 100px;-webkit-box-shadow: inset 0 5px 10px -5px #191919,0 1px 0 0 #444;text-align: center;padding: 2px 14px;color: #fff;font-family: "Microsoft Yahei";">
				                <p style="margin: 0;font-size: 30px;">请返回刷新页面重试</p>
                            </div>
                            </div>
                            </div>
                        </div> 
                    </div>
                </div>
            </div> 
        </div>
    </body>
</html>';
    exit;
}
if($row['state'] != 1){
	exit('{"code":-1,"msg":"您的有关权限已停用或权限未激活"}');
}
$CONF =  array(

    '__APPID__' =>'wxddd5300f1287aeb8',

    '__SERECT__' =>'d5d8d96f130fd3f7c95260d6e31ea2bd',

    '__CALL_URL__' =>urlencode('http://www.oreopay.com/wx_api.php') //当前页地址 注意这里要urlencode()过的地址才成哦

);
if(!isset($_GET['code']) || empty($_GET['code'])){
    $getCodeUrl  =  "https://open.weixin.qq.com/connect/oauth2/authorize".

                    "?appid=" . $CONF['__APPID__'] .

                    "&redirect_uri=" . $CONF['__CALL_URL__']  . 

                    "&response_type=code".

                    "&scope=snsapi_base". #!!!scope设置为snsapi_base !!!

                    "&state=1";    
    header('Location:' . $getCodeUrl);
    exit;
}
$code     		=	trim($_GET['code']);
$getTokenUrl    =  "https://api.weixin.qq.com/sns/oauth2/access_token".

                    "?appid={$CONF['__APPID__']}".

                    "&secret={$CONF['__SERECT__']}".

                    "&code={$code}".

                    "&grant_type=authorization_code";

      function OreoWxOpenId($openid,$myid,$domain){
        $url = $domain."/user/openid/check_up.php"; //api地址不用修改
        $headers = array();
        array_push($headers,"openid:".$openid,"myid:".$myid,"domain:".$domain);
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        if (1 == strpos("$".$domain, "https://"))
        {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        return(curl_exec($curl));
    }
    $openid=(json_decode(file_get_contents($getTokenUrl),true));
    $openid=$openid['openid'];
    if($openid){
    $myid=$_GET['myid'];
    $domain=$_GET['domain'];
    $port=$_GET['port'];
    $ports=$port == 80 ? 'http://':'https://';
    $domain=$ports.$_GET['domain'];
    if($ports!=$row['xieyi']){
        echo'
        <html>
        <head>
            <meta charset="utf-8" />
            <title>微信扫码登录</title>
            <link rel="shortcut icon" href="./assets/user/images/favicon.ico">
            <link href="./assets/user/css/app.min.css" rel="stylesheet" type="text/css" />
        </head>
        <body style=" background-color: #f6f6f6;">
                    <div class="content-page">
                        <div class="content">
                            <div class="row">
                                <div class="col-xl-12">
                                <div style="margin-top: 5em;">
                                    <div style="text-align: center;font-size: 70px;line-height: 1.6;" >您配置的回调协议与当前域名协议不匹配</div>
                                    <div style="line-height: 1.6;text-align: center;">
                                    <img style="width: 350px;margin: 15px;" class="qrcode lightBorder" src="./assets/user/images/wx_openid_err.jpg"></div>
                                </div> 
                                <div style="width: 350px;margin: 0 auto;">
                                <div style="margin-top: 15px;background-color: #232323;-webkit-border-radius: 100px;-webkit-box-shadow: inset 0 5px 10px -5px #191919,0 1px 0 0 #444;text-align: center;padding: 2px 14px;color: #fff;font-family: "Microsoft Yahei";">
                                    <p style="margin: 0;font-size: 30px;">当前域名协议为：'.$ports.'</p>
                                </div>
                                </div>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div> 
            </div>
        </body>
    </html>';
        exit;
    }
    $response =OreoWxOpenId($openid,$myid,$domain);
    $DB->exec("INSERT INTO `oreo_wx_seesion` (`token`, `type`, `addtime`) VALUES ('{$myid}', '1', '{$date}')"); 
    $DB->exec("UPDATE `oreo_wxback` SET  `in_all`=in_all+1 WHERE  token='$oreo_token'");
    echo'
    <html>
    <head>
        <meta charset="utf-8" />
        <title>微信扫码登录</title>
        <link rel="shortcut icon" href="./assets/user/images/favicon.ico">
        <link href="./assets/user/css/app.min.css" rel="stylesheet" type="text/css" />
    </head>
    <body style=" background-color: #f6f6f6;">
                <div class="content-page">
                    <div class="content">
                        <div class="row">
                            <div class="col-xl-12">
                            <div style="margin-top: 5em;">
                                <div style="text-align: center;font-size: 70px;line-height: 1.6;" >扫码登录成功</div>
                                <div style="line-height: 1.6;text-align: center;">
                                <img style="width: 350px;margin: 15px;" class="qrcode lightBorder" src="./assets/user/images/wx_openid.jpg"></div>
                            </div> 
                            <div style="width: 350px;margin: 0 auto;">
                            <div style="margin-top: 15px;background-color: #232323;-webkit-border-radius: 100px;-webkit-box-shadow: inset 0 5px 10px -5px #191919,0 1px 0 0 #444;text-align: center;padding: 2px 14px;color: #fff;font-family: "Microsoft Yahei";">
				                <p style="margin: 0;font-size: 30px;">请返回继续操作</p>
                            </div>
                            </div>
                            </div>
                        </div> 
                    </div>
                </div>
            </div> 
        </div>
    </body>
</html>';
exit;
}
?>
