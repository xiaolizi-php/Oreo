<?php
include("../oreo/oreo.core.php");
if($islogin2 != 1){exit("<script language='javascript'>window.location.href='./login.php';</script>");}
include './oreo_static.php';
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
                                            <li class="breadcrumb-item active">在线充值</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">在线充值</h4>
                                </div> <!-- end page-title-box -->
                            </div> <!-- end col-->
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-8">
                                              <div class="alert alert-success" role="alert">
                                            <?php echo $conf['oreo_zfsm'];?>
                                        </div>   
                                            </div>
                                            <!-- end col -->
                                            <div class="col-lg-4">
                                                <div class="border p-3 mt-4 mt-lg-0 rounded">
                                                    <h4 class="header-title mb-3">订单详情</h4>
													 <form class="needs-validation"name="alipayment"action="../pay/payment.php"method="post"target="iframes">
                                                    <div class="table-responsive">
                                                        <table class="table mb-0">
                                                            <tbody>
                                                                <tr>
                                                                    <td>充值账号 :</td>
                                                                    <td><input type="text"class="form-control"name="id"value="<?php echo $pid?>"readonly="readonly"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>商品名称 : </td>
                                                                    <td><input type="text"class="form-control"name="WIDsubject"value="<?php echo $conf['oreo_ordername']?>"readonly="readonly"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td for="validationTooltip03">充值金额 :</td>
                                                                     <td><input type="text"class="form-control"name="WIDtotal_fee" value="" required=""></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!-- end table-responsive -->
                                                </div>
                                                <div class="button-list mt-3" style="text-align: center;">
                                                   <?php if($conf['alipay_mode']!=0){?>
                                                   <button type="radio" value="alipay" name="type" class="btn btn-primary"><i class="iconfont icon-zhifubao"></i> 支付宝</button>
												   <?php }if($conf['wxpay_mode']!=0){ ?>		
												   <button type="radio" value="wxpay" name="type" class="btn btn-success"><i class="iconfont icon-weixin"></i> 微信</button>
												   <?php }if($conf['qqpay_mode']!=0){ ?>
												   <button type="radio" value="qqpay" name="type" class="btn btn-secondary"><i class="iconfont icon-qq"></i> QQ钱包</button>
                                                   <?php } ?>   
                                                </div>
                                             </form>
                                            </div> <!-- end col -->
                                        </div> <!-- end row -->
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->    
                    </div> <!-- content -->
                    <!-- Footer Start -->
                    <footer class="footer">
                        <div class="row">
                            <div class="col-md-6">
                                 <?php echo $conf['web_copyright']; ?>
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
<script src="../assets/user/js/app.min.js"></script>
</body>
</html>