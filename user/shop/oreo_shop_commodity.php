<?php
include("../../oreo/oreo.core.php");
if($islogin2==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
include './oreo_shop_static.php';
if($userrow['action']==0){
exit("<script language='javascript'>alert('您的账号已被封禁，暂无法登陆后台');window.location.href='./login.php?logout';</script>");
}
if($Shop_user['activation']!=2){
exit('<script language="javascript">swal("无权操作","实名认证用户才能发布产品", "error", {button: "明白",}).then(function () {window.location.href="./oreo_shop_real.php"});</script>');
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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">商品管理</a></li>
                                            <li class="breadcrumb-item active">发布/管理</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">发布/管理</h4>
                                </div> <!-- end page-title-box -->
                            </div> <!-- end col-->
                        </div>
                        <!-- end page title -->
                        <div class="row mb-2">
                            <div class="col-sm-4">
                                <a type="button" href="./oreo_shop_add.php" class="btn btn-danger btn-rounded mb-3"><i class="mdi mdi-plus"></i> 商品发布</a>
                            </div>
                        </div> 
                        <!-- end row-->
                        <div class="row">	
<?php											
								   $rs=$DB->query("SELECT * FROM oreo_shop_guarantee WHERE seller='$pid' order by id desc limit 999999"); 
                                     while($row = $rs->fetch())
                                      {
									//查询最近购买用户
									$Shop_all_user=$DB->query("select * from oreo_shop_details where unique_code='{$row['unique_code']}' limit 1")->fetch();
									$Shop_user_qq=$DB->query("select * from oreo_shop_user where user='{$Shop_all_user['user']}' limit 1")->fetch();
								    $dianji=$DB->query("select count(*) as total from oreo_shop_visitors where shop_id='{$row['id']}'")->fetch();
									$Shop_in_user=$DB->query("select * from oreo_shop_details where unique_code='{$row['unique_code']}' and status='1' order by id desc limit 5")->fetch();
									$Shop_in_user_tb=$DB->query("select * from oreo_shop_user where user='{$Shop_in_user['user']}' limit 1")->fetch();
									$new_shop='
									<a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="" data-original-title="'.$Shop_in_user_tb['user'].'" class="d-inline-block">
                                    <img src="//q3.qlogo.cn/headimg_dl?bs=qq&dst_uin='.$Shop_in_user_tb['qq'].'&src_uin='.$Shop_in_user_tb['qq'].'&fid='.$Shop_in_user_tb['qq'].'&spec=100&url_enc=0&referer=bu_interface&term_type=PC" class="rounded-circle avatar-xs" alt="friend">
                                    </a>
									';if(!Shop_in_user){$new_shop='';}
									//好评率计算
									$goods=round($row['evaluate_good']/($row['evaluate_good']+$row['evaluate_bad'])*100,3);
									if($row['evaluate_good']==0&&$row['evaluate_bad']==0){$goods='0';}
									//计算总卖出
										  $shops=round($row['evaluate_good']+$row['evaluate_bad'],2);
                                    $dianjis = $dianji[0];
										    if($row['type']==1){
											$states='<div class="badge badge-success mb-3">正常接单</div>'; 
											$statesicon='<input type="text" value="'.$row['unique_code'].'" name="ShopUnCode" style="display: none"/><input type="text" value="'.$row['id'].'" name="ShopIdJj" style="display: none"/><a href="javascript:void(0);" type="button" id="goJj" onclick="JjDz()" class="dropdown-item"><i class="mdi mdi-check"></i> 正常接单(当前)</a>';}
											else{
											$states='<div class="badge badge-secondary mb-3">拒绝接单</div>'; 
											$statesicon='<input type="text" value="'.$row['unique_code'].'" name="ShopUnCode" style="display: none"/><input type="text" value="'.$row['id'].'" name="ShopIdJd" style="display: none"/><a href="javascript:void(0);" type="button" id="goZc" onclick="ZcJd()" class="dropdown-item"><i class="mdi mdi-close"></i> 拒绝接单(当前)</a>';}
											$DeleteShop='<input type="text" value="'.$row['unique_code'].'" name="ShopUnCode" style="display: none"/><input type="text" value="'.$row['id'].'" name="DeleteShopId" style="display: none"/><a href="javascript:void(0);" id="goDel" onclick="DeleteShop()" class="dropdown-item"><i class="mdi mdi-delete mr-1"></i>删除</a>';
											echo '
											 <div class="col-md-6 col-xl-3">
                                <div class="card d-block">
                                    <div class="card-body">
                                        <div class="dropdown card-widgets">
                                            <a href="#" class="dropdown-toggle arrow-none" data-toggle="dropdown" aria-expanded="false">
                                                <i class="dripicons-dots-3"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
											    <a href="./oreo_shop_seo.php?shop_id='.$row['id'].'" class="dropdown-item"><i class="mdi mdi-cursor-default-click-outline"></i> SEO数据</a>
                                                <!-- item-->
                                                <a href="./oreo_shop_edit.php?shop_id='.$row['id'].'&shop_seller='.$row['seller'].'&shop_safe_code='.$row['unique_code'].'" class="dropdown-item"><i class="mdi mdi-border-color"></i> 编辑</a>
                                                <!-- item-->
                                                '.$DeleteShop.'
                                                <!-- item-->
                                                '.$statesicon.'
                                            </div>
                                        </div>
                                        <!-- project title-->
                                        <h4 class="mt-0">
                                            <a href="./oreo_shop_guarantees.php?shop_id='.$row['id'].'" class="text-title">'.$row['name'].'</a>
                                        </h4>
                                        '.$states.'
                                        <p class="text-muted font-13 mb-3">'.$row['text'].'<a href="./oreo_shop_guarantees.php?shop_id='.$row['id'].'" class="font-weight-bold text-muted"> ...详细</a>
                                        </p>
                                        <p class="mb-1">
                                            <span class="pr-2 text-nowrap mb-2 d-inline-block">
                                                <i class="mdi mdi-format-list-bulleted-type text-muted"></i>
                                                <b>'.$shops.'个</b> 卖出
                                            </span>
											<span class="pr-2 text-nowrap mb-2 d-inline-block">
                                                <i class="mdi mdi-format-list-bulleted-type text-muted"></i>
                                                <b>'.$dianjis.'</b> 曝光
                                            </span>
                                            <span class="text-nowrap mb-2 d-inline-block">
                                                <i class="mdi mdi-comment-multiple-outline text-muted"></i>
                                                <b>'.round($row['evaluate_good']+$row['evaluate_bad']).'</b> 评价
                                            </span>
                                        </p>
                                        <div>
                                            '.$new_shop.'
                                            <a href="javascript:void(0);" class="d-inline-block text-muted font-weight-bold ml-2">
                                                 最近
                                            </a>
                                        </div>
                                    </div> <!-- end card-body-->
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item p-3">
                                            <!-- project progress-->
                                            <p class="mb-2 font-weight-bold">好评率 <span class="float-right">'.$goods.'%</span></p>
                                            <div class="progress progress-sm">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: '.$goods.'%;">
                                                </div><!-- /.progress-bar -->
                                            </div>
                                        </li>
                                    </ul>
                                </div> 
                            </div> ';}
?>    
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
        <!-- END Container -->
        <!-- App js -->
<script src="../../assets/user/js/app.min.js"></script>
<script src="../../assets/user/js/layer.js"></script>
<script> 	
		function ZcJd(){
		var rzForm = new FormData(); 
		rzForm.append("shopid",$("input[name='ShopIdJd']").val());  
		rzForm.append("shopuncode",$("input[name='ShopUnCode']").val());  
		var ii = layer.load(2, {shade: [0.1, '#fff']});
		$.ajax({
			url: "oreo_shop_sub.php?act=Commodity_ZcJd",
			type : "POST",
			dataType : 'JSON', 
			data : rzForm,
			cache: false,
			processData: false,
			contentType: false,
			success: function (data) {
								layer.close(ii);
								if (data.code == 1) {
									layer.alert('状态成功设置为：正常接单', function(index) {
                                    layer.close(index);
                                    location.reload();
                                    })
								} else {
									layer.alert(data.msg);
								}
							}
        })
	}
		function JjDz(){
		var rzForm = new FormData(); 
		rzForm.append("shopid",$("input[name='ShopIdJj']").val());  
		rzForm.append("shopuncode",$("input[name='ShopUnCode']").val());  
		var ii = layer.load(2, {shade: [0.1, '#fff']});
		$.ajax({
			url: "oreo_shop_sub.php?act=Commodity_JjDz",
			type : "POST",
			dataType : 'JSON', 
			data : rzForm,
			cache: false,
			processData: false,
			contentType: false,
			success: function (data) {
								layer.close(ii);
								if (data.code == 1) {
									layer.alert('状态成功设置为：拒绝接单', function(index) {
                                    layer.close(index);
                                    location.reload();
                                    })
								} else {
									layer.alert(data.msg);
								}
							}
        })
	}
		function DeleteShop(){
		var rzForm = new FormData(); 
		rzForm.append("shopid",$("input[name='DeleteShopId']").val());  
		rzForm.append("shopuncode",$("input[name='ShopUnCode']").val());  
		var ii = layer.load(2, {shade: [0.1, '#fff']});
		$.ajax({
			url: "oreo_shop_sub.php?act=Commodity_DelShop",
			type : "POST",
			dataType : 'JSON', 
			data : rzForm,
			cache: false,
			processData: false,
			contentType: false,
			success: function (data) {
								layer.close(ii);
								if (data.code == 1) {
									layer.alert('商品删除成功', function(index) {
                                    layer.close(index);
                                    location.reload();
                                    })
								} else {
									layer.alert(data.msg);
								}
							}
        })
	}	
</script>
    </body>

</html>