<?php
include("../../oreo/oreo.core.php");
if($islogin2==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
include './oreo_shop_static.php';
if($userrow['action']==0){
exit("<script language='javascript'>alert('您的账号已被封禁，暂无法登陆后台');window.location.href='./login.php?logout';</script>");
}
$Shop_Real=$DB->query("select * from oreo_shop_real where  activation='3' or activation='2'  and user='$pid' limit 1")->fetch();
if($Shop_user['activation']==1){$shop_activ='未实名';}
if($Shop_user['activation']==2){$shop_activ='已实名';}
if($Shop_user['activation']==3){$shop_activ='待审核';}
?>
                <div class="content-page">
                    <div class="content">
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">基本</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">用户中心</a></li>
                                            <li class="breadcrumb-item active">用户详情</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">用户详情</h4>
                                </div> <!-- end page-title-box -->
                            </div> <!-- end col-->
                        </div>
                        <!-- end page title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <!-- Profile -->
                                <div class="card bg-secondary">
                                    <div class="card-body profile-user-box">
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <div class="media">
                                                    <span class="float-left m-2 mr-4"><img src="<?php echo ($userrow['qq'])?'//q3.qlogo.cn/headimg_dl?bs=qq&dst_uin='.$userrow['qq'].'&src_uin='.$userrow['qq'].'&fid='.$userrow['qq'].'&spec=100&url_enc=0&referer=bu_interface&term_type=PC':'/assets/images/team-1.jpg'?>" style="height: 100px;" alt="" class="rounded-circle img-thumbnail"></span>
                                                    <div class="media-body">
                                                        <h4 class="mt-1 mb-1 text-white"><?php echo $userrow['names'];?></h4>
                                                        <p class="font-13 text-white-50"> ID:<?php echo $userrow['id'];?></p>
                                                        <ul class="mb-0 list-inline text-light">
                                                            <li class="list-inline-item mr-3">
                                                                <h5 class="mb-1">¥<?php echo $Shop_user['money']?></h5>
                                                                <p class="mb-0 font-13 text-white-50">余额</p>
                                                            </li>
                                                            <li class="list-inline-item">
                                                                <h5 class="mb-1"><?php echo $shop_activ;?></h5>
                                                                <p class="mb-0 font-13 text-white-50">实名</p>
                                                            </li>
                                                        </ul>
                                                    </div> <!-- end media-body-->
                                                </div>
                                            </div> <!-- end col-->
                                        </div> <!-- end row -->
                                    </div> <!-- end card-body/ profile-user-box-->
                                </div><!--end profile/ card -->
                            </div> <!-- end col-->
                        </div>
                        <!-- end row -->
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title mb-3">详细信息</h4>
                                        <form>
                                            <div id="basicwizard">
                                                <ul class="nav nav-pills nav-justified form-wizard-header mb-4">
                                                    <li class="nav-item">
                                                        <a href="#myinfo" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2 show active"> 
                                                            <i> 我的信息</i>
                                                            <span class="d-none d-sm-inline"></span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#myedit" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                            <i> 修改信息</i>
                                                            <span class="d-none d-sm-inline"></span>
                                                        </a>
                                                    </li>
													<li class="nav-item">
                                                        <a href="#newpass" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                            <i> 修改密码</i>
                                                            <span class="d-none d-sm-inline"></span>
                                                        </a>
                                                    </li>
                                                </ul>
                                                <div class="tab-content b-0 mb-0">
                                                    <div class="tab-pane show active" id="myinfo">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <small class="text-muted">我的名称: </small>
                                                                 <p class="m-b-0" style="margin-top: 1em;"><?php echo $userrow['names']?></p>
                                                                 <hr>
																 <small class="text-muted">真实姓名: </small>
                                                                 <p class="m-b-0" style="margin-top: 1em;"><?php echo $Shop_Real['real_name']?></p>
                                                                 <hr>
																  <small class="text-muted">结算支付宝账户: </small>
                                                                 <p class="m-b-0" style="margin-top: 1em;"><?php echo $Shop_Real['alipay_id']?></p>
                                                                 <hr>
																 <small class="text-muted">保密手机: </small>
																 <?php if($conf['mail_cloud']==2&&$userrow['phone']==0||!$userrow['phone']){ ?>
																 <button type="button" class="btn btn-success" data-toggle="modal" data-target="#bangdingsj" data-id="bangdingsj" style="float: right;">绑定</button>
																 <?php } ?>
																 <p class="m-b-0" style="margin-top: 1em;"><?php echo $userrow['phone']?></p>
                                                                 <hr>
                                                                 <small class="text-muted">保密邮箱: </small>
                                                                 <p class="m-b-0" style="margin-top: 1em;"><?php echo $userrow['email']?></p>
							                                     <hr>
							                                     <small class="text-muted">联系QQ: </small>
                                                                 <p class="m-b-0" style="margin-top: 1em;"><?php echo $userrow['qq']?></p>
                                                            </div> <!-- end col -->
                                                        </div> <!-- end row -->
                                                    </div>
                                                    <div class="tab-pane" id="myedit">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="alert alert-warning" role="alert">
                                                                <i class="dripicons-warning mr-2"></i> <strong>警告</strong> 请不要填写随意或虚假信息,这影响您的其他操作!
                                                                </div>
                                                               <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#xiugai" data-id="xiugai">修改</button>
                                                            </div> <!-- end col -->
                                                        </div> <!-- end row -->
                                                    </div>
													<div class="tab-pane" id="newpass">
                                                        <div class="row">
                                                            <div class="col-12">
                                                             <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="name">输入新密码</label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" name="newpassword" class="form-control" placeholder="请输入新密码">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label" for="surname">再次输入</label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" name="lastpassword" class="form-control" placeholder="请再次输入新密码">
                                                                    </div>
                                                                </div>   
                                                               <button type="button" id="xiugaimima" class="btn btn-primary">修改</button>
                                                            </div> <!-- end col -->
                                                        </div> <!-- end row -->
                                                    </div>
													
                                                </div> <!-- tab-content -->
                                            </div> <!-- end #basicwizard-->
                                        </form>
                                    </div> <!-- end card-body -->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->
                                  <div id="xiugai" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="text-center mt-2 mb-4">
                                                         <i class="mdi mdi-account-circle mr-1"> 验证信息</i>
                                                        </div>
													<?php if($conf['mail_cloud']==1) {?> 	
													<div class="form-group">
                                                    <label>保密邮箱:</label>
                                                    <div>
													 <input type="text" class="form-control ca1"  readonly="readonly" value="<?php echo $userrow['email']?>"/>
                                                    </div>
                                                </div> 
												<div class="form-group">
                                                    <label>输入验证码:</label>
                                                    <div class="input-group">
                                                    <input class="form-control"type="text"name="code"placeholder="输入邮箱验证码"required>
                                                    <div class="input-group-append"><button type="button" class="btn btn-default" id="sendcode">获取验证码</button>
                                                 </div></div>
                                                </div> 
												<?php }if($conf['mail_cloud']==2) { ?>  
												<div class="form-group">
                                                    <label>保密手机:</label>
                                                    <div>
													 <input type="text" class="form-control ca1"  name="myphone" readonly="readonly" value="<?php echo $userrow['phone']?>"/>
                                                    </div>
                                                </div> 
												<div class="form-group">
                                                    <label>输入验证码:</label>
                                                    <div class="input-group">
                                                    <input class="form-control"type="text"name="code"placeholder="输入手机验证码"required>
                                                    <div class="input-group-append"><button type="button" class="btn btn-default" id="sendcode">获取验证码</button>
                                                 </div></div>
                                                </div> 
												 <?php } ?> 
                                                <div class="form-group text-center">
                                                 <button class="btn btn-primary" type="button" id="verifycode">提交验证</button>
                                                     </div>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->
										<div id="bangdingsj" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="text-center mt-2 mb-4">
                                                         <i class="mdi mdi-account-circle mr-1"> 绑定手机号</i>
                                                        </div>
												<div class="form-group">
                                                    <label>保密手机:</label>
                                                    <div>
													 <input type="text" class="form-control"  name="myphonebd"  value="<?php echo $userrow['phone']?>"/>
                                                    </div>
                                                </div> 
												<div class="form-group">
                                                    <label>输入验证码:</label>
                                                    <div class="input-group">
                                                    <input class="form-control"type="text"name="codes"placeholder="输入手机验证码"required>
                                                    <div class="input-group-append"><button type="button" class="btn btn-default" id="sendcode2">获取验证码</button>
                                                 </div></div>
                                                </div> 
                                                <div class="form-group text-center">
                                                 <button class="btn btn-primary" type="button" id="bangdingsjhm">提交绑定</button>
                                                     </div>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->
										<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="text-center mt-2 mb-4">
                                                         <i class="mdi mdi-account-circle mr-1"> 修改详情</i>
                                                        </div>
														<div class="form-group">
                                                    <label id="typename">我的名称:</label>
                                                    <div>
													 <input type="text" class="form-control ca2" name="names" value="<?php echo $userrow['names']?>" />
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label>保密邮箱:</label>
                                                    <div>
													 <input type="text" class="form-control ca1" name="email" value="<?php echo $userrow['email']?>" />
                                                    </div>
                                                </div> 
												<div class="form-group">
                                                    <label>联系QQ:</label>
                                                    <div>
													 <input type="text" class="form-control ca3" name="qq" value="<?php echo $userrow['qq']?>" />
                                                    </div>
                                                </div>
                                                <div class="form-group text-center">
                                                 <button class="btn btn-primary" type="button" id="editInfo">修改</button>
                                                     </div>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->
                    </div> <!-- content -->

                    <!-- Footer Start -->
                   <footer class="footer">
                        <div class="row">
                            <div class="col-md-6">
                                 <?php echo $conf['web_copyright']; ?>. 
                            </div>
                            <div class="col-md-6">
                                <div class="text-md-right footer-links d-none d-md-block">
                                    <a href="javascript: void(0);"><?php echo $conf['web_beian']; ?></a>
                                </div>
                            </div>
                        </div>
                    </footer>
                    <!-- end Footer -->
                </div> <!-- content-page -->

            </div> <!-- end wrapper-->
        </div>
        <div class="rightbar-overlay"></div>
<script src="../../assets/user/js/app.min.js"></script>
<script src="../../assets/user/js/layer.js"></script>
<script src="//static.geetest.com/static/tools/gt.js"></script>
<script> 
		
function invokeSettime(obj) {
					var countdown = 60;
					settime(obj);

					function settime(obj) {
						if (countdown == 0) {
							$(obj).attr("data-lock", "false");
							$(obj).text("获取验证码");
							countdown = 60;
							return;
						} else {
							$(obj).attr("data-lock", "true");
							$(obj).attr("disabled", true);
							$(obj).text("(" + countdown + ") s 重新发送");
							countdown--;
						}
						setTimeout(function () {
								settime(obj)
							}
							, 1000)
					}
				}

				var handlerEmbed = function (captchaObj) {
					var myphonebd;
					captchaObj.onReady(function () {
						$("#wait").hide();
					}).onSuccess(function () {
						var result = captchaObj.getValidate();
						if (!result) {
							return alert('请完成验证');
						}
						var situation = $("#situation").val();
						var ii = layer.load(2, {shade: [0.1, '#fff']});
						$.ajax({
							type: "POST",
							url: "oreo_shop_sub.php?act=sendcode",
							data: {
								situation: situation,
								myphonebd: myphonebd,
								geetest_challenge: result.geetest_challenge,
								geetest_validate: result.geetest_validate,
								geetest_seccode: result.geetest_seccode
							},
							dataType: 'json',
							success: function (data) {
								layer.close(ii);
								if (data.code == 0) {
									new invokeSettime("#sendcode");
									new invokeSettime("#sendcode2");
									layer.msg('发送成功，请注意查收！');
								} else {
									layer.alert(data.msg);
									captchaObj.reset();
								}
							}
						});
					});
					$('#sendcode').click(function () {
						if ($(this).attr("data-lock") === "true") return;
						captchaObj.verify();
					});
					$('#sendcode2').click(function () {
						if ($(this).attr("data-lock") === "true") return;
						myphonebd=$("input[name='myphonebd']").val();
						captchaObj.verify();
					});
					
					// 更多接口参考：http://www.geetest.com/install/sections/idx-client-sdk.html
				};
				$(document).ready(function () {
					$("#editInfo").click(function () {
						var names = $("input[name='names']").val();
						var email = $("input[name='email']").val();
						var qq = $("input[name='qq']").val();
						if (names == '' || email == '' || qq == '' ) {
							layer.alert('请确保各项不能为空！');
							return false;
						}
						if (email.length > 0) {
							var reg = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/;
							if (!reg.test(email)) {
								layer.alert('邮箱格式不正确！');
								return false;
							}
						}
						var ii = layer.load(2, {shade: [0.1, '#fff']});
						$.ajax({
							type: "POST",
							url: "oreo_shop_sub.php?act=edit_info",
							data: {names: names,email: email, qq: qq},
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
					$("#checkbind").click(function () {
						var ii = layer.load(2, {shade: [0.1, '#fff']});
						$.ajax({
							type: "GET",
							url: "oreo_shop_sub.php?act=checkbind",
							dataType: 'json',
							success: function (data) {
								layer.close(ii);
								if (data.code == 1) {
									$("#situation").val("bind");
									$('#myModal2').modal('show');
								} else if (data.code == 2) {
									$("#situation").val("mibao");
									$('#myModal').modal('show');
								} else {
									layer.alert(data.msg);
								}
							}
						});
					});
					$("#verifycode").click(function () {
						var code = $("input[name='code']").val();
						var situation = $("#situation").val();
						if (code == '') {
							layer.alert('请输入验证码！');
							return false;
						}
						var ii = layer.load(2, {shade: [0.1, '#fff']});
						$.ajax({
							type: "POST",
							url: "oreo_shop_sub.php?act=verifycode",
							data: {code: code},
							dataType: 'json',
							success: function (data) {
								layer.close(ii);
								if (data.code == 1) {
									layer.msg('验证成功！');
									$('#myModal').modal('show');
									if (situation == 'settle') {
										$("#editSettle").click();
									} else if (situation == 'mibao') {
										$("#situation").val("bind");
										$('#myModal2').modal('show');
									} else if (situation == 'bind') {
										$('#myModal2').modal('hide');
										window.location.reload();
									}
								} else {
									layer.alert(data.msg);
								}
							}
						});
					});
					$("#bangdingsjhm").click(function () {
						var code = $("input[name='codes']").val();
						var situation = $("#situation").val();
						if (code == '') {
							layer.alert('请输入验证码！');
							return false;
						}
						var ii = layer.load(2, {shade: [0.1, '#fff']});
						$.ajax({
							type: "POST",
							url: "oreo_shop_sub.php?act=verifycodesjbd",
							data: {code: code},
							dataType: 'json',
							success: function (data) {
								layer.close(ii);
								if (data.code == 1) {
									layer.alert('綁定成功', function(index) {
                                    layer.close(index);
                                    location.reload();
                                    })
								} else {
									layer.alert(data.msg);
								}
							}
						});
					});
					$.ajax({
						// 获取id，challenge，success（是否启用failback）
						url: "oreo_shop_sub.php?act=captcha&t=" + (new Date()).getTime(), // 加随机数防止缓存
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
					var items = $("select[default]");
					for (i = 0; i < items.length; i++) {
						$(items[i]).val($(items[i]).attr("default") || 1);
					}
				});		
					
				$("#xiugaimima").click(function () {
						var newpassword = $("input[name='newpassword']").val();						
                        var lastpassword = $("input[name='lastpassword']").val();			
						if (newpassword == '' || lastpassword == '') {
							layer.alert('请确保各项不能为空！');
							return false;
						}
						var ii = layer.load(2, {shade: [0.1, '#fff']}); 
						
						$.ajax({
							type: "POST",
							url: "oreo_shop_sub.php?act=m_EditPassword",
							data: {newpassword:newpassword,lastpassword:lastpassword},
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