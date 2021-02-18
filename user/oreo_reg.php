<?php 
include("../oreo/oreo.core.php");
?>
<!DOCTYPE html>
<html>
<head>    
<meta charset="utf-8">    
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">    
<meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=yes">    
<title><?php echo $conf['web_title'];?>-用户注冊</title>
<link rel="shortcut icon" href="../favicon.ico" />    
<link rel="stylesheet" href="../assets/user/login/css/iconfont.css">    
<link rel="stylesheet" href="../assets/user/login/css/animate.min.css">    
<link rel="stylesheet" href="../assets/user/login/css/qietu.css">    
<link rel="stylesheet" href="../assets/user/login/css/style.css">    
<link rel="stylesheet" href="../assets/user/login/css/responsive.css">
<link rel="stylesheet" href="//at.alicdn.com/t/font_1139659_0jfutseu4njt.css">
</head>
<body class="reg-bg-2" style="background: url(../assets/user/login/image/img_resg_bg.jpg);">
<div class="regist">    
<div class="regfm regfm-register">        
<div class="reg-hd">            
<h2>注册属于您的账号</h2>                
 </div>        
 <div class="reg-bd">                           
 <input type="hidden" name="spread_userid" value="">                
 <ul>                    
 <li>                        
 <div class="fm-txt">                            
 <div class="fm-ico">                                
 <i class="iconfont icon-yonghu"></i>                            
 </div>                            
 <input class="fm-ipt" type="text" name="names"  placeholder="名称" />                        
 </div>                    
 </li>                    
 <li class="iphone">                        
 <div class="fm-txt">                            
 <div class="fm-ico">                               
 <i class="iconfont icon-queren"></i>                            
 </div>                            
 <input class="fm-ipt" type="tel"  name="username"  placeholder="英文登录账号" />                       
 </div>                    
 </li>                   
 <li>                        
 <div class="fm-txt">                            
 <div class="fm-ico">                               
 <i class="iconfont icon-mima"></i>                           
 </div>                            
 <input class="fm-ipt" type="password" name="password"  value=""placeholder="密码" />                       
 </div>                    
 </li>                   
                  
 <li>                        
 <div class="fm-txt">                            
 <div class="fm-ico">                                
 <i class="iconfont icon-qq1"></i>                            
 </div>                            
 <input class="fm-ipt" type="text" name="qq"  placeholder="联系QQ" />                        
 </div>                    
 </li>                    
 <li>                        
 <div class="fm-txt">                            
 <div class="fm-ico">                               
 <i class="iconfont icon-youjian"></i>                            
 </div>                            
 <input class="fm-ipt" type="email" autocomplete="email" name="email" placeholder="电子邮箱" />                        
 </div>                    
 </li>     
 <li> 
<?php if($conf['mail_cloud']==1) {?> 
 <li>  
 <div class="fm-txt">                            
 <div class="fm-ico">                                
 <i class="iconfont icon-anquanbaozhang1"></i>                            
 </div>
 <input class="fm-ipt" type="text" name="code" placeholder="邮箱验证码" />                                                        
 <button class="verification-code" id="sendcode" type="button" >发送验证码</button> 
 </div>
<?php }if($conf['mail_cloud']==2) { ?>  
<li>                        
 <div class="fm-txt">                            
 <div class="fm-ico">                               
 <i class="iconfont icon-shouji"></i>                            
 </div>                            
 <input class="fm-ipt" type="text" autocomplete="phone" name="phone" placeholder="手机号码" />                        
 </div>                    
 </li> 
 <li> 
 <div class="fm-txt">                            
 <div class="fm-ico">                                
 <i class="iconfont icon-anquanbaozhang1"></i>                            
 </div>
 <input class="fm-ipt" type="text" name="code" placeholder="手机验证码" />                                                        
 <button class="verification-code" id="sendsmsten" type="button" >发送验证码</button> 
 </div>
  </li>
 <?php } ?>                                          
 <li class="fm-rule fm-rule-resg">                        
 <label>                            
 <input type="checkbox" name="agree" id="check" value="" />                            
 <i class="iconfont icon-fuxuansel"></i>  我已阅读并接受 <a id="agreement" href="#">《服务协议》</a>                        
 </label>                    
 </li>                    
 <li>                        
 <button type="button" class="fm-btn" id="submit"  value="注 册" /> 注 册</button>                  
 </li>                
 </ul>                   
 </div>        
 <div class="reg-ft"> 已有账号，<a href="login.php">立即登录</a>        
 </div>    
 </div>
 </div>
 <footer class="footer reg-footer">    
 <div class="wrapper"> <p><?php echo $conf['web_copyright'];?><a style="color: #cedcf6;" href="javascript:void(0)" onclick="window.open('http://www.miitbeian.gov.cn/');" >                    
 <a href="http://www.beian.miit.gov.cn" style="color: white;"><?php echo $conf['web_beian'];?></a></a></p>            
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
	var handlerEmbed = function (captchaObj) {
    var phone;
    captchaObj.onReady(function () {
        $("#wait").hide();
    }).onSuccess(function () {
        var result = captchaObj.getValidate();
        if (!result) {
            return alert('请完成验证');
        }
        var ii = layer.load(2, {shade:[0.1,'#fff']});
        $.ajax({
            type : "POST",
            url : "ajax.php?act=sendsmsten",
            data : {phone:phone,geetest_challenge:result.geetest_challenge,geetest_validate:result.geetest_validate,geetest_seccode:result.geetest_seccode},
            dataType : 'json',
            success : function(data) {
                layer.close(ii);
                if(data.code == 0){
                    new invokeSettime("#sendsmsten");
                    layer.msg('发送成功，请注意查收！');
                }else{
                    layer.alert(data.msg);
                    captchaObj.reset();
                }
            } 
        });
    });
    $('#sendsmsten').click(function () {
        if ($(this).attr("data-lock") === "true") return;
        phone=$("input[name='phone']").val();
        if(phone==''){layer.alert('手机号码不能为空！');return false;}
        if(phone.length!=11){layer.alert('手机号码不正确！');return false;}
        captchaObj.verify();
    })
    // 更多接口参考：http://www.geetest.com/install/sections/idx-client-sdk.html
};
	$("#submit").click(function(){
        if ($(this).attr("data-lock") === "true") return;
        var names=$("input[name='names']").val();
        var username=$("input[name='username']").val();
		var qq=$("input[name='qq']").val();
        var sjname=$("input[name='sjname']").val();
		var password=$("input[name='password']").val();
        var email=$("input[name='email']").val();
		var code=$("input[name='code']").val();
        var phone=$("input[name='phone']").val();
        var reg = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/;
        if(!reg.test(email)){layer.alert('邮箱格式不正确！');return false;}
        
        var ii = layer.load(2, {shade:[0.1,'#fff']});
        $(this).attr("data-lock", "true");
        $.ajax({
            type : "POST",
            url : "ajax.php?act=reg",
            data : {names:names,username:username,qq:qq,sjname:sjname,password:password,email:email,phone:phone,code:code},
            dataType : 'json',
            success : function(data) {
                $("#submit").attr("data-lock", "false");
                layer.close(ii);
                if(data.code == 1){
                    layer.alert('注册成功', function(index) {
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