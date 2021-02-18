<?php
include "../oreo/oreo.core.php";
include './oreo_static.php';
if ($islogin == 1) {
} else {
    exit("<script language='javascript'>window.location.href='./login.php';</script>");
}
?>
                  <div class="page-content-wrapper ">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="page-title-box">
                                        <div class="btn-group float-right">
                                            <ol class="breadcrumb hide-phone p-0 m-0">
                                                <li class="breadcrumb-item"><a href="#">控制台</a></li>
                                                <li class="breadcrumb-item"><a href="#">系统参数</a></li>
                                                <li class="breadcrumb-item active">邮件短信配置</li>
                                            </ol>
                                        </div>
                                        <h4 class="page-title">邮件短信配置</h4>
                                    </div>
                                </div>
                            </div>
                            <!-- end page title end breadcrumb -->
                            <div class="row">
                                <div class="col-lg98-6">
                                    <div class="card m-b-30">
                                        <div class="card-body">
                                            <h4 class="mt-0 header-title">邮件短信置说明</h4>
                                            <p class="text-muted m-b-30 font-14">在这里您可以设置平台的邮箱参数，请认真填写每一项，否则不能发送有关邮件验证！</p>
                                                <div class="form-group">
                                                    <label>邮箱开关</label>
                                                  <select  class="form-control" name="mail_cloud"  id="mail_cloud"  onchange="sh_rg('sh',this.value)">
												  <option value="2" <?=$conf['mail_cloud']==2?"selected":""?> >腾讯云短信</option>
                                                  <option value="1" <?=$conf['mail_cloud']==1?"selected":""?> >SMTP发信</option>
                                                  <option value="0" <?=$conf['mail_cloud']==0?"selected":""?> >关闭邮箱验证</option>
                                                 </select>
                                                </div>
												<div  id="sh_reg"  style="<?php echo $conf['mail_cloud'] == 1 ? "" : "display: none;";?>">
                                                <div class="form-group">
                                                    <label>SMTP地址</label>
                                                    <div>
                                                      <input type="text" class="form-control" name="mail_smtp"  placeholder="如：smtp.qq.com" value="<?php echo $conf['mail_smtp']; ?>" class="form-control"/>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>SMTP端口</label>
                                                    <div>
                                                        <input type="text" class="form-control" placeholder="一般465或25" name="mail_port" value="<?php echo $conf['mail_port']; ?>"/>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>邮箱账号</label>
                                                    <div>
                                                        <input type="text" class="form-control" placeholder="请输入邮箱账号" name="mail_name" value="<?php echo $conf['mail_name']; ?>" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>邮箱密码</label>
                                                    <div>
                                                        <input type="text" class="form-control" placeholder="请输入正确的密码/授权码"  name="mail_pwd" value="<?php echo $conf['mail_pwd']; ?>"/>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>极限验证ID</label>
                                                    <div>
                                                        <input class="form-control"  type="text range"  name="CAPTCHA_ID" value="<?php echo $conf['CAPTCHA_ID']; ?>" />
                                                      <small>* Geetest极限验证码官网https://www.geetest.com/</small>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>极限验证KEY</label>
                                                    <div>
                                                        <input type="text" class="form-control" name="PRIVATE_KEY" value="<?php echo $conf['PRIVATE_KEY']; ?>"/>
                                                    </div>
                                                 </div></div>  
												<div  id="sh_ten"  style="<?php echo $conf['mail_cloud'] == 2 ? "" : "display: none;";?>">
												<div class="form-group">
                                                    <label>短信应用AppID</label>
                                                    <div>
                                                        <input type="text" class="form-control" name="oreo_tenmsg_appid" value="<?php echo $conf['oreo_tenmsg_appid']; ?>"/>
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>短信应用AppKey</label>
                                                    <div>
                                                        <input type="text" class="form-control" name="oreo_tenmsg_key" value="<?php echo $conf['oreo_tenmsg_key']; ?>"/>
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>短信模板ID</label>
                                                    <div>
                                                        <input type="text" class="form-control" name="oreo_tenmsg_templateId" value="<?php echo $conf['oreo_tenmsg_templateId']; ?>"/>
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>短信签名</label>
                                                    <div>
                                                        <input type="text" class="form-control" name="oreo_tenmsg_smsSign" value="<?php echo $conf['oreo_tenmsg_smsSign']; ?>"/>
                                                    </div>
													<small>* 签名参数使用的是`签名内容`，而不是`签名ID`</small>
                                                </div>
												</div> 
												   
                                                <div class="form-group m-b-0">
                                                    <div>
                                                         <button type="button" id="dispatch"  value="保存修改" class="btn btn-primary waves-effect waves-light" >
                                                            提交
                                                        </button>
                                                        <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                                                            重置
                                                        </button>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div> <!-- end col -->
                </div> <!-- content -->
                <footer class="footer">
                  <?php echo $conf['copyright']; ?>.
                  <div><?php echo $conf['beian']; ?>.</div>
                </footer>
            <?php include'oreo_foot.php';?>
		<script>
	function sh_rg(type,val){
    var gb  = $("#"+type+"_reg");
	var tn  = $("#"+type+"_ten");
    if(val == 0){
       $(gb).hide() 
	   $(tn).hide() 
    }
    if(val == 1){
       $(gb).show()
	   $(tn).hide() 
    } 
    if(val == 2){
       $(gb).hide()
	   $(tn).show() 
    }
    if(val == 3){
       $(gb).hide()
	   $(tn).show() 
    }	
}
		 $("#dispatch").click(function () {
					    var mail_cloud = $("#mail_cloud").val();												
						var mail_smtp=$("input[name='mail_smtp']").val();
						var mail_port=$("input[name='mail_port']").val();
						var mail_name=$("input[name='mail_name']").val();
						var mail_pwd=$("input[name='mail_pwd']").val();
						var CAPTCHA_ID=$("input[name='CAPTCHA_ID']").val();
						var PRIVATE_KEY=$("input[name='PRIVATE_KEY']").val();
						var oreo_tenmsg_appid=$("input[name='oreo_tenmsg_appid']").val();
						var oreo_tenmsg_key=$("input[name='oreo_tenmsg_key']").val();
						var oreo_tenmsg_templateId=$("input[name='oreo_tenmsg_templateId']").val();
						var oreo_tenmsg_smsSign=$("input[name='oreo_tenmsg_smsSign']").val();
						var ii = layer.load(2, {shade: [0.1, '#fff']}); 
						$.ajax({
							type: "POST",
							url: "ajax.php?act=edit_Dispatch",
							data: {mail_cloud:mail_cloud,mail_smtp:mail_smtp,mail_port:mail_port,mail_name:mail_name,mail_pwd:mail_pwd,CAPTCHA_ID:CAPTCHA_ID,PRIVATE_KEY:PRIVATE_KEY,oreo_tenmsg_appid:oreo_tenmsg_appid,oreo_tenmsg_key:oreo_tenmsg_key,oreo_tenmsg_templateId:oreo_tenmsg_templateId,oreo_tenmsg_smsSign:oreo_tenmsg_smsSign},
							dataType: 'json',
							success: function (data) {
								layer.close(ii);
								if (data.code == 1) {
									layer.alert('修改成功', function(index) {
                                    layer.close(index);
                                    location.reload();
                                    })
								} else {
									layer.alert(data.msg);
								}
							}
						});
					});
</script>
    </body>
</html>