<?php
include("../oreo/oreo.core.php");
if($islogin2==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
include './oreo_static.php';
if(!$_POST)exit("<script language='javascript'>window.location.href='./oreo_order.php';</script>");
$adtime = $_POST['adtime'];
$endtime = $_POST['endtime'];
$uids = $_POST['uids'];
$status = $_POST['status'];
$out_trade_no = $_POST['out_trade_no'];
$money = $_POST['money'];
$ddcx = $_POST['ddcx'];
$zt = $_POST['zhuangtai'];
$shopname = $_POST['shopname'];
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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">在线充值</a></li>
                                            <li class="breadcrumb-item active">充值反馈单</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">充值反馈单</h4>
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
                                                <img src="../assets/user/images/logo-light.png" alt="" height="18">
                                            </div>
                                            <div class="float-right">
											<?php if($status==1&&$zt!='余额支付'){ ?>
                                                <h4 class="m-0 d-print-none">充值成功</h4>
												<?php }if($status==0&&$zt!='余额支付'){ ?>
												 <h4 class="m-0 d-print-none">充值失败</h4>
												<?php }if($status==1&&$zt=='余额支付'){ ?>
												 <h4 class="m-0 d-print-none">余额支付</h4>
												<?php } ?>
                                            </div>
                                        </div>
                                        <!-- Invoice Detail-->
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="float-left mt-3">
                                                    <p><b>尊敬的, <?php echo $userrow['names'];?></b></p>
													 <?php if($status==1&&$zt!='余额支付'){ ?>
                                                    <p class="text-muted font-13">很负责任的告诉您，我们已经成功收到您的汇款，并且已经为您的账户充上对应的余额.</p>
													<?php }if($status==0&&$zt!='余额支付'){?>
													<p class="text-muted font-13">糟糕，我们并没有收到您的汇款，因此我们无法对您的账号进行充值，如有问题请联系管理员.</p>
													<?php }if($status==1&&$zt=='余额支付'){ ?> 
													<p class="text-muted font-13">很负责任的告诉您，我们已经成功收到您的消费通知，并且已经为您的账户进行了有关权限的设置.</p>
													 <?php } ?>
                                                </div>
            
                                            </div><!-- end col -->
                                            <div class="col-sm-4 offset-sm-2">
                                                <div class="mt-3 float-sm-right">
                                                    <p class="font-13"><strong>订单完成时间: </strong> &nbsp;&nbsp;&nbsp; <?php echo $endtime; ?></p>
													<?php if($status==1){ ?>
                                                    <p class="font-13"><strong>订单状态: </strong> <span class="badge badge-success float-right">完成</span></p>
													<?php }else{ ?>
													 <p class="font-13"><strong>订单状态: </strong> <span class="badge badge-danger float-right">失败</span></p>
													 <?php } ?>
                                                    <p class="font-13"><strong>充值账号: </strong> <span class="float-right">#<?php echo $uids; ?></span></p>
                                                </div>
                                            </div><!-- end col -->
                                        </div>      
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="table-responsive">
                                                    <table class="table mt-4 text-nowrap">
                                                        <thead>
                                                        <tr><th>#</th>
                                                            <th>内容</th>
                                                            <th>创建时间</th>
															<?php if($zt!='余额支付'&&$status==1||$status==0){ ?>
                                                            <th>充值金额</th>
															 <?php } if($zt=='余额支付'&&$status==1||$status==0){ ?>
															 <th>商品价格</th>
															 <?php } ?>
                                                            <th class="text-right">订单号</th>
                                                        </tr></thead>
                                                        <tbody>
                                                        <tr>
                                                            <td>1</td>
                                                            <td>
															    <?php if($zt!='余额支付'&&$status==1||$status==0){ ?>
                                                                <b><?php echo $conf['oreo_ordername'];?></b> <br/>
                                                                账号：<?php echo $uids; ?>充值余额
																 <?php } if($zt=='余额支付'&&$status==1||$status==0){ ?>
																<b><?php echo $shopname;?></b> <br/>
                                                                账号：<?php echo $uids; ?>站内消费
																 <?php } ?>
                                                            </td>
                                                            <td>¥<?php echo $adtime; ?></td>
                                                            <td>¥<?php echo $money; ?></td>
                                                            <td class="text-right"><?php echo $out_trade_no; ?></td>
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
                                                    <h6 class="text-muted">备注:</h6>
                                                    <small>
                                                        如对该订单有疑问请及时联系Oreo尽快取得解决方法.
                                                    </small>
                                                </div>
                                            </div> <!-- end col -->
                                            <div class="col-sm-6">
                                                <div class="float-right mt-3 mt-sm-0">
												    <?php if($zt!='余额支付'&&$status==1||$status==0){ ?>
                                                    <p><b>充值金额:</b> <span class="float-right">¥<?php echo $money; ?></span></p>
                                                    <p><b>实际到账:</b> <span class="float-right">¥<?php echo $money; ?></span></p>
                                                    <h3>¥<?php echo $money; ?> RMB</h3>
													 <?php } if($zt=='余额支付'&&$status==1||$status==0){ ?>
													<p><b>商品价格:</b> <span class="float-right">¥<?php echo $money; ?></span></p>
                                                    <p><b>余额减去:</b> <span class="float-right">¥ -<?php echo $money; ?></span></p>
                                                    <h3>¥ -<?php echo $money; ?> RMB</h3>
													 <?php } ?>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div> <!-- end col -->
                                        </div>
                                        <!-- end row-->
                                        <div class="d-print-none mt-4">
                                            <div class="text-right">
                                                <a href="javascript:window.print()" class="btn btn-primary"><i class="mdi mdi-printer"></i> 打印</a>
                                                <?php if($status==1&&$ddcx==''){ ?>
												<a href="./index.php" class="btn btn-info">进行授权</a>
												<?php }if($status==0&&$ddcx==''){ ?>
												<a href="./oreo_deposit.php" class="btn btn-info">重新充值</a>
												<?php }if($ddcx==1){ ?>
												 <?php } ?>
                                            </div>
                                        </div>   
                                        <!-- end buttons -->

                                    </div> <!-- end card-body-->
                                </div> <!-- end card -->
                            </div> <!-- end col-->
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
         <script src="../assets/user/js/app.min.js"></script>
    </body>
</html>