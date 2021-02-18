<?php
include("../../oreo/oreo.core.php");
if($islogin2==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
include './oreo_shop_static.php';
$ktztc=$DB->query("SELECT user FROM `oreo_authsys` WHERE concat(',',user,',') LIKE '%,$pid,%'")->fetch();
if($userrow['action']==0){
exit("<script language='javascript'>alert('您的账号已被封禁，暂无法登陆后台');window.location.href='./login.php?logout';</script>");
}
if(!$_GET)exit("<script language='javascript'>window.location.href='./oreo_shop_commodity.php';</script>");
$shop_id=$_GET['shop_id'];
$seller=$_GET['shop_seller'];
$unique_code=$_GET['shop_safe_code'];
$shop_cx=$DB->query("select * from oreo_shop_guarantee where id='$shop_id' and unique_code='$unique_code' and seller='$seller' order by id desc limit 1")->fetch();
if(!$shop_cx)exit("<script language='javascript'>window.location.href='./oreo_shop_commodity.php';</script>");
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
                                            <li class="breadcrumb-item active">编辑商品</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">编辑商品</h4>
                                </div> <!-- end page-title-box -->
                            </div> <!-- end col-->
                        </div>
                        <!-- end page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">编写您的商品</h4>
                                        <p class="text-muted font-14 mb-3">
                                            请一定按照说明来编写您的商品详情内容.
                                        </p>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                    <label>商品名称</label>
                                                    <input type="text" class="form-control" maxlength="25" data-toggle="maxlength" name="name" value="<?=$shop_cx['name'];?>" >
                                                    <input type="text" value="<?=$shop_id;?>" name="shop_id" style="display: none"/>
													<input type="text" value="<?=$seller;?>" name="shop_seller" style="display: none"/>
													<input type="text" value="<?=$unique_code;?>" name="shop_safe_code" style="display: none"/>
												</div>
												<div class="form-group mb-3">
                                                        <label>商品图标</label><br>
                                                        <img src="<?=$shop_cx['photo'];?>" alt="user-image" class="card-img-top" style="max-width:280px;">
                                                </div>
                                                <div class="form-group mb-3">
                                                        <label for="example-fileinput">新商品图标(小于200K,无需修改留空)</label>
                                                        <input type="file" name="photo" id="photo" class="form-control-file">
                                                    </div>
												<div class="form-group mb-3">
                                                    <label>商品价格</label>
                                                    <input data-toggle="touchspin" type="text" data-bts-prefix="¥" name="money" value="<?=$shop_cx['money'];?>"/>
                                                </div>	
												<div class="form-group mb-3">
                                                    <label>库存 - (最多 200)</label>
                                                    <input data-toggle="touchspin" data-bts-max="200" data-btn-vertical="true" type="text" name="stock" value="<?=$shop_cx['stock'];?>" />
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label>商品简介</label>
                                                    <textarea data-toggle="maxlength" class="form-control" maxlength="225" rows="3" 
                                                        placeholder="最多255个字符." name="text" ><?=$shop_cx['text'];?></textarea>
                                                </div>
                                                 <input type="hidden" name="module" value="<?php echo $module;?>"/>
                                                 <input type="hidden" name="timestamp" value="<?php echo time();?>"/>
                                                 <input type="hidden" name="token" value="<?php echo md5($module.'#$@%!^*'.time());?>"/>
												<div class="form-group mb-3">
                                                        <label for="example-select">商品状态</label>
                                                        <select class="form-control" id="type" name="type" >
                                                            <option value="1"  <?=$shop_cx['type']==1?"selected":""?>>正常接单</option>
                                                            <option value="2"  <?=$shop_cx['type']==2?"selected":""?>>拒绝接单</option>
                                                        </select>
                                                    </div>
												<div style="text-align:center">
												<button name="addshop" value="addshop" id="go" onclick="addshop()" class="btn btn-primary">修改</button>
												 </div>
                                            </div> <!-- end col -->  
                                        </div>
                                        <!-- end row -->
                                    </div> <!-- end card-body -->
                                </div> <!-- end card-->
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
        </div>
        <!-- App js -->
       <script src="../../assets/user/js/app.min.js"></script>
		<script src="../../assets/user/js/layer.js"></script>
<script> 	
		function addshop(){
		var rzForm = new FormData(); 
		rzForm.append("shop_id",$("input[name='shop_id']").val()); 
		rzForm.append("shop_seller",$("input[name='shop_seller']").val()); 
		rzForm.append("shop_safe_code",$("input[name='shop_safe_code']").val()); 
		rzForm.append("name",$("input[name='name']").val()); 
		rzForm.append("money",$("input[name='money']").val()); 
		rzForm.append("stock",$("input[name='stock']").val()); 
		rzForm.append("text",$("textarea[name='text']").val()); 
		rzForm.append("module",$("input[name='module']").val()); 
		rzForm.append("timestamp",$("input[name='timestamp']").val()); 
		rzForm.append("token",$("input[name='token']").val()); 
		rzForm.append("type",$("#type").val());
		rzForm.append("photo",$('#photo')[0].files[0]); 
		var ii = layer.load(2, {shade: [0.1, '#fff']});
		$.ajax({
			url: "oreo_shop_sub.php?act=Edit_My_Shops",
			type : "POST",
			dataType : 'JSON', 
			data : rzForm,
			cache: false,
			processData: false,
			contentType: false,
			success: function (data) {
								layer.close(ii);
								if (data.code == 1) {
									layer.alert('修改成功', function(index) {
                                    layer.close(index);
                                    location.href="oreo_shop_commodity.php"; 
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