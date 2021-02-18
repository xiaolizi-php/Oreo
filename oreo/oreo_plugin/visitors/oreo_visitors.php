<?php
function visitor($shop_id){
    global $DB;
    #当前url
    $url=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    #获取ip和来源
    $address = GetIpFrom();
    $froms = $address[0];
    $ip = $address[1];
    #获取浏览器和系统类型
    $broswer = get_broswer();
    $os = get_os();
    
    #获取最后来源地址
    if(empty($_SERVER['HTTP_REFERER'])){
        $source_link = $url;
    }else{
        $source_link = $_SERVER['HTTP_REFERER'];
    }
    #获取到的信息放入数据库
    $sql =" INSERT INTO oreo_shop_visitors (ip,shop_id,froms,add_time,system,browser,pageview,source_link) VALUES ('$ip','$shop_id','$froms',now(),'$os','$broswer','$url','$source_link')";
    $DB -> exec($sql);
}
// 浏览器信息和ip信息获取函数
function get_broswer(){
    $sys = $_SERVER['HTTP_USER_AGENT'];  //获取用户代理字符串
    if (stripos($sys, "Firefox/") > 0) {
        preg_match("/Firefox\/([^;)]+)+/i", $sys, $b);
        $exp[0] = "Firefox";
        $exp[1] = $b[1];  //获取火狐浏览器的版本号
    } elseif (stripos($sys, "Maxthon") > 0) {
        preg_match("/Maxthon\/([\d\.]+)/", $sys, $aoyou);
        $exp[0] = "傲游";
        $exp[1] = $aoyou[1];
    } elseif (stripos($sys, "Baiduspider") > 0) {
        $exp[0] = "百度";
        $exp[1] = '蜘蛛';
    }elseif (stripos($sys, "YisouSpider") > 0) {
        $exp[0] = "一搜";
        $exp[1] = '蜘蛛';
    }elseif (stripos($sys, "Googlebot") > 0) {
        $exp[0] = "谷歌";
        $exp[1] = '蜘蛛';
    }elseif (stripos($sys, "Android 4.3") > 0) {
        $exp[0] = "安卓";
        $exp[1] = '4.3';
    }elseif (stripos($sys, "Android 5.0") > 0) {
        $exp[0] = "安卓";
        $exp[1] = '5.0';
    }elseif (stripos($sys, "Android 6.0") > 0) {
        $exp[0] = "安卓";
        $exp[1] = '6.0';
    }elseif (stripos($sys, "Android 7.0") > 0) {
        $exp[0] = "安卓";
        $exp[1] = '7.0';
    }elseif (stripos($sys, "Android 8.0") > 0) {
        $exp[0] = "安卓";
        $exp[1] = '8.0';
    }elseif (stripos($sys, "Android 9.0") > 0) {
        $exp[0] = "安卓";
        $exp[1] = '9.0';
    }
    elseif (stripos($sys, "MSIE") > 0) {
        preg_match("/MSIE\s+([^;)]+)+/i", $sys, $ie);
        $exp[0] = "IE";
        $exp[1] = $ie[1];  //获取IE的版本号
    } elseif (stripos($sys, "OPR") > 0) {
        preg_match("/OPR\/([\d\.]+)/", $sys, $opera);
        $exp[0] = "Opera";
        $exp[1] = $opera[1];
    } elseif(stripos($sys, "Edge") > 0) {
        //win10 Edge浏览器 添加了chrome内核标记 在判断Chrome之前匹配
        preg_match("/Edge\/([\d\.]+)/", $sys, $Edge);
        $exp[0] = "Edge";
        $exp[1] = $Edge[1];
    } elseif (stripos($sys, "Chrome") > 0) {
        preg_match("/Chrome\/([\d\.]+)/", $sys, $google);
        $exp[0] = "Chrome";
        $exp[1] = $google[1];  //获取google chrome的版本号
    } elseif(stripos($sys,'rv:')>0 && stripos($sys,'Gecko')>0){
        preg_match("/rv:([\d\.]+)/", $sys, $IE);
        $exp[0] = "IE";
        $exp[1] = $IE[1];
    }else if(stripos($sys,'AhrefsBot')>0){
        $exp[0] = "AhrefsBot";
        $exp[1] = '蜘蛛';
    }else if(stripos($sys,'Safari')>0){
        preg_match("/([\d\.]+)/", $sys, $safari);
        $exp[0] = "Safari";
        $exp[1] = $safari[1];
    }else if(stripos($sys,'bingbot')>0){
        $exp[0] = "必应";
        $exp[1] = '蜘蛛';
    }else if(stripos($sys,'WinHttp')>0){
        $exp[0] = "windows";
        $exp[1] = 'WinHttp 请求接口工具';
    }else if(stripos($sys,'iPhone OS 10')>0){
        $exp[0] = "iPhone";
        $exp[1] = 'OS 10';
    }else if(stripos($sys,'Sogou')>0){
        $exp[0] = "搜狗";
        $exp[1] = '蜘蛛';
    }else if(stripos($sys,'HUAWEIM')>0){
        $exp[0] = "华为";
        $exp[1] = '手机端';
    }else if(stripos($sys,'Dalvik')>0){
        $exp[0] = "安卓";
        $exp[1] = 'Dalvik虚拟机';
    }else if(stripos($sys,'Mac OS X 10')>0){
        $exp[0] = "MAC";
        $exp[1] = 'OS X10';
    }else if(stripos($sys,'Opera/9.8')>0){
        $exp[0] = "Opera";
        $exp[1] = '9.8';
    }else if(stripos($sys,'JikeSpider')>0){
        $exp[0] = "即刻";
        $exp[1] = '蜘蛛';
    }else if(stripos($sys,'Baiduspider')>0){
        $exp[0] = "百度";
        $exp[1] = '蜘蛛';
    }
    else {
        $exp[0] = $sys;
        $exp[1] = "";
    }
    return $exp[0].' '.$exp[1];
}
 
