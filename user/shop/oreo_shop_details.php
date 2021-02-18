<?php
include("../../oreo/oreo.core.php");
if($islogin2==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
include './oreo_shop_static.php';
if($userrow['action']==0){
exit("<script language='javascript'>alert('您的账号已被封禁，暂无法登陆后台');window.location.href='./login.php?logout';</script>");
}
if(!$_POST)exit("<script language='javascript'>window.history.back(-1);</script>");
$shop_id=$_POST['shops_id'];//商品ID
$shop_cx=$DB->query("select * from oreo_shop_guarantee where id='$shop_id' order by id desc limit 1")->fetch();
//不能购买自己的商品
if($shop_cx['seller']==$Shop_user['user']){
exit('<script language="javascript">swal("不能购买自己的商品","", "error", {
  button: "明白",
}).then(function () {
        window.history.back(-1)
    });</script>');
}
//生成订单信息
$showtime=date("Y-m-d H:i:s");//下单时间
$trade_no=date("YmdHis").rand(11111,99999);
$out_trade_no=date("YmdHis").rand(111,999);
$moneys=round($shop_cx['money']*$_POST['stock'],2);
$DB->exec("INSERT INTO `oreo_shop_details` (`unique_code`, `seller`, `name`, `money`, `stock`, `payment_method`, `trade_no`, `out_trade_no`, `user`, `addtime`, `status`, `shop_type`) VALUES ('{$shop_cx['unique_code']}', '{$shop_cx['seller']}', '{$shop_cx['name']}', '$moneys', '{$_POST['stock']}', '', '$trade_no', '$out_trade_no', '$pid', '{$showtime}', '0', '0')");
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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">商品购买</a></li>
                                            <li class="breadcrumb-item active">付款</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">付款</h4>
                                </div> <!-- end page-title-box -->
                            </div> <!-- end col-->
                        </div>
                        <!-- end page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="border p-3 mt-4 mt-lg-0 rounded">
                                                            <h4 class="header-title mb-3">订单详情</h4>
                                                            <div class="table-responsive">
                                                                <table class="table table-centered mb-0">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>
                                                                                <img src="<?=$shop_cx['photo'];?>" alt="contact-img"
                                                                                    title="contact-img" class="rounded mr-2" height="48" />
                                                                                <p class="m-0 d-inline-block align-middle">
                                                                                    <a href="oreo_shop_guarantees.php?shop_id=<?=$shop_id?>"
                                                                                        class="text-body font-weight-semibold"><?=$shop_cx['name'];?></a>
                                                                                    <br>
                                                                                    
                                                                                </p>
                                                                            </td>
                                                                            <td class="text-right">
                                                                                ¥<?=$shop_cx['money'];?>
                                                                            </td>
                                                                        </tr>
                                                                        <tr class="text-right">
                                                                            <td>
                                                                                <h6 class="m-0">购买数量:</h6>
                                                                            </td>
                                                                            <td class="text-right">
                                                                                X <?=$_POST['stock'];?>
                                                                            </td>
                                                                        </tr>
                                                                        <tr class="text-right">
                                                                            <td>
                                                                                <h6 class="m-0">是否优惠:</h6>
                                                                            </td>
                                                                            <td class="text-right">
                                                                                否
                                                                            </td>
                                                                        </tr>
                                                                        <tr class="text-right">
                                                                            <td>
                                                                                <h5 class="m-0">代付款:</h5>
                                                                            </td>
                                                                            <td class="text-right font-weight-semibold">
                                                                                ¥<?=round($shop_cx['money']*$_POST['stock']);?>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <!-- end table-responsive -->
                                                        </div> <!-- end .border-->
											        <form action="../../pay/shop/shop_payment.php" method="POST" >
                                                        <div class="row">
                                                                <div class="col-12">
                                                                    <div class="form-group mt-3">
                                                                        <label for="example-textarea">订单备注:</label>
                                                                        <textarea class="form-control" id="example-textarea" name="order_text" rows="3" placeholder="我对卖家有话说"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div> <!-- end row -->
                                                       </div> <!-- end col -->          
                                                    <div class="col-lg-8">
                                                        <h4 class="mt-2">付款方式</h4>
    
                                                        <p class="text-muted mb-4">请选择您正确的付款方式.</p>
    
                                                        <!-- Pay with Paypal box-->
														<input style="display: none" type="hidden" name="order_num" value="<?=$trade_no?>"/>
														<?php if($conf['alipay_mode']!=0){?>
                                                        <div class="border p-3 mb-3 rounded">
                                                            <div class="row">
                                                                <div class="col-sm-8">
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" id="BillingOptRadio2" name="payment" value="alipay" class="custom-control-input" required>
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
                                                                        <input type="radio" id="BillingOptRadio3" name="payment" value="wxpay" class="custom-control-input" required>
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
                                                                        <input type="radio" id="BillingOptRadio4" name="payment" value="qqpay" class="custom-control-input" required>
                                                                        <label class="custom-control-label font-16 font-weight-bold" for="BillingOptRadio4">QQ钱包</label>
                                                                    </div>
																	
                                                                    <p class="mb-0 pl-3 pt-1">诚信支付，用心服务.</p>
                                                                </div>
                                                                <div class="col-sm-4 text-sm-right mt-3 mt-sm-0">
                                                                    <img src="../../assets/user/images/qq.jpeg" height="22" alt="paypal-img">
                                                                </div>
                                                            </div>
                                                        </div>
														 <?php } ?>   
                                                        <!-- end Cash on Delivery box-->
                                                        <div class="row mt-4">
                                                            <div class="col-sm-6">
                                                                <div class="text-sm-right">
                                                                    <button type="submit" name="submit" class="btn btn-danger">
                                                                        <i class="mdi mdi-cash-multiple mr-1"></i> 立刻付款 </button>
                                                                </div>
																 </form>
                                                            </div> <!-- end col -->
                                                        </div> <!-- end row-->
    
                                                    </div> <!-- end col -->
                                                </div> <!-- end row-->
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row-->
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
    </body>
</html>