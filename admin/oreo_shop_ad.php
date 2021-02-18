<?php
include "../oreo/oreo.core.php";
include './oreo_static.php';
if ($islogin == 1) {
} else {
    exit("<script language='javascript'>window.location.href='./login.php';</script>");
}
?>
                  <div class="page-content-wrapper ">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="page-title-box">
                                        <div class="btn-group float-right">
                                            <ol class="breadcrumb hide-phone p-0 m-0">
                                                <li class="breadcrumb-item"><a href="#">控制台</a></li>
                                                <li class="breadcrumb-item"><a href="#">系统参数</a></li>
                                                <li class="breadcrumb-item active">商业广告配置</li>
                                            </ol>
                                        </div>
                                        <h4 class="page-title">商业广告配置</h4>
                                    </div>
                                </div>
                            </div>
                            <!-- end page title end breadcrumb -->
                            <div class="row">
                                <div class="col-lg98-6">
                                    <div class="card m-b-30">
                                        <div class="card-body">
                                            <h4 class="mt-0 header-title">商业广告配置说明</h4>
                                            <p class="text-muted m-b-30 font-14">在这里您可以设置平台的商业广告参数，请认真填写每一项，如需设置授权程序的广告位请到-    添加授权程序

添加授权程序-设置。 否则用户不能正常购买广告位！</p>
                                                <div class="form-group">
                                                    <label>商业广告开关</label>
                                                  <select  class="form-control" name="shop_ad"  id="shop_ad"  onchange="sh_rg('sh',this.value)">
                                                  <option value="0" <?=$conf['shop_ad']==0?"selected":""?> >关闭</option>
												  <option value="1" <?=$conf['shop_ad']==1?"selected":""?> >开启</option>
                                                 </select>
												 <small>* 关闭则用户无法购买广告位，用户中心中不显示广告位销售页面。</small>
                                                </div>
												<div  id="sh_reg"  style="<?php echo $conf['shop_ad'] == 1 ? "" : "display: none;";?>">
                                                <div class="form-group">
                                                    <label>站内广告价格</label>
                                                    <div>
                                                      <input type="text" class="form-control" name="z_ad_money"  placeholder="如：20" value="<?php echo $conf['z_ad_money']; ?>" class="form-control"/>
                                                    </div>
                                                </div>
												<div class="form-group" >
                                                    <label>站内广告说明</label>
                                                    <div>
                                                       <textarea rows="4"  name="z_ad_text" class="form-control"  placeholder="如：<li>站内广告20元/月</li> ,建议4个，多了或者少了影响美观" ><?php echo $conf['z_ad_text'];?></textarea> 
                                                    </div>
                                                </div>	
											</div>                    
                                                <div class="form-group m-b-0">
                                                    <div>
                                                         <button type="button" id="shopad"  value="保存修改" class="btn btn-primary waves-effect waves-light" >
                                                            提交
                                                        </button>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div> <!-- end col -->
                </div> <!-- content -->
                <footer class="footer">
                  <?php echo $conf['copyright']; ?>.
                  <div><?php echo $conf['beian']; ?>.</div>
                </footer>
            <?php include'oreo_foot.php';?>
		<script>
	function sh_rg(type,val){
    var gb  = $("#"+type+"_reg");
    if(val == 0){
       $(gb).hide() 
    }
    if(val == 1){
       $(gb).show()
    }        
}
		 $("#shopad").click(function () {
					    var shop_ad = $("#shop_ad").val();	
						var z_ad_money=$("input[name='z_ad_money']").val();						
						var z_ad_text=$("textarea[name='z_ad_text']").val();
						var ii = layer.load(2, {shade: [0.1, '#fff']}); 
						$.ajax({
							type: "POST",
							url: "ajax.php?act=edit_ZAdinput",
							data: {shop_ad:shop_ad,z_ad_money:z_ad_money,z_ad_text:z_ad_text},
							dataType: 'json',
							success: function (data) {
								layer.close(ii);
								if (data.code == 1) {
									layer.alert('修改成功', function(index) {
                                    layer.close(index);
                                    location.reload();
                                    })
								} else {
									layer.alert(data.msg);
								}
							}
						});
					});
</script>
    </body>
</html>