//获取操作系统信息
function get_os(){
    $agent = $_SERVER['HTTP_USER_AGENT'];
    $os = false;
 
    if (preg_match('/win/i', $agent) && strpos($agent, '95'))
    {
        $os = 'Windows 95';
    }
    else if (preg_match('/win 9x/i', $agent) && strpos($agent, '4.90'))
    {
        $os = 'Windows ME';
    }
    else if (preg_match('/win/i', $agent) && preg_match('/98/i', $agent))
    {
        $os = 'Windows 98';
    }
    else if (preg_match('/win/i', $agent) && preg_match('/nt 6.0/i', $agent))
    {
        $os = 'Windows Vista';
    }
    else if (preg_match('/win/i', $agent) && preg_match('/nt 6.1/i', $agent))
    {
        $os = 'Windows 7';
    }
    else if (preg_match('/win/i', $agent) && preg_match('/nt 6.2/i', $agent))
    {
        $os = 'Windows 8';
    }else if(preg_match('/win/i', $agent) && preg_match('/nt 10.0/i', $agent))
    {
        $os = 'Windows 10';#添加win10判断
    }else if (preg_match('/win/i', $agent) && preg_match('/nt 5.1/i', $agent))
    {
        $os = 'Windows XP';
    }
    else if (preg_match('/win/i', $agent) && preg_match('/nt 5/i', $agent))
    {
        $os = 'Windows 2000';
    }
    else if (preg_match('/win/i', $agent) && preg_match('/nt/i', $agent))
    {
        $os = 'Windows NT';
    }
    else if (preg_match('/win/i', $agent) && preg_match('/32/i', $agent))
    {
        $os = 'Windows 32';
    }
    else if (preg_match('/linux/i', $agent))
    {
        $os = 'Linux';
    }
	else if (preg_match('/android/i', $agent))
    {
        $os = 'Android';
    }
    else if (preg_match('/unix/i', $agent))
    {
        $os = 'Unix';
    }
    else if (preg_match('/sun/i', $agent) && preg_match('/os/i', $agent))
    {
        $os = 'SunOS';
    }
    else if (preg_match('/ibm/i', $agent) && preg_match('/os/i', $agent))
    {
        $os = 'IBM OS/2';
    }
    else if (preg_match('/Mac/i', $agent) && preg_match('/PC/i', $agent))
    {
        $os = 'Macintosh';
    }
    else if (preg_match('/PowerPC/i', $agent))
    {
        $os = 'PowerPC';
    }
    else if (preg_match('/AIX/i', $agent))
    {
        $os = 'AIX';
    }
    else if (preg_match('/HPUX/i', $agent))
    {
        $os = 'HPUX';
    }
    else if (preg_match('/NetBSD/i', $agent))
    {
        $os = 'NetBSD';
    }
    else if (preg_match('/BSD/i', $agent))
    {
        $os = 'BSD';
    }
    else if (preg_match('/OSF1/i', $agent))
    {
        $os = 'OSF1';
    }
    else if (preg_match('/IRIX/i', $agent))
    {
        $os = 'IRIX';
    }
    else if (preg_match('/FreeBSD/i', $agent))
    {
        $os = 'FreeBSD';
    }
    else if (preg_match('/teleport/i', $agent))
    {
        $os = 'teleport';
    }
    else if (preg_match('/flashget/i', $agent))
    {
        $os = 'flashget';
    }
    else if (preg_match('/webzip/i', $agent))
    {
        $os = 'webzip';
    }
    else if (preg_match('/offline/i', $agent))
    {
        $os = 'offline';
    }else if (preg_match('/iPhone OS 8/i', $agent))
    {
        $os = 'iOS 8';
    }else if (preg_match('/YisouSpider/i', $agent))
    {
        $os = '一搜引擎';
    }else if (preg_match('/Yahoo! Slurp/i', $agent))
    {
        $os = '雅虎引擎';
    }else if (preg_match('/iPhone OS 6/i', $agent))
    {
        $os = 'iOS 6';
    }
    else if (preg_match('/Baiduspider/i', $agent))
    {
        $os = '百度引擎';
    }else if (preg_match('/iPhone OS 10/i', $agent))
    {
        $os = 'iOS 10';
    }else if (preg_match('/Mac OS X 10/i', $agent))
    {
        $os = 'Mac OS 10';
    }
    else if (preg_match('/Ahrefs/i', $agent))
    {
        $os = 'Ahrefs SEO 引擎';
    }
    else if (preg_match('/JikeSpider/i', $agent))
    {
        $os = '即刻引擎';
    }else if (preg_match('/Googlebot/i', $agent))
    {
        $os = '谷歌引擎';
    }else if(preg_match('/bingbot/i',$agent)){
        $os = '必应引擎';
    }else if(preg_match('/iPhone OS 7/i',$agent)){
        $os = 'iOS 7';
    }else if(preg_match('/Sogou web spider/i',$agent)){
        $os = '搜狗引擎';
    }else if(preg_match('/IP-Guide.com Crawler/i',$agent)){
        $os = 'IP-Guide Crawler 引擎';
    }else if(preg_match('/VenusCrawler/i',$agent)){
        $os = 'VenusCrawler 引擎';
    }
    else{
        $os = $agent;
    }
    return $os;
}

