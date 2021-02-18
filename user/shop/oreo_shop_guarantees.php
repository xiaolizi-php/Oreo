<?php
include("../../oreo/oreo.core.php");
if($islogin2==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
include './oreo_shop_static.php';
$ktztc=$DB->query("SELECT user FROM `oreo_authsys` WHERE concat(',',user,',') LIKE '%,$pid,%'")->fetch();
if($userrow['action']==0){
exit("<script language='javascript'>alert('您的账号已被封禁，暂无法登陆后台');window.location.href='./login.php?logout';</script>");
}
if(!$_GET)exit("<script language='javascript'>window.location.href='./oreo_guarantee.php';</script>");
$shop_id=$_GET['shop_id'];
$shop_cx=$DB->query("select * from oreo_shop_guarantee where id='$shop_id' order by id desc limit 1")->fetch();
//好评率计算
$goods=round($shop_cx['evaluate_good']/($shop_cx['evaluate_good']+$shop_cx['evaluate_bad'])*100,3);
if($shop_cx['evaluate_good']==0&&$shop_cx['evaluate_bad']==0){$goods='暂无';}
//统计代码开始
include("../../oreo/oreo_plugin/visitors/oreo_visitors.php");
//visitor($shop_id);
?>
                <!-- Left Sidebar End -->
                <div class="content-page">
                    <div class="content">
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">基本</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">担保交易</a></li>
                                            <li class="breadcrumb-item active">商品详情</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">商品详情</h4>
                                </div> <!-- end page-title-box -->
                            </div> <!-- end col-->
                        </div>
                        <!-- end page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-5">
                                                <!-- Product image -->
                                                <a href="javascript: void(0);" class="text-center d-block mb-4">
                                                    <img src="<?php echo $shop_cx['photo']; ?>" class="img-fluid" style="max-width: 290px;margin-top: 5em;" alt="Product-img" />
                                                </a>
                                            </div> <!-- end col -->
                                            <div class="col-lg-7">
                                                <form class="pl-lg-4" action="./oreo_shop_details.php" method="POST" >
                                                    <!-- Product title -->
                                                    <h3 class="mt-0"><?php echo $shop_cx['name']; ?><a href="javascript: void(0);" class="text-muted"><i class="mdi mdi-square-edit-outline ml-2"></i></a> </h3>
                                                    <p class="mb-1">编辑时间: <?php echo $shop_cx['addtime']; ?></p>
													<p class="mb-1">库存: <?php echo $shop_cx['stock']; ?></p>
                                                    <p class="font-16">
                                                        <span class="text-warning mdi mdi-star"></span>
                                                        <span class="text-warning mdi mdi-star"></span>
                                                        <span class="text-warning mdi mdi-star"></span>
                                                        <span class="text-warning mdi mdi-star"></span>
                                                        <span class="text-warning mdi mdi-star"></span>
                                                    </p>
                                                    <!-- Product description -->
                                                    <div class="mt-4">
                                                        <h6 class="font-14">出售价格:</h6>
                                                        <h3> ¥ <?php echo $shop_cx['money']; ?></h3>
                                                    </div>

                                                    <!-- Quantity -->
                                                    <div class="mt-4">
                                                        <h6 class="font-14">数量</h6>
                                                        <div class="d-flex">
														
                                                            <input type="number" min="1" value="1" class="form-control" name="stock" placeholder="Qty" style="width: 90px;">
															<input style="display: none" name="shops_id" value="<?=$shop_id?>">
															<?php if($shop_cx['type']==1){ ?>
                                                            <button type="submit" name="submit" class="btn btn-danger ml-2"><i class="mdi mdi-cart mr-1"></i> 立刻购买</button>
                                                            <?php }else{ ?>
															<a  class="btn btn-secondary ml-2" style="color: white;"><i class="mdi mdi-cart mr-1"></i>停止销售</a>
                                                            <?php } ?>
													  </div>
                                                    </div>
                                        
                                                    <!-- Product description -->
                                                    <div class="mt-4">
                                                        <h6 class="font-14">详细内容:</h6>
                                                        <p><?php echo $shop_cx['text']; ?></p>
                                                    </div>
                                                </form>
                                            </div> <!-- end col -->
                                        </div> <!-- end row-->
                                        <div class="table-responsive mt-4">
                                            <table class="table table-bordered table-centered mb-0 text-nowrap">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>卖家QQ</th>
                                                        <th>保证金</th>
														<th>好评率</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?=$shop_cx['seller_qq'];?>&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:<?=$shop_cx['seller_qq'];?>:51" alt="点击这里给我发消息" title="点击这里给我发消息"/></a>&nbsp;&nbsp;<?php echo $shop_cx['seller_qq']; ?></td>
                                                        <td>未交付保证金</td>
                                                        <td>
                                                            <div class="progress-w-percent mb-0">
                                                                <span class="progress-value"><?=$goods;?>%</span>
                                                                <div class="progress progress-sm">
                                                                    <div class="progress-bar bg-success" role="progressbar" style="width: <?=$goods;?>%;" aria-valuenow="<?=$goods;?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div> <!-- end table-responsive-->
                                        
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col-->
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
        </div>
        <!-- App js -->
        <script src="../../assets/user/js/app.min.js"></script>
    </body>
</html>