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
                                                <li class="breadcrumb-item active">支付通道配置</li>
                                            </ol>
                                        </div>
                                        <h4 class="page-title">支付通道配置</h4>
                                    </div>
                                </div>
                            </div>
                            <!-- end page title end breadcrumb -->
                            <div class="row">
                                <div class="col-lg98-6">
                                    <div class="card m-b-30">
                                        <div class="card-body">
                                            <h4 class="mt-0 header-title">支付通道配置说明</h4>
                                            <p class="text-muted m-b-30 font-14">在这里您可以设置平台支付通道有关参数，请认真填写每一项，否则可能用户无法付款（请先确保您有第三方或第四方收付款权限）！</p>
                                                <div class="form-group">
                                                    <label>支付宝对接通道</label>
                                                    <select  class="form-control" name="alipay_mode"  id="alipay_mode" onchange="api_qh('ali',this.value)">
                                                      <option value="1" <?=$conf['alipay_mode']==1?"selected":""?> >官方通道</option>
                                                      <option value="2" <?=$conf['alipay_mode']==2?"selected":""?> >易支付</option>
                                                      <option value="0" <?=$conf['alipay_mode']==0?"selected":""?> >（关闭）开启维护模式</option>
                                                   </select>
                                                </div>
                                                <!--对接支付宝官方信息-->
                                                 <div id="ali_gf_info" style="<?php echo $conf['alipay_mode'] == 1 ? "" : "display: none;";?>" > 
                                                 <div class="form-group">
                                                    <label>合作身份者ID</label>
                                                    <div>
                                                      <input type="text" class="form-control" name="ali_api_partner"   value="<?php echo $conf['ali_api_partner']; ?>" class="form-control"/>
                                                      <small> * 合作身份者id，以2088开头的16位纯数字</small>
                                                     </div>
	                                                 </div>
                                                   <div class="form-group">
                                                    <label>支付宝收款账号</label>
                                                    <div>
                                                      <input type="text" class="form-control" name="ali_api_seller_email"   value="<?php echo $conf['ali_api_seller_email']; ?>" class="form-control"/>
                                                      <small> * 收款支付宝账号</small>
                                                     </div>
	                                                  </div>
                                                   <div class="form-group">
                                                    <label>安全检验码</label>
                                                    <div>
                                                      <input type="text" class="form-control" name="ali_api_key"   value="<?php echo $conf['ali_api_key']; ?>" class="form-control"/>
                                                      <small> * 安全检验码，以数字和字母组成的32位字符</small>
                                                     </div>
	                                                 </div></div>
                                                   <!-- END 对接支付宝官方信息-->
                                                   <!--对接易支付信息-->
                                                 <div id="ali_epay_info" style="<?php echo $conf['alipay_mode'] == 2 ? "" : "display: none;";?>" > 
                                                 <div class="form-group">
                                                    <label>易支付地址</label>
                                                    <div>
                                                      <input type="text" class="form-control" name="ali_epay_api_url"   value="<?php echo $conf['ali_epay_api_url']; ?>" class="form-control"/>
                                                      <small> * 网站的URL地址 例如:https://pay.oreopay.com/</small>
                                                     </div>
	                                                 </div>
                                                   <div class="form-group">
                                                    <label>易支付商户ID</label>
                                                    <div>
                                                      <input type="text" class="form-control" name="ali_epay_api_id"   value="<?php echo $conf['ali_epay_api_id']; ?>" class="form-control"/>
                                                       <small> * 易支付商户ID</small>
                                                     </div>
	                                                 </div>
                                                   <div class="form-group">
                                                    <label>易支付秘钥</label>
                                                    <div>
                                                      <input type="text" class="form-control" name="ali_epay_api_key"   value="<?php echo $conf['ali_epay_api_key']; ?>" class="form-control"/>
                                                      <small> * 易支付商户密钥(KEY)，以数字和字母组成的32位字符</small>
                                                     </div>
	                                                 </div></div>
                                                   <!-- END 对接易支付信息-->
                                                    <!--关闭通道维护信息-->
                                                   <div id="ali_close_info" style="<?php echo $conf['alipay_mode'] == 0 ? "" : "display: none;";?>">
                                                     <div class="form-group">
                                                       <label>若关闭登录则维护提示信息</label>
                                                       <div>
                                                       <textarea  placeholder="Oreo支付系统提醒您：管理员已开启商户登录维护模式，请稍后重试！！" name="ali_close_info"  id="ali_close_info" rows="4" class="form-control"><?php echo $conf['ali_close_info']; ?></textarea>
                                                       <small>* 维护通知</small>
                                                  </div>
                                                </div></div><br/><hr class="hr97">
                                                   <!-- END 关闭通道维护信息-->
												   <!-- 微信支付对接通道配置 -->
                                                   <div class="form-group" >
                                                    <label>微信支付对接通道</label>
                                                    <select  class="form-control" name="wxpay_mode"  id="wxpay_mode" onchange="api_qh('wx',this.value)">
                                                      <option value="1" <?=$conf['wxpay_mode']==1?"selected":""?> >官方通道</option>
                                                      <option value="2" <?=$conf['wxpay_mode']==2?"selected":""?> >易支付</option>
                                                      <option value="0" <?=$conf['wxpay_mode']==0?"selected":""?> >（关闭）开启维护模式</option>
                                                   </select>
                                                </div>
                                                   <!--对接微信官方信息-->
                                                   <div id="wx_gf_info" style="<?php echo $conf['wxpay_mode'] == 1 ? "" : "display: none;";?>" >
												    <small style="color: red;"> * 小奥 缺乏对微信官方测试的条件，如您要对接官方请先自己做测试，有问题给小奥反馈！</small>
                                                   <div class="form-group">
                                                    <label>微信支付APPID:</label>
                                                    <div>
                                                      <input type="text" class="form-control" name="wx_api_appid"   value="<?php echo $conf['wx_api_appid']; ?>" class="form-control"/>
                                                      <small> * 绑定支付的APPID（必须配置，开户邮件中可查看）</small>
                                                     </div>
	                                                 </div>
                                                   <div class="form-group">
                                                    <label>微信支付MCHID</label>
                                                    <div>
                                                      <input type="text" class="form-control" name="wx_api_mchid"   value="<?php echo $conf['wx_api_mchid']; ?>" class="form-control"/>
                                                      <small> * MCHID：商户号（必须配置，开户邮件中可查看）</small>
                                                     </div>
	                                                  </div>
                                                      <div class="form-group">
                                                    <label>商户支付密钥</label>
                                                    <div>
                                                      <input type="text" class="form-control" name="wx_api_key"   value="<?php echo $conf['wx_api_key']; ?>" class="form-control"/>
                                                      <small> * KEY：商户支付密钥，参考开户邮件设置（必须配置，登录商户平台自行设置）设置地址：https://pay.weixin.qq.com/index.php/account/api_cert</small>
                                                     </div>
	                                                  </div>
                                                   <div class="form-group">
                                                    <label>微信支付APPSECRET</label>
                                                    <div>
                                                      <input type="text" class="form-control" name="wx_api_appsecret"   value="<?php echo $conf['wx_api_appsecret']; ?>" class="form-control"/>
                                                      <small> *APPSECRET：公众帐号secert（仅JSAPI支付的时候需要配置， 登录公众平台，进入开发者中心可设置）获取地址：https://mp.weixin.qq.com/advanced/advanced?action=dev&t=advanced/dev&token=2005451881&lang=zh_CN</small>
                                                     </div>
	                                                 </div></div>
                                                    <!-- END 对接支付宝官方信息-->
													  <!--对接易支付信息-->
                                                   <div id="wx_epay_info" style="<?php echo $conf['wxpay_mode'] == 2 ? "" : "display: none;";?>" > 
                                                   <div class="form-group">
                                                    <label>易支付地址</label>
                                                    <div>
                                                      <input type="text" class="form-control" name="wx_epay_api_url"   value="<?php echo $conf['wx_epay_api_url']; ?>" class="form-control"/>
                                                      <small> * 网站的URL地址 例如:https://pay.oreopay.com/</small>
                                                     </div>
	                                                 </div> 
                                                   <div class="form-group">
                                                    <label>易支付商户ID</label>
                                                    <div>
                                                      <input type="text" class="form-control" name="wx_epay_api_id"   value="<?php echo $conf['wx_epay_api_id']; ?>" class="form-control"/>
                                                       <small> * 易支付商户ID</small>
                                                     </div>
	                                                 </div>
                                                   <div class="form-group">
                                                    <label>易支付秘钥</label>
                                                    <div>
                                                      <input type="text" class="form-control" name="wx_epay_api_key"   value="<?php echo $conf['wx_epay_api_key']; ?>" class="form-control"/>
                                                      <small> * 易支付商户密钥(KEY)，以数字和字母组成的32位字符</small>
                                                     </div>
	                                                 </div></div>
													 <!-- END 对接易支付信息-->
                                                    <!--关闭通道维护信息-->
                                                   <div id="wx_close_info" style="<?php echo $conf['wxpay_mode'] == 0 ? "" : "display: none;";?>">
                                                     <div class="form-group">
                                                       <label>若关闭登录则维护提示信息</label>
                                                       <div>
                                                       <textarea  placeholder="Oreo支付系统提醒您：管理员已开启微信支付通道维护模式，请稍后重试！！" name="wx_close_info" id="wx_close_info" rows="4" class="form-control"><?php echo $conf['wx_close_info']; ?></textarea>
                                                       <small>* 维护通知</small>
                                                  </div>
                                                </div></div><br/><hr class="hr97">
												  <!-- END 关闭通道维护信息-->
                                                   <!-- QQ钱包对接通道配置 -->
                                                   <div class="form-group">
                                                    <label>QQ钱包对接通道</label>
                                                    <select  class="form-control" name="qqpay_mode" id="qqpay_mode" onchange="api_qh('qq',this.value)">
                                                      <option value="1" <?=$conf['qqpay_mode']==1?"selected":""?> >官方通道</option>
                                                      <option value="2" <?=$conf['qqpay_mode']==2?"selected":""?> >易支付</option>
                                                      <option value="0" <?=$conf['qqpay_mode']==0?"selected":""?> >（关闭）开启维护模式</option>
                                                   </select>
                                                </div>
                                                   <!--对接QQ官方信息-->
                                                   <div id="qq_gf_info" style="<?php echo $conf['qqpay_mode'] == 1 ? "" : "display: none;";?>" > 
                                                   <small style="color: red;"> * 小奥 缺乏对QQ官方测试的条件，如您要对接官方请先自己做测试，有问题给小奥反馈！</small>
												   <div class="form-group">
                                                    <label>QQ钱包MCHID:</label>
                                                    <div>
                                                      <input type="text" class="form-control" name="qq_api_mchid"   value="<?php echo $conf['qq_api_mchid']; ?>" class="form-control"/>
                                                      <small> * QQ钱包商户号</small>
                                                     </div>
	                                                 </div>
                                                   <div class="form-group">
                                                    <label>QQ钱包MCHKEY:</label>
                                                    <div>
                                                      <input type="text" class="form-control" name="qq_api_mchkey"   value="<?php echo $conf['qq_api_mchkey']; ?>" class="form-control"/>
                                                      <small> * 于QQ钱包商户平台(http://qpay.qq.com/)获取</small>
                                                     </div>
	                                                 </div></div>
                                                      <!-- END 对接QQ官方信息-->
													  <!--对接易支付信息-->
                                                     <div id="qq_epay_info" style="<?php echo $conf['qqpay_mode'] == 2 ? "" : "display: none;";?>" > 
                                                   <div class="form-group">
                                                    <label>易支付地址</label>
                                                    <div>
                                                      <input type="text" class="form-control" name="qq_epay_api_url"   value="<?php echo $conf['qq_epay_api_url']; ?>" class="form-control"/>
                                                      <small> * 网站的URL地址 例如:https://pay.oreopay.com/</small>
                                                     </div>
	                                                 </div> 
                                                   <div class="form-group">
                                                    <label>易支付商户ID</label>
                                                    <div>
                                                      <input type="text" class="form-control" name="qq_epay_api_id"   value="<?php echo $conf['qq_epay_api_id']; ?>" class="form-control"/>
                                                       <small> * 易支付商户ID</small>
                                                     </div>
	                                                 </div> 
                                                   <div class="form-group">
                                                    <label>易支付秘钥</label>
                                                    <div>
                                                      <input type="text" class="form-control" name="qq_epay_api_key"   value="<?php echo $conf['qq_epay_api_key']; ?>" class="form-control"/>
                                                      <small> * 易支付商户密钥(KEY)，以数字和字母组成的32位字符</small>
                                                     </div>
	                                                 </div></div>
                                                      <!-- END 对接易支付信息-->
                                                    <!--关闭通道维护信息-->
                                                   <div id="qq_close_info" style="<?php echo $conf['qqpay_mode'] == 0 ? "" : "display: none;";?>">
                                                     <div class="form-group">
                                                       <label>若关闭登录则维护提示信息</label>
                                                       <div>
                                                       <textarea  placeholder="Oreo支付系统提醒您：管理员已开启微信支付通道维护模式，请稍后重试！！" name="qq_close_info" rows="4" class="form-control"><?php echo $conf['qq_close_info']; ?></textarea>
                                                       <small>* 维护通知</small>
                                                  </div>
                                                </div></div>
												  <!-- END 关闭通道维护信息-->											                                                
                                                <div class="form-group m-b-0">
                                                    <div>
                                                        <button type="button" id="editPayset"  value="保存修改" class="btn btn-primary waves-effect waves-light" >
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
                <?php include'oreo_foot.php';?>
<script>
function api_qh(type,val){
    var alipay  = $("#"+type+"_gf_info");
	var alipaydm  = $("#"+type+"_dm_info");
    var epay =  $("#"+type+"_epay_info");
    var codepay =  $("#"+type+"_codepay_info");
	var eshanghu =  $("#"+type+"_eshanghu_info");
    var cloes = $("#"+type+"_close_info");
    if(val == 1){
       $(alipay).show()
	   $(alipaydm).hide()
       $(epay).hide();
       $(codepay).hide();
	   $(eshanghu).hide();
       $(cloes).hide();
       
    }
    if(val == 2){
       $(alipay).hide()
	   $(alipaydm).hide()
       $(epay).show();
       $(codepay).hide();
	   $(eshanghu).hide();
       $(cloes).hide();
    }
    if(val == 3){
       $(alipay).hide()
	   $(alipaydm).hide()
       $(epay).hide();
       $(codepay).show();
	   $(eshanghu).hide();
       $(cloes).hide();
    }
      if(val == 0){
       $(alipay).hide()
	   $(alipaydm).hide()
       $(epay).hide();
       $(codepay).hide();
	   $(eshanghu).hide();
       $(cloes).show();
    }
	if(val == 4){
       $(alipay).hide()
	   $(alipaydm).show()
       $(epay).hide();
       $(codepay).hide();
       $(cloes).hide();
	   $(eshanghu).show();
    }
}
                        $("#editPayset").click(function () {
					    var alipay_mode = $("#alipay_mode").val();
                        var ali_api_partner=$("input[name='ali_api_partner']").val();
						var ali_api_seller_email=$("input[name='ali_api_seller_email']").val();
						var ali_api_key=$("input[name='ali_api_key']").val();
						var ali_epay_api_url=$("input[name='ali_epay_api_url']").val();
						var ali_epay_api_id=$("input[name='ali_epay_api_id']").val();
						var ali_epay_api_key=$("input[name='ali_epay_api_key']").val();
						var ali_close_info=$("textarea[name='ali_close_info']").val();
						var wxpay_mode = $("#wxpay_mode").val();
						var wx_api_appid=$("input[name='wx_api_appid']").val();
						var wx_api_mchid=$("input[name='wx_api_mchid']").val();
						var wx_api_key=$("input[name='wx_api_key']").val();
						var wx_api_appsecret=$("input[name='wx_api_appsecret']").val();
						var wx_epay_api_url=$("input[name='wx_epay_api_url']").val();
						var wx_epay_api_id=$("input[name='wx_epay_api_id']").val();
						var wx_epay_api_key=$("input[name='wx_epay_api_key']").val();
						var wx_close_info=$("textarea[name='wx_close_info']").val();
						var qqpay_mode = $("#qqpay_mode").val();
						var qq_api_mchid=$("input[name='qq_api_mchid']").val();
						var qq_api_mchkey=$("input[name='qq_api_mchkey']").val();
						var qq_epay_api_url=$("input[name='qq_epay_api_url']").val();
						var qq_epay_api_id=$("input[name='qq_epay_api_id']").val();
						var qq_epay_api_key=$("input[name='qq_epay_api_key']").val();
						var qq_close_info=$("textarea[name='qq_close_info']").val();
						var ii = layer.load(2, {shade: [0.1, '#fff']});
						$.ajax({
							type: "POST",
							url: "ajax.php?act=edit_Payset",
							data: {alipay_mode:alipay_mode,ali_api_partner:ali_api_partner,ali_api_seller_email:ali_api_seller_email,ali_api_key:ali_api_key,ali_epay_api_url:ali_epay_api_url,ali_epay_api_id:ali_epay_api_id,ali_epay_api_key:ali_epay_api_key,ali_close_info:ali_close_info,
wxpay_mode:wxpay_mode,wx_api_appid:wx_api_appid,wx_api_mchid:wx_api_mchid,wx_api_key:wx_api_key,wx_api_appsecret:wx_api_appsecret,wx_epay_api_url:wx_epay_api_url,wx_epay_api_id:wx_epay_api_id,wx_epay_api_key:wx_epay_api_key,wx_close_info:wx_close_info,qqpay_mode:qqpay_mode,qq_api_mchid:qq_api_mchid,
qq_api_mchkey:qq_api_mchkey,qq_epay_api_url:qq_epay_api_url,qq_epay_api_id:qq_epay_api_id,qq_epay_api_key:qq_epay_api_key,qq_close_info:qq_close_info},
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
					var items = $("select[default]");
for (i = 0; i < items.length; i++) {
	$(items[i]).val($(items[i]).attr("default"));
}  
</script>        
    </body>
</html>