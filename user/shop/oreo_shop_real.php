<?php
include("../../oreo/oreo.core.php");
if($islogin2==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
include './oreo_shop_static.php';
if($userrow['action']==0){
exit("<script language='javascript'>alert('您的账号已被封禁，暂无法登陆后台');window.location.href='./login.php?logout';</script>");
}
//查询实名认证订单是否存在
$order=$DB->query("SELECT * FROM oreo_shop_details WHERE name='oreo实名认证' and user='$pid' limit 1")->fetch();
if($order['status']==1){
echo '<form id="oreosubmit" name="oreosubmit" action="./oreo_shop_real_add.php" method="POST">
			  <input type="hidden" name="module" value="'.$module.'"/>
             <input type="hidden" name="timestamp" value="'.time().'"/>
             <input type="hidden" name="token" value="'.md5($module.'#$@%!^*'.time()).'"/>
			 <script>document.forms["oreosubmit"].submit();</script>';
			 exit;
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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">商户中心</a></li>
                                            <li class="breadcrumb-item active">实名认证</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">实名认证</h4>
                                </div> <!-- end page-title-box -->
                            </div> <!-- end col-->
                        </div>
                        <!-- end page title -->
                        <div class="row">
                            <div class="col-md-6 col-lg-3">
                                <!-- Simple card -->
                                <div class="card d-block">
                                    <img class="card-img-top" src="../../assets/user/images/gongan.jpg" alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title">认证说明</h5>
                                        <p class="card-text">
										<a style="text-indent: 2em;">1.身份证与姓名全国公安联网查询真实性.</a><br>
										<a style="text-indent: 2em;">2.提现支付宝账户姓名必须与提交的身份证信息一致.</a><br>
										<a style="text-indent: 2em;">3.认证费用为5元，认证结束将系统自动退款到认证支付宝账户内（若您是个人恶意填写信息或信息核验失败将不给予退款）,其中0.1元作为认证基础费（防止恶意验证身份证）.</a><br>
										</p>
										<form id="oreosubmit" name="oreosubmit" action="./oreo_shop_real_pay.php" method="POST" >
										<input type="hidden" name="module" value="<?=$module;?>"/>
                                        <input type="hidden" name="timestamp" value="<?=time()?>"/>
                                        <input type="hidden" name="token" value="<?=md5($module.'#$@%!^*'.time())?>"/>
                                        <button type="submit" class="btn btn-primary">开始认证</button></form>
                                    </div> 
                                </div> 
                            </div>
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
<script src="../../assets/user/js/app.min.js"></script>

    </body>

</html>