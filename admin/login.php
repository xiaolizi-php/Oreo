<?php
//php防注入和XSS攻击通用过滤. 
$_GET     && SafeFilter($_GET);
$_POST    && SafeFilter($_POST);
$_COOKIE  && SafeFilter($_COOKIE);
function SafeFilter (&$arr){
	$ra=Array('/([\x00-\x08,\x0b-\x0c,\x0e-\x19])/','/script/','/javascript/','/vbscript/','/expression/','/applet/','/meta/','/xml/','/blink/','/link/','/style/','/embed/','/object/','/frame/','/layer/','/title/','/bgsound/','/base/','/onload/','/onunload/','/onchange/','/onsubmit/','/onreset/','/onselect/','/onblur/','/onfocus/','/onabort/','/onkeydown/','/onkeypress/','/onkeyup/','/onclick/','/ondblclick/','/onmousedown/','/onmousemove/','/onmouseout/','/onmouseover/','/onmouseup/','/onunload/');
	if (is_array($arr)){
		foreach ($arr as $key => $value){
			if(!is_array($value)){
				if (!get_magic_quotes_gpc()){             //不对magic_quotes_gpc转义过的字符使用addslashes(),避免双重转义。
					$value=addslashes($value);           //给单引号（'）、双引号（"）、反斜线（\）与 NUL（NULL 字符）加上反斜线转义
				}
				$value=preg_replace($ra,'',$value);     //删除非打印字符，粗暴式过滤xss可疑字符串
				$arr[$key]     = htmlentities(strip_tags($value)); //去除 HTML 和 PHP 标记并转换为 HTML 实体
			}else{
				SafeFilter($arr[$key]);
			}
		}
	}
}
include("../oreo/oreo.core.php");
if(isset($_POST['user']) && isset($_POST['pass'])){
	if(!$_SESSION['pass_error'])$_SESSION['pass_error']=0;
	$user=daddslashes($_POST['user']);
	$pass=daddslashes($_POST['pass']);
	$safepassword = $_POST['safepassword'];
	if($safe!==$safepassword){
	   echo "<script>alert('安全码错误！');window.location.href='index.php'</script>";
	   exit();
	}
        $pass =  md5($pass.$password_hash."admin");
	if($_SESSION['pass_error']>5) {
		@header('Content-Type: text/html; charset=UTF-8');
		exit("<script language='javascript'>alert('用户名或密码不正确！');history.go(-1);</script>");
	}elseif($user==$conf['admin_user'] && $pass==$conf['admin_pwd']) {
		$session=md5($user.$pass.$password_hash);
		$token=authcode("{$user}\t{$session}", 'ENCODE', SYS_KEY);
		setcookie("admin_token", $token, time() + 604800);
		@header('Content-Type: text/html; charset=UTF-8');
		exit("<script language='javascript'>alert('登陆管理中心成功！');window.location.href='./';</script>");
	}elseif ($pass != $conf['admin_pwd']) {
		$_SESSION['pass_error']++;
		@header('Content-Type: text/html; charset=UTF-8');
		exit("<script language='javascript'>alert('用户名或密码不正确！');history.go(-1);</script>");
	}
}elseif(isset($_GET['logout'])){
	setcookie("admin_token", "", time() - 604800);
	@header('Content-Type: text/html; charset=UTF-8');
	exit("<script language='javascript'>alert('您已成功注销本次登陆！');window.location.href='./login.php';</script>");
}elseif($islogin==1){
	exit("<script language='javascript'>alert('您已登陆！');window.location.href='./';</script>");
}
?>
<!DOCTYPE html>
<html>
<head>    
<meta charset="utf-8">    
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">    
<meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=yes">    
<title><?php echo $conf['web_title'];?>-管理员登录</title>
<link rel="shortcut icon" href="../favicon.ico" />    
<link rel="stylesheet" href="../assets/admin/login/css/iconfont.css">    
<link rel="stylesheet" href="../assets/admin/login/css/animate.min.css">    
<link rel="stylesheet" href="../assets/admin/login/css/qietu.css">    
<link rel="stylesheet" href="../assets/admin/login/css/style.css">    
<link rel="stylesheet" href="../assets/admin/login/css/responsive.css">     
<style>        .footer{position:absolute;}    </style>
</head><body class="login-bg">
<div class="regbg">    
<div class="regfm">        
<div class="reg-hd">           
 <h2>管理员登录</h2>       
 </div>        
 <div class="reg-bd">            
 <form role="form" action="" method="POST">                
 <ul>                    
 <li>                        
 <div class="fm-txt">                            
 <div class="fm-ico">                                
 <i class="iconfont icon-yonghu"></i>                            
 </div>                           
 <input class="fm-ipt" type="text" name="user" value="" placeholder="请输入用户名">                       
 </div>                    
 </li>                    
 <li>                        
 <div class="fm-txt">                            
 <div class="fm-ico">                                
 <i class="iconfont icon-mima"></i>                            
 </div>                            
 <input class="fm-txt fm-codetxt" type="password" name="pass" value="" placeholder="请输入密码" />                        
 </div>                    
 </li>                    
   <li>                        
 <div class="fm-txt">                            
 <div class="fm-ico">                                
 <i class="iconfont icon-mima"></i>                            
 </div>                            
 <input class="fm-txt fm-codetxt" type="password" name="safepassword" value="" placeholder="请输入安全码" />                        
 </div>                    
 </li>                  
 <li>                        
 <input type="submit" class="fm-btn-login" name="" value="登 录" />                   
 </li>               
 </ul>            
 </form>        
 </div>        
    </div></div><footer class="footer reg-footer">    
 <div class="wrapper">        
 <p><?php echo $conf['web_copyright'];?>        
 <a style="color: #cedcf6;" href="javascript:void(0)" onclick="window.open('http://www.miitbeian.gov.cn/');" >                   
 <a href="http://www.beian.miit.gov.cn" style="color: white;"><?php echo $conf['web_beian']; ?></a></a></p>            
 </div>
 </footer>

 </body>
 </html>