// 获取客户端真实ip和ip归属地函数
    function GetIps(){  
          $realip = '';  
          $unknown = 'unknown';  
          if (isset($_SERVER)){  
              if(isset($_SERVER['HTTP_X_FORWARDED_FOR']) && !empty($_SERVER['HTTP_X_FORWARDED_FOR']) && strcasecmp($_SERVER['HTTP_X_FORWARDED_FOR'], $unknown)){  
                  $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);  
                  foreach($arr as $ip){  
                      $ip = trim($ip);  
                      if ($ip != 'unknown'){  
                          $realip = $ip;  
                          break;  
                      }  
                  }  
              }else if(isset($_SERVER['HTTP_CLIENT_IP']) && !empty($_SERVER['HTTP_CLIENT_IP']) && strcasecmp($_SERVER['HTTP_CLIENT_IP'], $unknown)){  
                  $realip = $_SERVER['HTTP_CLIENT_IP'];  
              }else if(isset($_SERVER['REMOTE_ADDR']) && !empty($_SERVER['REMOTE_ADDR']) && strcasecmp($_SERVER['REMOTE_ADDR'], $unknown)){  
                  $realip = $_SERVER['REMOTE_ADDR'];  
              }else{  
                  $realip = $unknown;  
              }  
          }else{  
              if(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), $unknown)){  
                  $realip = getenv("HTTP_X_FORWARDED_FOR");  
              }else if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), $unknown)){  
                  $realip = getenv("HTTP_CLIENT_IP");  
              }else if(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), $unknown)){  
                  $realip = getenv("REMOTE_ADDR");  
              }else{  
                  $realip = $unknown;  
              }  
          }  
          $realip = preg_match("/[\d\.]{7,15}/", $realip, $matches) ? $matches[0] : $unknown;  
          return $realip;  
      }  
        
      function GetIpFrom($ip = ''){  
          if(empty($ip)){  
              $ip = GetIps();  
          }
     
     
         $res = @file_get_contents('http://ip.taobao.com/service/getIpInfo.php?ip='.$ip);
     
          if($res){
              $json = json_decode($res,true);
          }else{
              $json = '';
          }
     
          //var_dump($json);
     
          $address[0] = $json['data']['country'].$json['data']['region'].$json['data']['city'].$json['data']['isp'];
    $address[1] = $ip;
     
    return $address;
      }
?>