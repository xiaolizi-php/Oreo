<?php
include("../../oreo/oreo.core.php");
if($islogin2==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
include './oreo_shop_static.php';
if($userrow['action']==0){
exit("<script language='javascript'>alert('您的账号已被封禁，暂无法登陆后台');window.location.href='./login.php?logout';</script>");
}
if(!$_POST)exit("<script language='javascript'>window.location.href='./index.php';</script>");
//验证Token
$module = $_POST['module'];
$timestamp = $_POST['timestamp'];
$token = md5($module.'#$@%!^*'.$timestamp);
if($token != $_POST['token']){
exit('<script language="javascript">swal("非法数据来源","我们将记录您的非法操作并作出相应的处罚", "error", {button: "明白",}).then(function () {window.location.href="./oreo_shop_real_add.php"});</script>');
}//验证token结束

//查看实名是否提交
$real_info=$DB->query("select * from oreo_shop_real where user='{$pid}' limit 1")->fetch();
$order=$DB->query("SELECT * FROM oreo_shop_details WHERE name='oreo实名认证' and user='$pid' and status='1' limit 1")->fetch();
$real_num=$order['out_trade_no'];
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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">商家中心</a></li>
                                            <li class="breadcrumb-item active">实名认证</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">补充实名认证</h4>
                                </div> <!-- end page-title-box -->
                            </div> <!-- end col-->
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
							<div class="alert alert-success" role="alert">
                        <p class="mb-0">说明：<br/>
						<a style="text-indent: 2em;">1.身份证与姓名全国公安联网查询真实性.</a><br>
                        <a style="text-indent: 2em;">2.提现支付宝账户姓名必须与提交的身份证信息一致.</a><br>
						<a style="text-indent: 2em;">3.认证为公安联网认证，准确性为100%，无论验证成功或失败每次将扣除0.1元的查询费.</a><br>
						<a style="text-indent: 2em;">4.我们将验证外其余的余额原路极速退回.</a><br>
                         </div>  
                                <div class="card">
                                    <div class="card-body">
                                        <?php if(!$real_info){?>
                                               <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label">提现支付宝账户</label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" name="alipay_id" class="form-control" placeholder="支付宝账号">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label">真实姓名</label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" name="real_name" class="form-control" placeholder="与支付宝账号和身份证信息保持一致的姓名">
                                                                    </div>
                                                                </div>
																<div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label">身份证号码</label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" name="sfnumber" class="form-control" placeholder="18位身份证号码">
                                                                    </div>
                                                                </div>
                                             <div class="button-list mt-3" style="text-align: center;">
										     <button  name="tjrz" value="tjrz" id="go" onclick="tjrz()" class="btn btn-success"><i class="iconfont icon-queren"></i> 验证信息</button>
                                            </div>
										<?php }if($real_info['activation']==3){?>
									              <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label">提现支付宝账户</label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" name="alipay_id" class="form-control" value="<?=$real_info['alipay_id']?>" readonly="readonly">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row mb-3">
                                                                    <label class="col-md-3 col-form-label">真实姓名</label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" name="real_name" class="form-control" value="<?=$real_info['real_name']?>" readonly="readonly">
                                                                    </div>
                                                                </div>
                                             <div class="button-list mt-3" style="text-align: center;">
										     <button id="id"  class="btn btn-success nocheck recheck"><i class="iconfont icon-queren"></i> 验证支付宝</button>
                                            </div>
									  <?php }if($real_info['activation']==2){?>	
									         <div class="row clearfix" style="text-align: center;">
						 <div class="col-lg-3 col-md-4">
                                <img src="../../assets/user/images/yishiming.png" alt="Raised Image" class="rounded" style="width: 200px;height: 200px;margin: 3em auto;display: block;">
                            </div> 
                              <div class="col-lg-4 col-md-4">
									<table class="table table-bordered">
							      <thead>
									<tr>
    							      <th colspan="3" style="background-color: #f1f5f9;"><center style="color: #56688A;">认证信息</center></th>
     							   </tr>
    							  </thead>
    							  <tbody>
    							    <tr>
    							      <th scope="row">姓名：</th>
    							      <td><?=$real_info['real_name']?></td>
    							      <th scope="row"><span class="iconfont icon-lujing" style="text-align: center;display: block;color: #50d38a !important;"></span></th>
    							    </tr>
    							    <tr>
     							     <th scope="row">证件：</th>
      							    <td><?=$real_info['sfnumber']?></td>
    							      <th scope="row"><span class="iconfont icon-lujing" style="text-align: center;display: block;color: #50d38a !important;"></span></th>
      							  </tr>
								  <tr>
     							     <th scope="row">性别：</th>
     							     <td><?=$real_info['sex']?></td>
    							      <th scope="row"><span class="iconfont icon-lujing" style="text-align: center;display: block;color: #50d38a !important;"></span></th>
    							    </tr>
     							   <tr>
     							     <th scope="row">提现账号：</th>
     							     <td><?=$real_info['alipay_id']?></td>
    							      <th scope="row"><span class="iconfont icon-lujing" style="text-align: center;display: block;color: #50d38a !important;"></span></th>
    							    </tr>
									<tr>
     							     <th scope="row">卖家权限：</th>
     							     <td style="color: #50d38a !important;">已开启</td>
    							      <th scope="row"><span class="iconfont icon-lujing" style="text-align: center;display: block;color: #50d38a !important;"></span></th>
    							    </tr>
    							  </tbody>
								</table>
								</div>
					   </div>
									   <?php }?>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->
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
        <!-- App js -->
<script src="../../assets/user/js/app.min.js"></script>
<script src="../../assets/user/js/layer.js"></script>
<script>
function tjrz(){
		var rzForm = new FormData(); 
		rzForm.append("tjrz","tjrz"); 
		rzForm.append("alipay_id",$("input[name='alipay_id']").val()); 
		rzForm.append("sfnumber",$("input[name='sfnumber']").val()); 
		rzForm.append("real_name",$("input[name='real_name']").val()); 
		var ii = layer.load(2, {shade: [0.1, '#fff']});
		$.ajax({
			url: "oreo_shop_sub.php?act=edit_My_Real",
			type : "POST",
			dataType : 'JSON', 
			data : rzForm,
			cache: false,
			processData: false,
			contentType: false,
			success: function (data) {
								layer.close(ii);
								if (data.code == 1) {
									layer.alert('验证成功，请继续完成支付宝验证!', function(index) {
                                    layer.close(index);
                                    location.reload();
                                    })
								} else {
									layer.alert(data.msg);
								}
							}
        })
	}	
	var transnum = 0;
	$('.recheck').click(function(){
		var self=$(this),
			id="<?=$real_num;?>";
			module=<?=$module;?>;
			timestamp=<?=time();?>;
		    token="<?=md5($module.'#$@%!^*'.time());?>";
		var url="oreo_shop_apply.php";
        
		self.html("<div class='spinner-grow text-light m-2' role='status'></div>");
		
		xiha.postData(url,{id:id,module:module,timestamp:timestamp,token:token}, function(d) {
			if(d.code==0){
				if(d.ret==1){
					self.html('认证成功');
				}else if(d.ret==2){
					self.html('认证成功');
					window.history.go(0)
				}else{
					self.html('认证失败');
				}
				$('#res'+id).html('<font color="blue">'+d.result+'</font>');
				$('.uins[value='+id+']').attr('checked',false);
				self.removeClass('nocheck');
			}else if(d.code==3){
				self.html('认证失败');
				alert(d.msg);
			}else if(d.code==5){
			swal(d.msg,"认证失败", "error", {
            button: "明白",
            }).then(function () {
            window.history.go(0)
            });
			}else if(d.code==6){
			swal("无权自动退款",d.msg, "error", {
            button: "明白",
            }).then(function () {
            window.history.go(0)
            });
			}else if(d.code==7){
			swal("非法数据来源",d.msg, "error", {
            button: "明白",
            }).then(function () {
            window.history.go(0)
            });
			}else{
				self.html('认证失败');
				alert(d.msg);
			}
		});
	});
var xiha={
	postData: function(url, parameter, callback, dataType, ajaxType) {
		if(!dataType) dataType='json';
		$.ajax({
			type: "POST",
			url: url,
			async: true,
			dataType: dataType,
			json: "callback",
			data: parameter,
			success: function(data,status) {
				if (callback == null) {
					return;
				}
				callback(data);
			},
			error: function(error) {
				//alert('创建连接失败');
			}
		});
	}
}
</script>	
    </body>
</html>