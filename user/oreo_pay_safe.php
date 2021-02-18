<?php
include("../oreo/oreo.core.php");
if($islogin2==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
include './oreo_static.php';
if($userrow['action']==0){
exit("<script language='javascript'>alert('您的账号已被封禁，暂无法登陆后台');window.location.href='./login.php?logout';</script>");
}
//检测是否绑定邮箱
if($userrow['phone']==''||!$userrow['phone']){
    exit("<script language='javascript'>alert('您的账号未绑定手机号码，请先绑定手机号码再操作');window.location.href='./oreo_my.php';</script>");
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
                                            <li class="breadcrumb-item active">支付系统接口安全</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">支付系统接口安全</h4>
                                </div> <!-- end page-title-box -->
                            </div> <!-- end col-->
                        </div>
                        <!-- end page title -->
                        <div class="row">
                            <div class="col-12">
                            <div class="alert alert-success" role="alert">
                                <p class="mb-0">接口安全检测设置说明:<br>
                                1.您在这里可以设置您对接接口的动态验证，如果您允许接口信息同步于oreo云端，则当您的接口被更改（包括数据库内更改）时您会收到Oreo的通知手机短信或邮件.<br>
                                2.如果您修改了接口可以在此页面进行同步数据的操作，我们会根据你的选择来判断是否进行云端同步的操作，并且会为您专属定制安全策略.<br>  
                                3.目前此功能仅支持Oreo正式注册会员，如果您是授权码登录，建议您注册账号域名过户到本账户.<br>
                                4. 如果开启接收短信将会扣除您的oreo综合服务站中的短信数量.<br>
                                5. 如果您不同步您站点的对接信息则我们不会主动去获取您的相关信息.<br>
                                6. 短信余量充值方法为在<a href="./oreo_sms.php" target="_blank" >Oreo云短信</a> 中添加你对应的域名来获取余量.<br>
                                7. 我们将全程采用最高级别的安全验证来传输数据，并承诺您的相关信息不会明文同步到云端，将经过Oreo多次特殊加密处理.<br>
                                8. 我们将验证过程通过监控的方式放到Oreo支付系统后台，您可以到您系统内获取相关URL并且根据实际情况来挂监控（我们建议相隔时间不要少于8分钟）.<br></p></div>
                                <div class="card">
                                    <div class="card-body">
                                      <div class="text-lg-left">
                                           <button data-toggle="modal" data-target="#tianjia" data-id="tianjia" class="btn btn-success mb-2 mr-2"><i class="mdi mdi-bolnisi-cross"></i> 添加检测</button>
                                         </div>
                                        <div class="table-responsive">
                                            <table class="table table-centered mb-0 text-nowrap">
                                                <thead class="thead-light" style="text-align: center;">
                                                    <tr>
                                        <th>站点域名</th>
                                        <th>动态检测</th>
                                        <th>短信通知</th>
                                        <th>短信余量</th>
                                        <th>最近同步时间</th>
                                        <th>TOKEN</th>
									 	<th>操作</th>
                                                    </tr>
                                                </thead>
                                                <tbody style="text-align: center;">
												<?php
$numrows=$DB->query("SELECT count(*) from oreo_pay_safe WHERE user='$pid' ")->fetchColumn();
$pagesize=10;
$pages=intval($numrows/$pagesize);
if ($numrows%$pagesize)
{
 $pages++;
 }
if (isset($_GET['page'])){
$page=intval($_GET['page']);
}
else{
$page=1;
}
$offset=$pagesize*($page - 1);												
								$rs=$DB->query("SELECT * FROM oreo_pay_safe WHERE user='$pid' order by id desc limit $offset,$pagesize"); 
                                     while($row = $rs->fetch())
                                      {
                                      //查询短信余量
                                      $sms=$DB->query("SELECT * FROM oreo_tensms WHERE pid='$pid' AND domain='{$row['domain']}' limit 1 ")->fetch();  
										    if($row['detection']==1){
											$detection_in="开启";}
											else{
                                            $detection_in="关闭";}
                                            if($row['sms_type']==1){
                                            $sms_type_in="开启";}
                                            else{
                                            $sms_type_in="邮件提醒";}
                                            if($sms){
                                                $my_sms=$sms['surplus'];
                                            }else{
                                                $my_sms="无信息";
                                            }if($row['addtime']==''){
                                                $addtime_in="还未同步";}
                                            else{
                                                $addtime_in=$row['addtime'];
                                            }
                                            if($row['xieyi']=="http://"){
                                               $xieyi="1";
                                            }
                                            if($row['xieyi']=="https://"){
                                               $xieyi="2";
                                            }   
                                            echo "<tr>";
                                            echo "<td >".$row['xieyi'].$row['domain']."</td>";
											echo "<td style='display: none;'>".$row['domain']."</td>";
											echo "<td >".$detection_in."</td>";
                                            echo "<td >".$sms_type_in."</td>";
                                            echo "<td >".$my_sms."</td>";
                                            echo "<td >".$addtime_in."</td>";
                                            echo "<td style='display: none;'>".$row['detection']."</td>";
                                            echo "<td style='display: none;'>".$row['sms_type']."</td>";
                                            echo "<td style='display: none;'>".$xieyi."</td>";
                                            echo "<td >".$row['token']."</td>";
											echo "<td ><button data-toggle='modal' data-target='#tongbu' data-id='tongbu' class='btn btn-primary' >同步</button>&nbsp;&nbsp;<button data-toggle='modal' data-target='#bianji' data-id='bianji' class='btn btn-success'>编辑</button>&nbsp;&nbsp;<button data-toggle='modal' data-target='#shanchu' data-id='shanchu' class='btn btn-danger' >删除</button></td>";
											echo "</tr>";
											}
									?>
                                                </tbody>
                                            </table>
											<nav style="float: inline-end;">
<?php
echo'<ul class="pagination">';
$first=1;
$prev=$page-1;
$next=$page+1;
$last=$pages;
if ($page>1)
{
echo '<li class="page-item"><a class="page-link" href="oreo_qc.php?page='.$first.$link.'">首页</a></li>';
echo '<li class="page-item"><a class="page-link" href="oreo_qc.php?page='.$prev.$link.'">&laquo;</a></li>';

} else {
echo '<li class="page-item"><a class="page-link">首页</a></li>';

}
for ($i=1;$i<$page;$i++)
echo '<li class="page-item"><a class="page-link" href="oreo_qc.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '<li class="page-item active"><a class="page-link">'.$page.'</a></li>';
if($pages>=3)$s=3;
else $s=$pages;
for ($i=$page+1;$i<=$s;$i++)
echo '<li class="page-item"><a class="page-link" href="oreo_qc.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '';
if ($page<$pages)
{
echo '<li class="page-item"><a class="page-link" href="oreo_qc.php?page='.$next.$link.'">&raquo;</a></li>';
echo '<li class="page-item"><a class="page-link" href="oreo_qc.php?page='.$last.$link.'">尾页</a></li>';
} else {

echo '<li class="page-item"><a class="page-link">尾页</a></li>';
}
echo'</ul>';
#分页
?>
                                                </nav>
                                        </div>
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->
						 <div id="shanchu" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="text-center mt-2 mb-4">
                                                         <i class="mdi mdi-delete-forever mr-1"> 删除接口检测</i>
                                                        </div>
														<div class="form-group">
                                                    <label>域名:</label>
                                                    <div>
													 <input type="text" class="form-control ca1"  name="domains" readonly="readonly"/>
                                                     <input type="text" class="form-control ca9"  name="tokens"  style="display: none;" readonly="readonly"/>
                                                 </div>
                                                </div>
                                                <?php if($conf['mail_cloud']==1) {?> 	
												<div class="form-group">
                                                    <label>输入验证码:</label>
                                                    <div class="input-group">
                                                    <input class="form-control"type="text"name="codes"placeholder="输入邮箱验证码"required>
                                                    <input class="form-control"type="hidden"name="type_thiss" value="<?=$userrow['email'];?>">
                                                    <input class="form-control"type="hidden"name="type_this_nums"value="2">
                                                    <div class="input-group-append"><button type="button" class="btn btn-default" id="sendcode">获取验证码</button>
                                                 </div></div>
                                                </div> 
												<?php }if($conf['mail_cloud']==2) { ?>  
												<div class="form-group">
                                                    <label>输入验证码:</label>
                                                    <div class="input-group">
                                                    <input class="form-control"type="text"name="codes"placeholder="输入手机验证码"required>
                                                    <input class="form-control"type="hidden"name="type_thiss"value="<?=$userrow['phone'];?>">
                                                    <input class="form-control"type="hidden"name="type_this_nums"value="3">
                                                    <div class="input-group-append"><button type="button" class="btn btn-default" id="sendcode2">获取验证码</button>
                                                 </div></div>
                                                </div> 
												 <?php } ?> 
                                                <div class="form-group text-center">
                                                 <button class="btn btn-danger" type="button" id="shuanchul">删除</button>
                                                     </div>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->
                                        <div id="tongbu" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="text-center mt-2 mb-4">
                                                         <i class="iconfont icon-anquan mr-1">  同步接口信息</i>
                                                        </div>
														<div class="form-group">
                                                    <label>域名:</label>
                                                    <div>
													 <input type="text" class="form-control ca1"  name="domaint" readonly="readonly"/>
                                                     <input type="text" class="form-control ca9"  name="tokent" style="display: none;" readonly="readonly"/>
                                                 </div>
                                                 <small>* Oreo承诺，不获取敏感信息并且您的接口信息将特殊加密处理再以加密形式同步.</small>
                                                </div>
                                                <div class="form-group text-center">
                                                 <button class="btn btn-primary" type="button" id="SafeTongBu">同步</button>
                                                     </div>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->    
										<div id="tianjia" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="text-center mt-2 mb-4">
                                                         <i class="iconfont icon-anquan mr-1"> 添加接口安全检测</i>
                                                        </div>
                                                        <div class="form-group mb-3">
                                                        <label for="example-select">选择您的域名:</label>
                                                        <select class="form-control"  id="domain" name="domain">
                                                            <?php
													$sccs=$DB->query("SELECT * FROM `oreo_authorize`  WHERE sjid='$pid' AND authname='Oreo支付系统' ");
                                                    while ($row = $sccs->fetch()) {
						                            echo "<option value={$row['domain']}>{$row['domain']}</option>
													";
	                                                 }
					                                  ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="example-select">网站协议:</label>
                                                        <select class="form-control"  id="xieyi" name="xieyi">
                                                           <option value="1">http</option>
                                                           <option value="2">https</option>
                                                        </select>
                                                        <small>* 网站协议很重要，如果您的网站开启SSL协议请选择https协议.</small>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="example-select">动态检测:</label>
                                                        <select class="form-control"  id="detection" name="detection">
                                                           <option value="1">开启</option>
                                                           <option value="0">关闭</option>
                                                        </select>
                                                        <small>* 当开启动态检测时我们会时刻关注您网站接口动态变换情况.</small>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="example-select">短信提醒:</label>
                                                        <select class="form-control"  id="sms_type" name="sms_type">
                                                           <option value="1">开启</option>
                                                           <option value="0">关闭</option>
                                                        </select>
                                                    <small>* 当开启接受短信时，若接口发生改变且未进行同步时您将收到短信提示.</small><br>
                                                    <small>* 若您选择关闭短信提示则我们会选择邮箱发送异常信息.</small>
                                                    </div>
													<div class="form-group text-center">
                                                 <button class="btn btn-primary" type="button" id="TianjiaSafe">添加</button>
                                                     </div>
                                                     </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->
                                        <div id="bianji" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="text-center mt-2 mb-4">
                                                         <i class="iconfont icon-anquan mr-1"> 编辑接口安全检测</i>
                                                        </div>
                                                        <div class="form-group">
                                                    <label>域名:</label>
                                                    <div>
													 <input type="text" class="form-control ca1"  name="domainb"  readonly="readonly"/>
                                                 </div>
                                                 </div>
                                                 <div class="form-group mb-3">
                                                        <label for="example-select">网站协议:</label>
                                                        <select class="form-control ca8"  id="xieyib" name="xieyib">
                                                           <option value="1">http://</option>
                                                           <option value="2">https://</option>
                                                        </select>
                                                        <small>* 网站协议很重要，如果您的网站开启SSL协议请选择https协议.</small>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="example-select">动态检测:</label>
                                                        <select class="form-control ca6"  id="detectionb" name="detectionb">
                                                           <option value="1">开启</option>
                                                           <option value="0">关闭</option>
                                                        </select>
                                                        <small>* 当开启动态检测时我们会时刻关注您网站接口动态变换情况.</small>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="example-select">短信提醒:</label>
                                                        <select class="form-control ca7"  id="sms_typeb" name="sms_typeb">
                                                           <option value="1">开启</option>
                                                           <option value="0">关闭</option>
                                                        </select>
                                                    <small>* 当开启接受短信时，若接口发生改变且未进行同步时您将收到短信提示.</small><br>
                                                    <small>* 若您选择关闭短信提示则我们会选择邮箱发送异常信息.</small>
                                                    </div>
                                                    <?php if($conf['mail_cloud']==1) {?> 	
												<div class="form-group">
                                                    <label>输入验证码:</label>
                                                    <div class="input-group">
                                                    <input class="form-control"type="text"name="code"placeholder="输入邮箱验证码"required>
                                                    <input class="form-control"type="hidden"name="type_this" value="<?=$userrow['email'];?>">
                                                    <input class="form-control"type="hidden"name="type_this_num"value="2">
                                                    <div class="input-group-append"><button type="button" class="btn btn-default" id="sendcode1">获取验证码</button>
                                                 </div></div>
                                                </div> 
												<?php }if($conf['mail_cloud']==2) { ?>  
												<div class="form-group">
                                                    <label>输入验证码:</label>
                                                    <div class="input-group">
                                                    <input class="form-control"type="text"name="code"placeholder="输入手机验证码"required>
                                                    <input class="form-control"type="hidden"name="type_this"value="<?=$userrow['phone'];?>">
                                                    <input class="form-control"type="hidden"name="type_this_num"value="3">
                                                    <div class="input-group-append"><button type="button" class="btn btn-default" id="sendcode3">获取验证码</button>
                                                 </div></div>
                                                </div> 
												 <?php } ?> 
													<div class="form-group text-center">
                                                 <button class="btn btn-primary" type="button" id="BianjiSafe">编辑</button>
                                                     </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->
                                        </div>
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
<script src="../assets/user/js/app.min.js"></script>
<script src="../assets/user/js/layer.js"></script>
<script src="//static.geetest.com/static/tools/gt.js"></script>
<script> 
 $('#shanchu').on('show.bs.modal', function (event) {
      var btnThis = $(event.relatedTarget); //触发事件的按钮
      var modal = $(this);  //当前模态框
      var modalId = btnThis.data('id');   //解析出data-id的内容
      var content = btnThis.closest('tr').find('td').eq(1).text();
      modal.find('.ca1').val(content); 
      var content = btnThis.closest('tr').find('td').eq(9).text();
      modal.find('.ca9').val(content); 
});  
$('#tongbu').on('show.bs.modal', function (event) {
      var btnThis = $(event.relatedTarget); //触发事件的按钮
      var modal = $(this);  //当前模态框
      var modalId = btnThis.data('id');   //解析出data-id的内容
      var content = btnThis.closest('tr').find('td').eq(1).text();
      modal.find('.ca1').val(content); 
      var content = btnThis.closest('tr').find('td').eq(9).text();
      modal.find('.ca9').val(content); 
});  
$('#bianji').on('show.bs.modal', function (event) {
      var btnThis = $(event.relatedTarget); //触发事件的按钮
      var modal = $(this);  //当前模态框
      var modalId = btnThis.data('id');   //解析出data-id的内容
      var content = btnThis.closest('tr').find('td').eq(1).text();
      modal.find('.ca1').val(content); 
      var content = btnThis.closest('tr').find('td').eq(6).text();
      modal.find('.ca6').val(content); 
      var content = btnThis.closest('tr').find('td').eq(7).text();
      modal.find('.ca7').val(content); 
      var content = btnThis.closest('tr').find('td').eq(8).text();
      modal.find('.ca8').val(content); 
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
							url: "ajax2.php?act=sendcode",
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
                                    new invokeSettime("#sendcode1");
									new invokeSettime("#sendcode2");
                                    new invokeSettime("#sendcode3");
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
                    $('#sendcode1').click(function () {
						if ($(this).attr("data-lock") === "true") return;
						captchaObj.verify();
					});
					$('#sendcode2').click(function () {
						if ($(this).attr("data-lock") === "true") return;
						myphonebd=$("input[name='myphonebd']").val();
						captchaObj.verify();
					});
					$('#sendcode3').click(function () {
						if ($(this).attr("data-lock") === "true") return;
						myphonebd=$("input[name='myphonebd']").val();
						captchaObj.verify();
					});
					// 更多接口参考：http://www.geetest.com/install/sections/idx-client-sdk.html
				};
				$(document).ready(function () {
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
					$("#shuanchul").click(function () {
						var domain = $("input[name='domains']").val();
                        var token=$("input[name='tokens']").val();
                        var code=$("input[name='codes']").val();
                        var type_this=$("input[name='type_thiss']").val();
                        var type_this_num=$("input[name='type_this_nums']").val();
						var ii = layer.load(2, {shade: [0.1, '#fff']});
						$.ajax({
							type: "POST",
							url: "ajax2.php?act=delete_JkSafe",
							data: {domain:domain,token:token,code:code,type_this:type_this,type_this_num:type_this_num},
							dataType: 'json',
							success: function (data) {
								layer.close(ii);
								if (data.code == 1) {
									layer.alert('删除成功', function(index) {
                                    layer.close(index);
                                    location.reload();
                                    })
								} else {
									layer.alert(data.msg);
								}
							}
						});
					});	
                    $("#TianjiaSafe").click(function () {
			            var domain = $("#domain").val();	
                        var xieyi = $("#xieyi").val();	
						var detection = $("#detection").val();	
						var sms_type = $("#sms_type").val();	
						var ii = layer.load(2, {shade: [0.1, '#fff']}); 
						$.ajax({
							type: "POST",
							url: "ajax2.php?act=New_TianjiaSafe",
							data: {domain:domain,xieyi:xieyi,detection:detection,sms_type:sms_type},
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
                    $("#BianjiSafe").click(function () {	
                        var domain=$("input[name='domainb']").val();
                        var xieyi= $("#xieyib").val();	
						var detection = $("#detectionb").val();	
						var sms_type = $("#sms_typeb").val();	
                        var code=$("input[name='code']").val();
                        var type_this=$("input[name='type_this']").val();
                        var type_this_num=$("input[name='type_this_num']").val();
						var ii = layer.load(2, {shade: [0.1, '#fff']}); 
						$.ajax({
							type: "POST",
							url: "ajax2.php?act=New_BianjiSafe",
							data: {domain:domain,xieyi:xieyi,detection:detection,sms_type:sms_type,code:code,type_this:type_this,type_this_num:type_this_num},
							dataType: 'json',
							success: function (data) {
								layer.close(ii);
								if (data.code == 1) {
									layer.alert('编辑成功', function(index) {
                                    layer.close(index);
                                    location.reload();
                                    })
								} else {
									layer.alert(data.msg);
								}
							}
						});
					}); 
                    $("#SafeTongBu").click(function () {	
                        var domain=$("input[name='domaint']").val();
                        var token=$("input[name='tokent']").val();
						var ii = layer.load(2, {shade: [0.1, '#fff']}); 
						$.ajax({
							type: "POST",
							url: "ajax2.php?act=Tongbu_safe_Jk",
							data: {domain:domain,token:token},
							dataType: 'json',
							success: function (data) {
								layer.close(ii);
								if (data.code == 1) {
									layer.alert('同步成功', function(index) {
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