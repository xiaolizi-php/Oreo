<?php
include("../oreo/oreo.core.php");
if($islogin2 != 1){exit("<script language='javascript'>window.location.href='./login.php';</script>");}
include './oreo_static.php';
$userad=$DB->query("select * from oreo_ad where uid='{$pid}' and ad_type='1' ")->fetch();
?>
<link rel="stylesheet" href="//at.alicdn.com/t/font_1139659_a1gvys4jdtq.css">
                <div class="content-page">
                    <div class="content">
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">基本</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">广告合作</a></li>
                                            <li class="breadcrumb-item active">购买广告位</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">购买广告位</h4>
                                </div> <!-- end page-title-box -->
                            </div> <!-- end col-->
                        </div>
                        <!-- end page title -->
                        <div class="row justify-content-center">
                            <div class="col-xl-10">
                                <!-- Pricing Title-->
                                <div class="text-center">
                                    <h3 class="mb-2">您可以在此页进行购买平台规定位置的广告位展示权限</h3>
                                </div>
                                <!-- Plans -->
                                <div class="row mt-sm-5 mt-3 mb-3">
								
									<div class="col-md-4">
                                        <div class="card card-pricing">
                                            <div class="card-body text-center">
                                                <p class="card-pricing-plan-name font-weight-bold text-uppercase">站内广告</p>
                                                <i class="card-pricing-icon dripicons-store text-primary"></i>
                                                <h2 class="card-pricing-price">¥<?php echo $conf['z_ad_money']; ?><span>/ 元</span></h2>
                                                <ul class="card-pricing-features">
                                                    <?php echo $conf['z_ad_text'];?>
                                                </ul>
												<?php if($userad['type']==1){?>
												<button class="btn btn-success mt-4 mb-2 btn-rounded" data-toggle="modal" data-target="#shopzad" data-id="shopzad">点击补充广告信息</button>
												<?php }if($userad['type']==2){?> 
												<button class="btn btn-warning mt-4 mb-2 btn-rounded">正在准备展示</button> 
												<?php }if($userad['type']==3){?> 
												<button class="btn btn-danger mt-4 mb-2 btn-rounded" type="button" id="znadxf">再续费一个月</button>  
												<?php } if(!$userad){?>
                                                <button class="btn btn-primary mt-4 mb-2 btn-rounded" type="button" id="znggw">立即购买</button>
                                                <?php }?>
                                            </div>
                                        </div> <!-- end Pricing_card -->
                                    </div> <!-- end col -->
                                    <?php
                                       /* $rs=$DB->query("SELECT * FROM oreo_authsys WHERE ad_type='1'");
                                        while($row = $rs->fetch()){
											if()
			                          echo '
			                            <div class="col-md-4">
                                        <div class="card card-pricing">
                                            <div class="card-body text-center">
                                                <p class="card-pricing-plan-name font-weight-bold text-uppercase">'.$row['name'].'</p>
                                                <i class="iconfont icon-zhifubao" style="font-size: 35px;color: #05bcff;"></i>
                                                <h2 class="card-pricing-price">¥'.$row['ad_money'].'<span>/ 元</span></h2>
                                                <ul class="card-pricing-features">
                                                   '.$row['ad_text'].'
                                                </ul>
                                                <button class="btn btn-primary mt-4 mb-2 btn-rounded">您已开通,无需再次操作</button>
                                            </div>
                                        </div> 
                                    </div> ';} */?>   
                                </div>
                                <!-- end row -->
                            </div> <!-- end col-->
                        </div>
                        <!-- end row -->
						<div id="shopzad" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="text-center mt-2 mb-4">
                                                         <i class="mdi mdi-database-settings"> 补充广告信息</i>
                                                        </div>
														<div class="form-group">
                                                    <label id="typename">我的广告词:</label>
                                                    <div>
													 <textarea rows="4"  name="adtext" class="form-control" style="border: solid 1px;"></textarea> 
                                                    </div>
													 <small>* 可适当的添加html代码，如 style，href 等</small>
                                                </div>
                                                <div class="form-group text-center">
                                                 <button class="btn btn-primary" type="button" id="TijiaAd">修改</button>
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
<script src="../assets/user/js/layer.js"></script>	
<script>
					 $("#znggw").click(function () {
						var uid="<?=$pid?>";
						var ii = layer.load(2, {shade: [0.1, '#fff']}); 
						$.ajax({
							type: "POST",
							url: "ajax2.php?act=edit_GoumaiZnAd",
							data: {uid:uid},
							dataType: 'json',
							success: function (data) {
								layer.close(ii);
								if (data.code == 1) {
									 layer.msg('购买成功！');
									$('#shopzad').modal('show');
								}else if (data.code == -2) {
									layer.alert(data.msg);
								}else if (data.code == -3) {
									layer.alert(data.msg);
								}

								else if (data.code == -1) {
									layer.alert( data.msg, function(index) {
                                    layer.close(index);
                                    location.href="order_cz.php"; 
                                    })
								} 
							}
						});
					});
					 $("#TijiaAd").click(function () {
						var uid="<?=$pid?>";
                        var adtext=$("textarea[name='adtext']").val();
						var ii = layer.load(2, {shade: [0.1, '#fff']}); 
						$.ajax({
							type: "POST",
							url: "ajax2.php?act=edit_AdText",
							data: {uid:uid,adtext:adtext},
							dataType: 'json',
							success: function (data) {
								layer.close(ii);
								if (data.code == 1) {
									layer.alert('成功补充广告信息，请耐心等待管理员的审核，这个过程并不会太长', function(index) {
                                    layer.close(index);
                                    location.reload();
                                    })
								} else if (data.code == -1) {
									layer.alert(data.msg, function(index) {
                                    layer.close(index);
                                    location.reload();
                                    })
								}else {
									layer.alert(data.msg);
								}
							}
						});
					});
					
					$("#znadxf").click(function () {
						var uid="<?=$pid?>";
						var ii = layer.load(2, {shade: [0.1, '#fff']}); 
						$.ajax({
							type: "POST",
							url: "ajax2.php?act=edit_XufeiZnAd",
							data: {uid:uid},
							dataType: 'json',
							success: function (data) {
								layer.close(ii);
								if (data.code == 1) {
									 layer.msg('续费成功！');
									
								}else if (data.code == -2) {
									layer.alert(data.msg);
								}else if (data.code == -3) {
									layer.alert(data.msg);
								}

								else if (data.code == -1) {
									layer.alert( data.msg, function(index) {
                                    layer.close(index);
                                    location.href="order_cz.php"; 
                                    })
								} 
							}
						});
					});
				
</script>
</body>
</html>