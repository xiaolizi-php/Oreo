<?php
include("../../oreo/oreo.core.php");
if($islogin2==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
include './oreo_shop_static.php';
$ktztc=$DB->query("SELECT user FROM `oreo_authsys` WHERE concat(',',user,',') LIKE '%,$pid,%'")->fetch();
if($userrow['action']==0){
exit("<script language='javascript'>alert('您的账号已被封禁，暂无法登陆后台');window.location.href='./login.php?logout';</script>");
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
                                            <li class="breadcrumb-item active">添加商品</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">添加商品</h4>
                                </div> <!-- end page-title-box -->
                            </div> <!-- end col-->
                        </div>
                        <!-- end page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">填写详细内容</h4>
                                        <p class="text-muted font-14 mb-3">
                                            请一定按照说明来编写您的商品详情内容.
                                        </p>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                    <label>商品名称</label>
                                                    <input type="text" class="form-control" maxlength="25" data-toggle="maxlength" name="name">
                                                </div>
                                                <div class="form-group mb-3">
                                                        <label for="example-fileinput">商品图标(小于200K)</label>
                                                        <input type="file" name="photo" id="photo" class="form-control-file">
                                                    </div>
												<div class="form-group mb-3">
                                                    <label>商品价格</label>
                                                    <input data-toggle="touchspin" type="text" data-bts-prefix="¥" name="money">
                                                </div>	
												<div class="form-group mb-3">
                                                    <label>库存 - (最多 200)</label>
                                                    <input data-toggle="touchspin" data-bts-max="200" value="1" data-btn-vertical="true" type="text" name="stock"/>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label>商品简介</label>
                                                    <textarea data-toggle="maxlength" class="form-control" maxlength="225" rows="3" 
                                                        placeholder="最多255个字符." name="text"></textarea>
                                                </div>
												<div class="form-group mb-3">
                                                        <label for="example-select">商品状态</label>
                                                        <select class="form-control" id="type" name="type" >
                                                            <option value="1">正常接单</option>
                                                            <option value="2">拒绝接单</option>
                                                        </select>
                                                    </div>
												<div style="text-align:center">
												<button name="addshop" value="addshop" id="go" onclick="addshop()" class="btn btn-primary">添加</button>
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
		rzForm.append("addshop","addshop"); 
		rzForm.append("name",$("input[name='name']").val()); 
		rzForm.append("money",$("input[name='money']").val()); 
		rzForm.append("stock",$("input[name='stock']").val()); 
		rzForm.append("text",$("textarea[name='text']").val()); 
		rzForm.append("type",$("#type").val());
		rzForm.append("photo",$('#photo')[0].files[0]); 
		var ii = layer.load(2, {shade: [0.1, '#fff']});
		$.ajax({
			url: "oreo_shop_sub.php?act=Add_My_Shops",
			type : "POST",
			dataType : 'JSON', 
			data : rzForm,
			cache: false,
			processData: false,
			contentType: false,
			success: function (data) {
								layer.close(ii);
								if (data.code == 1) {
									layer.alert('添加成功', function(index) {
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