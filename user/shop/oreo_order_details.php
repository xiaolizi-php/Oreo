<?php
include("../../oreo/oreo.core.php");
if($islogin2==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
include './oreo_shop_static.php';
if($userrow['action']==0){
exit("<script language='javascript'>alert('您的账号已被封禁，暂无法登陆后台');window.location.href='./login.php?logout';</script>");
}
if(!$_GET)exit("<script language='javascript'>window.history.back(-1);</script>");
$out_trade_no=$_GET['shop_code'];//商品交易单号
$shop_cx=$DB->query("select * from oreo_shop_details where out_trade_no='$out_trade_no' and user='$pid' limit 1")->fetch();
if($shop_cx['shop_type']==4||$shop_cx['shop_type']==5){
$tuikuan=$DB->query("select * from oreo_shop_apply where odd_numbers='$out_trade_no' and user='$pid' limit 1")->fetch();
}
//查看商品是否存在或接单状态
$shops_info=$DB->query("select * from oreo_shop_guarantee where unique_code='{$shop_cx['unique_code']}' limit 1")->fetch();
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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">服务市场</a></li>
                                            <li class="breadcrumb-item active">订单详情</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">订单详情</h4>
                                </div> <!-- end page-title-box -->
                            </div> <!-- end col-->
                        </div>
                        <!-- end page title -->
                        <div class="row justify-content-center">
                            <div class="col-lg-7 col-md-10 col-sm-11">
                                <div class="horizontal-steps mt-4 mb-4 pb-5">
								 <?php if($shop_cx['status']==0){?>
                                    <div class="horizontal-steps-content text-nowrap">
                                            <div class="step-item current">
											<span data-toggle="tooltip" data-placement="bottom" title="" data-original-title="20/08/2018 07:24 PM">待付款</span>
											</div>
											<div class="step-item">
											 <span>待卖家确认</span>
                                            </div>
                                            <div class="step-item">
                                            <span>已发货</span>
                                            </div>
                                            <div class="step-item">
                                            <span>完成</span>
                                            </div>
                                    </div>
                                    <div class="process-line" style="width: 0%;"></div>
									<?php }if($shop_cx['status']==1&&$shop_cx['shop_type']==0){?>
                                    <div class="horizontal-steps-content text-nowrap">
                                            <div class="step-item">
											<span data-toggle="tooltip" data-placement="bottom" title="" data-original-title="<?=$shop_cx['endtime'];?>">已付款</span>
											</div>
											<div class="step-item current">
											 <span>待卖家确认</span>
                                            </div>
                                            <div class="step-item">
                                            <span>已发货</span>
                                            </div>
                                            <div class="step-item">
                                            <span>完成</span>
                                            </div>
                                    </div>
                                    <div class="process-line" style="width: 33%;"></div>
									<?php }if($shop_cx['status']==1&&$shop_cx['shop_type']==1){?>
                                    <div class="horizontal-steps-content text-nowrap">
                                            <div class="step-item">
											<span data-toggle="tooltip" data-placement="bottom" title="" data-original-title="<?=$shop_cx['endtime'];?>">已付款</span>
											</div>
											<div class="step-item current">
											 <span data-toggle="tooltip" data-placement="bottom" title="" data-original-title="<?=$shop_cx['seller_adtime'];?>">卖家接单</span>
                                            </div>
                                            <div class="step-item">
                                            <span>已发货</span>
                                            </div>
                                            <div class="step-item">
                                            <span>完成</span>
                                            </div>
                                    </div>
                                    <div class="process-line" style="width: 33%;"></div>
									<?php }if($shop_cx['status']==1&&$shop_cx['shop_type']==2){?>
                                    <div class="horizontal-steps-content text-nowrap">
                                            <div class="step-item">
											<span data-toggle="tooltip" data-placement="bottom" title="" data-original-title="<?=$shop_cx['endtime'];?>">已付款</span>
											</div>
											<div class="step-item">
											 <span data-toggle="tooltip" data-placement="bottom" title="" data-original-title="<?=$shop_cx['seller_adtime'];?>">卖家接单</span>
                                            </div>
                                            <div class="step-item current">
                                            <span data-toggle="tooltip" data-placement="bottom" title="" data-original-title="<?=$shop_cx['seller_endtime'];?>">已发货</span>
                                            </div>
                                            <div class="step-item">
                                            <span>待收货</span>
                                            </div>
                                    </div>
                                    <div class="process-line" style="width: 66%;"></div>
									<?php }if($shop_cx['status']==1&&$shop_cx['shop_type']==3){?>
                                    <div class="horizontal-steps-content text-nowrap">
                                            <div class="step-item">
											<span data-toggle="tooltip" data-placement="bottom" title="" data-original-title="<?=$shop_cx['endtime'];?>">已付款</span>
											</div>
											<div class="step-item">
											 <span data-toggle="tooltip" data-placement="bottom" title="" data-original-title="<?=$shop_cx['seller_adtime'];?>">卖家接单</span>
                                            </div>
                                            <div class="step-item">
                                            <span data-toggle="tooltip" data-placement="bottom" title="" data-original-title="<?=$shop_cx['seller_endtime'];?>">已发货</span>
                                            </div>
                                            <div class="step-item current">
                                            <span data-toggle="tooltip" data-placement="bottom" title="" data-original-title="<?=$shop_cx['user_endtime'];?>">完成</span>
                                            </div>
                                    </div>
                                    <div class="process-line" style="width: 99%;"></div>
									<?php }if($shop_cx['status']==1&&$shop_cx['shop_type']==4){?>
									<div class="horizontal-steps-content text-nowrap">
                                            <div class="step-item">
											<span data-toggle="tooltip" data-placement="bottom" title="" data-original-title="<?=$shop_cx['endtime'];?>">已付款</span>
											</div>
											<div class="step-item">
											 <span data-toggle="tooltip" data-placement="bottom" title="" data-original-title="<?=$tuikuan['addtime'];?>">申请退款</span>
                                            </div>
                                            <div class="step-item">
                                            <span data-toggle="tooltip" data-placement="bottom" title="" data-original-title="<?=$tuikuan['transfer_date'];?>">处理退款</span>
                                            </div>
                                            <div class="step-item ">
                                            <span data-toggle="tooltip" data-placement="bottom" title="" data-original-title="<?=$tuikuan['transfer_date'];?>">完成</span>
                                            </div>
                                    </div>
                                    <div class="process-line" style="width: 99%;"></div>
									<?php }if($shop_cx['status']==1&&$shop_cx['shop_type']==5){?>
									<div class="horizontal-steps-content text-nowrap">
                                            <div class="step-item">
											<span data-toggle="tooltip" data-placement="bottom" title="" data-original-title="<?=$shop_cx['endtime'];?>">已付款</span>
											</div>
											<div class="step-item">
											 <span data-toggle="tooltip" data-placement="bottom" title="" data-original-title="<?=$tuikuan['addtime'];?>">申请退款</span>
                                            </div>
                                            <div class="step-item">
                                            <span data-toggle="tooltip" data-placement="bottom" title="" data-original-title="<?=$tuikuan['transfer_date'];?>">人工审核</span>
                                            </div>
                                            <div class="step-item ">
                                            <span data-toggle="tooltip" data-placement="bottom" title="" data-original-title="<?=$tuikuan['transfer_date'];?>">完成</span>
                                            </div>
                                    </div>
                                    <div class="process-line" style="width: 66%;"></div>
									<?php }?>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->    
                        <div class="row">
                            <div class="col-lg-12">
							<div class="alert alert-success" role="alert">
                        <p class="mb-0">退款说明：<br/>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;退款极速到账仅支持平台实名认证用户，实名认证<a href="oreo_shop_real.php">点这里</a>.<br/>
                         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;您可以在商品付款成功后在卖家确认订单之前可申请极速退款业务，该功能仅开放与实名认证用户，若您未实名认证，退款申请将记录在后台管理员审批后到账到您的支付宝账号.<br/>
                         </div>  
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title mb-3">订单详情</h4>
                                        <div class="table-responsive">
                                            <table class="table mb-0 text-nowrap" style="text-align: center;">
                                                <thead class="thead-light">
                                                <tr>
                                                    <th>订单号</th>
													 <th>名称</th>
													<th>下单/付款</th>
													<th>价格</th>
													<th>商品备注</th>
													<th>状态</th>
													<?php if($shop_cx['shop_type']==5){ ?>
													<th>自动退款错误</th>
													<?php }?>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td># <?=$out_trade_no;?></td>
                                                    <td><?=$shop_cx['name'];?></td>
													<td ><?=$shop_cx['addtime'];?><br><?=$shop_cx['endtime'];?></td>
													<td>¥<?=$shop_cx['money'];?></td>
													<td><?=$shop_cx['order_text'];?></td>
													<td><?php
													if($shop_cx['shop_type']==0){echo '<span class="badge badge-warning">等待卖家确认订单</span>';}
													if($shop_cx['shop_type']==1){echo '<span class="badge badge-info">卖家已接单</span>';}
													if($shop_cx['shop_type']==2){echo '<span class="badge badge-success">卖家已发货</span>';}
													if($shop_cx['shop_type']==3){echo '<span class="badge badge-success">交易完成</span>';}
													if($shop_cx['shop_type']==4){echo '<span class="badge badge-primary">成功退款</span>';}
													if($shop_cx['shop_type']==5){echo '<span class="badge badge-secondary">正在退款</span>';}
													?></td>
													<?php if($shop_cx['shop_type']==5){ ?>
													<th><?=$tuikuan['transfer_result'];?></th>
													<?php }?>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                      <div class="button-list mt-3" style="text-align: center;">
											 <?php if($shop_cx['status']==0&&$shops_info['type']==2||!$shops_info){?>
											 <button  class="btn btn-light">商品不存在或卖家设置不接单</button>
											 <?php }if($shop_cx['status']==1&&$shop_cx['shop_type']==2){?>
										     <button data-toggle="modal" data-target="#evaluate" data-id="evaluate" class="btn btn-success"><i class="iconfont icon-queren"></i> 确认收货</button>
											 <?php }if($shop_cx['status']==1&&$shop_cx['shop_type']==0&&$shop_cx['shop_type']!=4){?>
											  <a  id="id" uin="<?php echo $out_trade_no;?>" class="btn btn-success nocheck recheck"  style="color: white;"><i class="iconfont icon-fukuan"></i> 申请退款</a> 
                                             <?php }?>
                                                  
                                            </div>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->
						<div id="evaluate" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-sm modal-right">
                                                <div class="modal-content">
                                                    <div class="modal-header border-0">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="text-center">
															 <div class="tab-pane" id="finish-2">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="text-center">
                                                                    <h2 class="mt-0"><i class="mdi mdi-check-all"></i></h2>
                                                                    <h3 class="mt-0">Thank you !</h3>
                                                                    <p class="w-75 mb-2 mx-auto" style="text-indent: 2em;">谢谢您抽出宝贵的时间来进行评价订单，这对于我们来说很重要的，我们根据评价来衡量卖家的信誉度，再次感谢您.</p>
                                                                </div>
                                                            </div> <!-- end col -->
                                                        </div> <!-- end row -->
                                                    </div> 
                                                           <div class="form-group mb-3">
                                                           <label for="example-select">请做出评价</label>
                                                            <select class="form-control" id="shop_type" name="shop_type" >
                                                            <option value="1">好评</option>
                                                            <option value="2">差评</option>
                                                            </select>
                                                            </div>  
                                                          <div class="button-list mt-3" style="text-align: center;">
                                                       <button type="button" id="shouhuo" class="btn btn-success"><i class="iconfont icon-querenshouhuo"></i> 确认收货</button>
                                                       </div>
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
		var url="oreo_shop_apply.php";
        
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