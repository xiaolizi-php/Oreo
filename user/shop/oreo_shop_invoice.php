<?php
include("../../oreo/oreo.core.php");
if($islogin2==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
include './oreo_shop_static.php';
//验证Token
$module = $_POST['module'];
$timestamp = $_POST['timestamp'];
$token = md5($module.'#$@%!^*'.$timestamp);
if($token != $_POST['token']){
exit('<script language="javascript">swal("非法数据来源","我们将记录您的非法操作并作出相应的处罚", "error", {button: "明白",}).then(function () {window.location.href="./oreo_shop_mall_order.php"});</script>');
}//验证token结束
$adtime = $_POST['adtime'];//创建时间
$endtime = $_POST['endtime'];//完成时间
$uids = $_POST['uids'];//付款id
$status = $_POST['status'];//付款状态
$out_trade_no = $_POST['out_trade_no'];//订单号
$money = $_POST['money'];//付款金额
$maijia = $_POST['seller'];//卖家id
$shopname = $_POST['ordername'];//商品名称
$ordertext = $_POST['order_text'];//商品备注
//来自订单中心付款
$shop_cx=$DB->query("select * from oreo_shop_details where out_trade_no='{$out_trade_no}' and user='{$pid}'  limit 1")->fetch();
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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">在线付款</a></li>
                                            <li class="breadcrumb-item active">付款反馈单</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">付款反馈单</h4>
                                </div> <!-- end page-title-box -->
                            </div> <!-- end col-->
                        </div>
                        <!-- end page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">

                                        <!-- Invoice Logo-->
                                        <div class="clearfix">
                                            <div class="float-left mb-3">
                                                <img src="../../assets/user/images/logo-light.png" alt="" height="18">
                                            </div>
                                            <div class="float-right">
												<?php if($status==1){ ?>
                                                <h4 class="m-0 d-print-none">付款成功</h4>
												<?php }if($status==0){ ?>
												<h4 class="m-0 d-print-none">付款失败</h4>
												<?php } ?>
                                            </div>
                                        </div>
                                        <!-- Invoice Detail-->
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="float-left mt-3">
                                                     <p><b>尊敬的, <?php echo $userrow['names'];?></b></p>
                                                    <?php if($status==1){ ?>
                                                    <p class="text-muted font-13">很负责任的告诉您，我们已经成功收到您的汇款，并且已通知卖家及时处理您的订单.</p>
													<?php }if($status==0){?>
													<p class="text-muted font-13">糟糕，我们并没有收到您的汇款，因此我们无法对您的账号进行购买请求的处理，如有问题请联系管理员.</p>
													<?php } ?>
													</div>
                                            </div><!-- end col -->
                                            <div class="col-sm-4 offset-sm-2">
                                               <div class="mt-3 float-sm-right">
                                                    <p class="font-13"><strong>订单创建时间: </strong> &nbsp;&nbsp;&nbsp; <?php echo $adtime; ?></p>
													<?php if($status==1){ ?>
													<p class="font-13"><strong>订单完成时间: </strong> &nbsp;&nbsp;&nbsp; <?php echo $endtime; ?></p>
                                                    <p class="font-13"><strong>订单状态: </strong> <span class="badge badge-success float-right">完成</span></p>
													<?php }else{ ?>
													 <p class="font-13"><strong>订单状态: </strong> <span class="badge badge-danger float-right">失败</span></p>
													 <?php } ?>
                                                    <p class="font-13"><strong>付款账号: </strong> <span class="float-right">#<?php echo $uids; ?></span></p>
													<?php if($status==1){ ?>
													<p class="font-13"><strong>卖家账号: </strong> <span class="float-right">#<?php echo $maijia; ?></span></p>
													 <?php } ?>
                                                </div>
                                            </div><!-- end col -->
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="table-responsive">
                                                    <table class="table mt-4 text-nowrap">
                                                        <thead>
                                                        <tr><th>订单号</th>
                                                            <th>商品名称</th>
                                                            <th>商品价格</th>
                                                        </tr>
														</thead>
                                                        <tbody>
                                                        <tr>
                                                            <td><?php echo $out_trade_no;?></td>
                                                            <td>
                                                                <b><?php echo $shopname;?></b> <br/>
                                                                  备注：<?php echo $ordertext;?>
                                                            </td>
                                                            <td><?php echo $money;?></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div> <!-- end table-responsive-->
                                            </div> <!-- end col -->
                                        </div>
                                        <!-- end row -->
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="clearfix pt-3">
                                                    <h6 class="text-muted">提示:</h6>
                                                     <small>
                                                        如对该订单有疑问请及时联系Oreo尽快取得解决方法.
                                                    </small>
                                                </div>
                                            </div> <!-- end col -->
                                            <div class="col-sm-6">
                                                <div class="float-right mt-3 mt-sm-0">
                                                    <p><b>商品金额:</b> <span class="float-right">¥<?php echo $money; ?></span></p>
                                                    <p><b>实际付款:</b> <span class="float-right">¥<?php echo $money; ?></span></p>
                                                    <h3>¥<?php echo $money; ?> RMB</h3>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div> <!-- end col -->
                                        </div>
                                        <!-- end row-->
    
                                        <div class="d-print-none mt-4">
                                            <div class="text-right">
												<?php if($status==1){ ?>
                                               <a href="javascript:window.print()" class="btn btn-primary"><i class="mdi mdi-printer"></i> 打印</a>
												<?php }if($status==0&&$shops_info['type']==1&&$shops_info){ ?>
												<button data-toggle="modal" data-target="#fukuan" data-id="fukuan" class="btn btn-success"> 付款</button>
											    <?php }if($status==0&&$shops_info['type']==2||!$shops_info){ ?>
												 <button  class="btn btn-secondary">商品不存在或卖家设置不接单</button>
												<?php } ?>
                                            </div>
                                        </div>   
                                        <!-- end buttons -->

                                    </div> <!-- end card-body-->
                                </div> <!-- end card -->
                            </div> <!-- end col-->
                        </div>
						<div id="fukuan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="info-header-modalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
											   <form action="../../pay/shop/shop_payment.php" method="POST" >
                                                <div class="modal-content">
                                                    <div class="modal-header modal-colored-header bg-info">
                                                        <h4 class="modal-title" id="info-header-modalLabel">订单在线付款</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    </div>
													 <input type="hidden" value="<?=$shop_cx['trade_no']?>"  name="order_num"  style="display: none;">
                                                    <?php if($conf['alipay_mode']!=0){?>
                                                        <div class="border p-3 mb-3 rounded">
                                                            <div class="row">
                                                                <div class="col-sm-8">
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" id="BillingOptRadio2" name="payment" value="alipay" class="custom-control-input">
                                                                        <label class="custom-control-label font-16 font-weight-bold" for="BillingOptRadio2">支付宝</label>
                                                                    </div>
                                                                    <p class="mb-0 pl-3 pt-1">一步操作，一步到位，支付就是一步.</p>
                                                                </div>
                                                                <div class="col-sm-4 text-sm-right mt-3 mt-sm-0">
                                                                    <img src="../../assets/user/images/alipay.jpeg" height="25" alt="paypal-img">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- end Pay with Paypal box-->
                                                        <!-- Pay with Payoneer box-->
														 <?php }if($conf['wxpay_mode']!=0){ ?>		
                                                        <div class="border p-3 mb-3 rounded">
                                                            <div class="row">
                                                                <div class="col-sm-8">
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" id="BillingOptRadio3" name="payment" value="wxpay" class="custom-control-input">
                                                                        <label class="custom-control-label font-16 font-weight-bold" for="BillingOptRadio3">微信</label>
                                                                    </div>
                                                                    <p class="mb-0 pl-3 pt-1">支付不累，安心加倍.</p>
                                                                </div>
                                                                <div class="col-sm-4 text-sm-right mt-3 mt-sm-0">
                                                                    <img src="../../assets/user/images/weixin.jpeg" height="30" alt="paypal-img">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- end Pay with Payoneer box-->
                                                        <!-- Cash on Delivery box-->
														<?php }if($conf['qqpay_mode']!=0){ ?>
                                                        <div class="border p-3 mb-3 rounded">
                                                            <div class="row">
                                                                <div class="col-sm-8">
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" id="BillingOptRadio4" name="payment" value="qqpay" class="custom-control-input">
                                                                        <label class="custom-control-label font-16 font-weight-bold" for="BillingOptRadio4">QQ钱包</label>
                                                                    </div>
                                                                    <p class="mb-0 pl-3 pt-1">诚信支付，用心服务.</p>
                                                                </div>
																<input style="display: none" type="hidden" name="ddcx" value="<?=$trade_no?>"/>
                                                                <div class="col-sm-4 text-sm-right mt-3 mt-sm-0">
                                                                    <img src="../../assets/user/images/qq.jpeg" height="22" alt="paypal-img">
                                                                </div>
                                                            </div>
                                                        </div>
														 <?php } ?>   
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light" data-dismiss="modal">关闭</button>
                                                        <button type="submit" name="submit" class="btn btn-info">付款</button>
                                                    </div>
                                                </div><!-- /.modal-content -->
												</form>
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->
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
<script src="../../assets/user/js/app.min.js"></script>
</body>
</html>