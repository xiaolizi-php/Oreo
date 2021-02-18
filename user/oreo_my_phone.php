<?php
include("../oreo/oreo.core.php");
if($islogin2==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
include './oreo_static.php';
$ktztc=$DB->query("SELECT user FROM `oreo_authsys` WHERE concat(',',user,',') LIKE '%,$pid,%'")->fetch();
if($userrow['action']==0){
exit("<script language='javascript'>alert('您的账号已被封禁，暂无法登陆后台');window.location.href='./login.php?logout';</script>");
}
if($userrow['sjname']==''){
$wdsj='无';
}else{
$wdsj=$userrow['sjname'];
}
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
                                                                <h5 class="mb-1">¥<?php echo $userrow['money']?></h5>
                                                                <p class="mb-0 font-13 text-white-50">余额</p>
                                                            </li>
                                                            <li class="list-inline-item">
                                                                <h5 class="mb-1"><?php echo $userrow['grade_name'];?></h5>
                                                                <p class="mb-0 font-13 text-white-50">等级</p>
                                                            </li>
															 <li class="list-inline-item">
                                                                <h5 class="mb-1">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $wdsj;?></h5>
                                                                <p class="mb-0 font-13 text-white-50">&nbsp;&nbsp;&nbsp;&nbsp;上级</p>
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
                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title mb-3">绑定手机号</h4>
                                        <form>
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
                                                    <div class="input-group-append"><button type="button" class="btn btn-default" id="sendcodebangding2">获取验证码</button>
                                                 </div></div>
                                                </div> 
                                                <div class="form-group text-center">
                                                 <button class="btn btn-primary" type="button" id="bangdingsjhm">提交绑定</button>
                                                     </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->


                                                </div> <!-- tab-content -->
                                            </div> <!-- end #basicwizard-->
                                        </form>
                                    
                                </div> <!-- end card-->
                            </div> <!-- end col -->
							<div class="col-lg-6">
                               
                               <div class="card cta-box bg-primary text-white">
                                   <div class="card-body">
                                       <div class="text-center">
                                           <h3 class="m-0 font-weight-normal cta-box-title">为了更好的提供服务 <b>强烈建议</b> 加入Oreo技术交流QQ群</h3>
                                           <img class="my-3" src="../assets/user/images/report.svg" width="180" alt="Generic placeholder image">
                                           <br/>
                                           <a href="//jq.qq.com/?_wv=1027&k=5P9T28K" target="blank" class="btn btn-sm btn-light btn-rounded">立刻加入 <i class="mdi mdi-arrow-right"></i></a>
                                       </div>
                                   </div>
                                   <!-- end card-body -->
                               </div>
                               <!-- end card-->
                           </div> <!-- end col-->
                        </div>
                        <!-- end row -->
                               
        <div class="rightbar-overlay"></div>
<script src="../assets/user/js/app.min.js"></script>
<script src="../assets/user/js/layer.js"></script>
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
							url: "ajax2.php?act=sendcodebangding",
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
									new invokeSettime("#sendcodebangding");
									new invokeSettime("#sendcodebangding2");
									layer.msg('发送成功，请注意查收！');
								} else {
									layer.alert(data.msg);
									captchaObj.reset();
								}
							}
						});
					});
					$('#sendcodebangding').click(function () {
						if ($(this).attr("data-lock") === "true") return;
						captchaObj.verify();
					});
					$('#sendcodebangding2').click(function () {
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
							url: "ajax2.php?act=edit_info",
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
							url: "ajax2.php?act=checkbind",
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
							url: "ajax2.php?act=verifycode",
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
							url: "ajax2.php?act=verifycodesjbd1",
							data: {code: code},
							dataType: 'json',
							success: function (data) {
								layer.close(ii);
								if (data.code == 1) {
									layer.alert('綁定成功', 
									function(index) {
                                    layer.close(index);
                                    location.reload();
                                    })
                                    window.location.href='/user/oreo_my.php';
								} else {
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
							url: "ajax2.php?act=m_EditPassword",
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