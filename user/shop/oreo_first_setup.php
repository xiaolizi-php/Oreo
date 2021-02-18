<?php
include("../../oreo/oreo.core.php");
if($islogin2 != 1){exit("<script language='javascript'>window.location.href='./login.php';</script>");}
include './oreo_shop_static.php';
if($userrow['action']==0){
exit("<script language='javascript'>alert('您的账号已被封禁，暂无法登陆后台');window.location.href='./login.php?logout';</script>");
}
$Shop_user=$DB->query("select * from oreo_shop_user where user='$pid' limit 1")->fetch();
if($Shop_user){
exit("<script language='javascript'>window.location.href='./';</script>");
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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Oreo担保平台</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">设置</a></li>
                                            <li class="breadcrumb-item active">首次设置</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">首次设置</h4>
                                </div> <!-- end page-title-box -->
                            </div> <!-- end col-->
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="text-center">
                                    <h3 class="">尊敬的新用户欢迎登录Oreo担保平台</h3>
                                    <p class="text-muted mt-3"> 系统检测到您是首次登录Oreo担保平台,
                                       因此我们需要对您进行一些简单的了解!<br/> 请在认真阅读有关说明后做出您的选择,这个对我们来说很重要!</p>
                                    <button type="button" id="MyBuyer" class="btn btn-success btn-sm mt-2"><i class="mdi mdi-email-outline mr-1"></i> 加入Oreo担保平台 </button>
                                </div>
                            </div><!-- end col -->
                        </div><!-- end row -->
        
                        <div class="row pt-5">
                            <div class="col-lg-5 offset-lg-1">
                                <!-- Question/Answer -->
                                <div>
                                    <div class="faq-question-q-box">Q.</div>
                                    <h4 class="faq-question" data-wow-delay=".1s">什么是Oreo担保平台 ？</h4>
                                    <p class="faq-answer mb-4">Oreo担保平台是基于Oreo综合服务站的一项新的独立的一项产品,在这里您可以一个账号走通整个Oreo系列产品,免除多个账号的烦恼.</p>
                                </div>
        
                                <!-- Question/Answer -->
                                <div>
                                    <div class="faq-question-q-box">Q.</div>
                                    <h4 class="faq-question">Oreo担保平台的说明 ？</h4>
                                    <p class="faq-answer mb-4">综合服务站承接担保服务, 服务过程为卖家发布产品, 买家自愿购买, 卖家发货, 买家确认收到货并且做出评价, 买家最终一旦确认收货即视为交易成功, 冻结余额打入卖家账户.</p>
                                </div>
        
                                <!-- Question/Answer -->
                                <div>
                                    <div class="faq-question-q-box">Q.</div>
                                    <h4 class="faq-question">Oreo担保平台的优点 ？</h4>
                                    <p class="faq-answer mb-4">一个账号一键式管理, 买家自愿购买, 余额冻结到平台, 先收货后确认打款, 公开公正, 记录卖家/买家信用值.</p>
                                </div>

                            </div>
                            <!--/col-md-5 -->
        
                            <div class="col-lg-5">
                                <!-- Question/Answer -->
                                <div>
                                    <div class="faq-question-q-box">Q.</div>
                                    <h4 class="faq-question">买家权利 ？</h4>
                                    <p class="faq-answer mb-4">买家自愿购买商品, 付款到平台, 买家等待收货, 买家收货并确认无误(若有卖家违约可终止交易余额原路退回), 交易完成, 做出评价, 记录卖家/买家信用值. </p>
                                </div>
        
                                <!-- Question/Answer -->
                                <div>
                                    <div class="faq-question-q-box">Q.</div>
                                    <h4 class="faq-question">卖家权利 ？</h4>
                                    <p class="faq-answer mb-4">卖家实名认证后可发布商品, 当收到买家订单应当及时做出相关事务, 卖家发货等待买家的确认(若买家存在违约可申请维权), 买家付款的冻结余额极速打入支付宝账户, 等待卖家评价, 卖家评价买家, 交易完成.</p>
                                </div>
        
                                <!-- Question/Answer -->
                                <div>
                                    <div class="faq-question-q-box">Q.</div>
                                    <h4 class="faq-question">如何成为卖家 ？</h4>
                                    <p class="faq-answer mb-4">我们在此页面进行您的初步身份确认工作, 若您想做卖家也可以在商家中心进行实名认证和填补收款账号信息, 认证完成即可成为卖家.</p>
                                </div>
        
                            </div>
                            <!--/col-md-5-->
                        </div>
                        <!-- end row -->

                    </div> <!-- content -->
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
            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->
        </div>
        <!-- END Container -->
            </div>
        </div>
        <!-- App js -->
<script src="../../assets/user/js/app.min.js"></script>
<script src="../../assets/user/js/layer.js"></script>	
<script src="//static.geetest.com/static/tools/gt.js"></script>
<script> 
                        $("#MyBuyer").click(function () {
						var MyId="<?=$pid?>";
						var ii = layer.load(2, {shade: [0.1, '#fff']});
						$.ajax({
							type: "POST",
							url: "oreo_shop_sub.php?act=MyIsBuyer",
							data: {MyId:MyId},
							dataType: 'json',
							success: function (data) {
								layer.close(ii);
								if (data.code == 1) {
									layer.alert('欢迎加入Oreo担保平台！', function(index) {
                                    layer.close(index);
                                    location.href="index.php"; 
                                    })
								}else if (data.code == 2) {
									layer.msg('请先绑定手机号');
									$('#bangdingsj').modal('show');
								}else {
									layer.alert(data.msg);
								}
							}
						});
					});	
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
							url: "oreo_shop_sub.php?act=oreo_sendcode",
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
									new invokeSettime("#sendcode2");
									layer.msg('发送成功，请注意查收！');
								} else {
									layer.alert(data.msg);
									captchaObj.reset();
								}
							}
						});
					});
					$('#sendcode2').click(function () {
						if ($(this).attr("data-lock") === "true") return;
						myphonebd=$("input[name='myphonebd']").val();
						captchaObj.verify();
					});
					
					// 更多接口参考：http://www.geetest.com/install/sections/idx-client-sdk.html
				};
				$(document).ready(function () {
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
			
</script>
</body>
</html>