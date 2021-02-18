<?php
include("../../oreo/oreo.core.php");
if($islogin2==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
include './oreo_shop_static.php';
if($userrow['action']==0){
exit("<script language='javascript'>alert('您的账号已被封禁，暂无法登陆后台');window.location.href='./login.php?logout';</script>");
}
if($Shop_user['activation']!=2){
exit('<script language="javascript">swal("无权操作","实名认证用户才能发布产品", "error", {button: "明白",}).then(function () {window.location.href="./oreo_shop_my.php"});</script>');
}
//验证Token
$module = $_POST['module'];
$timestamp = $_POST['timestamp'];
$token = md5($module.'#$@%!^*'.$timestamp);
if($token != $_POST['token']){
exit('<script language="javascript">swal("非法数据来源","我们将记录您的非法操作并作出相应的处罚！", "error", {button: "明白",}).then(function () {window.location.href="./oreo_shop_my.php"});</script>');
}//验证token结束
$out_trade_no = $_POST['out_trade_no'];//订单号
$shop_type = $_POST['shops_types'];//订单号
$status = $_POST['status'];//付款状态
$endtime = $_POST['endtime'];//完成时间
$money = $_POST['money'];//付款金额
$adtime = $_POST['adtime'];//创建时间

$uids = $_POST['uids'];//付款id
$ordertext = $_POST['order_text'];//商品备注


$maijia = $_POST['seller'];//卖家id
$shopname = $_POST['ordername'];//商品名称

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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">卖家中心</a></li>
                                            <li class="breadcrumb-item active">订单管理</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">订单管理</h4>
                                </div> <!-- end page-title-box -->
                            </div> <!-- end col-->
                        </div>
                        <!-- end page title -->


                        <div class="row">
                            <div class="col-md-8">
                                <!-- project card -->
                                <div class="card d-block">
                                    <div class="card-body">
                                        
                                        <!-- project title-->
                                        <h3 class="mt-0">
                                           #<?=$out_trade_no?>
                                        </h3>
										<?php if($status==0&&$shop_type==0){?>
                                        <div class="badge badge-danger mb-3">买家未付款</div>
										<?php }if($status==1&&$shop_type==0){?>
										 <div class="badge badge-primary mb-3">请确认订单</div>
										<?php }if($status==1&&$shop_type==1){?>
										 <div class="badge badge-info mb-3">请极速备货</div>
										<?php }if($status==1&&$shop_type==2){?>
										 <div class="badge badge-success mb-3">您已发货</div>
										<?php }if($status==1&&$shop_type==3){?>
										 <div class="badge badge-success mb-3">买家已确认收货</div>
										<?php }if($status==1&&$shop_type==4){?>
										<div class="badge badge-secondary mb-3">退款成功</div>
										<?php }if($status==1&&$shop_type==5){?>
										<div class="badge badge-dark mb-3">人工审核退款</div>
                                        <?php }?>
                                        <h5>商品买家备注:</h5>

                                        <p class="text-muted mb-2">
                                            <?=$ordertext?>
                                        </p>

                                        
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="mb-4">
                                                    <h5>订单付款时间</h5>
                                                     <p>1111</p>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-4">
                                                    <h5>订单完成时间</h5>
                                                    <p><?=$endtime?></p>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-4">
                                                    <h5>订单金额</h5>
                                                   <p>¥<?=$money?></p>
                                                </div>
                                            </div>
                                        </div>
                                            <div class="d-print-none mt-4">
                                            <div class="text-right">
											<?php if($status==0&&$shop_type==0){?>
											<?php }if($status==1&&$shop_type==0){?>
												<button data-toggle="modal" data-target="#fukuan" data-id="fukuan" class="btn btn-success"> 接单</button>
												<button id="id" uin="<?php echo $out_trade_no;?>"  class="btn btn-danger nocheck recheck"> 退款</button>
											<?php }if($status==1&&$shop_type==1){?>	
											<button type="button" class="btn btn-danger" disabled="">发货</button>
											<?php }if($status==1&&$shop_type==2){?>	
											<button type="button" class="btn btn-danger" disabled="">等待卖家确认收货</button>
											<?php }if($status==1&&$shop_type==3){?>	
											<button type="button" class="btn btn-success" disabled="">交易完成</button>
											<?php }if($status==1&&$shop_type==4){?>	
											<button type="button" class="btn btn-dark" disabled="">退款完成</button>
											<?php }if($status==1&&$shop_type==5){?>	
                                            <button type="button" class="btn btn-warning" disabled="">该订单退款进入人工审核</button>
										   <?php }?>	
											</div>
                                        </div>   
                                    </div> <!-- end card-body-->
                                    
                                </div> <!-- end card-->


                                <!-- end card-->
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

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>


        <!-- App js -->
<script src="../../assets/user/js/app.min.js"></script>
<script src="../../assets/user/js/layer.js"></script>
<script> 
var transnum = 0;
	$('.recheck').click(function(){
		var self=$(this),
			id=self.attr('uin');
			module=<?=$module;?>;
			timestamp=<?=time();?>;
		    token="<?=md5($module.'#$@%!^*'.time());?>";
		var url="oreo_shop_apply_seller.php";
        
		self.html("<div class='spinner-grow text-light m-2' role='status'></div>");
		
		xiha.postData(url,{id:id,module:module,timestamp:timestamp,token:token}, function(d) {
			if(d.code==0){
				if(d.ret==1){
					self.html('退款完成');
				}else if(d.ret==2){
					self.html('退款完成');
					window.history.go(0)
				}else{
					self.html('自动退款失败');
				}
				$('#res'+id).html('<font color="blue">'+d.result+'</font>');
				$('.uins[value='+id+']').attr('checked',false);
				self.removeClass('nocheck');
			}else if(d.code==3){
				self.html('自动退款失败');
				alert(d.msg);
			}else if(d.code==5){
			swal(d.msg,"该订单进入人工审批退款", "error", {
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
				self.html('自动退款失败');
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
$("#shouhuo").click(function () {
	                    module=<?=$module;?>;
			            timestamp=<?=time();?>;
						shop_num="<?=$out_trade_no;?>";
		                token="<?=md5($module.'#$@%!^*'.time());?>";
						var shop_type = $("#shop_type").val();
						var ii = layer.load(2, {shade: [0.1, '#fff']});
						$.ajax({
							type: "POST",
							url: "oreo_shop_sub.php?act=Order_evaluation",
							data: {shop_num:shop_num,shop_type:shop_type,module:module,timestamp:timestamp,token:token},
							dataType: 'json',
							success: function (data) {
								layer.close(ii);
								if (data.code == 1) {
									layer.alert('评价成功', function(index) {
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