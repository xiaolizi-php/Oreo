<?php 
include("../oreo/oreo.core.php");
if($conf['mail_cloud']==0){
exit("<script language='javascript'>alert('本站管理员未开启或未配置邮件系统信息，如有疑问请联系管理员！');history.go(-1);</script>");
}
?>
<!DOCTYPE html>
<html>
<head>    
<meta charset="utf-8">    
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">    
<meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=yes">    
<title><?php echo $conf['web_title'];?>-找回密码</title>
<link rel="shortcut icon" href="../favicon.ico" />    
<link rel="stylesheet" href="../assets/user/login/css/iconfont.css">    
<link rel="stylesheet" href="../assets/user/login/css/animate.min.css">    
<link rel="stylesheet" href="../assets/user/login/css/qietu.css">    
<link rel="stylesheet" href="../assets/user/login/css/style.css">    
<link rel="stylesheet" href="../assets/user/login/css/responsive.css">
</head>
<body class="reg-bg-2" style="background: url(../assets/user/login/image/img_resg_bg.jpg);">
<div class="regist">    
<div class="regfm regfm-register">        
<div class="reg-hd">            
<h2>找回您的密码</h2>                
 </div>        
 <div class="reg-bd">                           
 <input type="hidden" name="spread_userid" value="">                
 <ul>                                                     
 <li>                        
 <div class="fm-txt">                            
 <div class="fm-ico">                               
 <i class="iconfont icon-youjian"></i>                            
 </div>                            
 <input class="fm-ipt" type="email" autocomplete="email" name="email" placeholder="电子邮箱" />                        
 </div>                    
 </li>                                        
 <li> 
 <div class="fm-txt">                            
 <div class="fm-ico">                                
 <i class="iconfont icon-anquanbaozhang1"></i>                            
 </div>
 <input class="fm-ipt" type="text" name="code" placeholder="验证码" />                                                        
 <button class="verification-code" id="sendcode" type="button" >发送验证码</button> 
 </div>
 </li> 
 <li>                        
 <div class="fm-txt">                            
 <div class="fm-ico">                               
 <i class="iconfont icon-mima"></i>                           
 </div>                            
 <input class="fm-ipt" type="password" name="password"  value=""placeholder="输入新密码" />                       
 </div>                    
 </li>  
  <li>                        
 <div class="fm-txt">                            
 <div class="fm-ico">                               
 <i class="iconfont icon-mima"></i>                           
 </div>                            
 <input class="fm-ipt" type="password" name="password2"  value=""placeholder="确认新密码" />                       
 </div>                    
 </li>                    
 <li>                        
 <button type="button" class="fm-btn" id="zhuimm"  value="找回密码" /> 找回密码 </button>                  
 </li>                
 </ul>                   
 </div>        
 <div class="reg-ft"> 已找回密码，<a href="login.php">立即登录</a>        
 </div>    
 </div>
 </div>
 <footer class="footer reg-footer">    
 <div class="wrapper"> <p><?php echo $conf['web_copyright'];?><a style="color: #cedcf6;" href="javascript:void(0)" onclick="window.open('http://www.miitbeian.gov.cn/');" >                    
 <a href="http://www.beian.miit.gov.cn"><?php echo $conf['web_beian'];?></a></a></p>            
</div>
</footer>
<script src="../assets/user/js/jquery.min.js"></script>
<script src="//static.geetest.com/static/tools/gt.js"></script>
<script src="../assets/user/js/layer.js"></script>
<script>    
function invokeSettime(obj){
    var countdown=60;
    settime(obj);
    function settime(obj) {
        if (countdown == 0) {
            $(obj).attr("data-lock", "false");
            $(obj).text("获取验证码");
            countdown = 60;
            return;
        } else {
            $(obj).attr("data-lock", "true");
            $(obj).attr("disabled",true);
            $(obj).text("(" + countdown + ") s 重新发送");
            countdown--;
        }
        setTimeout(function() {
                    settime(obj) }
                ,1000)
    }
}
$(document).ready(function(){
	$("#sendcode").click(function(){
        if ($(this).attr("data-lock") === "true") return;
        var email=$("input[name='email']").val();
        if(email==''){layer.alert('邮箱不能为空！');return false;}
        var reg = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/;
        if(!reg.test(email)){layer.alert('邮箱格式不正确！');return false;}
        var ii = layer.load(2, {shade:[0.1,'#fff']});
        $.ajax({
            type : "POST",
            url : "ajax.php?act=sendcode",
            data : {email:email},
            dataType : 'json',
            success : function(data) {
                layer.close(ii);
                if(data.code == 0){
                    new invokeSettime("#sendcode");
                    layer.msg('发送成功，请注意查收！');
                }else{
                    layer.alert(data.msg);
                }
            } 
        });
    });
	$("#zhuimm").click(function(){
        if ($(this).attr("data-lock") === "true") return;
        var email=$("input[name='email']").val();
		var code=$("input[name='code']").val();
        var password=$("input[name='password']").val();
		var password2=$("input[name='password2']").val();
        var reg = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/;
        if(!reg.test(email)){layer.alert('邮箱格式不正确！');return false;}
        
        var ii = layer.load(2, {shade:[0.1,'#fff']});
        $(this).attr("data-lock", "true");
        $.ajax({
            type : "POST",
            url : "ajax.php?act=Zhmmima",
            data : {password:password,password2:password2,email:email,code:code},
            dataType : 'json',
            success : function(data) {
                $("#submit").attr("data-lock", "false");
                layer.close(ii);
                if(data.code == 1){
                    layer.alert('找回成功', function(index) {
                    layer.close(index);
                    location.href="index.php"; 
                 })
                }else{
                    layer.alert(data.msg);
                }
            }
        });
    });
    $.ajax({
        // 获取id，challenge，success（是否启用failback）
        url: "ajax.php?act=captcha&t=" + (new Date()).getTime(), // 加随机数防止缓存
        type: "get",
        dataType: "json",
        success: function (data) {
            console.log(data);
            // 使用initGeetest接口
            // 参数1：配置参数
            // 参数2：回调，回调的第一个参数验证码对象，之后可以使用它做appendTo之类的事件
            initGeetest({
                width: '100%',
                gt: data.gt,
                challenge: data.challenge,
                new_captcha: data.new_captcha,
                product: "bind", // 产品形式，包括：float，embed，popup。注意只对PC版验证码有效
                offline: !data.success // 表示用户后台检测极验服务器是否宕机，一般不需要关注
                // 更多配置参数请参见：http://www.geetest.com/install/sections/idx-client-sdk.html#config
            }, handlerEmbed);
        }
    });
}); 
</script>
</body>
</html>